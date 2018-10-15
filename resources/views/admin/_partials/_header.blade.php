<header class="main-header">
  <!-- Logo -->
  <a href="" class="logo">
    <!-- logo for regular state and mobile devices -->
    <span class="logo-lg"><b>YOURS</b></span>
  </a>
  <!-- Header Navbar: style can be found in header.less -->
  <nav class="navbar navbar-static-top" role="navigation">
    <!-- Sidebar toggle button-->
    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
      <span class="sr-only">Toggle navigation</span>
    </a>
    <div class="navbar-custom-menu">
      <ul class="nav navbar-nav">
        <li>
          <a href="{{ route('profile::dashboard') }}" title="zum Profil">Profil</a>
        </li>
        <li>
          <a href="{{ route('logout') }}" title="Logout"><i class="fa fa-sign-out"></i></a>
        </li>
      </ul>
    </div>
  </nav>
</header>
