<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Test</title>
</head>

<body>
  <h1>Test</h1>
  <form action="<?= site_url('test') ?>" method="post">
    <div class="list">
      <label for="">First Name</label>
      <input type="text" name="firstname[]" id=""> <br>
      <label for="">Last Name</label>
      <input type="text" name="lastname[]" id=""> <br>
      <hr>
    </div>
    <div id="added"></div>
    <button type="button" id="addRowBtn">Add Row</button>
    <button type="submit">Submit</button>
  </form>

  <script src="<?= base_url('') ?>plugins/jquery/jquery.min.js"></script>
  <script>
    $(document).ready(function() {
      i = 1;
      $('#addRowBtn').click(function() {
        // alert("Clicked");
        el = `<div class="list" data-id="${i}">
    <label for="">First Name</label>
      <input type="text" name="firstname[]" id=""> <br>
      <label for="">Last Name</label>
      <input type="text" name="lastname[]" id=""> <br>
      <hr>
    <button type="button" class="close-btn" data-close="${i}">&times;</button>
    </div>`

        $('#added').append(el);
        i++;
      });

      $('#added').on('click', '.close-btn', function(e) {
        $(`[data-id=${e.target.getAttribute('data-close')}]`).remove()
      })
    })
  </script>
</body>

</html>