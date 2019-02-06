@extends('public.index')

@section('title')
    Über uns
@endsection

@section('content')
    <section id="about-header">
        <div class="container">
            <div class="row">
                <div class="about-col-50 text-center">
                    <h2 class="section-heading">Philosophie</h2>
                    <hr class="hr-primary">
                    <p>
                        Bei YOURS arbeiten wir mit und an unserem Körper. Deshalb gibt es bei uns auch keine schweren Fitnessgeräte.<br><br>
                    Das Schönste ist, wenn sich die Teilnehmer wohl fühlen, Spaß haben und dabei merken, dass es ihnen durch die Bewegung besser geht.<br><br>
                    Professionelle Anleitung und eine überschaubare Gruppengröße machen unsere Kurse besonders effektiv, da die Trainer individuell auf jeden Teilnehmer eingehen können.<br><br>
                    Jeder Mensch ist individuell und so auch seine Fitness.
                    </p>
                </div>
            </div>
        </div>
    </section>
    <section id="about-trainer" class="bg-tafel">
        <div class="container-fluid text-center">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2">
                    <h2 class="light-heading">Unsere Trainer</h2>
                    <hr class="hr-primary">
                </div>
            </div>
            <div class="row">
                <div class="trainer-container">
                    <div class="trainer-box">
                        <div class="trainer-img"><img src="/img/trainer/selina-kuehlwein.png" class="img-responsive wow fadeIn" data-wow-delay=".1s" data-wow-offset="150" alt=""></div>
                        <h3 class="light-heading m-t-10">Selina</h3>
                        <p class="text-light">
                            ... ist die Inhaberin des Studio YOURS und Masterabsolventin in Sportwissenschaft-Leistungssport. Bereits während ihres Bachelorstudiums Sportmanagement war sie als Pilates- und Personaltrainerin tätig.
                        </p>
                    </div>
                    <div class="trainer-box">
                        <div class="trainer-img"><img src="/img/trainer/ariane-woitalla.png" class="img-responsive wow fadeIn" data-wow-delay=".1s" data-wow-offset="150" alt=""></div>
                        <h3 class="light-heading m-t-10">Ariane</h3>
                        <p class="text-light">
                            ... ist Diplom Sportwissenschaftlerin und gibt bereits seit mehreren Jahren freiberuflich Kurse in Berlin und Potsdam. Im Studio Yours ist Sie Kurstrainerin für Rückentraining.
                        </p>
                    </div>
                    <div class="trainer-box">
                        <div class="trainer-img"><img src="/img/trainer/christian-weber.png" class="img-responsive wow fadeIn" data-wow-delay=".1s" data-wow-offset="150" alt=""></div>
                        <h3 class="light-heading m-t-10">Christian</h3>
                        <p class="text-light">
                            … liebt lachende Menschen! Fröhlichkeit verbreiten liegt in seiner Natur. Als Yogalehrer hat er die Ehre, Menschen Ruhe und gleichzeitig Spaß zu schenken. Es ist seine Berufung.
                        </p>
                    </div>
                    <div class="trainer-box">
                        <div class="trainer-img"><img src="/img/trainer/ana-soethe.png" class="img-responsive wow fadeIn" data-wow-delay=".1s" data-wow-offset="150" alt=""></div>
                        <h3 class="light-heading m-t-10">Ana</h3>
                        <p class="text-light">
                            … liebt es, wenn sie Andere zum Lächeln bringen kann. Aufgrund ihrer brasilianischen Herkunft und Spontanität ist jede Zumba Stunde besonders spaßig, aber auch schweißtreibend. Beim Tanzen geht ihr das Herz auf!
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
