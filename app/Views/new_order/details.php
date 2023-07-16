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
          <h1><?= $title ?></h1>
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
        <!-- <h3 class="card-title">Invoice</h3> -->
        <a href="<?= site_url('order/invoice/') . $order_id ?>" target="_blank" class="btn btn-danger"><i class="fa fa-file-pdf"></i> Cetak Invoice</a>
      </div>
      <div class="card-body">
        <table class="table">
          <thead>
            <tr>
              <th>Nama Produk</th>
              <th>Harga Produk</th>
              <th>Jumlah Barang Dipesan</th>
              <th>Sub Total Harga</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($order_details as $od) : ?>
              <tr>
                <td><?= $od['product_name'] ?></td>
                <td>Rp<?= number_format($od['product_price'], 2) ?></td>
                <td><?= $od['qty'] ?></td>
                <td>Rp<?= number_format($od['total'], 2) ?></td>
              </tr>
            <?php endforeach ?>
            <tr>
              <th colspan="3" class="text-center">Total</th>
              <td>Rp<?= number_format($total, 2) ?></td>
            </tr>
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