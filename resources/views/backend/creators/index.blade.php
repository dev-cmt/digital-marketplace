<x-backend-layout title="Creators List">
    @push('css')
        <!-- Datatables CSS -->
        <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.bootstrap.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.bootstrap5.min.css">

        <link rel="stylesheet" href="{{ asset('backend/libs/select2/select2.min.css') }}">
    @endpush

    <!-- Page Header -->
    <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
        <h1 class="page-title fw-semibold fs-18 mb-0">Creators Management</h1>
        <div class="ms-md-1 ms-0">
            <nav>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Creators</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-12">
            <div class="card custom-card">
                <div class="card-header justify-content-between d-flex align-items-center">
                    <div class="card-title">Marketplace Creators</div>
                </div>
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show">{{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table id="responsiveDataTable" class="table table-bordered text-nowrap" style="width:100%">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Avatar</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Assets</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($creators as $key => $creator)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>
                                            @if ($creator->photo_path)
                                                <img src="{{ asset($creator->photo_path) }}" class="rounded-circle"
                                                    width="40" height="40">
                                            @else
                                                <img src="https://ui-avatars.com/api/?name={{ urlencode($creator->name) }}&background=6c63ff&color=fff" class="rounded-circle" width="40" height="40">
                                            @endif
                                        </td>
                                        <td>{{ $creator->name }}</td>
                                        <td>{{ $creator->email }}</td>
                                        <td>
                                            <span class="badge bg-primary-transparent text-primary">
                                                {{ $creator->assets_count }} Assets
                                            </span>
                                        </td>
                                        <td>
                                            <div class="btn-list">
                                                <button type="button"
                                                    class="btn btn-sm btn-warning-light btn-icon edit-creator"
                                                    data-id="{{ $creator->id }}" 
                                                    data-name="{{ $creator->name }}"
                                                    data-email="{{ $creator->email }}"
                                                    data-type="{{ $creator->user_type }}"
                                                    data-photo="{{ $creator->photo_path }}" 
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#editCreatorModal">
                                                    <i class="ri-pencil-line"></i>
                                                </button>
                                                <form action="{{ route('creators.destroy', $creator->id) }}" method="POST"
                                                    class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger-light btn-icon"
                                                        onclick="return confirm('Are you sure you want to delete this creator? This will not delete their assets.')">
                                                        <i class="ri-delete-bin-line"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center text-muted">No creators found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4">
                        {{ $creators->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Creator Modal -->
    <div class="modal fade" id="editCreatorModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title">Edit Creator Profile</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form id="editCreatorForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Full Name</label>
                                <input type="text" name="name" class="form-control" id="edit_name" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Email Address</label>
                                <input type="email" name="email" class="form-control" id="edit_email" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">User Type</label>
                                <select name="user_type" class="form-select" id="edit_type" required>
                                    <option value="customer">Customer</option>
                                    <option value="creator">Creator</option>
                                    <option value="admin">Admin</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label text-primary fw-bold">Profile Photo (Creator Avatar)</label>
                                <input type="file" name="photo" class="form-control" id="edit_photo">
                                <small class="text-muted">Saved to: public/uploads/creators/</small>
                                <div class="mt-3 text-center" id="current_photo_preview"></div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer mt-3">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update Profile</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('js')
        <!-- Datatables Cdn -->
        <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
        <script src="https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.min.js"></script>

        <script src="{{ asset('backend/libs/select2/select2.min.js') }}"></script>
        <script>
            $(document).ready(function() {
                // Populate edit modal
                $(document).on('click', '.edit-creator', function() {
                    const id = $(this).data('id');
                    const name = $(this).data('name');
                    const email = $(this).data('email');
                    const type = $(this).data('type');
                    const photo = $(this).data('photo');

                    // Set Form Action matching the project root
                    const baseUrl = "{{ route('creators.index') }}";
                    $('#editCreatorForm').attr('action', `${baseUrl}/${id}`);
                    
                    $('#edit_name').val(name);
                    $('#edit_email').val(email);
                    $('#edit_type').val(type);

                    if (photo) {
                        $('#current_photo_preview').html(
                            `<label class='d-block text-muted mb-2'>Current Avatar</label><img src="{{ asset('/') }}${photo}" class="rounded-circle border shadow-sm" width="80" height="80">`
                        );
                    } else {
                        $('#current_photo_preview').html('<span class="text-muted">No custom avatar uploaded</span>');
                    }
                });
            });
        </script>
    @endpush
</x-backend-layout>
