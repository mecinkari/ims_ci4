<?= $this->extend('templates/layout') ?>

<?= $this->section('content') ?>

<?php
$status_orders = array(
  '0' => 'Belum Bayar',
  '1' => 'Bayar Parsial',
  '2' => 'Full Bayar',
  '3' => 'Dalam Pengiriman',
  '4' => 'Sudah Sampai',
)
?>

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
      <div class="card-body">
        <form action="<?= site_url('admin/update_status_order/' . $order['order_id']) ?>" method="post">
          <div class="form-group">
            <label for="">Order ID</label>
            <input type="text" name="order_id" id="order_id" readonly value="<?= $order['order_id'] ?>" class="form-control">
          </div>
          <div class="form-group">
            <label for="">Order ID</label>
            <select name="order_status" id="order_status" class="form-control">
              <?php foreach ($status_orders as $key => $value) : ?>
                <option <?= ($key == $order['order_status']) ? 'selected' : '' ?> value="<?= $key ?>"><?= $key . ' - ' . $value ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <button class="btn btn-success" type="submit">Submit</button>
        </form>
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