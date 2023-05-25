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
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Blank Page</li>
          </ol>
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
        <h3 class="card-title">List Order</h3>
      </div>
      <div class="card-body">
        <?php if (empty($allOrders)) : ?>
          <p>Anda belum membuat sebuah order.</p>
          <a href="<?= site_url('order/make') ?>" class="btn btn-success">Buat Order</a>
        <?php else : ?>
          <table class="table table-responsive table-head-fixed text-nowrap">
            <thead>
              <tr>
                <th>ID</th>
                <th>Jumlah Produk</th>
                <th>Total Harga</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $db = \Config\Database::connect();
              $builder = $db->table('order_details');
              foreach ($allOrders as $order) : ?>
                <?php
                $grand_total = $builder->selectSum('total')->where('order_id', $order['order_id'])->get()->getFirstRow();
                $count = $builder->selectCount('total', 'count')->where('order_id', $order['order_id'])->get()->getFirstRow();
                // print_r($count);
                ?>
                <tr>
                  <td><?= $order['order_id'] ?></td>
                  <td><?= $count->count ?></td>
                  <td><?= $grand_total->total ?></td>
                  <td>
                    <a href="" class="btn btn-primary"><i class="fa fa-fw fa-pen"></i></a>
                    <a href="<?= site_url('order/view_order/' . $order['order_id']) ?>" class="btn btn-success"><i class="fa fa-fw fa-eye"></i></a>
                    <a href="<?= site_url('order/delete_order/' . $order['order_id']) ?>" class="btn btn-danger"><i class="fa fa-fw fa-trash"></i></a>
                  </td>
                </tr>
              <?php endforeach ?>
            </tbody>
          </table>
        <?php endif ?>
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