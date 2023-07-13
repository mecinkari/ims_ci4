<?= $this->extend('templates/export') ?>

<?= $this->section('content') ?>
<h1>Daftar Kategori</h1>
<table>
  <thead>
    <tr>
      <th>ID</th>
      <th>Nama Kategori</th>
      <th>Deskripsi</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($categories as $c) : ?>
      <tr>
        <td><?= $c['category_id'] ?></td>
        <td><?= $c['category_name'] ?></td>
        <td><?= $c['category_desc'] ?></td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<?= $this->endSection() ?>