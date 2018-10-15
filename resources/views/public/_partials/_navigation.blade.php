<nav id="mainNav" class="navbar navbar-default navbar-fixed-top">
    <div class="container-fluid navbar-main">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#main-navigation" aria-expanded="false">
                <span class="sr-only">Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand page-scroll" href="{{ route('home') }}">Yours</a>
            {{-- <a class="navbar-brand page-scroll" href="{{ route('home') }}"><img src="/img/logo-weiss.png"></a> --}}
            <p class="contact-phone navbar-brand"><i class="fa fa-phone"></i> 0171 / 98 68 712</p>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="main-navigation">
            @if (Request::is('/'))
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a class="page-scroll" href="#angebote" title="Unsere Angebote">Angebote</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="{{ route('kursplan') }}" title="Kursplan">Kursplan</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="{{ route('massagen') }}" title="Massagen">Massagen</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="{{ route('about') }}" title="Über uns">Über uns</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#kontakt" title="Kontakt">Kontakt</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#anfahrt" title="Anfahrt">Anfahrt</a>
                    </li>
                    @if (\Auth::check())
                        <li class="dropdown dropdown-profile-link">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dein YOURS <span class="caret"></span></a>
                            <ul class="dropdown-menu dropdown-profile-list">
                                <li><a href="{{ route('profile::dashboard') }}" title="Dashboard">Dashboard</a></li>
                                @if (\Auth::user()->isTrainer() || \Auth::user()->isAdmin())
                                    <li><a href="{{ route('trainer::dashboard') }}" title="Trainer-Dashboard">Trainer-Dashboard</a></li>
                                @endif
                                @if (\Auth::user()->isAdmin())
                                    <li><a href="{{ route('admin::dashboard') }}" title="Admin-Dashboard">Admin-Dashboard</a></li>
                                @endif
                                <li><a href="{{ route('logout') }}" title="Logout">Logout</a></li>
                            </ul>
                        </li>
                    @else
                        <li>
                            <a href="" @click.prevent="showLoginModal">Login</a>
                        </li>
                        {{-- <loginmodal :show.sync="showLogin"></loginmodal> --}}
                    @endif
                </ul>
            @else
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a class="page-scroll" href="{{ route('home') }}" title="Startseite">Startseite</a>
                    </li>
                    <li class="{{ Request::is('kursplan') ? 'active' : '' }}">
                        <a class="page-scroll" href="{{ route('kursplan') }}" title="Kursplan">Kursplan</a>
                    </li>
                    <li class="{{ Request::is('massagen') ? 'active' : '' }}">
                        <a class="page-scroll" href="{{ route('massagen') }}" title="Massagen">Massagen</a>
                    </li>
                    <li class="{{ Request::is('about') ? 'active' : '' }}">
                        <a class="page-scroll" href="{{ route('about') }}" title="Über uns">Über uns</a>
                    </li>
                    <li>
                        <a class="page-scroll " href="{{ route('home') }}#kontakt" title="Kontakt">Kontakt</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="{{ route('home') }}#anfahrt" title="Anfahrt">Anfahrt</a>
                    </li>
                    @if (\Auth::check())
                            <li class="dropdown dropdown-profile-link">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dein YOURS <span class="caret"></span></a>
                            <ul class="dropdown-menu dropdown-profile-list">
                                <li><a href="{{ route('profile::dashboard') }}">Dashboard</a></li>
                                @if (\Auth::user()->isTrainer() || \Auth::user()->isAdmin())
                                    <li><a href="{{ route('trainer::dashboard') }}" title="Trainer-Dashboard">Trainer-Dashboard</a></li>
                                @endif
                                @if (\Auth::user()->isAdmin())
                                    <li><a href="{{ route('admin::dashboard') }}">Admin-Dashboard</a></li>
                                @endif
                                <li><a href="{{ route('logout') }}">Logout</a></li>
                            </ul>
                        </li>
                        {{-- @endunless --}}
                    @else
                        <li>
                            <a href="" @click.prevent="showLoginModal">Login</a>
                        </li>
                    @endif
                </ul>
            @endif
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container-fluid -->
<loginmodal :show.sync="showLogin"></loginmodal>
</nav>

