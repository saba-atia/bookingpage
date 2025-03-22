

    @include('dashborde.include.top')


<div class="container-scroller">
   
    <!-- partial:partials/_navbar.html -->
    @include('dashborde.include.navbar')

    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_sidebar.html -->
      @include('dashborde.include.sidebar')
      @yield( 'content')
    </div>
    <!-- page-body-wrapper ends -->
    @include('dashborde.include.footer')
  </div>



  
  @include('dashborde.include.end')
