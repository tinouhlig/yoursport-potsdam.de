
<script src="/js/app.js" charset="utf-8"></script>
<script src="/js/vendor.js" charset="utf-8"></script>
<script type="text/javascript">
    $('.notification-close-button').on('click', function () {
        $( ".notification" ).removeClass( 'slideInRight' )
                            .fadeOut(1000);
    });

    setTimeout(function(){
       $( ".notification" ).removeClass( 'slideInRight' )
                            .fadeOut(1000);
    }, 4000);
</script>

@yield('scripts')
