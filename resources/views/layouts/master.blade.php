
<!DOCTYPE html>
<html>
@include('includes.head')
<body>
<!-- container section start -->
<section id="container" class="">

@include('includes.header')
@include('includes.menu')


<section class="col-sm-9">
<section class="wrapper">

@yield('content')



</section>
</section>

@include('includes.chat')

@include('includes.footer')

</body>
</html>
