@extends('dashborde.dashhome')

@section('content')
    <div class="container">
        <h2>User Management</h2>
        <a href="{{ route('users.create') }}" class="btn btn-gradient-primary">Add User</a>
        
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

        <table class="table table-bordered mt-3">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            <!-- Edit Button -->
                            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-gradient-primary btn-sm action-btn" title="Edit">
                                <i class="mdi mdi-pencil"></i>
                            </a>

                            <!-- Delete Button -->
                            <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline;">
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
            {{ $users->links() }}
        </div>
    </div>
@endsection

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