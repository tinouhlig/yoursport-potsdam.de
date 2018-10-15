<template id="kursplankursanmeldungmodal">
    <div class="modal-mask" v-show="show" @click="close" transition="modal" @keyup.esc="close">
        <div class="modal-wrapper kursplan-kursanmeldung" >
            <div class="modal-container" @click.stop>
                <div class="modal-header">
                    <button class="modal-close-button" @click="close">
                        <span></span>
                    </button>
                    <h3 class="modal-title">Kursanmeldung</h3>
                    <hr class="hr-primary">
                </div>
                <div class="modal-body">
                    <div class="kursplan-kursanmeldung-form">
                        <p>
                            Bitte Kurs auswählen!
                        </p>
                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <p>{{ $error }}</p>
                                @endforeach
                            </div>
                        @endif
                        {!! Form::open(['route' => 'kursanmeldung', 'role' => 'form']) !!}

                            <div class="form-group col-md-12">
                                {!! Form::label('courses', 'Kurs') !!}
                                <select
                                    class="form-control"
                                    name="courses"
                                    v-model="selectedKurstyp"
                                    v-on:change="changeKurs"
                                    required
                                >
                                    <option ></option>
                                    <option v-for="option in kurse" :value="option">
                                        @{{ option.name }}
                                    </option>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                {!! Form::label('course_day', 'Tag') !!}
                                <select
                                    class="form-control"
                                    name="course_day"
                                    v-model="selectedTag"
                                    :disabled="disabledTag"
                                    v-on:change="changeTag"
                                    required
                                >
                                    <option></option>
                                    <option v-for="option in tage" :value="option">
                                        @{{ $key }}
                                    </option>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                {!! Form::label('course_id', 'Uhrzeit') !!}
                                <select
                                    class="form-control"
                                    name="course_id"
                                    v-model="selectedZeit"
                                    :disabled="disabledZeit"
                                    required
                                >
                                    <option ></option>
                                    <option v-for="option in zeiten" :value="option.id">
                                        @{{ option.zeit }}
                                    </option>
                                </select>
                            </div>
                            <div class="form-group col-md-12">
                                {!! Form::label('email', 'E-Mailadresse') !!}
                                {!! Form::email('email', null, [ 'class' => 'form-control', 'required' => 'required'] ) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('message', 'optionale Nachricht') !!}
                                {!! Form::textarea('message', null, [ 'class' => 'form-control' ] ) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::submit('Senden', [ 'class' => 'form-control btn button-primary'] ) !!}
                            </div>
                            {!! Form::text('spam_filter', null, [ 'class' => 'input-hidden']) !!}
                        {!! Form::close() !!}
                    </div>
                    <p class="home-kursanmeldung-footer-text">
                        Diese Kursanmeldung ist unverbindlich!<br>
                        *Pflichtfeld
                    </p>
                </div>
            </div><!-- /.modal-contaienr -->
        </div><!-- /.modal-wrapper -->
    </div><!-- /.modal-mask -->
</div>
</template>

<template id="kursplankursabmeldungmodal">
    <div class="modal-mask" id="kursplankursabmeldungmodal" v-show="show" transition="modal">
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

<template id="kursplannachholanmeldungmodal">
    <div class="modal-mask" id="kursplannachholanmeldungmodal" v-show="show" transition="modal">
        <div class="modal-wrapper">
            <div class="modal-container">
                <div class="modal-header">
                    <button class="modal-close-button" @click="show = false">
                        <span></span>
                    </button>
                    <h3 class="modal-title">Zum Nachholkurs eintragen</h3>
                    <hr class="hr-primary">
                </div>
                <div class="modal-body">
                    <p>
                        Willst du dich wirklich in diesen Kurs eintragen? <br>
                    </p>
                    <a href="@{{ link }}" class="btn button-primary">Jetzt eintragen</a>
                </div>
                <div class="modal-footer">
                    <button class="modal-close-text center-block" @click="show = false">Nein doch nicht</button>
                </div>
            </div><!-- /.modal-contaienr -->
        </div><!-- /.modal-wrapper -->
    </div><!-- /.modal-mask -->
</template>

@section('scripts')
    @parent
    <script type="text/javascript">
        Vue.component('kursplannachholanmeldungmodal',{
            template: '#kursplannachholanmeldungmodal',
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
        Vue.component('kursplankursabmeldungmodal',{
            template: '#kursplankursabmeldungmodal',
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
        Vue.component('kursplankursanmeldungmodal',{
            template: '#kursplankursanmeldungmodal',
            data: function () {
                return {
                    kurse : [],
                    zeiten : [],
                    tage : [],
                    selectedKurstyp : null,
                    selectedTag : null,
                    selectedZeit : '',
                }
            },
            props: {
                show: {
                    type: Boolean,
                    required: true,
                    twoWay: true
                }
            },
            computed: {
                disabledTag: function() {
                    if (!this.selectedKurstyp) {
                        return true;
                    } else {
                        return false;
                    };
                },
                disabledZeit: function() {
                    if (!this.selectedTag) {
                        return true;
                    } else {
                        return false;
                    };
                }
            },
            methods: {
                fetchCourseData: function() {
                    $.getJSON('/api/kurse', function (kurse) {
                        this.kurse = kurse;
                    }.bind(this));
                },
                fetchDaysOfChosenCourse: function() {
                    $.getJSON('/api/kurse/' + this.selectedKurstyp.slug + '/tage', function (tage) {
                        this.tage = tage;
                    }.bind(this));
                },
                fetchTimesFromDay: function() {
                    var tag = this.selectedTag;
                    Array.prototype.getTimeObject = function() {
                        for (var i = 0; i < this.length; i++) {
                            this[i] = {
                                'id' : this[i].id,
                                'zeit': this[i].time,
                                'type': this[i].type == 'normal' ? 'Gruppenkurs' : 'Kleingruppe'
                            }
                        }
                    }

                    tag.getTimeObject();
                    this.zeiten = tag;
                },

                changeKurs: function() {
                    //alert('changeKurs wurde aktiviert');
                    this.fetchDaysOfChosenCourse();
                },

                changeTag: function () {
                    this.fetchTimesFromDay();
                },

                close: function () {
                    this.show = false;
                }
            },
            created: function () {
                this.fetchCourseData();
            }
        });
        new Vue({
            el: '#page-kursplan',

            data: {
                showKursanmeldung: false,
                showKursabmeldung: false,
                linkKursabmeldung: "",
                showNachholkursanmeldung: false,
                linkKursanmeldung: ""
            },
            methods : {
                showKursanmeldungModal: function () {
                    this.showKursanmeldung = true;
                },
                showKursabmeldungModal: function (event) {
                    if (event.target.className == "fa fa-sign-out") {
                        this.linkKursabmeldung = event.target.parentElement.href;
                    } else {
                        this.linkKursabmeldung = event.target.href;
                    }
                    this.showKursabmeldung = true;
                },
                showNachholkursanmeldungModal: function (event) {
                    if (event.target.className == "fa fa-sign-out") {
                        this.linkKursanmeldung = event.target.parentElement.href;
                    } else {
                        this.linkKursanmeldung = event.target.href;
                    }
                    this.showNachholkursanmeldung = true;
                }

            },
            ready: function () {
                if ({{$errors->count()}}>0) {
                    this.showKursanmeldung = true
                }
            }

        });
    </script>
@endsection
