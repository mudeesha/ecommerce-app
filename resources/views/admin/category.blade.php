<!DOCTYPE html>
<html>
  <head>
    @include('admin.css')

    <style type="text/css">
      input[type='text'] {
        width: 400px;
        height:  50px;
      }

      .div_deg {
        display: flex;
        justify-content: center;
        align-items: center;
        margin: 30px;
      }

      .table_deg {
        text-align: center;
        margin: auto;
        border: 2px solid yellowgreen;
        margin-top: 50px;
        width: 600px;
      }

      th {
        background-color: skyblue;
        padding: 15px;
        font-size: 20px;
        color: white;
      }

    </style>
  </head>
  <body>
    <!-- header start -->
    @include('admin.header')
    <!-- header end -->

    <div class="d-flex align-items-stretch">
      <!-- Sidebar Navigation-->
      @include('admin.sidebar')
      <!-- Sidebar Navigation end-->
      <div class="page-content">
        <div class="page-header">
          <div class="container-fluid">

            <h1 style="color:white;">Add Category</h1>
            <div class="div_deg">

              <form action="{{ route('add_category') }}" method="POST">
                @csrf
                <div>
                  <input type="text" name="category"/>
                  <button class="btn btn-primary" type="submit">Add category</button>
                </div>
              </form>

            </div>

            <div>
                <table class="table_deg">
                    <tr>
                        <th>category Name</th>
                    </tr>

                    @foreach ($data as $data)
                    <tr>
                        <td>{{$data->category_name}}</td>
                    </tr>
                    @endforeach
                </table>

            <div>

      </div>
    </div>
    <!-- JavaScript files-->
    <script src="{{asset('admincss/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('admincss/vendor/popper.js/umd/popper.min.js')}}"> </script>
    <script src="{{asset('admincss/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('admincss/vendor/jquery.cookie/jquery.cookie.js')}}"> </script>
    <script src="{{asset('admincss/vendor/chart.js/Chart.min.js')}}"></script>
    <script src="{{asset('admincss/vendor/jquery-validation/jquery.validate.min.js')}}"></script>
    <script src="{{asset('admincss/js/charts-home.js')}}"></script>
    <script src="{{asset('admincss/js/front.js')}}"></script>
  </body>
</html>
