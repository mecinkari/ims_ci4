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
        <?php if (in_array($user['role_id'], array(1, 2, 3, 4))) : ?>
          <li class="nav-item">
            <a href="<?= site_url('dashboard') ?>" class="nav-link">
              <i class="nav-icon fa fa-tachometer-alt"></i>
              <p class="text">Dashboard</p>
            </a>
          </li>
        <?php else : ?>
          <li class="nav-item">
            <a href="<?= site_url('home') ?>" class="nav-link">
              <i class="nav-icon fa fa-home"></i>
              <p class="text">Home</p>
            </a>
          </li>
        <?php endif ?>
        <li class="nav-item">
          <a href="<?= site_url('user') ?>" class="nav-link">
            <i class="nav-icon fa fa-user"></i>
            <p class="text">Your Account</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="<?= site_url('profile') ?>" class="nav-link">
            <i class="nav-icon fa fa-user"></i>
            <p class="text">Profile</p>
          </a>
        </li>
        <?php if (in_array($user['role_id'], array(1, 2, 3))) : ?>
          <?php
          $admin_links = [
            [
              'title' => 'Master User',
              'url' => 'admin/master_user',
              'icon' => 'fa fa-user'
            ],
            [
              'title' => 'Master Category',
              'url' => 'admin/master_category',
              'icon' => 'fa fa-window-restore'
            ],
            [
              'title' => 'Master Supplier',
              'url' => 'admin/master_supplier',
              'icon' => 'fa fa-cubes'
            ],
            [
              'title' => 'Master Product',
              'url' => 'admin/master_product',
              'icon' => 'fa fa-cube'
            ],
            [
              'title' => 'Master Transaction',
              'url' => 'admin/master_transaction',
              'icon' => 'fa fa-bill'
            ]
          ]
          ?>
          <li class="nav-header">ADMIN</li>
          <?php foreach ($admin_links as $link) : ?>
            <li class="nav-item">
              <a href="<?= site_url($link['url']) ?>" class="nav-link">
                <i class="nav-icon <?= $link['icon'] ?> text-danger"></i>
                <p class="text"><?= $link['title'] ?></p>
              </a>
            </li>
          <?php endforeach ?>
        <?php endif; ?>
        <?php
        $customers_menu = [
          [
            'site' => 'order',
            'title' => 'Order',
          ],
          [
            'site' => 'transaction',
            'title' => 'Transaction',
          ],
          [
            'site' => 'test',
            'title' => 'Test',
          ]
        ];
        if ($user['role_id'] == 5) : ?>
          <li class="nav-header">CUSTOMER'S MENU</li>
          <?php foreach ($customers_menu as $cus) : ?>
            <li class="nav-item">
              <a href="<?= site_url($cus['site']) ?>" class="nav-link">
                <i class="nav-icon fas fa-circle text-primary"></i>
                <p class="text"><?= $cus['title'] ?></p>
              </a>
            </li>
          <?php endforeach ?>
        <?php endif ?>
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>