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
        <h3 class="card-title">Title</h3>
      </div>
      <div class="card-body">
        <?php //if (empty($orders)) : 
        ?>
        <!-- <a href="" class="btn btn-success">Tambah Order</a> -->
        <?php //endif; 
        ?>
        <a href="<?= site_url('order/make') ?>" class="btn btn-success">Tambah Order</a>
        <table class="table">
          <thead>
            <tr>
              <th>Order ID</th>
              <th>Status</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($orders as $or) : ?>
              <tr>
                <td><?= $or['order_id'] ?></td>
                <td>
                  <?php if ($or['order_status'] == 0) : ?>
                    <span class="badge badge-danger">Belum Bayar</span>
                  <?php elseif ($or['order_status'] == 1) : ?>
                    <span class="badge badge-warning">Bayar Parsial</span>
                  <?php elseif ($or['order_status'] == 2) : ?>
                    <span class="badge badge-success">Bayar Full</span>
                  <?php elseif ($or['order_status'] == 3) : ?>
                    <span class="badge badge-primary">Dalam Pengiriman</span>
                  <?php elseif ($or['order_status'] == 4) :  ?>
                    <span class="badge badge-success">Sudah Sampai</span>
                  <?php endif ?>
                </td>
                <td>
                  <a href="<?= site_url('order/view_details/' . $or['order_id']) ?>" class="btn btn-success"><i class="fa fa-eye"></i> Lihat Order</a>
                  <?php if (in_array($or['order_status'], ['0', '1'])) : ?>
                    <a href="<?= site_url('order/cancel_order/' . $or['order_id']) ?>" class="btn btn-danger"><i class="fa fa-trash"></i> Batalkan Order</a>
                  <?php endif ?>
                </td>
              </tr>
            <?php endforeach; ?>
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