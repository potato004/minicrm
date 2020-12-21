<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="info">
          <a href="/" class="d-block">
            <i class="fas fa-paper-plane"></i>&nbsp;
            Mini CRM</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item {{$data['module'] == 'company' ? 'menu-open' : ''}}">
            <a href="#" class="nav-link"> 
              <i class="fas fa-building"></i>&nbsp;
              <p>
                Companies
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/company" class="nav-link {{$data['link'] == 'company' ? 'active' : ''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View Company List</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/company/create" class="nav-link {{$data['link'] == 'company/create' ? 'active' : ''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Company</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item {{$data['module'] == 'employee' ? 'menu-open' : ''}}">
            <a href="#" class="nav-link">
              <i class="fas fa-users"></i>&nbsp;
              <p>
                Employees
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/employee" class="nav-link {{$data['link'] == 'employee' ? 'active' : ''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View Employee List</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/employee/create" class="nav-link {{$data['link'] == 'employee/create' ? 'active' : ''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Employee</p>
                </a>
              </li>
            </ul>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
  <!-- Content Wrapper. Contains page content -->