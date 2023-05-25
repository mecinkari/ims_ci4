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
          <h1>View Order</h1>
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

        <div class="card-tools">
          <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
            <i class="fas fa-minus"></i>
          </button>
          <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
            <i class="fas fa-times"></i>
          </button>
        </div>
      </div>
      <div class="card-body">
        <table>
          <thead>
            <tr>
              <th>Nama Produk</th>
              <th>Harga Produk</th>
              <th>Banyak Dibeli</th>
              <th>Total</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($order_details as $od) : ?>
              <tr>
                <td><?= $od['product_name'] ?></td>
                <td><?= $od['product_price'] ?></td>
                <td><?= $od['qty'] ?></td>
                <td><?= $od['total'] ?></td>
              </tr>
            <?php endforeach ?>
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