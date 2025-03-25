@extends('dashborde.dashhome')

@section('content')
<div class="container">
    <h1>Admins</h1>
    <a href="{{ route('admins.create') }}" class="btn btn-gradient-primary">Create New Admin</a>
    
    @if(session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: '{{ session('success') }}',
                showConfirmButton: false,
                timer: 2000
            });
        </script>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th> 
                <th>Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($admins as $admin)
                <tr>
                    <td>{{ $admin->name }}</td>
                    <td>{{ $admin->email }}</td>
                    <td>{{ $admin->phone }}</td>
                    <td>
                        <img src="{{ asset('storage/' . $admin->image) }}" alt="Admin Image" width="50" height="50">
                    </td>
                    <td>
                        <!-- View Button -->
                        <a href="{{ route('admins.show', $admin->id) }}" class="btn btn-gradient-info btn-sm action-btn" title="View">
                            <i class="mdi mdi-eye"></i>
                        </a>

                        <!-- Edit Button -->
                        <a href="{{ route('admins.edit', $admin->id) }}" class="btn btn-gradient-primary btn-sm action-btn" title="Edit">
                            <i class="mdi mdi-pencil"></i>
                        </a>

                        <!-- Delete Button -->
                        <form action="{{ route('admins.destroy', $admin->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-gradient-danger btn-sm action-btn" title="Delete" onclick="return confirmDelete(event)">
                                <i class="mdi mdi-trash-can"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div>
        {{ $admins->links() }}
    </div>
</div>

<script>
    function confirmDelete(event) {
        event.preventDefault(); 
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                event.target.closest('form').submit();
            }
        });
    }
</script>
@endsection