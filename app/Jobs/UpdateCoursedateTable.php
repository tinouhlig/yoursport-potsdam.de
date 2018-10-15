<?php

namespace Yours\Jobs;

use Log;
use Carbon\Carbon;
use Yours\Jobs\Job;
use Yours\Models\Course;
use Yours\Models\Coursedate;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Contracts\Bus\SelfHandling;

class UpdateCoursedateTable extends Job implements SelfHandling, ShouldQueue
{
    use SerializesModels, InteractsWithQueue;

    /**
     * Update or Create Coursedates for Courses. 
     * Called by artisan command 'coursedate:update', by cronjob and from controller
     *
     * @return void
     */
    public function handle()
    {
        $max_befristung = Carbon::now()->addYears(2);

        $courses = Course::with('coursedate')->active()->get();

        foreach ($courses as $course) {
            $coursedates = $this->getCoursedates($course);
            
            if ($course->coursedate()->saveMany($coursedates) || empty($coursedates)) {
                Log::info('Coursedates für '.$course->name_day.' wurden erfolgreich eingepflegt');
            } else {
                Log::error('FEHLER bei Coursedateanlage für '.$course->name_day);
            }
            
        }
    }
    
    /**
     * Check if Coursedates exist and returns all Coursedates for the next 2 years which need to be imported
     * @param  mixed $course
     * @return array $coursedates         [Array containing Coursedates for the Course]
     */
    private function getCoursedates($course)
    {
        $heute = Carbon::parse('this '.$course->day_english);
        $start = Carbon::createFromFormat('Y-m-d', $course->start);
        $befristung = ($course->end == '0000-00-00' ? Carbon::now()->addYears(2) : Carbon::parse($course->end));
        
        $coursedate_array = $course->coursedate->toArray();

        $active_date = $heute;
        $coursedates = [];


        while ($active_date <= $befristung) {
            $in_array = false;

            foreach ($coursedate_array as $coursedate) {
                if ($active_date->format('Y-m-d') == $coursedate['date']) {
                    $in_array = true;
                }
            }

            if ($active_date >= $start &&  !$in_array) {
                $coursedates[] = new Coursedate(['date' => $active_date->format('Y-m-d')]); 
            }


            $active_date->addDays(7);
        }

        return $coursedates;
    }
}
