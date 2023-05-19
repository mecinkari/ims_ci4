<?= $this->extend('templates/layout') ?>

<?= $this->section('content') ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <?php if (session()->getFlashdata('success')) : ?>
        <div class="alert alert-success">
          <?= session()->getFlashdata('success') ?>
        </div>
      <?php endif ?>
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>User</h1>
        </div>
        <div class="col-sm-6">
          <!-- <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Blank Page</li>
          </ol> -->
        </div>
      </div>
    </div>
    <!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <!-- Default box -->
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Title</h3>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-md-4">
            <strong><i class="fas fa-user mr-1"></i> Username</strong>

            <p class="text-muted">
              <?= $user['user_name'] ?>
            </p>

            <hr>
          </div>
          <div class="col-md-4">
            <strong><i class="fas fa-user mr-1"></i> Dibuat pada</strong>

            <p class="text-muted">
              <?= $user['created_at'] ?>
            </p>

            <hr>
          </div>
          <div class="col-md-4">
            <strong><i class="fas fa-user mr-1"></i> Diupdate pada</strong>

            <p class="text-muted">
              <?= $user['updated_at'] ?>
              <?php date_default_timezone_set("Asia/Jakarta");
              //echo date('m-d-Y H:i:s') 
              ?>
            </p>

            <hr>
          </div>
        </div>
      </div>
      <!-- /.card-body -->
      <div class="card-footer">
        <a href="<?= site_url('user/change_username') ?>" class="btn btn-primary"><i class="fa fa-user"></i> Ubah Username</a>
        <a href="<?= site_url('user/change_password') ?>" class="btn btn-primary"><i class="fa fa-lock"></i> Ubah Password</a>
      </div>
      <!-- /.card-footer-->
    </div>
    <!-- /.card -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?= $this->endSection() ?>