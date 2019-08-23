<!DOCTYPE html>
<html lang="de-DE">
    <head>
        <meta charset="utf-8">
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <meta name="description" content="Yours ist ein Fitnessstudio in Potsdam. Bei uns können Sie Pilates, Yoga, Zumba und Rückenkurse besuchen. Besuchen Sie uns im Studio oder schreiben Sie eine E-Mail." />
        <meta name="keywords" content="Pilates, Yoga, Zumba, Rückenkurs, Potsdam, Bornstedt, Kühlwein" />

        <title>@yield('title', 'Pilates und Yoga im YOURS - Potsdam')</title>

        {{-- included Styles --}}
        @include('public._partials._styles')

        <link rel="shortcut icon" type="image/x-icon" href="/favicon.ico">
    </head>
    <body id="page-top">
        @include('public._partials._header')

        @include('public._partials._navigation')

        @include('public._partials._flash-notification')

        @if($showCTA)
            @include('public._partials._cta-neukunde')
        @endif

        <section class="bg-tafel" id="aktion">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2 text-center">
                        <h2 class="light-heading">Aktion &amp; Neuigkeiten</h2>
                        <hr class="hr-primary">
                    </div>
                </div>
                <div class="row angebot">
                    <div class="col-lg-8 col-lg-offset-2 text-center">
                        <p class="text-uppercase">
                            <span class="text-primary">>></span> SOMMERPAUSE <span class="text-primary"><<</span><br>
                            Das Studio bleibt im Sommer vom <strong>22.07. - 02.08. geschlossen</strong>.
                            <br> Weiter geht es am Montag, den 05.08.19!
                        </p>
                        <hr class="hr-primary">
                    </div>
                </div>
                <div class="row angebot">
                    <div class="col-lg-8 col-lg-offset-2 text-center">
                        <p class="text-uppercase">
                            <span class="text-primary">>></span> ONE WEEK - TICKET <span class="text-primary"><<</span><br>
                            Zwei Kurse zum Preis von Einem für nur 15€.<br> Jetzt unverbindlich Kurs auswählen und Anfrage senden!
                        </p>
                        <a href="{{ route('kursplan') }}" class="btn button-primary page-scroll">Zum Kursplan ></a>
                    </div>
                </div>
            </div>
        </section>

        <section class="no-padding-bottom" id="angebote">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <h2 class="section-heading">Unsere Angebote</h2>
                        <hr class="hr-primary">
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row no-gutter">
                    <div class="col-lg-4 col-sm-6">
                        <a href="{{ route('kurs', 'pilates') }}" class="portfolio-box" >
                            <img src="img/kurse/pilates.jpg" class="img-responsive wow fadeIn" data-wow-delay=".1s" alt="pilates">
                            <div class="portfolio-box-overlay">
                                    <div class="portfolio-box-inner">
                                        <h4>Pilates</h4>
                                    </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <a href="{{ route('kurs', 'power-yoga') }}" class="portfolio-box">
                            <img src="img/kurse/power-yoga.jpg" class="img-responsive wow fadeIn" data-wow-delay=".3s" alt="power-yoga">
                            <div class="portfolio-box-overlay">
                                <div class="portfolio-box-inner">
                                    <h4>Power Yoga</h4>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <a href="{{ route('massagen') }}" class="portfolio-box">
                            <img src="img/Massagefrau.jpg" class="img-responsive wow fadeIn" data-wow-delay=".2s" alt="massagen">
                            <div class="portfolio-box-overlay">
                                <div class="portfolio-box-inner">
                                    <h4>Massagen</h4>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <a href="{{ route('kurs', 'rueckentraining') }}" class="portfolio-box">
                            <img src="img/kurse/rueckentraining.jpg" class="img-responsive wow fadeIn" data-wow-delay=".4s" alt="rueckentraining">
                            <div class="portfolio-box-overlay">
                                <div class="portfolio-box-inner">
                                    <h4>Rückenkurs</h4>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <a href="{{ route('kurs', 'yogilates') }}" class="portfolio-box">
                            <img src="img/kurse/yogilates.jpg" class="img-responsive wow fadeIn" data-wow-delay=".5s" alt="yogilates">
                            <div class="portfolio-box-overlay">
                                <div class="portfolio-box-inner">
                                    <h4>Yogilates</h4>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <a href="{{ route('kurs', 'zumba-fitness') }}" class="portfolio-box">
                            <img src="img/kurse/zumba-fitness.jpg" class="img-responsive wow fadeIn" data-wow-delay=".6s" alt="zumba-fitness">
                            <div class="portfolio-box-overlay">
                                <div class="portfolio-box-inner">
                                    <h4>Zumba Fitness</h4>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <section id="kursplan">
            <div class="container text-center">
                <div class="row">
                    <div class="col-xs-12"><a href="{{ route('kursplan') }}" class="btn button-primary button-large wow slideInLeft">Zum Kursplan ></a></div>
                </div>
            </div>
        </section>

        <section id="rezension" class="bg-tafel">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2 text-center">
                        <h2 class="light-heading">Was unsere Teilnehmer sagen</h2>
                        <hr class="hr-primary">
                    </div>
                </div>
                <div id="rezension-carousel" class="carousel slide" > {{-- data-ride="carousel" --}}
                  <!-- Wrapper for slides -->
                    <div class="carousel-inner" role="listbox">
                        <div class="item active ">
                            <div class="col-xs-8 col-xs-offset-2">
                                <div class="rezension-container">
                                    <div class="rezension-text">
                                        <p>
                                            "Nach einem Bandscheibenvorfall suchte ich nach einer 'anerkannten' Rückentrainingsmöglichkeit (möglichst in der Nähe). Insofern fand ich es toll, als auf der Empfehlungsliste meiner Krankenkasse das Bornstedt-Carree als Adresse auftauchte. Inzwischen trainiere ich neben meinem Rücken auch noch Pilates. Mir gefällt das Training in kleinen Gruppen mit Trainern, die auf die korrekte Ausführung der Übungen achten.
                                            Deshalb meine Empfehlung: Daumen hoch!"
                                        </p>
                                        <em class="rezension-autor pull-right">Petra Burow</em>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="col-xs-8 col-xs-offset-2">
                                <div class="rezension-container">
                                    <div class="rezension-text">
                                        <p>
                                            "Zeit für mich habe ich hier gefunden, beim Pilates und Rückentraining. Und dabei ist es schön zu merken, wie es Körper und Seele gleichermaßen guttut."
                                        </p>
                                        <em class="rezension-autor pull-right">Doris S.</em>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="col-xs-8 col-xs-offset-2">
                                <div class="rezension-container">
                                    <div class="rezension-text">
                                        <p>
                                            "Pilates bei Selina ist abwechslungsreich (woher hat sie bloß immer diese schönen, neuen Übungen?), in kleinen Gruppen auch immer individuell, gibt Muskelkater, aber macht vor allem sehr viel Spaß. Nach knapp zwei Jahren kann ich sagen, dass mir der Pilates-Kurs unglaublich gut tut. (Der Beweis dafür ist sicherlich, dass ich quasi nie fehle.) Also Fazit: absolut empfehlungswert!!"
                                        </p>
                                        <em class="rezension-autor pull-right">Jolanda Hermanns</em>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                  <!-- Controls -->
                    <a class="left carousel-control" href="#rezension-carousel" role="button" data-slide="prev">
                        <span class="fa fa-angle-left fa-2x" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="right carousel-control" href="#rezension-carousel" role="button" data-slide="next">
                        <span class="fa fa-angle-right fa-2x" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
        </section>

        <section id="kontakt" >
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2 text-center">
                        <h2 class="section-heading">Fragen?</h2>
                        <hr class="hr-primary">
                        <p>Haben Sie Fragen zu unseren Kursen oder möchten Sie unser Einsteigerangebot nutzen? Dann schreiben Sie uns einfach eine Mail an <span class="link-primary"><a href="mailto:info@yoursport-potsdam.de">info@yoursport-potsdam.de</a></span> oder nutzen Sie das Kontaktformular.</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="kontakt-form">
                            {!! Form::open(array('route' => 'kontakt', 'role' => 'form')) !!}
                                <div class="form-group col-md-4">
                                    {!! Form::label('first_name', 'Vorname') !!}
                                    {!! Form::text('first_name', null, ['class' => 'form-control', 'required' => 'required' ] ) !!}
                                    {{ $errors->first('first_name', '<p class="form-error-block">:message</p>') }}
                                </div>
                                <div class="form-group col-md-4">
                                    {!! Form::label('last_name', 'Nachname') !!}
                                    {!! Form::text('last_name', null, ['class' => 'form-control', 'required' => 'required' ] ) !!}
                                    {!! $errors->first('last_name', '<p class="form-error-block">:message</p>') !!}
                                </div>
                                <div class="form-group col-md-4">
                                    {!! Form::label('email_kontakt', 'E-Mailadresse') !!}
                                    {!! Form::email('email_kontakt', null, [ 'class' => 'form-control', 'required' => 'required' ] ) !!}
                                    {!! $errors->first('email_kontakt', '<p class="form-error-block">:message</p>') !!}
                                </div>
                                <div class="form-group col-md-12">
                                    {!! Form::label('subject', 'Betreff') !!}
                                    {!! Form::text('subject', null, [ 'class' => 'form-control', 'required' => 'required' ] ) !!}
                                    {!! $errors->first('subject', '<p class="form-error-block">:message</p>') !!}
                                </div>
                                <div class="form-group col-md-12">
                                    {!! Form::label('message', 'Nachricht') !!}
                                    {!! Form::textarea('message', null, [ 'class' => 'form-control', 'required' => 'required'] ) !!}
                                    {!! $errors->first('message', '<p class="form-error-block">:message</p>') !!}
                                </div>
                                <div class="form-group col-md-12">
                                    {!! Form::submit('Senden', [ 'class' => 'form-control btn button-primary'] ) !!}
                                </div>
                                {!! Form::text('spam_filter', null, [ 'class' => 'input-hidden']) !!}
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="anfahrt" class="bg-tafel">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2 text-center">
                        <h2 class="light-heading">Anfahrt</h2>
                        <hr class="hr-primary">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="flexible-container">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2433.531988409833!2d13.025964341278076!3d52.415157826748555!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47a8f69c28a6769f%3A0x9817bb009e29da20!2sPotsdamer+Str.+18A%2C+14469+Potsdam!5e0!3m2!1sde!2sde!4v1444131421607"  frameborder="0" style="border:0" allowfullscreen></iframe>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            <div class="anfahrt-beschreibung">
                                <div class="col-sm-6">
                                    <div class="anfahrt-img-container">
                                        <img src="img/eingang.jpg" alt="Eingang"/>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <p class="text-light">
                                        Bornstedt Carree<br>
                                        YOURS<br>
                                        Potsdamer Straße 18a <br>
                                        14469 Potsdam
                                        <br><br>
                                        Der Eingang befindet sich auf der linken Seite (siehe Skizze)
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 anfahrt-verkehr-list">
                                <ul>
                                    <li class="auto">
                                        Kostenlose Parkmöglichkeiten vor dem Gebäude + Tiefgarage <br>
                                        Achtung: Tiefgarage schließt um 19 Uhr!
                                    </li>
                                    <li class="bus">Die Linien 612, 614 und 692 halten an der Haltestelle Thaerstrasse direkt vor dem Carree</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        @include('public._partials._footer')

        @include('public._partials._scripts')

        @include('public._partials._vue-components._loginModal')
        {{-- @include('public._partials._vue-components._home-kursanmeldungModal') --}}



        <script type="text/javascript">

            var viewHeight = $( window ).height();
            var carouselStart = $( '#rezension' ).offset().top - viewHeight;
            var carouselStop = $('#kontakt').offset().top - 200;
            var scrollTop = $( window ).scrollTop();

            $('.carousel').carousel({
                interval: 3000
            }).on('slide.bs.carousel', function (e) {
                var nextH = $(e.relatedTarget).height();
                $(this).find('.active.item').parent().animate({
                    height: nextH
                }, 500);
            });
            if (scrollTop < carouselStart || scrollTop > carouselStop) {
                $('.carousel').carousel('pause');
            }

            $(document).scroll(function() {
                var scrollTop = $( window ).scrollTop();
                if (scrollTop < carouselStart || scrollTop > carouselStop) {
                    $('.carousel').carousel('pause');
                } else {
                    $('.carousel').carousel({
                        interval: 3000,
                        pause: 'hover'
                    });
                };
            });

        </script>
                <script>
          (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
          (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
          m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
          })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

          ga('create', 'UA-87139758-1', 'auto');
          ga('send', 'pageview');

        </script>
    </body>
</html>
