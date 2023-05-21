<?= $this->extend('templates/layout') ?>

<?= $this->section('content') ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1><?= $title ?></h1>
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
      <div class="card-body">
        <form action="<?= site_url('admin/edit_supplier/' . $supplier['supplier_id']) ?>" method="post">
          <?= csrf_field() ?>
          <?php $validation = \Config\Services::validation() ?>
          <div class="form-group row">
            <label for="" class="col-sm-2 col-form-label">Nama Supplier</label>
            <div class="col-sm-10">
              <input type="text" name="supplier_name" class="form-control" value="<?= $supplier['supplier_name'] ?>">
              <?php if ($validation->getError('supplier_name')) : ?>
                <small class="text-danger"><?= $validation->getError('supplier_name') ?></small>
              <?php endif ?>
            </div>
          </div>
          <div class="form-group row">
            <label for="" class="col-sm-2 col-form-label">Alamat Supplier</label>
            <div class="col-sm-10">
              <input type="text" name="supplier_address" class="form-control" value="<?= $supplier['supplier_address'] ?>">
              <?php if ($validation->getError('supplier_address')) : ?>
                <small class="text-danger"><?= $validation->getError('supplier_address') ?></small>
              <?php endif ?>
            </div>
          </div>
          <div class="form-group row">
            <label for="" class="col-sm-2 col-form-label">No. Telp.</label>
            <div class="col-sm-10">
              <input type="text" name="supplier_phone" class="form-control" value="<?= $supplier['supplier_phone'] ?>">
              <?php if ($validation->getError('supplier_phone')) : ?>
                <small class="text-danger"><?= $validation->getError('supplier_phone') ?></small>
              <?php endif ?>
            </div>
          </div>
          <div class="form-group row">
            <label for="" class="col-sm-2 col-form-label">Email</label>
            <div class="col-sm-10">
              <input type="email" name="supplier_email" class="form-control" value="<?= $supplier['supplier_email'] ?>">
              <?php if ($validation->getError('supplier_email')) : ?>
                <small class="text-danger"><?= $validation->getError('supplier_email') ?></small>
              <?php endif ?>
            </div>
          </div>
          <div class="form-group row">
            <div class="offset-sm-2 col-sm-10"><button type="submit" class="btn btn-success">Submit</button></div>
          </div>
        </form>
      </div>
      <!-- /.card-body -->
      <!-- /.card-footer-->
    </div>
    <!-- /.card -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?= $this->endSection() ?>