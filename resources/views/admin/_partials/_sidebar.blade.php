<aside class="main-sidebar">
    <!-- start sidebar -->
  <section class="sidebar">
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu">
      <li class="header">Navigation</li>
      <li class="{{ Request::is('admin/dashboard') ? 'active' : '' }} treeview">
        <a href="{{ route('admin::dashboard') }}">
          <i class="fa fa-dashboard"></i> <span>Dashboard</span>
        </a>
      </li>
      <li class="{{ Request::is('admin/users*') ? 'active' : '' }} treeview">
        <a href="{{ route('admin::users') }}">
          <i class="fa fa-users"></i> <span>Kunden</span>
        </a>
      </li>
      <li class="{{ Request::is('admin/courses*') ? 'active' : '' }} treeview">
        <a href="{{ route('admin::courses') }}">
          <i class="fa fa-list"></i> <span>Kurse</span>
        </a>
      </li>
      <li class="{{ Request::is('admin/coursedate*') ? 'active' : '' }} treeview">
        <a href="{{ route('admin::coursedates') }}">
          <i class="fa fa-calendar"></i> <span>Kurstermine</span>
        </a>
      </li>
      <li class="{{ Request::is('admin/finance*') ? 'active' : '' }} treeview">
        <a href="{{ route('admin::prices_dashboard') }}">
          <i class="fa fa-eur"></i> <span>Finanzen</span>
        </a>
      </li>
      <li class="header">Quicklinks</li>
    </ul>
  </section>
  <!-- /.sidebar -->
</aside>
