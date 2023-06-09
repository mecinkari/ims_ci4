<?= $this->extend('templates/layout') ?>

<?= $this->section('content') ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Master User</h1>
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
        <h3 class="card-title">Title</h3>
      </div>
      <div class="card-body table-responsive p-0" style="height: 640px;">
        <div class="p-3">
          <a href="<?= site_url('admin/create_user') ?>" class="btn btn-success"><i class="fa fa-plus"></i> Tambah User</a>
        </div>
        <?php if (session()->getFlashdata('success')) : ?>
          <div class="p-3">
            <div class="alert alert-success">
              <?= session()->getFlashdata('success') ?>
            </div>
          </div>
        <?php endif ?>
        <table class="table table-head-fixed text-nowrap">
          <thead>
            <tr>
              <th>UserID</th>
              <th>Username</th>
              <th>Roles</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($allUsers as $users) : ?>
              <tr style="vertical-align: middle;">
                <td><?= $users->user_id ?></td>
                <td><?= $users->user_name ?></td>
                <td><?= $users->role_name ?></td>
                <td><a href="<?= site_url('admin/edit_user/' . $users->user_id) ?>" class="btn btn-primary"><i class="fa fa-pen"></i></a> <a href="<?= site_url('admin/delete_user/' . $users->user_id) ?>" class="btn btn-danger"><i class="fa fa-trash"></i></a></td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
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