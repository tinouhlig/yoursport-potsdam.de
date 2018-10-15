<div class="container-fluid navbar-profile" data-spy="affix" data-offset-top="40">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-profile">
            <span class="sr-only">Profilnavigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-profile">
        <ul class="nav navbar-nav navbar-right">
            <li class="{{ Request::is('profile') ? 'active' : '' }}">
                <a href="{{ route('profile::dashboard') }}">Profil</a>
            </li>
            <li class="{{ Request::is('profile/benutzerdaten') ? 'active' : '' }}">
                <a href="{{ route('profile::user_show') }}">persönliche Daten</a>
            </li>
            <li>
                <a href="{{ route('logout') }}">Logout</a>
            </li>
        </ul>
    </div>
    <!-- /.navbar-collapse -->
</div>
<!-- /.container-fluid -->
