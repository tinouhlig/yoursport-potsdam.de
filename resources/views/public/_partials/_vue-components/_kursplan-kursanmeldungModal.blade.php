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

@section('scripts')
    @parent
    <script type="text/javascript">
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
            el: '#kurse',

            data: {
                showModal: false,
            },
            methods : {
                showKursanmeldungModal: function () {
                    this.showModal = true;
                }
            },
            ready: function () {
                if ({{$errors->count()}}>0) {
                    this.showModal = true
                }
            }

        });
    </script>
@endsection
