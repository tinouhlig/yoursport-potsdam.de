@extends('public.index')

@section('title')
    {{ $kurstyp->name }}
@endsection

@section('content')
    <section id ="kurs" class="bg-tafel">
        <div class="container-fluid">
        <div class="row">
            <div class="col-xs-8 col-xs-offset-2 text-center">
                <h2 class="light-heading">{{ $kurstyp->name }}</h2>
                <hr class="hr-primary">
            </div>
        </div>
        <div class="row text-center kurs-cta-section">
            @if (Auth::check())
                <div class="col-xs-12"><a href="{{ route('kursplan') }}" class="btn button-primary button-xs kurs-button">Zum Kursplan ></a></div>
            @else
                <div class="col-xs-6 col-lg-offset-2 col-lg-4"><a href="" class="btn button-primary button-xs kurs-button" @click.prevent="showKursanmeldungModal">Jetzt anmelden ></a></div>
                <div class="col-xs-6 col-lg-4"><a href="{{ route('kursplan') }}" class="btn button-primary button-xs kurs-button">Zum Kursplan ></a></div>
            @endif
        </div>
        <div class="row">
            <div class="col-md-5 kurs-column col-md-offset-1">
                <div class="kursbeschreibung text-light">
                    {!! $kurstyp->description !!}
                </div>
                @if (!$kurstrainer->isEmpty())
                    <div class="row text-center">
                        <div class="col-lg-8 col-lg-offset-2">
                             @if (count($kurstrainer)>1)
                                <h3 class="light-heading ">Eure Trainer</h3>
                                <hr class="hr-primary">
                            @else
                                <h3 class="light-heading ">Euer Trainer</h3>
                                <hr class="hr-primary">
                            @endif
                        </div>
                    </div>
                    <div class="kurstrainer-container text-center">
                        @foreach ($kurstrainer as $trainer)
                            <div class="kurstrainer">
                                @if (file_exists('img/trainer/'.$trainer['slug'].'.png'))
                                    <div class="trainer-img"><img src="/img/trainer/{{$trainer['slug']}}.png" class="img-responsive wow fadeIn" data-wow-delay=".1s" data-wow-offset="150" alt=""></div>
                                @endif
                                <h3 class="light-heading">{{ $trainer['first_name'] }}</h3>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            <div class="col-md-5 kurs-column">
                <div class="row hidden-xs hidden-sm">
                    <div class="col-lg-8 col-lg-offset-2">
                        <div class="kurs-img"><img src="/img/kurse/{{$kurstyp->slug}}.jpg" class="img-responsive wow fadeIn" data-wow-delay=".1s" data-wow-offset="150" alt=""></div>
                    </div>
                </div>
                <div class="row kurs-termine">
                    <div class="col-lg-12 text-center text-light">
                        @if (!$gruppenkurse->isEmpty())
                            <h3 class="light-heading ">Gruppenkurse</h3>
                            <hr class="hr-primary">
                            @foreach ($gruppenkurse as $tag => $kurse)
                                <div class="kurs-termin">
                                    <h4 class="light-heading">{{ $tag }}</h4>
                                    @foreach ($kurse as $kurs)
                                        <p>{{ $kurs->start_end_time }}</p>
                                    @endforeach
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
        </div>
        <kurskursanmeldungmodal :show.sync="showModal"></kurskursanmeldungmodal>
        @include('public._partials._vue-components._kurs-kursanmeldungModal')
    </section>
@endsection
