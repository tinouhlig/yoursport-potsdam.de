<template id="homekursanmeldungmodal">
    <div class="modal-mask" v-show="show" transition="modal">
        <div class="modal-wrapper">
            <div class="modal-container">
                <div class="modal-header">
                    <button class="modal-close-button" @click="show = false">
                        <span></span>
                    </button>
                    <h3 class="modal-title">Kursanmeldung</h3>
                    <hr class="hr-primary">
                </div>
                <div class="modal-body">
                    <div class="home-kursanmeldung-form">
                        <p>
                            „Nach 10 Stunden spüren sie den Unterschied,<br>
                            nach 20 Stunden sehen Sie den Unterschied, und<br>
                            nach 30 Stunden haben Sie einen neuen Körper.“<br>
                            				<em>Joseph Hubert Pilates</em> <br>
                            <br>
                            Und wir freuen uns darauf diese Worte mit Ihnen in die Tat umsetzen!
                        </p>
                        {!! Form::open(array('route' => 'homekursanmeldung', 'role' => 'form')) !!}
                            <div class="form-group">
                                {!! Form::label('emailanmeldung', 'E-Mailadresse*', ['class' => 'pull-left']) !!}
                                {!! Form::email('emailanmeldung', "", ['class' => 'form-control ', 'placeholder' => 'E-Mailadresse', "required" => "required"]) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('messageanmeldung', 'optionale Nachricht', ['class' => 'pull-left']) !!}
                                {!! Form::textarea('messageanmeldung', "", ['class' => 'form-control', 'placeholder' => 'optionale Nachricht an den Kurstrainer', "rows" => "3"]) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::submit('Anmeldung abschicken', [ 'class' => 'btn button-primary form-control'] ) !!}
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


<script type="text/javascript">
    Vue.component('homekursanmeldungmodal',{
        template: '#homekursanmeldungmodal',
        props: {
            show: {
                type: Boolean,
                required: true,
                twoWay: true
            }
        }
    });
    new Vue({
        el: '#angebote',

        data: {
            showModal: false,
        },

        methods: {
            showKursanmeldungModal: function () {
                this.showModal = true;
            }
        }
    });
</script>
