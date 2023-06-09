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
        <table class="table">
          <thead>
            <tr>
              <th>Order ID</th>
              <th>Total Price Order</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($orders as $o) : ?>
              <tr>
                <td><?= $o['order_id'] ?></td>
                <td>Rp<?= number_format((float) $o['grand_total'], 0, ',', '.') ?></td>
                <td><a href="<?= site_url('transaction/check_out/' . $o['order_id']) ?>" class="btn btn-primary">Check Out</a></td>
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