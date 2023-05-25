<?= $this->extend('templates/layout') ?>

<?= $this->section('content') ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <?php

      use App\Models\Product;

      if (session()->getFlashdata('success')) : ?>
        <div class="alert alert-success">
          <?= session()->getFlashdata('success') ?>
        </div>
      <?php endif ?>
      <?php if (session()->getFlashdata('error')) : ?>
        <div class="alert alert-danger">
          <?= session()->getFlashdata('error') ?>
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
        <p class="m-0"><strong>Receipt Order : <?= session()->get('order_id') ?></strong></p>
      </div>
      <div class="card-body">
        <!-- <form action="<?= site_url('admin/create_order') ?>" method="post"> -->
        <form>
          <?= csrf_field() ?>
          <?php $validation = \Config\Services::validation() ?>
          <div id="list">
            <div class="card">
              <div class="card-body">
                <div class="form-group row">
                  <label for="" class="col-sm-2 col-form-label">Nama Produk</label>
                  <div class="col-sm-10">
                    <select name="product_id" id="productID" class="form-control">
                      <?php $productModel = new Product(); ?>
                      <option value="nan">Pilih Produk</option>
                      <?php foreach ($allCategories as $cat) : ?>
                        <optgroup label="<?= $cat['category_name'] ?>"></optgroup>
                        <?php $products = $productModel->where('category_id', $cat['category_id'])->findAll() ?>
                        <?php foreach ($products as $pd) : ?>
                          <option value="<?= $pd['product_id'] ?>-<?= $pd['product_name'] ?>"><?= $pd['product_name'] . " | (" . $pd['product_id'] . ")" ?></option>
                        <?php endforeach ?>
                      <?php endforeach ?>
                    </select>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="" class="col-sm-2 col-form-label">Stok Produk</label>
                  <div class="col-sm-10">
                    <span id="stock">0</span>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="" class="col-sm-2 col-form-label">Jumlah Produk yang Akan Dibeli</label>
                  <div class="col-sm-10">
                    <input type="number" name="qty" min="1" id="qty" value="1" class="form-control">
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group row">
            <div class="offset-sm-2 col-sm-10"><button type="button" id="addBtn" class="btn btn-success">Tambah Produk</button></div>
          </div>
          <div class="form-group row">
            <div class="offset-sm-2 col-sm-10"><button type="button" id="cancel" class="btn btn-danger">Batalkan Order</button></div>
          </div>
        </form>

        <table class="table table-head-fixed text-nowrap">
          <thead>
            <th>No</th>
            <th>Nama Produk</th>
            <th>Kuantiti</th>
            <th>Aksi</th>
          </thead>
          <tbody id="addedRow">

          </tbody>
        </table>
      </div>
      <!-- /.card-body -->
      <!-- /.card-footer-->
    </div>
    <!-- /.card -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?= $this->endSection() ?>

<?= $this->section('js') ?>
<script>
  $(document).ready(function() {
    let forms = 1;

    $('#cancel').click(function() {
      if (confirm('Batalkan order yang sedang berlangsung?') == true) {
        window.location.replace("<?= site_url('order/cancel') ?>")
      }
    });

    $('#productID').change(function(e) {
      // alert(e.target.value); 
      if (e.target.value == 'nan') {
        $('#stock').text('-');
        return
      }

      $('#qty').val(1);

      $.post('<?= site_url('order/get_stock') ?>', {
        'product_id': e.target.value,
      }, function(data, status) {
        // alert("Data: " + data + "\nStatus: " + status)
        $('#stock').text(data);
        $('#qty').attr('max', data);
      });
    })


    $('#addBtn').click(function() {
      let product_id = $('#productID').val();
      product = product_id.split("-");

      let el = `<tr id=form-${forms}>
              <td>${forms}</td>
              <td><input class="form-control" type="text" value="${product[1]}"></td>
              <td><input class="form-control" type="number" value="0"></td>
              <td><button type="button" class="btn btn-danger">&cross;</button></td>
            </tr>`

      $('#addedRow').append(el);

      forms++;
    })

  });
</script>
<?= $this->endSection() ?>