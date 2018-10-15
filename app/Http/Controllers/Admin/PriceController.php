<?php

namespace Yours\Http\Controllers\Admin;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Yours\Http\Controllers\Controller;
use Yours\Http\Requests;
use Yours\Http\Requests\CreatePriceRequest;
use Yours\Http\Requests\UpdatePriceRequest;
use Yours\Models\BookedPrice;
use Yours\Models\Price;
use Yours\Models\User;
use Yours\Repositories\Eloquent\PriceRepository as PriceRepository;

class PriceController extends Controller
{
    protected $priceRepo;

    function __construct(PriceRepository $priceRepo)
    {
        $this->priceRepo = $priceRepo;
    }

    public function showDashboard()
    {
        return view('admin.finance.dashboard');
    }

    public function showExpiringContracts()
    {
        $contracts = BookedPrice::with('user', 'price')->contract()->active()->get()
                    ->filter(function ($contract) {
                        $kuendigungsfrist = $contract->extensions_count > 0 ? $contract->price->further_cancel_period : $contract->price->first_cancel_period;
                        return $contract->expire_at->subMonths($kuendigungsfrist)->lte(Carbon::now());
                    });

        return view('admin.finance.expiring', compact('contracts'));
    }

    public function extendExpiringContracts(BookedPrice $contract)
    {
        if ($contract->cancelled) {
            flash()->error('Vertrag wurde bereits gekündigt.');
            return redirect()->back();
        }
        if ( !$contract->price->isContract() ) {
            flash()->error('Wochenkarten können nicht verlängert werden!');
            return redirect()->back();
        }

        $old_expire_at = $contract->expire_at;
        $new_expire_at = $contract->expire_at->addMonths($contract->price->contract_extension)->toDateString();
        
        $contract->expire_at = $new_expire_at;
        $contract->extensions_count += 1;
        $contract->save();

        $booked_courses = $contract->user->course()->where('price_user_id', $contract->id)->get();

        foreach ($booked_courses as $course) {
            $coursedates = $course->coursedate()->active()->minDate($old_expire_at)->maxDate($new_expire_at)->lists('id')->toArray();
            $contract->user->coursedate()->attach($coursedates);
        }

        flash()->success('Der Vertrag von '. $contract->user->fullname .' wurde erfolgreich verlängert.');
        return redirect()->back();
    }

    public function showActiveContracts()
    {
        $contracts = BookedPrice::with('user', 'price')->active()->contract()->get();

        return view('admin.finance.active', compact('contracts'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function showPrices()
    {
        $prices = $this->priceRepo->all();

        return view('admin.finance.show_prices', compact('prices'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.finance.create_price');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(CreatePriceRequest $request)
    {
        $input = $request->all();

        if ($input['course_count']=='') {
            $input['course_count'] = -1;
        }

        $this->priceRepo->create($input);

        flash()->success('Preis wurde erfolgreich angelegt.');

        return redirect()->route('admin::prices');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show(Price $price)
    {
        return view('admin.finance.show_price_data', compact('price'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit(Price $price)
    {
        return view('admin.finance.edit_price_data', compact('price'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(UpdatePriceRequest $request, Price $price)
    {
        $input = $request->all();

        if ($input['course_count']=='') {
            $input['course_count'] = -1;
        }

        $price->fill($input)->sluggify()->save();

        flash()->success('Preis wurde erfolgreich bearbeitet.');

        return redirect()->route('admin::prices_show', $price->slug);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy(Price $price)
    {
        $this->priceRepo->delete($price->id);

        flash()->success('Preis wurde erfolgreich gelöscht.');

        return redirect()->back();
    }
}
