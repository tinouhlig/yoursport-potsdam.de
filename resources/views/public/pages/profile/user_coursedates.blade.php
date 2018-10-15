@extends('public.pages.profile.index')

@section('title')
    Deine Kurstermine
@endsection

@section('content')

    <!-- Page Content -->
    <div id="profile-dashboard">
        <section id="heading">
            <div class="container">
                <div class="row text-center">
                    <div class="col-lg-12">
                        <h2>Trainingstermine</h2>
                        <hr class="hr-primary">
                    </div>
                </div>
            

                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2 "><p class="help-block text-center">In dieser Übersicht findest du deine Kurstermine.<br>Mit einem Klick auf "Jetzt austragen" kannst du dich vom Kurs abmelden.</p></div>
                    <div class="col-lg-8 col-lg-offset-2">
                        <div class="list-kurstermin">
                            @foreach ($user->coursedate()->coming()->get()->sortBy('date') as $kurstermin)
                                <div class="list-kurstermin-item">
                                    <div class="list-kurstermin-item--info">
                                        {{ $kurstermin->course->name_kursplan }} am {{ $kurstermin->date_formated }} um {{ $kurstermin->course->time }}
                                    </div>
                                    @if($kurstermin->isComing())
                                        <a href="{{ route('profile::coursedate_detach', [ 'coursedate_id' => $kurstermin->id ]) }}" class="list-kurstermin-item--link" @click.prevent="showKursabmeldungModal">Jetzt austragen</a>
                                    @else
                                        <em class="list-kurstermin-item--info">
                                            Der Kurs liegt in der Vergangenheit
                                        </em>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>
            {{-- Kursblock ENDE--}}
        </div>
    </div>
    <!-- /#page-content-wrapper -->

    <kursabmeldungmodal :show.sync="showModal" :link="linkKursabmeldung"></kursabmeldungmodal>
    <template id="kursabmeldungmodal">
        <div class="modal-mask" id="kursabmeldungmodal" v-show="show" transition="modal">
            <div class="modal-wrapper">
                <div class="modal-container">
                    <div class="modal-header">
                        <button class="modal-close-button" @click="show = false">
                            <span></span>
                        </button>
                        <h3 class="modal-title">Kursabmeldung</h3>
                        <hr class="hr-primary">
                    </div>
                    <div class="modal-body">
                        <p>
                            Willst du dich wirklich abmelden? <br>
                        </p>
                        <a href="@{{ link }}" class="btn button-primary">Jetzt abmelden</a>
                    </div>
                    <div class="modal-footer">
                        <button class="modal-close-text center-block" @click="show = false">Nein doch nicht</button>
                    </div>
                </div><!-- /.modal-contaienr -->
            </div><!-- /.modal-wrapper -->
        </div><!-- /.modal-mask -->
    </template>
    
@endsection

@section('scripts')
    @parent

    <script type="text/javascript">
        Vue.component('kursabmeldungmodal',{
            template: '#kursabmeldungmodal',
            props: {
                show: {
                    type: Boolean,
                    required: true,
                    twoWay: true
                },
                link: {
                    required: true
                }
            }
        });
        new Vue({
            el: '#page-top',

            data: {
                showModal: false,
                linkKursabmeldung: ''
            },

            methods: {
                showKursabmeldungModal: function (event) {
                    if (event.target.className == "fa fa-sign-out") {
                        this.linkKursabmeldung = event.target.parentElement.href;
                    } else {
                        this.linkKursabmeldung = event.target.href;
                    }
                    this.showModal = true;
                }
            }
        });
    </script>
@endsection
