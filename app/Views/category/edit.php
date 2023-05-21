<?= $this->extend('templates/layout') ?>

<?= $this->section('content') ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Edit Category</h1>
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
        <form action="<?= site_url('admin/edit_category/' . $category['category_id']) ?>" method="post">
          <?= csrf_field() ?>
          <?php $validation = \Config\Services::validation() ?>
          <div class="form-group row">
            <label for="" class="col-sm-2 col-form-label">Nama Kategori</label>
            <div class="col-sm-10">
              <input type="text" name="category_name" class="form-control" value="<?= $category['category_name'] ?>">
              <?php if ($validation->getError('category_name')) : ?>
                <small class="text-danger"><?= $validation->getError('category_name') ?></small>
              <?php endif ?>
            </div>
          </div>
          <div class="form-group row">
            <label for="" class="col-sm-2 col-form-label">Deskripsi</label>
            <div class="col-sm-10">
              <input type="text" name="category_desc" class="form-control" value="<?= $category['category_desc'] ?>">
              <?php if ($validation->getError('category_desc')) : ?>
                <small class="text-danger"><?= $validation->getError('category_desc') ?></small>
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