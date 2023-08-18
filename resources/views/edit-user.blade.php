<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">

<title>edit Student</title>
{{--  css only--}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" >
{{--  ajax--}}
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

</head>

<body>
<div class="container" style="margin-top: 50px">
  <!-- row -->
  <div class="row">

    <div class="col-md-12">
      <h2>Student List</h2>

      <div style="  margin:1% 0%">
          <a href="{{url('/get-students')}}"><button type="button" class="btn btn-primary"> << Back </button></a>
      </div>

  </div>

  </div>
  <!-- row -->
  <!-- row -->
<div style="margin: 30px;">

  <div>
    <img src="{{asset('storage/')}}/{{$student[0]->image}}" alt="" width="100">
  </div>
  <br>

  <form id="update-form"  method="POST" enctype="multipart/form-data" >

    <label>
      <input type="text" name="name" value="{{$student[0]->name}}" placeholder="Enter Name" required>
    </label>

    <br><br>

    <label>
      <input type="text" name="email" value="{{$student[0]->email}}" placeholder="Enter Email" required>
    </label>

    <br><br>
    <input type="file" name="file">
    <input type="hidden" name="id" value="{{$student[0]->id}}">

    <br><br>
    <input type="submit" value="Update Data">
    @csrf

  </form>

  <br>
  <span id="output"></span>

</div>
  <!-- row -->

<script>
  $(document).ready(function(){
    var token = $('meta[name="csrf-token"]').attr('content'); // Fetch CSRF token
    var form = $("#update-form")[0];
    new FormData(form);
    // console.log(form);
    $("#update-form").submit(function (event){
      event.preventDefault();

      var form = $("#update-form")[0];
      var data = new FormData(form);
      // Append the CSRF token to the FormData
      data.append('_token', token);

      $.ajax({
          type: "post",
          url: "{{route('updateStudent')}}",
        data:data,
        processData:false,
        contentType:false,
        success:function(data){
            $("#output").text(data.filePath);
            window.open("/get-students","_self")
        },
        error:function(err){
            $("#output").text(err.responseText);
        }
        }

      );
    })
  });
</script>


</body>
</html>
