<template id="loginmodal">
    <div class="modal-mask" v-show="show" @click="close" transition="modal" @keyup.esc="close">
        <div class="modal-wrapper kursplan-kursanmeldung" >
            <div class="modal-container" @click.stop>
                <div class="modal-header">
                    <button class="modal-close-button" @click="close">
                        <span></span>
                    </button>
                    <h3 class="modal-title">Login</h3>
                    <hr class="hr-primary">
                </div>
                <div class="modal-body">
                    <div class="login-form" v-show="!showPasswordReset">
                        @if (count($errors->login->all()) > 0)
                            <div class="alert alert-danger">
                                @foreach ($errors->login->all() as $error)
                                    <p>{{ $error }}</p>
                                @endforeach
                            </div>
                        @endif
                        {!! Form::open(array('route' => 'post_login', 'role' => 'form')) !!}
                            <div class="form-group">
                                {!! Form::label('email', 'E-Mailadresse') !!}
                                {!! Form::email('email', null, [ 'class' => 'form-control'] ) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('password', 'Passwort') !!}
                                {!! Form::password('password', [ 'class' => 'form-control'] ) !!}
                            </div>
                            <div class="form-group col-sm-6 form-padding-right">
                                {!! Form::submit('Login', [ 'class' => 'btn form-control button-primary'] ) !!}
                            </div>
                            <div class="form-group col-sm-6 form-padding-left" @click="openPasswordReset">
                                <a href="#" class="btn form-control button-light">Passwort vergessen?</a>
                            </div>
                            {!! Form::token() !!}
                            <input type="checkbox" name="remember" checked style="display: none; visibility: hidden;"> 
                        {!! Form::close() !!}
                    </div>
                    <div class="login-form animated" v-show="showPasswordReset" transition="fade">
                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <p>{{ $error }}</p>
                                @endforeach
                            </div>
                        @endif
                        {!! Form::open(array('route' => 'post_reset_email', 'role' => 'form')) !!}
                            <div class="form-group">
                                {!! Form::label('email', 'E-Mailadresse') !!}
                                {!! Form::email('email', null, [ 'class' => 'form-control', 'required' => 'required', "id" => "reset_email"] ) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::submit('E-Mail senden', [ 'class' => 'btn form-control button-primary'] ) !!}
                            </div>
                            {!! Form::token() !!}
                        {!! Form::close() !!}
                    </div>

                </div>
            </div><!-- /.modal-contaienr -->
        </div><!-- /.modal-wrapper -->
    </div><!-- /.modal-mask -->
</div>
</template>

<script type="text/javascript">
    Vue.component('loginmodal',{
        template: '#loginmodal',
        props: {
            show: {
                type: Boolean,
                required: true,
                twoWay: true
            },
            showPasswordReset: {
                type: Boolean,
                required: false,
                default: false
            }
        },
        methods: {
            close: function () {
                this.show = false;
                this.showPasswordReset = false;
            },
            openPasswordReset: function () {
                this.showPasswordReset = true;
            }
        }
    });
    new Vue({
        el: '#mainNav',

        data: {
            showLogin: false,
            showPasswordReset: false
        },
        methods : {
            showLoginModal: function () {
                this.showLogin = true;
            }
        },
        ready: function () {
            @if (count($errors->login)>0)
                this.showLoginModal()
            @endif
        }

    });
</script>
