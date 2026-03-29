<x-backend-layout title="Asset List">
    @push('css')
        <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.bootstrap.min.css">
    @endpush

    <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
        <h1 class="page-title fw-semibold fs-18 mb-0">Assets Management</h1>
        <div class="ms-md-1 ms-0">
            <nav>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Assets</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-12">
            <div class="card custom-card">
                <div class="card-header justify-content-between d-flex align-items-center">
                    <div class="card-title">Assets List</div>
                    @can('create assets')
                    <a href="{{ route('assets.create') }}" class="btn btn-primary btn-sm">Add Asset</a>
                    @endcan
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
                                    <th>Thumbnail</th>
                                    <th>Title</th>
                                    <th>Category</th>
                                    <th>Type</th>
                                    <th>Price</th>
                                    <th>Trending</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($assets as $key => $asset)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>
                                            <img src="{{ asset($asset->thumbnail) }}" class="rounded" width="50" height="40" style="object-fit: cover;">
                                        </td>
                                        <td>{{ Str::limit($asset->title, 30) }}</td>
                                        <td>{{ $asset->category->name }}</td>
                                        <td><span class="badge bg-info-transparent">{{ ucfirst($asset->type) }}</span></td>
                                        <td>{{ $asset->is_free ? 'Free' : '$' . number_format($asset->price, 2) }}</td>
                                        <td>
                                            {!! $asset->is_trending ? '<span class="badge bg-warning-transparent">Yes</span>' : '<span class="badge bg-light text-dark">No</span>' !!}
                                        </td>
                                        <td>
                                            @if ($asset->is_active)
                                                <span class="badge bg-success-transparent">Active</span>
                                            @else
                                                <span class="badge bg-danger-transparent">Inactive</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="btn-list">
                                                @can('edit assets')
                                                <a href="{{ route('assets.edit', $asset->id) }}" class="btn btn-sm btn-warning-light btn-icon">
                                                    <i class="ri-pencil-line"></i>
                                                </a>
                                                @endcan
                                                @can('delete assets')
                                                <form action="{{ route('assets.destroy', $asset->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger-light btn-icon" onclick="return confirm('Are you sure?')">
                                                        <i class="ri-delete-bin-line"></i>
                                                    </button>
                                                </form>
                                                @endcan
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-4">
                        {{ $assets->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('js')
        <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
        <script>
            $(document).ready(function() {
                $('#responsiveDataTable').DataTable({
                    paging: false,
                    info: false
                });
            });
        </script>
    @endpush
</x-backend-layout>
