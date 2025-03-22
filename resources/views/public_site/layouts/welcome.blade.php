<!DOCTYPE html>
<html lang="en">
  @include('public_site.include.top')
   <!-- body -->
   <body class="main-layout">
      <!-- loader  -->
      <div class="loader_bg">
         <div class="loader"><img src="images/loading.gif" alt="#"/></div>
      </div>
      <!-- end loader -->
      <!-- header -->
      <header>
         <!-- header inner -->
         <div class="header">
            <div class="container">
               <div class="row">
                  <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col logo_section">
                     <div class="full">
                        <div class="center-desk">
                           {{-- <div class="logo">
                              <a href="index.html"><img src="images/logo.png" alt="#" /></a>
                           </div> --}}
                        </div>
                     </div>
                  </div>
                  <div class="col-xl-9 col-lg-9 col-md-9 col-sm-9">
                    @include('public_site.include.nav')
                  </div>
               </div>
            </div>
         </div>
      </header>
      <!-- end header inner -->
      <!-- end header -->
      <!-- banner -->
  @yield('content')
      <!-- end contact -->
      <!--  footer -->
  @include('public_site.include.footer')
      <!-- end footer -->
      <!-- Javascript files-->
      
      @include('public_site.include.bottom')
   </body>
</html>