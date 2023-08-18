<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>ajax</title>

  <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">



</head>

<body>
<center>
  <div id="message"></div>

  <form action="{{url('ajaxupload')}}" method="post" id="addpost">
    @csrf
    <br><br>
    <div>
        <label>Title</label>
        <input type="text" name="title" />
    </div>
    <br>
    <div>
        <label>Description</label>
        <input type="text" name="description" />
    </div>
    <br>
    <input type="submit" value="submit" />


</form>

</center>

{{--<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js"></script>
--}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>

<script>
  $(document).ready(function (){
    $('#addpost').on('submit',function (event)
      {
        event.preventDefault();

        jQuery.ajax({
        url:"{{url('ajaxupload')}}",
        data:jQuery('#addpost').serialize(),
        type:'post',
          success:function (result)
          {
            $('#message').css('display','block');
            jQuery('#message').html(result.message);
            jQuery('#addpost')[0].reset();

          }
        })
      }
    );
  });
</script>
</body>
</html>
