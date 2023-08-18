<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>ajax</title>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>


</head>

<body>

{{--<form id="my-form" method="post" >--}}
  <form id="my-form" method="POST" action="{{ route('form_submit') }}" enctype="multipart/form-data">

  <table>
    <tr>
      <td>name :</td>
      <td>
        <label>
          <input type="text" name="name" required />
        </label>
      </td>
    </tr>
    <tr>
      <td>Email :</td>
      <td>
        <label>
          <input type="email" name="email" required />
        </label>
      </td>
    </tr>
    <tr>
      <td>image :</td>
      <td>
        <input type="file" name="image">

      </td>
    </tr>
    <tr>
      <td></td>
      <td> <input type="submit" name="submit" id="btnSubmit" /></td>
    </tr>
  </table>
  @csrf
</form>
<span id="output">

</span>

{{--<script src="https://code.jquery.com/jquery-3.5.0.min.js"></script>--}}
<script>
  $(document).ready(function() {
    $('#my-form').submit(function (event) {
      event.preventDefault();

      var token = $('meta[name="csrf-token"]').attr('content'); // Fetch CSRF token

      var form = $("#my-form")[0];
      var data = new FormData(form);
      $("btnSubmit").prop("disabled",true);

      var formData = new FormData($('form')[0]);

      $.ajax({
        type: 'POST',
        url: '{{ route('form_submit') }}',
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
          $("#output").text(data.res);
          $("btnSubmit").prop("disabled",false);
          $("input[type='text']").val('');
          $("input[type='email']").val('');
          $("input[type='file']").val('');

          // Handle success response
        },
        error: function(xhr, status, error) {
          $("#output").text(e.responseText);
          $("btnSubmit").prop("disabled",false);
          $("input[type='text']").val('');
          $("input[type='email']").val('');
          $("input[type='file']").val('');

          // Handle error
        }
      });
    });
  });
</script>

</body>
</html>
