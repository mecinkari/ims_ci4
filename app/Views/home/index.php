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
        <div class="col-sm-12">
          <div class="card">
            <div class="card-body">
              <p id="clock" class="display-4"></p>
              <p id="date" class="lead text-bold"></p>
            </div>
          </div>
        </div>
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

      </div>
    </div>
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?= $this->endSection() ?>

<?= $this->section('js') ?>
<script>
  function clock() {
    var dateInfo = new Date();
    var day = dateInfo.getDate();
    var days = ["Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jum'at", "Sabtu"];
    var months = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
    var hour = (dateInfo.getHours() < 10) ? "0" + dateInfo.getHours() : dateInfo.getHours();
    var min = (dateInfo.getMinutes() < 10) ? "0" + dateInfo.getMinutes() : dateInfo.getMinutes();
    var sec = (dateInfo.getSeconds() < 10) ? "0" + dateInfo.getSeconds() : dateInfo.getSeconds();
    var current_time = `${hour} : ${min} : ${sec}`;
    var current_date = `${days[dateInfo.getDay()]}, ${day} ${months[dateInfo.getMonth()]} ${dateInfo.getFullYear()}`;

    $("#clock").text(current_time);
    $("#date").text(current_date);
  }

  clock();
  setInterval(() => {
    clock();
  }, 1000);
</script>
<?= $this->endSection() ?>