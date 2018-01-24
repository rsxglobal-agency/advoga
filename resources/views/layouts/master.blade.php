
<!DOCTYPE html>
<html>
@include('includes.head')
<body>
<!-- container section start -->
<section id="container" class="">

@include('includes.header')
@include('includes.menu')


<section id="main-content">
<section class="wrapper">
<div class="container">

@yield('content')

</div>


</section>
</section>

@include('includes.chat')

@include('includes.footer')

</body>
</html>
