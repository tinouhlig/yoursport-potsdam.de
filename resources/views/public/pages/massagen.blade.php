@extends('public.index')

@section('title')
    Massagen
@endsection

@section('content')
    <section class="massagen-header">
        <div class="header-content">
            <div class="header-content-inner header-inner-bg">
                    <h1>Massagen</h1>
                    <hr>
                    <p class="text-uppercase">Zeit, die wir uns nehmen,<br>ist Zeit, die uns etwas gibt.</p>
                    <em>Ernst Ferstl</em>
                    <a href="#massage-angebote" class="btn button-primary-transparent-border button-large page-scroll">Mehr erfahren</a>
            </div>
        </div>
    </section>
    <section id="massage-angebote">
        {{-- bg-tafel --}}
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 text-center">
                    <h2 class="section-heading">Unsere Wellnessangebote</h2>
                    <hr class="hr-primary">
                </div>
            </div>
            <div id="massage-carousel" class="carousel slide carousel-fade">
                <div class="massage-container">
                    <div class="massage-col">
                        <ol class="massage-list carousel-indicators clearfix">
                            <li data-target="#massage-carousel" data-slide-to="0" class="active massage-list__item">Klassische Massage</li>
                            <li data-target="#massage-carousel" data-slide-to="1" class="massage-list__item">Aromaölmassage</li>
                            <li data-target="#massage-carousel" data-slide-to="2" class="massage-list__item">Gentle Pressure Technique</li>
                            <li data-target="#massage-carousel" data-slide-to="3" class="massage-list__item">Ganzkörpermassage Abhyanga</li>
                        </ol>
                    </div>
                    <!-- Wrapper for slides -->
                    <div class="massage-col">
                        <div class="carousel-inner" role="listbox">
                            <div class="item active">
                                <div class="massage-beschreibung">
                                    <p>
                                        Verschiedene Grifftechniken machen die klassische Massage zu einer wunderbaren Methode, Körper und Seele in Einklang zu bringen. Erleben Sie am eigenen Körper, wie Blutdruck und Pulsfrequenz sich senken, Stress reduziert wird, Schmerzen gelindert werden und das Wohlbefinden sich steigert. <br><br>

                                        Ab einer Buchung von 60 Minuten bieten wir die klassische Massage auch für den ganzen Körper an. <br><br>

                                        Diese Anwendung können Sie auch als Paarmassage buchen.
                                    </p>
                                </div>
                                <div class="massage-preise-container">
                                    <div class="massage-preis-container">
                                        <p class="massage-dauer">30min</p>
                                        <p>35 €</p>
                                    </div>
                                    <div class="massage-preis-container">
                                        <p class="massage-dauer">45min</p>
                                        <p>45 €</p>
                                    </div>
                                    <div class="massage-preis-container">
                                        <p class="massage-dauer">60min</p>
                                        <p>65 €</p>
                                    </div>
                                    <div class="massage-preis-container">
                                        <p class="massage-dauer">90min</p>
                                        <p>95 €</p>
                                    </div>
                                </div>
                            </div>

                            <div class="item">
                                <div class="massage-beschreibung">
                                    <p>
                                        Bei der Aromaölmassage werden bestimmte Aromen eingesetzt, die speziell auf die Bedürfnisse der Kunden abgestimmt sind.
                                        <br><br>
                                        Ob Lavendel zur Entspannung, Orange zum Beleben - wählen Sie aus unserem Sortiment den richtigen Duft für Ihre Teil- oder Ganzkörpermassage aus!<br><br>

                                        Diese Anwendung können Sie auch als Paarmassage buchen.
                                    </p>
                                </div>
                                <div class="massage-preise-container">
                                    <div class="massage-preis-container">
                                        <p class="massage-dauer">30min</p>
                                        <p>35 €</p>
                                    </div>
                                    <div class="massage-preis-container">
                                        <p class="massage-dauer">45min</p>
                                        <p>45 €</p>
                                    </div>
                                    <div class="massage-preis-container">
                                        <p class="massage-dauer">60min</p>
                                        <p>65 €</p>
                                    </div>
                                    <div class="massage-preis-container">
                                        <p class="massage-dauer">90min</p>
                                        <p>95 €</p>
                                    </div>
                                </div>
                            </div>

                            <div class="item">
                                <div class="massage-beschreibung">
                                    <p>
                                        Bei dieser sanften Technik werden bestimmte Punkte am Körper wiederholt gedrückt, gehalten oder großflächig gestrichen. Der Körper wird harmonisiert und das steigert wiederum das Wohlbefinden und die Entspannung. Stress und Verspannungen können somit gelöst werden. Noch besser wirkt diese Technik zur Vorbeugung bei Stress, d.h. vor einer stressigen Phase können innere Ressourcen aktiviert und somit besser genutzt werden.<br><br>

                                        In unserem 45 Minuten-­Angebot ist eine 10­-minütige Kopf- ­und Gesichtsmassage enthalten.
                                    </p>
                                </div>
                                <div class="massage-preise-container">
                                    <div class="massage-preis-container">
                                        <p class="massage-dauer">30min</p>
                                        <p>39 €</p>
                                    </div>
                                    <div class="massage-preis-container">
                                        <p class="massage-dauer">45min</p>
                                        <p>48 €</p>
                                    </div>
                                </div>
                            </div>

                            <div class="item">
                                <div class="massage-beschreibung">
                                    <p>
                                        Die Abhyanga ist mehr als nur eine Massage. Sie ist der Inbegriff für genussreiche Entspannung sowohl Körper, Geist und Seele.Die warmen pflanzlichen Öle machen die Ganzkörpermassage zu einer der wohltuendsten und effektivsten Berührungsformen der ayurvedischen Gesundheitslehre. Sie verbindet auf harmonische Art und Weise mehrere Techniken, bei denen der Körper in der Tiefe entspannt und ebenso vitalisiert wird.
                                    </p>
                                </div>
                                <div class="massage-preise-container">
                                    <div class="massage-preis-container">
                                        <p class="massage-dauer">60min</p>
                                        <p>70 €</p>
                                    </div>
                                    <div class="massage-preis-container">
                                        <p class="massage-dauer">90min</p>
                                        <p>95 €</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                  <!-- Controls -->
                </div>
            </div>
            <div class="massage-anfrage-button">
                <div class="col-xs-12"><a href="" class="btn button-primary button-large" @click.prevent="showMassageAnmeldungModal">Termin anfragen ></a></div>
            </div>
        </div>
        <massageanmeldungmodal :show.sync="showModal"></massageanmeldungmodal>
    </section>
    @include('public._partials._vue-components._massageAnmeldungModal')
@endsection

@section('scripts')
    <script type="text/javascript">
    $( document ).ready(function() {

        console.log(window.location);
        $('.carousel').carousel({
            interval: false
        }).on('slide.bs.carousel', function (e) {
            var nextH = $(e.relatedTarget).height();
            $(this).find('.active.item').parent().animate({
                height: nextH
            }, 500);
        });


        
    });

    </script>
@stop
