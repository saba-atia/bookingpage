@extends('dashborde.dashhome')

@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white me-2">
                    <i class="mdi mdi-account"></i>
                </span> Admin Profile
            </h3>
        </div>
        <div class="row">
            <div class="col-md-6">
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
                            <a href="{{ route('admins.edit', $admin->id) }}" class="btn btn-gradient-primary btn-sm" title="Edit">
                                <i class="mdi mdi-pencil"></i> Edit Profile
                            </a>

                            <!-- Back Button -->
                            <a href="{{ route('admins.index') }}" class="btn btn-gradient-info btn-sm" title="Back to List">
                                <i class="mdi mdi-arrow-left"></i> Back
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection