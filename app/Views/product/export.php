<?= $this->extend('templates/export') ?>

<?= $this->section('content') ?>
<h1>Daftar Supplier</h1>
<table>
  <thead>
    <tr>
      <th>ID</th>
      <th>Nama</th>
      <th>Deskripsi</th>
      <th>Harga</th>
      <th>Stok Tersedia</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($products as $p) : ?>
      <tr>
        <td><?= $p['product_id'] ?></td>
        <td><?= $p['product_name'] ?></td>
        <td><?= $p['product_desc'] ?></td>
        <td>Rp<?= number_format($p['product_price'], 2, ',', '.') ?></td>
        <td><?= number_format($p['product_qty'], 0, ',', '.') ?></td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<?= $this->endSection() ?>