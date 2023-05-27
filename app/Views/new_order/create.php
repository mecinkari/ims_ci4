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
      <div class="card-body">
        <table class="table">
          <thead>
            <tr>
              <th>Nama Produk</th>
              <th>Stok Tersedia</th>
              <th>Jumlah Yang akan Dibeli</th>
              <th>Harga Produk</th>
              <th>Total Harga</th>
            </tr>
          <tbody>
            <tr>
              <td>
                <select name="product_id" id="productID" class="form-control">
                  <option value="0">Pilih Produk</option>
                  <?php foreach ($categories as $cat) : ?>
                    <optgroup label="<?= $cat['category_name'] ?>">
                      <?php $productModel = new Product();
                      $products = $productModel->where('category_id', $cat['category_id'])->findAll();
                      foreach ($products as $p) : ?>
                        <option value="<?= $p['product_id'] ?>"><?= $p['product_name'] ?></option>
                      <?php endforeach ?>
                    </optgroup>
                  <?php endforeach ?>
                </select>
              </td>
              <td><input readonly type="number" value="0" id="productQty" class="form-control"></td>
              <td><input type="number" name="qty" min="1 value=" 1" id="qty" class="form-control"></td>
              <td><input readonly type="number" name="product_price" id="productPrice" class="form-control"></td>
              <td><input readonly type="number" name="total" id="totalPrice" class="form-control"></td>
            </tr>
          </tbody>
          </thead>
        </table>
        <div class="form-group p-3">
          <button id="btnSubmit" type="button" class="btn btn-primary btn-block">Submit</button>
          <a href="<?= site_url('order/save_order') ?>" class="btn btn-success btn-block" id="btnSelesai">Selesai</a>
        </div>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?= $this->section('js') ?>
<script>
  $(document).ready(function() {
    let totalPrice = 0
    let productPrice = 0
    let productQty = 0;
    let product_id = '';
    let grandtotal = 0;
    $("#btnSubmit").hide();
    $("#btnSelesai").hide();

    $("#productID").change(function(e) {
      if (e.target.value != 0) {
        $.get(`<?= site_url('api/get_product_detail') ?>/${e.target.value}`, function(res, status) {
          let data = JSON.parse(res);
          console.log(data);
          productPrice = data.product_price
          productQty = data.product_qty
          product_id = e.target.value
          totalPrice = parseInt($("#qty").val()) * parseInt(productPrice)

          $("#productPrice").val(productPrice);
          $("#productQty").val(productQty);
          $("#totalPrice").val(totalPrice);
          $("#qty").val(1);
          $("#btnSubmit").show();
        })
      } else {
        $("#productPrice").val(0);
        $("#productQty").val(0);
        $("#totalPrice").val(0);
        $("#qty").val(1);
        $("#btnSubmit").hide();
      }
    })

    $("#qty").change(function(e) {
      let grandtotal = productPrice * e.target.value;
      $("#totalPrice").val(grandtotal);
    })

    $("#btnSubmit").click(function() {
      let data = {
        "product_id": product_id,
        "qty": $("#qty").val(),
        "total": parseInt($("#totalPrice").val()),
      };

      $.post('<?= site_url('order/save') ?>', data, function(res, status) {
        alert("Data berhasil dimasukkan ke database");
        console.log(res);
        $("#productID").val("0");
        $("#productPrice").val(0);
        $("#productQty").val(0);
        $("#totalPrice").val(0);
        $("#qty").val(1);
        $("#btnSubmit").hide();
        $("#btnSelesai").show();
      })

    })
  })
</script>
<?= $this->endSection() ?>

<?= $this->endSection() ?>