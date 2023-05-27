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
                  <label for="" class="col-sm-2 col-form-label">Harga Produk</label>
                  <div class="col-sm-10">
                    <input type="number" disabled value="0" id="price" class="form-control">
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
            <div class="offset-sm-2 col-sm-10">
              <button type="button" id="cancel" class="btn btn-outline-danger">Batalkan Order</button>
            </div>
          </div>
        </form>

        <form action="<?= site_url('order/create') ?>" method="post">
          <table class="table table-head-fixed text-nowrap">
            <thead>
              <th>No</th>
              <th>Nama Produk</th>
              <th>Kuantiti</th>
              <th>Total</th>
              <th>Aksi</th>
            </thead>
            <tbody id="addedRow">

            </tbody>
          </table>
          <div class="form-group mt-3">
            <button type="submit" class="btn btn-primary submit-btn">Submit</button>
          </div>
        </form>
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

    // $.get('<?= site_url('api/get_all_products') ?>', function(res, status) {
    //   data = JSON.parse(res)
    //   for (let index = 0; index < data.length; index++) {
    //     const element = data[index];
    //     `<tr data-id="${forms}">
    //           <td>${forms}</td>
    //           <td><input type="hidden" name="product_id[]" value="${product[0]}" ><input class="form-control" disabled type="text" value="${product[1]}"></td>
    //           <td><input class="form-control" readonly name="qty[]" type="number" value="${qty}"></td>
    //           <td><input class="form-control" readonly name="total[]" type="number" value="${total}"></td>
    //           <td><button type="button" data-close="${forms}" class="btn btn-danger close-btn">&cross;</button></td>
    //         </tr>`

    //     forms++;
    //   }
    // })

    $('.submit-btn').hide();

    function submitBtn() {
      if ($('#addedRow tr').length == 0) {
        $('.submit-btn').hide();
      } else {
        $('.submit-btn').show();
      }
    }

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

      let product = e.target.value;
      let product_id = product.split("-");

      $.post('<?= site_url('order/get_stock') ?>', {
        'product_id': product_id[0],
      }, function(res, status) {
        data = JSON.parse(res);
        // alert("Data: " + data + "\nStatus: " + status)
        // console.log(JSON.parse(data));
        $('#qty').attr('max', data.stock);
        $('#stock').text(data.stock);
        $('#price').val(data.price);
      });
    })


    $('#addBtn').click(function() {
      let product_id = $('#productID').val();
      let qty = $('#qty').val();
      let price = $('#price').val();
      let total = qty * price;
      product = product_id.split("-");

      let el = `<tr data-id="${forms}">
              <td>${forms}</td>
              <td><input type="hidden" name="product_id[]" value="${product[0]}" ><input class="form-control" disabled type="text" value="${product[1]}"></td>
              <td><input class="form-control" readonly name="qty[]" type="number" value="${qty}"></td>
              <td><input class="form-control" readonly name="total[]" type="number" value="${total}"></td>
              <td><button type="button" data-close="${forms}" class="btn btn-danger close-btn">&cross;</button></td>
            </tr>`

      $('#addedRow').append(el);

      forms++;
      submitBtn();
    })

    $('#addedRow').on('click', '.close-btn', function(e) {
      $(`[data-id=${e.target.getAttribute('data-close')}]`).remove()
      submitBtn();
    })
  });
</script>
<?= $this->endSection() ?>