@extends('public_site.layouts.welcome')
@section('title' , 'home')
    
@section ('content')
<section class="banner_main">
    <div id="myCarousel" class="carousel slide banner" data-ride="carousel">
       <ol class="carousel-indicators">
          <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
          <li data-target="#myCarousel" data-slide-to="1"></li>
          <li data-target="#myCarousel" data-slide-to="2"></li>
       </ol>
       <div class="carousel-inner">
          <div class="carousel-item active">
             <img class="first-slide" src="images/banner1.jpg" alt="First slide">
             <div class="container">
             </div>
          </div>
          <div class="carousel-item">
             <img class="second-slide" src="images/banner2.jpg" alt="Second slide">
          </div>
          <div class="carousel-item">
             <img class="third-slide" src="images/banner3.jpg" alt="Third slide">
          </div>
       </div>
       <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
       <span class="carousel-control-prev-icon" aria-hidden="true"></span>
       <span class="sr-only">Previous</span>
       </a>
       <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
       <span class="carousel-control-next-icon" aria-hidden="true"></span>
       <span class="sr-only">Next</span>
       </a>
    </div>
    <div class="booking_ocline">
       <div class="container">
          <div class="row">
             <div class="col-md-5">
                <div class="book_room">
                   <h1>Book a Room Online</h1>
                   <form class="book_now">
                      <div class="row">
                         <div class="col-md-12">
                            <span>Arrival</span>
                            <img class="date_cua" src="images/date.png">
                            <input class="online_book" placeholder="dd/mm/yyyy" type="date" name="dd/mm/yyyy">
                         </div>
                         <div class="col-md-12">
                            <span>Departure</span>
                            <img class="date_cua" src="images/date.png">
                            <input class="online_book" placeholder="dd/mm/yyyy" type="date" name="dd/mm/yyyy">
                         </div>
                         <div class="col-md-12">
                            <button class="book_btn">Book Now</button>
                         </div>
                      </div>
                   </form>
                </div>
             </div>
          </div>
       </div>
    </div>
 </section>
 <!-- end banner -->
 <!-- about -->
 <div class="about">
    <div class="container-fluid">
       <div class="row">
          <div class="col-md-5">
             <div class="titlepage">
                <h2>About Us</h2>
                <p>Welcome to LuxLodge, where luxury meets comfort. Located in the heart of Aqaba/Jordan, our hotel offers a perfect blend of modern elegance and warm hospitality. Whether you're here for business or leisure, we ensure every stay is memorable with exceptional service and thoughtfully designed rooms.

                  At LuxLodge, your comfort is our priority. Let us make your stay unforgettable.
                  
                  </p>
                <a class="read_more" href="Javascript:void(0)"> Read More</a>
             </div>
          </div>
          <div class="col-md-7">
             <div class="about_img">
                <figure><img src="images/about.png" alt="#"/></figure>
             </div>
          </div>
       </div>
    </div>
 </div>
 <!-- end about -->
 <!-- our_room -->
 <div  class="our_room">
    <div class="container">
       <div class="row">
          <div class="col-md-12">
             <div class="titlepage">
                <h2>Our Room</h2>
                <p>At LuxLodge, we offer a variety of rooms and suites designed to meet your every need. Whether you're traveling solo, with family, or on a romantic getaway, we have the perfect space for you.</p>
             </div>
          </div>
       </div>
       <div class="row">
          <div class="col-md-4 col-sm-6">
             <div id="serv_hover"  class="room">
                <div class="room_img">
                   <figure><img src="images/room1.jpg" alt="#"/></figure>
                </div>
                <div class="bed_room">
                   <h3>Family Room </h3>
                   <p> Traveling with family? Our Family Room offers ample space, multiple beds, and kid-friendly amenities to ensure a comfortable stay for everyone.

                   </p>
                   <div class="col-md-12">
                     <a href="/booking" class="book_btn">Book Now</a>
                 </div>
                </div>
             </div>
          </div>
          <div class="col-md-4 col-sm-6">
             <div id="serv_hover"  class="room">
                <div class="room_img">
                   <figure><img src="images/room2.jpg" alt="#"/></figure>
                </div>
                <div class="bed_room">
                   <h3>Standard Room</h3>
                   <p>Ideal for solo travelers or couples, our Standard Room provides a cozy and comfortable retreat with all the essential amenities for a relaxing stay.
                     <div class="col-md-12">
                        <a href="/booking" class="book_btn">Book Now</a>
                    </div>
                   </p>
                </div>
             </div>
          </div>
          <div class="col-md-4 col-sm-6">
             <div id="serv_hover"  class="room">
                <div class="room_img">
                   <figure><img src="images/room3.jpg" alt="#"/></figure>
                </div>
                <div class="bed_room">
                   <h3>Deluxe Room</h3>
                   <p>Experience extra space and luxury in our Deluxe Room, featuring a plush king-sized bed, a seating area, and stunning views.</p>
                
                   <div class="col-md-12">
                     <a href="/booking" class="book_btn">Book Now</a>
                 </div>
                 </div>
             </div>
          </div>
          <div class="col-md-4 col-sm-6">
             <div id="serv_hover"  class="room">
                <div class="room_img">
                   <figure><img src="images/room4.jpg" alt="#"/></figure>
                </div>
                <div class="bed_room">
                   <h3>Presidential Suite</h3>
                   <p>Indulge in the ultimate luxury with our Presidential Suite. This expansive suite features a separate living room, a dining area, a private terrace, and exclusive access to premium services. </p>
                   <div class="col-md-12">
                     <a href="/booking" class="book_btn">Book Now</a>
                 </div>
                  </div>
             </div>
          </div>
          <div class="col-md-4 col-sm-6">
             <div id="serv_hover"  class="room">
                <div class="room_img">
                   <figure><img src="images/room5.jpg" alt="#"/></figure>
                </div>
                <div class="bed_room">
                   <h3>Honeymoon Suite</h3>
                   <p>Celebrate love in our Honeymoon Suite, designed for romance and relaxation. Enjoy a private balcony, a luxurious bathtub, and breathtaking views. </p>
                
                   <div class="col-md-12">
                     <a href="/booking" class="book_btn">Book Now</a>
                 </div>  </div>
             </div>
          </div>
          <div class="col-md-4 col-sm-6">
             <div id="serv_hover"  class="room">
                <div class="room_img">
                   <figure><img src="images/room6.jpg" alt="#"/></figure>
                </div>
                <div class="bed_room">
                   <h3>Executive Suite</h3>
                   <p>Designed for business travelers, the Executive Suite includes a dedicated workspace, high-speed internet, and a spacious living area for both work and relaxation.

                   </p>
                   <div class="col-md-12">
                     <a href="/booking" class="book_btn">Book Now</a>
                 </div>
                </div>
             </div>
          </div>
       </div>
    </div>
 </div>
 <!-- end our_room -->
 
 
 <!--  contact -->
 <div class="contact">
    <div class="container">
       <div class="row">
          <div class="col-md-12">
             <div class="titlepage">
                <h2>Contact Us</h2>
             </div>
          </div>
       </div>
       <div class="row">
          <div class="col-md-6">
             {{-- <form id="request" class="main_form">
                <div class="row">
                   <div class="col-md-12 ">
                      <input class="contactus" placeholder="Name" type="type" name="Name"> 
                   </div>
                   <div class="col-md-12">
                      <input class="contactus" placeholder="Email" type="type" name="Email"> 
                   </div>
                   <div class="col-md-12">
                      <input class="contactus" placeholder="Phone Number" type="type" name="Phone Number">                          
                   </div>
                   <div class="col-md-12">
                      <textarea class="textarea" placeholder="Message" type="type" Message="Name">Message</textarea>
                   </div>
                   <div class="col-md-12">
                      <button class="send_btn">Send</button>
                   </div>
                </div>
             </form> --}}

             <form id="request" class="main_form" action="{{ route('contact.store') }}" method="POST">
               @csrf 
               
               <div class="row">
                  <div class="col-md-12">
                     <input class="contactus" placeholder="Name" type="text" name="name" required> 
                  </div>
                  <div class="col-md-12">
                     <input class="contactus" placeholder="Email" type="email" name="email" required> 
                  </div>
                  <div class="col-md-12">
                     <input class="contactus" placeholder="Phone Number" type="text" name="phone" required>                          
                  </div>
                  <div class="col-md-12">
                     <textarea class="textarea" placeholder="Message" name="message" required></textarea>
                  </div>
                  <div class="col-md-12">
                     <button type="submit" class="send_btn">Send</button>
                  </div>
               </div>
            </form>
          </div>
          <div class="col-md-6">
             <div class="map_main">
                <div class="map-responsive">
                  <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3471.3379180062425!2d35.017071528471504!3d29.5356519551309!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x150071875a9fca41%3A0xf5d61d999f967371!2sOrange%20Digital%20Village%20Aqaba!5e0!3m2!1sar!2sjo!4v1742500659726!5m2!1sar!2sjo" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>                </div>
             </div>
          </div>
       </div>
    </div>
 </div>
 @endsection
