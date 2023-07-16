<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $title ?></title>
</head>

<style>
  table {
    width: 100%;
  }

  table thead tr th {
    text-align: center;
  }

  table tbody tr td {
    border-top: 1px solid #ddd;
    padding: 12px;
  }
</style>

<body>
  <div id="content">
    <?= $this->renderSection('content') ?>
  </div>
  <div id="editor"></div>
</body>

<!-- jQuery -->
<script src="<?= base_url('') ?>plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?= base_url('') ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?= base_url('') ?>dist/js/jspdf.umd.min.js "></script>
<script src="<?= base_url('') ?>dist/js/html2canvas.min.js"></script>

<script>
  var date = new Date();

  var current_date = `${date.getFullYear()}-${((date.getMonth() + 1) < 10) ? ('0' + (date.getMonth() + 1)) : date.getMonth() + 1}-${date.getDate()}`;

  window.jsPDF = window.jspdf.jsPDF;
  var docPDF = new jsPDF();

  function print() {
    var elementHTML = document.querySelector("#content");
    docPDF.html(elementHTML, {
      callback: function(docPDF) {
        docPDF.save(`<?= $only_title ?> ${current_date}.pdf`);
      },
      x: 10,
      y: 10,
      width: 190,
      windowWidth: 1000
    });
  }

  print();
  setTimeout(() => {
    window.close();
  }, 1000);
</script>

</html>