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
          <h1>Add Purchased Products</h1>
        </div>
      </div>
    </div>
    <!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="card">
        <div class="card-body">
          <?php $validation = \Config\Services::validation() ?>
          <form action="<?= site_url('admin/add_purchased_product') ?>" method="post">
            <div class="form-group row">
              <label for="" class="col-sm-2 col-form-label">Nama Produk</label>
              <div class="col-sm-10">
                <select name="product_id" id="product_id" class="form-control">
                  <?php foreach ($products as $product) : ?>
                    <option value="<?= $product['product_id'] ?>"><?= $product['product_name'] ?></option>
                  <?php endforeach ?>
                </select>
              </div>
            </div>
            <div class="form-group row">
              <label for="" class="col-sm-2 col-form-label">Jumlah Produk</label>
              <div class="col-sm-10">
                <input class="form-control" type="number" name="qty" id="" value="1" min="1">
              </div>
            </div>
            <div class="form-group row">
              <label for="" class="col-sm-2 col-form-label">Nama Supplier</label>
              <div class="col-sm-10">
                <select name="supplier_id" id="supplier_id" class="form-control">
                  <?php foreach ($suppliers as $supplier) : ?>
                    <option value="<?= $supplier['supplier_id'] ?>"><?= $supplier['supplier_name'] ?></option>
                  <?php endforeach ?>
                </select>
              </div>
            </div>
            <div class="form-group row">
              <div class="col-sm-10 offset-sm-2">
                <button type="submit" class="btn btn-success">Submit</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?= $this->endSection() ?>