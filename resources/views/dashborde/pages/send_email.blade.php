

@include('dashborde.include.top')


<div class="container-scroller">
   
    <!-- partial:partials/_navbar.html -->
    @include('dashborde.include.navbar')

    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_sidebar.html -->
      @include('dashborde.include.sidebar')
      @yield( 'content')
      <div class="container">
        <h2> {{$data->name}}</h2>
        <form action="{{url('/mail',$data->id)}}" method="POST" >
            @csrf
            {{-- @method('PUT') --}}
            <div class="mb-3">
                <label for="greeting">Greeting</label>
                <input type="text" name="greeting" class="form-control" value="" required>
                
            </div>
            <div class="mb-3">
                <label for="emailbody">Email body</label>
                <textarea type="text" name="emailbody"  class="form-control" value="" required></textarea>
            </div>
            <div class="mb-3">
                <label for="action_text">Action text</label>
                <textarea type="text" name="action_text"  class="form-control" value="" required></textarea>
            </div>
            <div class="mb-3">
                <label for="Price">Action Url</label>
                <textarea type="text" name="action_url" class="form-control" value="" required></textarea>
            </div>
            <div class="mb-3">
                <label for="Price"> End Line</label>
                <textarea type="text" name="endline"  class="form-control" value="" required></textarea>
            </div>
           
            <button type="submit" class="btn btn-primary">send email</button>
        </form>
    </div>
</div>
    </div>
    
    <!-- page-body-wrapper ends -->
    @include('dashborde.include.footer')
  </div>



  
  @include('dashborde.include.end')
