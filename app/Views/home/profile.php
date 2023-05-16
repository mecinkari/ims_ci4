<?= $this->extend('templates/layout') ?>

<?= $this->section('content') ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Profile</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">User Profile</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-3">

          <!-- Profile Image -->

          <!-- /.card -->

          <!-- About Me Box -->
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Profile</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <strong><i class="fas fa-user mr-1"></i> Nama</strong>

              <p class="text-muted">
                <?= $profile['full_name'] ?> / <?= $role['role_name'] ?>
              </p>

              <hr>
              <strong><i class="fas fa-envelope mr-1"></i> Email</strong>

              <p class="text-muted">
                <?= $profile['email'] ?>
              </p>

              <hr>
              <strong><i class="fas fa-phone mr-1"></i> No.HP</strong>

              <p class="text-muted">
                <?= $profile['no_hp'] ?>
              </p>

              <hr>
              <strong><i class="fas fa-map mr-1"></i> Alamat</strong>

              <p class="text-muted">
              <ul>
                <li><?= $profile['address_1'] ?></li>
                <li><?= $profile['address_2'] ?></li>
              </ul>
              </p>

              <hr>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="card">
            <div class="card-header p-2">
              <p class="card-title">Settings</p>
            </div><!-- /.card-header -->
            <div class="card-body">
              <?php if (session()->getFlashdata('success')) : ?>
                <div class="alert alert-success">
                  <?= session()->getFlashdata('success') ?>
                </div>
              <?php endif ?>
              <form action="<?= site_url('profile/update') ?>" method="post" class="form-horizontal">
                <input type="hidden" name="profile_id" value="<?= $profile['profile_id'] ?>">
                <div class="form-group row">
                  <label for="" class="col-sm-2 col-form-label">Nama</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="full_name" value="<?= $profile['full_name'] ?>" placeholder="Nama">
                    <!-- <small class="text-danger">Error</small> -->
                  </div>
                </div>
                <hr>
                <div class="form-group row">
                  <label for="" class="col-sm-2 col-form-label">No HP</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="no_hp" value="<?= $profile['no_hp'] ?>" placeholder="No HP">
                    <!-- <small class="text-danger">Error</small> -->
                  </div>
                </div>
                <hr>
                <div class="form-group row">
                  <label for="" class="col-sm-2 col-form-label">Email</label>
                  <div class="col-sm-10">
                    <input type="email" class="form-control" name="email" value="<?= $profile['email'] ?>" placeholder="Email">
                    <!-- <small class="text-danger">Error</small> -->
                  </div>
                </div>
                <hr>
                <div class="form-group row">
                  <label for="" class="col-sm-2 col-form-label">Alamat</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control mb-3" name="address_1" value="<?= $profile['address_1'] ?>" placeholder="Alamat 1">
                    <input type="text" class="form-control" name="address_2" value="<?= $profile['address_2'] ?>" placeholder="Alamat 2">
                    <!-- <small class="text-danger">Error</small> -->
                  </div>
                </div>
                <div class="form-group row">
                  <div class="offset-sm-2 col-sm-10">
                    <button type="submit" class="btn btn-danger">Submit</button>
                  </div>
                </div>
              </form>
            </div><!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?= $this->endSection() ?>