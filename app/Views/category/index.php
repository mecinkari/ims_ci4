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
          <h1>Master Categories</h1>
        </div>
        <div class="col-sm-6">
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
        <a href="<?= site_url('admin/create_category') ?>" class="btn btn-success"><i class="fa fa-plus"></i> Tambah Category</a>
        <a href="<?= site_url('admin/export_category') ?>" target="_blank" class="btn btn-danger"><i class="fa fa-file-pdf"></i> Export PDF</a>
      </div>
      <div class="card-body table-responsive p-0" style="height: 500px;">
        <table class="table table-head-fixed text-nowrap">
          <thead>
            <tr>
              <th>ID</th>
              <th>Nama</th>
              <th>Deskripsi</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($categories as $category) : ?>
              <tr>
                <th><?= $category['category_id'] ?></th>
                <td><?= $category['category_name'] ?></td>
                <td><?= $category['category_desc'] ?></td>
                <td>
                  <a href="<?= site_url('admin/edit_category/' . $category['category_id']) ?>" class="btn btn-primary">
                    <div class="fa fa-pen"></div>
                  </a>
                  <a href="<?= site_url('admin/delete_category/' . $category['category_id']) ?>" class="btn btn-danger">
                    <div class="fa fa-trash"></div>
                  </a>
                </td>
              </tr>
            <?php endforeach ?>
          </tbody>
        </table>
      </div>
    </div>
    <!-- /.card -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?= $this->endSection() ?>