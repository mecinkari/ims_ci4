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
          <h1>Dashboard</h1>
        </div>
      </div>
    </div>
    <!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-6 col-6">

          <div class="small-box bg-info">
            <div class="inner">
              <h3><?= $total_orders ?></h3>
              <p>On Going Orders</p>
            </div>
            <div class="icon">
              <i class="fa fa-cart-arrow-down"></i>
            </div>
          </div>
        </div>

        <!-- <div class="col-lg-6 col-6">

          <div class="small-box bg-success">
            <div class="inner">
              <h3>Rp<?= number_format($total_payment) ?></h3>
              <p>Payment on hold</p>
            </div>
            <div class="icon">
              <i class="fa fa-dollar-sign"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div> -->

      </div>
    </div>
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?= $this->endSection() ?>