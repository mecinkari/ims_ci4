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
        <form action="<?= site_url('admin/edit_product/' . $product['product_id']) ?>" method="post">
          <?= csrf_field() ?>
          <?php $validation = \Config\Services::validation() ?>
          <div class="form-group row">
            <label for="" class="col-sm-2 col-form-label">Nama Produk</label>
            <div class="col-sm-10">
              <input type="text" name="product_name" class="form-control" value="<?= $product['product_name'] ?>">
              <?php if ($validation->getError('product_name')) : ?>
                <small class="text-danger"><?= $validation->getError('product_name') ?></small>
              <?php endif ?>
            </div>
          </div>
          <div class="form-group row">
            <label for="" class="col-sm-2 col-form-label">Deskripsi Produk</label>
            <div class="col-sm-10">
              <input type="text" name="product_desc" class="form-control" value="<?= $product['product_desc'] ?>">
              <?php if ($validation->getError('product_desc')) : ?>
                <small class="text-danger"><?= $validation->getError('product_desc') ?></small>
              <?php endif ?>
            </div>
          </div>
          <div class="form-group row">
            <label for="" class="col-sm-2 col-form-label">Harga Produk</label>
            <div class="col-sm-10">
              <input type="number" name="product_price" class="form-control" value="<?= $product['product_price'] ?>">
              <?php if ($validation->getError('product_price')) : ?>
                <small class="text-danger"><?= $validation->getError('product_price') ?></small>
              <?php endif ?>
            </div>
          </div>
          <div class="form-group row">
            <label for="" class="col-sm-2 col-form-label">Stok</label>
            <div class="col-sm-10">
              <input type="number" name="product_qty" class="form-control" value="<?= $product['product_qty'] ?>">
              <?php if ($validation->getError('product_qty')) : ?>
                <small class="text-danger"><?= $validation->getError('product_qty') ?></small>
              <?php endif ?>
            </div>
          </div>
          <div class="form-group row">
            <label for="" class="col-sm-2 col-form-label">Supplier</label>
            <div class="col-sm-10">
              <!-- <input type="text" name="product_name" class="form-control"> -->
              <select name="supplier_id" id="" class="form-control">
                <?php foreach ($suppliers as $sup) : ?>
                  <option <?php if ($product['supplier_id'] == $sup['supplier_id']) : ?> selected <?php endif ?> value="<?= $sup['supplier_id'] ?>"><?= $sup['supplier_name'] . ' - ' . $sup['supplier_email'] ?></option>
                <?php endforeach ?>
              </select>
              <?php if ($validation->getError('supplier_id')) : ?>
                <small class="text-danger"><?= $validation->getError('supplier_id') ?></small>
              <?php endif ?>
            </div>
          </div>
          <div class="form-group row">
            <label for="" class="col-sm-2 col-form-label">Kategori</label>
            <div class="col-sm-10">
              <!-- <input type="text" name="product_name" class="form-control"> -->
              <select name="category_id" id="" class="form-control">
                <?php foreach ($categories as $cat) : ?>
                  <option <?php if ($product['category_id'] == $cat['category_id']) : ?> selected <?php endif ?> value="<?= $cat['category_id'] ?>"><?= $cat['category_id'] . '-' . $cat['category_name'] ?></option>
                <?php endforeach ?>
              </select>
              <?php if ($validation->getError('category_id')) : ?>
                <small class="text-danger"><?= $validation->getError('category_id') ?></small>
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