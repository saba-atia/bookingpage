@include('dashborde.include.top')

<div class="container-scroller">
    @include('dashborde.include.navbar')
    <div class="container-fluid page-body-wrapper">
        @include('dashborde.include.sidebar')
        @yield('content')
        <div class="container-fluid p-3"> <!-- تعديل هنا -->
            <div class="table-responsive" style="overflow-x: auto; -webkit-overflow-scrolling: touch;">
                <table class="table table-bordered table-striped table-hover w-100" style="table-layout: fixed;">
                    <thead class="bg-light">
                        <tr>
                            <th style="width: 5%">ID</th>
                            <th style="width: 15%">Room_Title</th>
                            <th style="width: 15%">Desecription</th>
                            <th style="width: 15%">Price</th>
                            <th style="width: 15%">Image</th>
                            <th style="width: 15%">Room_Type</th>
                            <th style="width: 15%">Wifi</th>
                            <th style="width: 15%">Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($datas as $data)
                            <tr>
                                <td class="text-truncate">{{$data->id}}</td>
                                <td class="text-wrap">{{$data->room_title}}</td>
                                <td class="text-wrap">{{$data->desecription}}</td>
                                <td class="text-wrap">{{$data->price}}</td>
                                <td class="text-wrap"><img  width="60px" height="60px"src="room/{{$data->image}}" ></td>
                                <td class="text-wrap">{{$data->room_type}}</td>
                                <td class="text-wrap" style="white-space: normal; word-break: break-word;">{{$data->wifi}}</td>
                               <td> <a  class="btn btn-danger"  href="{{url('room_delete', $data->id)}}" >Delete</a>
                                <a class="btn btn-warning"  href="{{url('room_update', $data->id)}}" >update</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @include('dashborde.include.footer')
</div>

@include('dashborde.include.end')