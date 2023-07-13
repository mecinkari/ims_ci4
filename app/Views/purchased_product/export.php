<?= $this->extend('templates/export') ?>

<?= $this->section('content') ?>
<h1>Daftar Supplier</h1>
<table>
  <thead>
    <tr>
      <th>ID</th>
      <th>Nama Produk</th>
      <th>Stok Dibeli</th>
      <th>Nama Supplier</th>
      <th>Tanggal Beli</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($purchased_products as $p) : ?>
      <tr>
        <td><?= $p['purchased_product_id'] ?></td>
        <td><?= $p['product_name'] ?></td>
        <td><?= $p['qty'] ?></td>
        <td><?= $p['supplier_name'] ?></td>
        <td><?= $p['created_at'] ?></td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<?= $this->endSection() ?>