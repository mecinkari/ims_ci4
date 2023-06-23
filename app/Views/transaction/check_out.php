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
        <h3 class="card-title">Order ID: <?= $transaction_id ?></h3>
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
      <div class="card-footer">
        <p>Pay</p>
        <a href="<?= site_url('transaction/check_out_now/' . $transaction_id) ?>" class="btn btn-success">Check Out Now!</a>
      </div>
      <!-- /.card-footer-->
    </div>
    <!-- /.card -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?= $this->endSection() ?>