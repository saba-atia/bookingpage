@include('dashborde.include.top')

<div class="container-scroller">
    @include('dashborde.include.navbar')
    <div class="container-fluid page-body-wrapper">
        @include('dashborde.include.sidebar')
        @yield('content')
        <div class="container-fluid p-3">
            <div class="table-responsive" style="overflow-x: auto; -webkit-overflow-scrolling: touch;">
                <table class="table table-bordered table-striped table-hover w-100" style="table-layout: fixed;">
                    <thead class="bg-light">
                        <tr>
                            <th style="width: 5%">id</th>
                            <th style="width: 20%">Name</th>
                            <th style="width: 25%">Email</th>
                            <th style="width: 15%">Phone Number</th>
                            <th style="width: 35%">Message</th>
                            <th style="width: 35%">Send Email</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($datas as $data)
                            <tr>
                                <td class="text-truncate">{{$data->id}}</td>
                                <td class="text-wrap">{{$data->name}}</td>
                                <td class="text-wrap">{{$data->email}}</td>
                                <td class="text-wrap">{{$data->phone}}</td>
                                <td class="text-wrap" style="white-space: normal; word-break: break-word;">{{$data->message}}</td>
                                <td><a href="{{ url('send_email' , $data->id) }}" class="btn btn-success">send email</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div>
                {{ $datas->links() }}
            </div>
        </div>
    </div>
    @include('dashborde.include.footer')
</div>

@include('dashborde.include.end')