<?= $this->extend('templates/layout') ?>

<?= $this->section('content') ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Master Orders</h1>
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
      <div class="card-body table-responsive p-0">
        <?php if (session()->getFlashdata('success')) : ?>
          <div class="p-3">
            <div class="alert alert-success">
              <?= session()->getFlashdata('success') ?>
            </div>
          </div>
        <?php endif ?>
      </div>
      <table class="table table-head-fixed text-nowrap">
        <thead>
          <tr>
            <th>ID</th>
            <th>Status</th>
            <th>Nama</th>
            <th>User Email</th>
            <th>Action</th>
          </tr>
        <tbody>
          <?php foreach ($all_orders as $order) : ?>
            <tr>
              <td><?= $order['order_id'] ?></td>
              <td><?= $order['order_status'] ?></td>
              <td><?= $order['full_name'] ?></td>
              <td><?= $order['email'] ?></td>
              <td>
                <a href="<?= site_url('admin/update_status_order/' . $order['order_id']) ?>" class="btn btn-success">Update Status Order</a>
                <a href="<?= site_url('order/view_details/' . $order['order_id']) ?>" class="btn btn-primary">Check Order</a>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
        </thead>
      </table>
      <!-- /.card-body -->
      <div class="card-footer">
        <p>Catatan:</p>
        <ul>
          <li>0: Belum Bayar</li>
          <li>1: Bayar Partial</li>
          <li>2: Bayar Full</li>
          <li>3: Dalam Pengiriman</li>
          <li>4: Sudah Sampai</li>
        </ul>
      </div>
      <!-- /.card-footer-->
    </div>
    <!-- /.card -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?= $this->endSection() ?>