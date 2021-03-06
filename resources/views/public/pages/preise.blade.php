@extends('public.index')

@section('title')
    Preise
@endsection

@section('content')
    <div class="container-fluid">
        <section id="preise">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">Preise</h2>
                    <hr class="hr-primary">
                </div>
            </div>
            <div class="row" id="gruppenpreise">
                <div class="col-lg-2 col-lg-offset-2 col-md-3 col-sm-6">
                    <div class="preis-container">
                        <div class="preis-img">
                            <img src="/img/preise/flex-card.png" class="img-responsive" alt="flex-card">
                        </div>
                        <div class="preis-info">
                            <table class="preis-info-table">
                                <thead>
                                    <tr>
                                        <th>Flex Card</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>70,00€<br>&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td>5<br><em>Kurse</em></td>
                                    </tr>
                                    <tr>
                                        <td>6<br><em>Wochen Laufzeit</em></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-3 col-sm-6">
                    <div class="preis-container">
                        <div class="preis-img">
                            <img src="/img/preise/white-card.png" class="img-responsive" alt="white-card">
                        </div>
                        <div class="preis-info">
                            <table class="preis-info-table">
                                <thead>
                                    <tr>
                                        <th>White Card</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>49,00€<br><em>monatl.</em></td>
                                    </tr>
                                    <tr>
                                        <td>1<br><em>Kurs pro Woche</em></td>
                                    </tr>
                                    <tr>
                                        <td>9<br><em>Monate Laufzeit</em></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-3 col-sm-6">
                    <div class="preis-container">
                        <div class="preis-img">
                            <img src="/img/preise/orange-card.png" class="img-responsive" alt="orange-card-solo">
                        </div>
                        <div class="preis-info">
                            <table class="preis-info-table">
                                <thead>
                                    <tr>
                                        <th>Orange Card Solo</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>79,00€<br><em>monatl.</em></td>
                                    </tr>
                                    <tr>
                                        <td>2<br><em>Kurse pro Woche</em></td>
                                    </tr>
                                    <tr>
                                        <td>15<br><em>Monate Laufzeit</em></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-3 col-sm-6">
                    <div class="preis-container">
                        <div class="preis-img">
                            <img src="/img/preise/orange-card.png" class="img-responsive" alt="orange-card-plus">
                        </div>
                        <div class="preis-info">
                            <table class="preis-info-table">
                                <thead>
                                    <tr>
                                        <th>Orange Card Plus*</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>89,00€<br><em>monatl.</em></td>
                                    </tr>
                                    <tr>
                                        <td>2<br><em>Kurse pro Woche</em></td>
                                    </tr>
                                    <tr>
                                        <td>15<br><em>Monate Laufzeit</em></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 text-center">
                    <em>*gilt für Familienmitglieder. Kurse können getrennt besucht werden.</em>
                </div>
            </div>
        </section>
    </div>
@endsection
