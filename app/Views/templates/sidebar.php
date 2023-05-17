<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="../../index3.html" class="brand-link">
    <!-- <img src="../../dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: 0.8" /> -->
    <span class="brand-text font-weight-light"><?= $appname ?></span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <!-- <img src="../../dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image" /> -->
      </div>
      <div class="info">
        <a href="#" class="d-block"><?= $user['user_name'] ?></a>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-header">BASIC</li>
        <li class="nav-item">
          <a href="<?= site_url('dashboard') ?>" class="nav-link">
            <i class="nav-icon fa fa-tachometer-alt"></i>
            <p class="text">Dashboard</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="<?= site_url('profile') ?>" class="nav-link">
            <i class="nav-icon fa fa-user"></i>
            <p class="text">Profile</p>
          </a>
        </li>
        <?php if (in_array($user['role_id'], array(1, 2, 3))) : ?>
          <li class="nav-header">ADMIN</li>
          <li class="nav-item">
            <a href="<?= site_url('admin/master_user') ?>" class="nav-link">
              <i class="nav-icon fa fa-user text-danger"></i>
              <p class="text">Master User</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= site_url('admin/master_category') ?>" class="nav-link">
              <i class="nav-icon fa fa-user text-danger"></i>
              <p class="text">Master Category</p>
            </a>
          </li>
        <?php endif; ?>
        <li class="nav-header">CUSTOMER'S MENU</li>
        <li class="nav-item">
          <a href="<?= site_url('') ?>" class="nav-link">
            <i class="nav-icon fas fa-circle text-primary"></i>
            <p class="text">Order</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="<?= site_url('') ?>" class="nav-link">
            <i class="nav-icon fas fa-circle text-primary"></i>
            <p class="text">Transaksi</p>
          </a>
        </li>
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>