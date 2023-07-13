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
          <h1>Purchased Products</h1>
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
          <a href="<?= site_url('admin/add_purchased_product') ?>" class="btn btn-success">Tambah Produk</a>
          <a href="<?= site_url('admin/export_purchased_product') ?>" target="_blank" class="btn btn-danger"><i class="fa fa-file-pdf"></i> Export PDF</a>

          <table class="table">
            <thead>
              <tr>
                <th>ID</th>
                <th>Produk</th>
                <th>QTY</th>
                <th>Supplier</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($purchased_products as $list) : ?>
                <tr>
                  <td><?= $list['purchased_product_id'] ?></td>
                  <td><?= $list['product_name'] ?></td>
                  <td><?= $list['qty'] ?></td>
                  <td><?= $list['supplier_name'] ?></td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?= $this->endSection() ?>