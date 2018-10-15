@extends('public.index')

@section('title')
    Kursübersicht
@endsection

@section('content')
    <section id ="kurse" class="bg-tafel">
        <div class="row text-center no-margin">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2">
                        <h2 class="light-heading">Kursangebote</h2>
                        <hr class="hr-primary">
                    </div>
                </div>
                <div class="row">
                        <div class="col-xs-6">
                            <div class="kurs-link">
                                <a href="{{ route('kurs', 'pilates') }}">Pilates</a>
                                <em class="center-block text-light">Trainiert Bauch- Beine und Po, sowie den Rücken, baut Stress ab und sorgt für Entspannung</em>
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="kurs-link">
                                <a href="{{ route('kurs', 'power-yoga') }}">Power Yoga</a>
                                <em class="center-block text-light">Dehnt schonend verkürzte Muskeln und trainiert die Rücken- und Nackenmuskulatur</em>
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="kurs-link">
                                <a href="{{ route('kurs', 'yogilates') }}">Yogilates</a>
                                <em class="center-block text-light">Trainiert Bauch- Beine und Po, sowie den Rücken und hilft zu entspannen</em>
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="kurs-link">
                                <a href="{{ route('kurs', 'zumba-fitness') }}">Zumba Fitness</a>
                                <em class="center-block text-light">Trainiert vor allem das Herz-Kreislauf-System, sowie die Beine und den Po</em>
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="kurs-link">
                                <a href="{{ route('kurs', 'rueckentraining') }}">Rückentraining</a>
                                <em class="center-block text-light">Beugt Rückenschmerzen vor, hilft aber auch bei bereits bestehenden Rücken- und Nackenschmerzen</em>
                            </div>
                        </div>
                </div>
            </div>
            {{-- <div class="col-md-5">
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2">
                        <h2 class="light-heading">weitere Angebote</h2>
                        <hr class="hr-primary">
                    </div>
                </div>
                <div class="row gruppenkurse-rechts">
                    <div class="col-lg-12">
                        <div class="kurs-link">
                            <a href="{{ route('kurs', $kurs->slug) }}">{{$kurs->name}}</a>
                        </div>
                    </div>
                </div>
            </div> --}}
        </div>
    </section>

    <section id="kursplan">
        <div class="container text-center">
            <div class="row">
                <div class="col-xs-6"><a href="{{ route('kursplan') }}" class="btn button-primary button-large">Zum Kursplan ></a></div>
                <div class="col-xs-6"><a href="{{ route('home') }}#kontakt" class="btn button-primary button-large">Jetzt anmelden ></a></div>
            </div>
        </div>
    </section>

    <section id="trainer" class="bg-tafel">
        <div class="container-fluid trainer-container text-center">
            <div class="col-lg-8 col-lg-offset-2">
                <h2 class="light-heading">Unsere Trainer</h2>
                <hr class="hr-primary">
            </div>
            <div class="row">
                <div class="col-sm-4">
                    <div class="trainer-img"><img src="/img/trainer/ariane-woitalla.png" class="img-responsive wow fadeIn" data-wow-delay=".1s" data-wow-offset="150" alt=""></div>
                    <h3 class="light-heading">Ariane</h3>
                    <p class="text-light">
                        ... Diplom Sportwissenschaftlerin und gibt bereits seit mehreren Jahren freiberuflich Kurse in Berlin und Potsdam. Im Studio Yours ist Sie Kurstrainerin für Rückentraining.
                    </p>
                </div>
                <div class="col-sm-4">
                    <div class="trainer-img"><img src="/img/trainer/selina-kuehlwein.png" class="img-responsive wow fadeIn" data-wow-delay=".1s" data-wow-offset="150" alt=""></div>
                    <h3 class="light-heading">Selina</h3>
                    <p class="text-light">
                        ... ist die Inhaberin des Studio YOURS und Masterabsolventin in Sportwissenschaft-Leistungssport. Bereits während ihres Bachelorstudiums Sportmanagement war sie als Pilates- und Personaltrainerin tätig.
                    </p>
                </div>
                <div class="col-sm-4">
                    <div class="trainer-img"><img src="/img/trainer/manfred-flath.png" class="img-responsive wow fadeIn" data-wow-delay=".1s" data-wow-offset="150" alt=""></div>
                    <h3 class="light-heading">Manfred</h3>
                    <p class="text-light">
                        ... ist seit 2 Jahren leidenschaftlicher Zumba Fitness Trainer. Seit 2015 bringt er die Teilnehmer im Studio Yours regelmäßig zum schwitzen. Darüber hinaus ist er lizensierter Trainer für Zumba Fitness, Gold, Kids, Aqua und Toning.
                    </p>
                </div>
            </div>
        </div>
    </section>
@endsection
