{{-- {{dd($courses)}} --}}
<template>
<div id="kursanmeldungModal" class="kursanmeldung-modal modal-mask" transition="modal" v-show="showKursanmledung">
        <section id="heading">
            <button class="kursanmeldung-close-button" @click="showKursanmledung = false">
                <span></span>
            </button>
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 text-center">
                    <h2 class="section-heading">Kursanmeldung</h2>
                    <hr class="hr-primary">
                </div>
            </div>
            <div class="row">
                <div class="col-md-8 col-md-offset-2 text-center">
                    <p>
                        Die Kursanmeldung ist kostenlos und unverbindlich. Es werden keine Ihrer Daten gespeichert.
                    </p>
                </div>
            </div>
        </section>
        <section id="kursanmeldung-form" class="no-padding">
            <div class="container">
                <div class="kursanmeldung-form">
                    {!! Form::open(array('route' => 'kursanmeldung', 'role' => 'form')) !!}

                        <div class="form-group col-md-4 form-padding-right">
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
                        <div class="form-group col-md-4 form-no-padding">
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
                        <div class="form-group col-md-4 form-padding-left">
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
                                    @{{ option.zeit }} &emsp; @{{ option.type }}</span>
                                </option>
                            </select>
                        </div>
                        <div class="form-group col-md-4 form-padding-right">
                            {!! Form::label('first_name', 'Vorname') !!}
                            {!! Form::text('first_name', null, ['class' => 'form-control', 'required' => 'required' ] ) !!}
                        </div>
                        <div class="form-group col-md-4 form-no-padding">
                            {!! Form::label('last_name', 'Nachname') !!}
                            {!! Form::text('last_name', null, ['class' => 'form-control', 'required' => 'required' ] ) !!}
                        </div>
                        <div class="form-group col-md-4 form-padding-left">
                            {!! Form::label('email', 'E-Mailadresse') !!}
                            {!! Form::email('email', null, [ 'class' => 'form-control', 'required' => 'required' ] ) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('subject', 'Betreff') !!}
                            {!! Form::text('subject', null, [ 'class' => 'form-control', 'required' => 'required' ] ) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('message', 'Nachricht') !!}
                            {!! Form::textarea('message', null, [ 'class' => 'form-control', 'required' => 'required' ] ) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::submit('Senden', [ 'class' => 'form-control btn button-primary'] ) !!}
                        </div>
                        {!! Form::text('spam_filter', null, [ 'class' => 'input-hidden']) !!}
                    {!! Form::close() !!}
                </div>
            </div>
        </section>
</div>
</template>

@section('scripts')
    @parent
    {{-- <script harset="utf-8" src="http://cdnjs.cloudflare.com/ajax/libs/vue/1.0.8/vue.js"></script> --}}
    <script type="text/javascript">

        // $('#kursanmeldungModal').modal('show');
        // $('.kursanmeldung-close-button').click(function () {
        //     $('#kursanmeldungModal').modal('hide');
        // });

    </script>
@stop
