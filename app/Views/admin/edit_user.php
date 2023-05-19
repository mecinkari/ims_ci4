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
          <h1>Edit User</h1>
        </div>
        <!-- <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Blank Page</li>
          </ol>
        </div> -->
      </div>
    </div>
    <!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <!-- Default box -->
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Edit data <?= $data_user['user_name'] ?></h3>
      </div>
      <div class="card-body">
        <?php $validation = \Config\Services::validation() ?>
        <form action="<?= site_url('admin/update_user') ?>" method="post">
          <div class="form-group row">
            <label for="" class="col-sm-2 col-form-label">Username</label>
            <div class="col-sm-10">
              <input type="text" name="username" value="<?= $data_user['user_name'] ?>" disabled class="form-control">
              <?php if ($validation->getError('username')) : ?>
                <small class="text-danger"><?= $validation->getError('username') ?></small>
              <?php endif ?>
            </div>
          </div>
          <div class="form-group row">
            <label for="" class="col-sm-2 col-form-label">Password</label>
            <div class="col-sm-10">
              <input type="password" name="password" disabled class="form-control">
              <?php if ($validation->getError('password')) : ?>
                <small class="text-danger"><?= $validation->getError('password') ?></small>
              <?php endif ?>
            </div>
          </div>
          <div class="form-group row">
            <label for="" class="col-sm-2 col-form-label">Role</label>
            <div class="col-sm-10">
              <select name="role_id" class="form-control" id="">
                <?php foreach ($roles as $role) : ?>
                  <option <?php if ($data_user['role_id'] == $role['role_id']) : ?> selected <?php endif ?> value="<?= $role['role_id'] ?>"><?= $role['role_id'] . '. ' . $role['role_name'] ?></option>
                <?php endforeach ?>
              </select>
            </div>
          </div>
          <div class="form-group row">
            <div class="offset-sm-2 col-sm-10"><button type="submit" class="btn btn-success">Submit</button></div>
          </div>
        </form>
      </div>
      <!-- /.card-body -->
      <div class="card-footer">Footer</div>
      <!-- /.card-footer-->
    </div>
    <!-- /.card -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?= $this->endSection() ?>