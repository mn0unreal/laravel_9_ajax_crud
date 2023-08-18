<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Student List</title>
  {{--  css only--}}
  <link rel="stylesheet" href="{{url("/assets/css/bootstrap.min.css")}}" >
  {{--  ajax--}}
  <script src="{{url("/assets/jquery-3.6.4.min.js")}}"></script>

{{--  <style>--}}
{{--    * {--}}
{{--      -moz-box-sizing: border-box;--}}
{{--      -webkit-box-sizing: border-box;--}}
{{--      box-sizing: border-box;--}}
{{--      margin: 0;--}}
{{--      padding: 0;--}}
{{--    }--}}

{{--    .HoverDiv {--}}
{{--      position: relative;--}}
{{--      overflow: hidden;--}}
{{--      border: 1px solid black;--}}
{{--      width: 360px;--}}
{{--      margin: 10px;--}}
{{--    }--}}

{{--    .HoverDiv img {--}}
{{--      max-width: 100%;--}}
{{--      text-align: center;--}}
{{--      -moz-transition: all 0.3s;--}}
{{--      -webkit-transition: all 0.3s;--}}
{{--      transition: all 0.3s;--}}
{{--    }--}}

{{--    .HoverDiv:hover img {--}}
{{--      -moz-transform: scale(1.1);--}}
{{--      -webkit-transform: scale(1.1);--}}
{{--      transform: scale(1.1);--}}
{{--    }--}}

{{--    img {--}}
{{--      display: inline-block;--}}
{{--      border: 1px solid #ddd;--}}
{{--      border-radius: 4px;--}}
{{--      padding: 5px;--}}
{{--      transition: 0.3s;--}}
{{--      position: relative;--}}
{{--      z-index: 1;--}}
{{--    }--}}

{{--    img:hover {--}}
{{--      box-shadow: 0 0 2px 1px rgba(0, 140, 186, 0.5);--}}
{{--      -webkit-transform: skewX(-20deg);--}}
{{--      -ms-transform: skewX(-20deg);--}}
{{--      transform: skewX(-20deg);--}}
{{--      -webkit-transform-origin: 0 0;--}}
{{--      -ms-transform-origin: 0 0;--}}
{{--      transform-origin: 0 0;--}}
{{--    }--}}
{{--  </style>--}}

</head>
<body>

<div class="container" style="margin-top: 50px">
  <!-- row -->
  <div class="row">

    <div class="col-md-12">
      <h2>Student List</h2>

      <div style="float: right; margin:1% 0%">
          <a href="{{url('add-student')}}"><button type="button" class="btn btn-primary"> Add new </button></a>
      </div>

        <span id="output"></span>
      <!-- table -->
      <table id="students" class="table table-striped-columns" style="margin-bottom: 10%" border="1" >
        <thead>
        <tr>
          <th>#</th>
          <th>Name</th>
          <th>Email</th>
          <th>Image</th>
          <th>Action</th>
        </tr>
        </thead>
        <tbody>
        </tbody>
      </table>
      <!-- table -->
      </div>

  </div>
  <!-- row -->

</div>

<script>
  $(document).ready(function (){
    $.ajax({
      error: function (err) {
        console.log(err.responseText);

      },
      success: function (data) {
        console.log(data);
        if (data.students.length > 0) {
          for (let i = 0; i < data.students.length; i++) {

            let img = data.students[i]['image'];

            $("#students").append(`<tr>
              <td>` + (i + 1) + `</td>
              <td>` + (data.students[i]['name']) + `</td>
              <td>` + (data.students[i]['email']) + `</td>
              <td>
                <img class="" style=" width:90px;height:90px" src="{{asset('storage/`+img+`')}}" alt="` + img + `"/>
              </td>

              <td style="width: 170px;height: 5px !important;">
                <a style="width: 70px " href="editUser/` + (data.students[i]['id']) + `" class="btn btn-info"> Edit </a>
                <a href="#" class="deleteData btn btn-danger" data-id="` + (data.students[i]['id']) + `">Delete</a>
              </td>

          </tr>`)
          }
        } else {
          $("#students").append("<tr><td colspan='4'> Data Not Found</td></tr>");
        }

      },
      type: "GET",
      url: "{{route('getStudents')}}"
    });

    $("#students").on("click",".deleteData",function (){
      // alert($(this).attr("data-id"));
      var id = $(this).attr("data-id");
      var obj = $(this);
      $.ajax({
        type:"GET",
        url:"/delete-student/"+id,
        success:function(data){
          $(obj).parent().parent().remove();
          $("#output").text(data.message)

        },
        error:function(err){console.log(err.responseText)}
      });
    });

  });
</script>
</body>
</html>
