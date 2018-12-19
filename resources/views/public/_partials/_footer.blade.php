<footer id="footer">
    <div class="container">
        <div class="row">
            <div class="col-sm-4">
                <p class="text-muted">Schreib uns!</p>
                <hr class="hr-primary">
                <ul>
                    <li><a href="https://www.facebook.com/yoursportpotsdam">Facebook</a></li>
                    <li><a href="mailto:info@yoursport-potsdam.de">info@yoursport-potsdam.de</a></li>
                </ul>
            </div>
            <div class="col-sm-4">
                <p class="text-muted">Mehr entdecken</p>
                <hr class="hr-primary">
                <ul>
                    <li><a href="{{ route('kursplan') }}">Kursplan</a></li>
                    <li><a href="{{ route('preise') }}">Preise</a></li>
                    <li><a href="{{ route('about') }}">Über uns</a></li>
                </ul>
            </div>
            <div class="col-sm-4">
                <p class="text-muted">Sonstiges</p>
                <hr class="hr-primary">
                <ul>
                    <li><a href="{{ route('impressum') }}">Impressum</a></li>
                    <li><a href="{{ route('datenschutz') }}">Datenschutz</a></li>
                    <li>&copy; {{ Carbon\Carbon::now()->format('Y') }} Selina Kühlwein | YOURS</li>
                </ul>
            </div>
        </div>
    </div>
</footer>
