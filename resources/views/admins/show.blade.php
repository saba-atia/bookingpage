@extends('dashborde.dashhome')

@section('content')
<div class="container">
    <h1 class="mb-4">Admin Details</h1>
    <div class="card shadow-lg border-0">
        <div class="card-body p-4">
            <!-- Admin Image -->
            <div class="text-center mb-4">
                @if ($admin->image)
                    <img src="{{ asset('storage/' . $admin->image) }}" alt="Admin Image" class="img-fluid rounded-circle shadow-sm" width="150" height="150">
                @else
                    <div class="bg-light rounded-circle d-flex align-items-center justify-content-center" style="width: 150px; height: 150px; margin: 0 auto;">
                        <p class="text-muted mb-0">No Image</p>
                    </div>
                @endif
            </div>

            <!-- Admin Details -->
            <div class="text-center">
                <h3 class="card-title mb-3">{{ $admin->name }}</h3>
                <p class="card-text mb-2"><strong>Email:</strong> {{ $admin->email }}</p>
                <p class="card-text mb-4"><strong>Phone:</strong> {{ $admin->phone }}</p>
            </div>

            <!-- Action Buttons -->
            <div class="d-flex justify-content-center gap-2">
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

                <!-- Back Button -->
                <a href="{{ route('admins.index') }}" class="btn btn-gradient-info btn-sm action-btn" title="Back to List">
                    <i class="mdi mdi-arrow-left"></i>
                </a>
            </div>
        </div>
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