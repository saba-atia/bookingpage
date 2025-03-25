

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
        <h2> Add Room</h2>
        <form action="{{url('add_room')}}" method="POST" enctype="multipart/form-data">
            @csrf
            {{-- @method('PUT') --}}
            <div class="mb-3">
                <label for="title">Room Title</label>
                <input type="text" name="title" class="form-control" value="" required>
                
            </div>
            <div class="mb-3">
                <label for="description">Description</label>
                <textarea type="text" name='description'  class="form-control" value="" required></textarea>
            </div>
            <div class="mb-3">
                <label for="Price">Price</label>
                <textarea type="number" name='Price'  class="form-control" value="" required></textarea>
            </div>
            <div class="mb-3">
                <label >Room Type</label>
                <select name="type" class="form-control">
              <option value="Reguler" > Reguler</option>
              <option value="premium" > premium</option>
              <option value="Deluxe" > Deluxe</option>
                </select>
                <div class="mb-3">
                    <label >Free Wifi</label>
                    <select name="wifi" class="form-control">
                  <option value="yes" > yse</option>
                  <option value="No" > No</option>
                    </select>
            </div>
            <div class="mb-3">
                <label for="image">Uplode Image</label>
                <input type="file" name='image'  class="form-control"  ></input>
            </div>
            <button type="submit" class="btn btn-primary">Add Room</button>
        </form>
    </div>
</div>
    </div>
    
    <!-- page-body-wrapper ends -->
    @include('dashborde.include.footer')
  </div>



  
  @include('dashborde.include.end')
