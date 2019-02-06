@if (session()->has('flash_notification.message'))
{{--     <div class="alert alert-{{ session('flash_notification.level') }}">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>

        {!! session('flash_notification.message') !!}
    </div> --}}

    <div class="notification notification-{{ session('flash_notification.level') }} animated slideInRight">
        <div class="notification-icon-wrapper">
            @if (session('flash_notification.level') == 'success')
                <i class="fa fa-check fa-3x notification-icon-{{ session('flash_notification.level') }}"></i>
            @elseif (session('flash_notification.level') == 'danger')
                <i class="fa fa-exclamation-circle fa-3x notification-icon-{{ session('flash_notification.level') }}"></i>
            @else
                <i class="fa fa-info-circle fa-3x notification-icon-{{ session('flash_notification.level') }}"></i>
            @endif
        </div>
        <div class="notification-message-wrapper">
            <p class="notification-message">{!! session('flash_notification.message') !!}</p>
        </div>
        <div class="notification-close-wrapper">
            <button class="btn btn-sm button-primary notification-close-button">Schließen</button>
        </div>
    </div>
@endif

@section('scripts')
    @parent
    <script type="text/javascript">
        $('.notification-close-button').on('click', function () {
            $( ".notification" ).removeClass( 'slideInRight' )
                                .fadeOut(300);
        });

        setTimeout(function(){
           $( ".notification" ).removeClass( 'slideInRight' )
                                .fadeOut(300);
        }, 4000);
    </script>
@endsection