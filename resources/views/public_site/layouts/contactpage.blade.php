@extends('public_site.layouts.welcome')

@section('title', 'Contact')

@section(section: 'content')
<div class="back_re">
    <div class="container">
       <div class="row">
          <div class="col-md-12">
             <div class="title">
                 <h2>Contact Us</h2>
             </div>
          </div>
       </div>
    </div>
</div>

<div class="contact">
    <div class="container">
       <div class="row">
          <div class="col-md-6">
             @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
             @endif

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
