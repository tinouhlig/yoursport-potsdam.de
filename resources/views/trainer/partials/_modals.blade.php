<template id="changepasswordmodal">
    <div class="modal-mask" id="changepasswordmodal" v-show="show" transition="modal">
        <div class="modal-wrapper">
            <div class="modal-container">
                <div class="modal-header">
                    <button class="modal-close-button" @click="show = false">
                        <span></span>
                    </button>
                    <h3 class="modal-title">Passwort ändern</h3>
                    <hr class="hr-primary">
                </div>
                <div class="modal-body">
                    {!! Form::open(array('route' => 'profile::save_password', 'role' => 'form')) !!}
                        <div class="form-group">
                            {!! Form::label('old_password', 'Altes Passwort') !!}
                            {!! Form::password('old_password', ['class' => 'form-control', 'required' => 'required' ] ) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('password', 'Neues Passwort') !!}
                            {!! Form::password('password', ['class' => 'form-control', 'required' => 'required' ] ) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('password_confirm', 'Neues Passwort wiederholen') !!}
                            {!! Form::password('password_confirmation', ['class' => 'form-control', 'required' => 'required' ] ) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::submit('Speichern', [ 'class' => 'form-control btn button-primary'] ) !!}
                        </div>
                    {!! Form::close() !!}
                </div>
                <div class="modal-footer">
                    <button class="modal-close-text center-block" @click="show = false">Abbrechen</button>
                </div>
            </div><!-- /.modal-contaienr -->
        </div><!-- /.modal-wrapper -->
    </div><!-- /.modal-mask -->
</template>

<template id="changeuserdatamodal">
    <div class="modal-mask" id="changeuserdatamodal" v-show="show" transition="modal">
        <div class="modal-wrapper">
            <div class="modal-container">
                <div class="modal-header">
                    <button class="modal-close-button" @click="show = false">
                        <span></span>
                    </button>
                    <h3 class="modal-title">Persönliche Daten ändern</h3>
                    <hr class="hr-primary">
                </div>
                <div class="modal-body">
                    {!! Form::model($user, ['route' => 'trainer::update', 'role' => 'form']) !!}
                        <div class="form-group">
                            {!! Form::label('first_name', 'Vorname') !!}
                            {!! Form::text('first_name', null, ['class' => 'form-control', 'required' => 'required' ] ) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('last_name', 'Nachname') !!}
                            {!! Form::text('last_name', null, ['class' => 'form-control', 'required' => 'required' ] ) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('email', 'E-Mailadresse') !!}
                            {!! Form::email('email', null, ['class' => 'form-control', 'required' => 'required' ] ) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('phone', 'Telefonnummer') !!}
                            {!! Form::text('phone', null, ['class' => 'form-control'] ) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::submit('Speichern', [ 'class' => 'form-control btn button-primary'] ) !!}
                        </div>
                    {!! Form::close() !!}
                </div>
                <div class="modal-footer">
                    <button class="modal-close-text center-block" @click="show = false">Abbrechen</button>
                </div>
            </div><!-- /.modal-contaienr -->
        </div><!-- /.modal-wrapper -->
    </div><!-- /.modal-mask -->
</template>

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
        Vue.component('changepasswordmodal',{
            template: '#changepasswordmodal',
            props: {
                show: {
                    type: Boolean,
                    required: true,
                    twoWay: true
                }
            }
        });
        Vue.component('changeuserdatamodal',{
            template: '#changeuserdatamodal',
            props: {
                show: {
                    type: Boolean,
                    required: true,
                    twoWay: true
                }
            }
        });
        new Vue({
            el: '#page-top',

            data: {
                showChangePassword: false,
                showUserData: false,
                showModal: false,
                linkKursabmeldung: ''
            },
            methods: {
                showChangePasswordModal: function () {
                    this.showChangePassword = true;
                },
                showUserDataModal: function () {
                    this.showUserData = true;
                },
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
