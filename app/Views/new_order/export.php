<?= $this->extend('templates/export') ?>

<?= $this->section('content') ?>

<h1>Invoice <?= $order_id ?></h1>


<table class="table">
  <thead>
    <tr>
      <th>Nama Produk</th>
      <th>Harga Produk</th>
      <th>Jumlah Barang Dipesan</th>
      <th>Sub Total Harga</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($order_details as $od) : ?>
      <tr>
        <td><?= $od['product_name'] ?></td>
        <td>Rp<?= number_format($od['product_price'], 2) ?></td>
        <td><?= $od['qty'] ?></td>
        <td>Rp<?= number_format($od['total'], 2) ?></td>
      </tr>
    <?php endforeach ?>
    <tr>
      <th colspan="3" class="text-center">Total</th>
      <td>Rp<?= number_format($total, 2) ?></td>
    </tr>
  </tbody>
</table>

<?= $this->endSection() ?>