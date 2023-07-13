<?= $this->extend('templates/export') ?>

<?= $this->section('content') ?>
<h1>Daftar Supplier</h1>
<table>
  <thead>
    <tr>
      <th>ID</th>
      <th>Nama</th>
      <th>Alamat</th>
      <th>No. Telp</th>
      <th>Email</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($suppliers as $s) : ?>
      <tr>
        <td><?= $s['supplier_id'] ?></td>
        <td><?= $s['supplier_name'] ?></td>
        <td><?= $s['supplier_address'] ?></td>
        <td><?= $s['supplier_phone'] ?></td>
        <td><?= $s['supplier_email'] ?></td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<?= $this->endSection() ?>