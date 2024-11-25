<!DOCTYPE html>
<html>

<head>
    @include('home.css')
</head>

<body>
  <div class="hero_area">
    <!-- header section strats -->
    @include('home.header')
    <!-- end header section -->
    <!-- slider section -->

    {{-- @include('home.slider') --}}

    <!-- end slider section -->
  </div>
  <!-- end hero area -->

  <!-- shop section -->
  @include('order.order')

  <!-- end shop section -->







  <!-- contact section -->


  <br><br><br>

  <!-- end contact section -->



  <!-- info section -->

  {{-- @include('home.footer') --}}

  <!-- end info section -->


  <script src="{{asset('js/jquery-3.4.1.min.js')}}"></script>
  <script src="{{asset('js/bootstrap.js')}}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js">
  </script>
  <script src="js/custom.js"></script>

</body>

</html>
