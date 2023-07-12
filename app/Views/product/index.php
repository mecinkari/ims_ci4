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
        </div>
      </div>
    </div>
    <!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <!-- Default box -->
    <div class="card">
      <div class="card-body table-responsive p-0" style="height: 500px;">
        <div class="p-3">
          <a href="<?= site_url('admin/create_product') ?>" class="btn btn-success"><i class="fa fa-plus"></i> Tambah Data Produk</a>
        </div>
        <table class="table table-head-fixed text-nowrap">
          <thead>
            <tr>
              <th>ID</th>
              <th>Nama</th>
              <th>Deskripsi</th>
              <th>Harga</th>
              <th>Stok</th>
              <!-- <th>Supplier</th> -->
              <th>Kategori</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($products as $product) : ?>
              <tr>
                <th><?= $product['product_id'] ?></th>
                <td><?= $product['product_name'] ?></td>
                <td><?= $product['product_desc'] ?></td>
                <td><?= $product['product_price'] ?></td>
                <td><?= $product['product_qty'] ?></td>
                <td><?= $product['category_name'] ?></td>
                <td>
                  <a href="<?= site_url('admin/edit_product/' . $product['product_id']) ?>" class="btn btn-primary">
                    <div class="fa fa-pen"></div>
                  </a>
                  <a href="<?= site_url('admin/delete_product/' . $product['product_id']) ?>" class="btn btn-danger">
                    <div class="fa fa-trash"></div>
                  </a>
                </td>
              </tr>
            <?php endforeach ?>
          </tbody>
        </table>
      </div>
    </div>
    <!-- /.card -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?= $this->endSection() ?>