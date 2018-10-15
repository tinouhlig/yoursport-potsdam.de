@extends('public.index')

@section('title')
    Kursplan
@endsection

@section('content')
<div id="page-kursplan">
    <section id ="kursplan" class="bg-tafel">
        <div class="container-fluid">
            <div class="row no gutter">
                <div class="col-lg-8 col-lg-offset-2 text-center">
                    <h2 class="light-heading">Kursplan</h2>
                    <hr class="hr-primary">
                </div>
            </div>
            @if(\Auth::check())
                @if(\Auth::user()->nachholkurse()->gueltig()->get()->count() > 0)
                    <div class="row no gutter">
                        <div class="col-lg-8 col-lg-offset-2 text-center">
                            <p class="text-light">Du kannst aktuell {{ (\Auth::user()->nachholkurse()->gueltig()->get()->count() > 1 ? \Auth::user()->nachholkurse()->gueltig()->get()->count().' Kurse' : \Auth::user()->nachholkurse()->gueltig()->get()->count().' Kurs') }}  nachholen.</p>
                            <hr class="hr-primary">
                        </div>
                    </div>
                @endif
            @endif
            <div class="row kursplan-navigation">
                <div class="col-xs-2 col-xs-offset-1">
                        <a href="{{ route('kursplan', ['year' => $prevWeek->format('Y'), 'week' => $prevWeek->format('W')]) }}" class="btn button-primary">
                            <i class="fa fa-reply"></i> {{ $prevWeek->format('W') }}. Kalenderwoche
                        </a>
                </div>
                <div class="col-xs-2 col-xs-offset-6">
                    <div class="pull-right">
                        <a href="{{ route('kursplan', ['year' => $nextWeek->format('Y'), 'week' => $nextWeek->format('W')]) }}" class="btn button-primary">
                            {{ $nextWeek->format('W') }}. Kalenderwoche <i class="fa fa-share"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="kursplan-container hidden-sm hidden-xs"> {{-- anfang container-kursplan --}}
                    {{-- <div class="gapRow" style="top: {{ $gapMargin }}px;"></div> --}}
                    <div class="col-lg-1 span-column"></div>
                    @for ($dayOfWeek = 0; $dayOfWeek < 7 ; $dayOfWeek++)
                            <div class="col-lg-1 kursplan-column no-padding">
                                <div class="kursplan-header">
                                    <p>
                                        {{ $weekDayDE[$startOfWeek->format('l')] }} <br>
                                        <span class="kursplan-day-date">{{ $startOfWeek->format('d.m.Y') }}</span>
                                    </p>
                                </div>
                                @if ($coursedates->has($startOfWeek->format('Y-m-d')))
                                    @foreach ($coursedates[$startOfWeek->format('Y-m-d')] as $coursedate)
                                        <div class="kursplan-cell {{ $coursedate->getVisible()['kursbesucher'] ? 'kursbesucher' : '' }} " style="margin-top: {{ $coursedate->getVisible()['margin-top'] }}px;">
                                            <p>
                                                {{ $coursedate->course->name_kursplan }}<br>
                                                {{ $coursedate->course->start_end_time }}<br>
                                                {{ $coursedate->freie_plaetze }}
                                            </p>
                                            <div class="kursplan-cell-hover">
                                                {{-- <a href="{{ route('kurs', $coursedate->course->coursetype->slug) }}" class="btn button-primary-border">Zum Kurs ></a> --}}
                                                @if(\Auth::check())
                                                    @if((\Auth::user()->nachholkurse()->gueltig()->get()->count() > 0) && 
                                                        $coursedate->isComing() && 
                                                        !$coursedate->getVisible()['kursbesucher'] &&
                                                        $coursedate->hasFreeSpots())
                                                        <a href="{{ route('profile::coursedate_attach', $coursedate->id) }}" @click.prevent="showNachholkursanmeldungModal" class="btn btn-sm button-primary-border">Jetzt nachholen</a>
                                                    @else
                                                        <a href="{{ route('kurs', $coursedate->course->coursetype->slug) }}" class="btn button-primary-border">Zum Kurs ></a>
                                                    @endif
                                                    @if($coursedate->isComing() && $coursedate->getVisible()['kursbesucher'])
                                                        <a href="{{ route('profile::coursedate_detach', [ 'coursedate_id' => $coursedate->id ]) }}" @click.prevent="showKursabmeldungModal" class="btn btn-sm button-primary-border">Abmelden</a>
                                                    @endif
                                                @else
                                                    <a href="{{ route('kurs', $coursedate->course->coursetype->slug) }}" class="btn button-primary-border">Zum Kurs ></a>
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                            <?php $startOfWeek->addDay(); ?>
                    @endfor
                </div> {{-- ende container-kursplan --}}

                <div class="kursplan-container-small hidden-md hidden-lg">
                    <div id="kursplan-carousel" class="carousel slide">
                        <!-- Wrapper for slides -->
                        <div class="carousel-inner" role="listbox">
                            @for ($dayOfWeek = 0; $dayOfWeek < 7 ; $dayOfWeek++)
                                <div class="item {{ (($startOfWeekCopy->isToday() || (!$startOfWeekCopy->between(Carbon\Carbon::today()->startOfWeek(), Carbon\Carbon::today()->endOfWeek())) && $dayOfWeek == 0 ) ? 'active' : '') }}">
                                    <div class="row">
                                        <div class="kursplan-header">
                                            <p>
                                                {{ $weekDayDE[$startOfWeekCopy->format('l')] }} <br>
                                                <span class="kursplan-day-date">{{ $startOfWeekCopy->format('d.m.Y') }}</span>
                                            </p>
                                        </div>
                                    </div>
                                    @if ($coursedates->has($startOfWeekCopy->format('Y-m-d')))
                                        @foreach ($coursedates[$startOfWeekCopy->format('Y-m-d')] as $coursedate)
                                            <div class="row flex">
                                                <div class="col-xs-4 col-xs-offset-2 kursplan-cell-small">
                                                    <p class="text-center text-light">
                                                        {{ $coursedate->course->name_kursplan }}<br>
                                                        {{ $coursedate->course->start_end_time }}<br>
                                                        {{ $coursedate->freie_plaetze }}
                                                    </p>
                                                </div>
                                                <div class="col-xs-4 text-center kursplan-cell-small">
                                                    <a href="{{ route('kurs', $coursedate->course->coursetype->slug) }}" class="btn button-primary">Zum Kurs ></a>
                                                    @if(\Auth::check())
                                                        @if((\Auth::user()->nachholkurse()->gueltig()->get()->count() > 0) && $coursedate->isComing() && !$coursedate->getVisible()['kursbesucher'] && $coursedate->hasFreeSpots())
                                                            <a href="{{ route('profile::coursedate_attach', $coursedate->id) }}" @click.prevent="showNachholkursanmeldungModal" class="btn button-primary">Jetzt nachholen</a>
                                                        @endif
                                                        @if($coursedate->isComing() && $coursedate->getVisible()['kursbesucher'])
                                                            <a href="{{ route('profile::coursedate_detach', [ 'coursedate_id' => $coursedate->id ]) }}" @click.prevent="showKursabmeldungModal" class="btn button-primary">Abmelden</a>
                                                        @endif
                                                    @endif
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                                 <?php $startOfWeekCopy->addDay(); ?>
                            @endfor
                        </div>

                      <!-- Controls -->
                    <a class="left carousel-control" href="#kursplan-carousel" role="button" data-slide="prev">
                        <span class="fa fa-angle-left fa-2x" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="right carousel-control" href="#kursplan-carousel" role="button" data-slide="next">
                        <span class="fa fa-angle-right fa-2x" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
        </div>
    </section>
    @if (! \Auth::check())
        <section id="kurse">
            <div class="container text-center">
                <div class="row">
                    <div class="col-xs-12"><a href="" class="btn button-primary button-large" @click.prevent="showKursanmeldungModal">Jetzt anmelden ></a></div>
                </div>
            </div>
        </section>
    @endif
    <kursplankursanmeldungmodal :show.sync="showKursanmeldung"></kursplankursanmeldungmodal>
    <kursplankursabmeldungmodal :show.sync="showKursabmeldung" :link="linkKursabmeldung"></kursplankursabmeldungmodal>
    <kursplannachholanmeldungmodal :show.sync="showNachholkursanmeldung" :link="linkKursanmeldung"></kursplannachholanmeldungmodal>
    @include('public._partials._vue-components._kursplan')
</div>
@endsection

@section('scripts')
    @parent
    <script type="text/javascript">
        $('.carousel').carousel({
            interval: false
        }).on('slide.bs.carousel', function (e) {
            var nextH = $(e.relatedTarget).height();
            $(this).find('.active.item').parent().animate({
                height: nextH
            }, 500);
        });
    </script>
@endsection
