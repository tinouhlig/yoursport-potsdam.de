<div class="cta-neukunde bg-tafel">
    <div class="row">
        <div class="col-sm-10 col-sm-offset-1 text-center cta-heading">
            <p class="light-heading text-uppercase">Special offer für Neukunden</p>
            <p class="light-heading text-uppercase"><span class="cta-neukunde-big-number">2</span> für <span class="cta-neukunde-big-number">1</span></p>
        </div>
        <button class="cta-neukunde-close-button cta-close">
            <span></span>
        </button>
    </div>
    <div class="row">
        <div class="col-lg-12 text-center">
            <p class="text-light text-uppercase">
                Zwei Kurse für nur 15€ testen!
            </p>
            <a href="{{ route('kursplan') }}" class="btn button-primary">zum Kursplan ></a>
        </div>
    </div>
</div>

@section('scripts')
    @parent
    <script type="text/javascript">
        $( ".cta-neukunde" ).delay( 2000 ).animate({
            opacity: 1,
            left: "+=300",
        }, 1000, function() {
            // Animation complete.
        });
        $('.cta-close').on('click', function () {
            $( ".cta-neukunde" ).animate({
                opacity: 0.25,
                left: "-=300",
            }, 600, function() {
                // Animation complete.
            });
        });
    </script>
@endsection
