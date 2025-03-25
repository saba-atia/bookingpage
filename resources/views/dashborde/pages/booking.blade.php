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
                            <th style="width: 15%">Room_id</th>
                            <th style="width: 15%">Customer name</th>
                            <th style="width: 15%">Email</th>
                            <th style="width: 15%">Phone</th>
                            <th style="width: 15%">Start Date</th>
                            <th style="width: 15%">End Date</th>
                            <th style="width: 15%">Status</th>
                            <th style="width: 15%">Room Title</th>
                            <th style="width: 15%">price</th>
                            <th style="width: 15%">Image</th>
                            <th style="width: 15%">Delete</th>
                            <th style="width: 15%">Status Update</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($datas as $data)
                            <tr>
                                <td class="text-truncate">{{$data->id}}</td>
                                <td class="text-wrap">{{$data->room_id}}</td>
                                <td class="text-wrap">{{$data->name}}</td>
                                <td class="text-wrap">{{$data->email}}</td>
                                <td class="text-wrap">{{$data->phone}}</td>
                                <td class="text-wrap">{{$data->start_date}}</td>
                                <td class="text-wrap">{{$data->end_date}}</td>
                                <td class="text-wrap" style="white-space: normal; word-break: break-word;">
                                    @if($data->status == 'approve')
                                    <span style="color:skyblue;">Approved</span>
                                    @endif
                                    @if($data->status == 'rejected')
                                    <span style="color:red;">Rejected</span>
                                    @endif
                                    @if($data->status == 'waiting')
                                    <span style="color:yellow;">Waiting</span>
                                    @endif

                                </td>
                                <td class="text-wrap">{{ $data->room->room_title ?? 'No Room Assigned' }}</td>
                                <td class="text-wrap">{{ $data->room->price ?? 'No Room Assigned' }}</td>
                                <td>
                                    <img src="/room/{{ $data->room?->image ?? 'default.jpg' }}" alt="Room Image">
                                </td>
                                <td> <a  class="btn btn-danger"  href="{{route('delete_booking', $data->id)}}" >Delete</a></td>
                                <td> 
                                    <a class="btn btn-success" href="{{url('approve_book' , $data->id)}}">Approve</a>
                                    <a class="btn btn-success" href="{{url('Rejected_book' , $data->id)}}">Rejected</a>
                                </td>
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