<x-backend-layout title="Category List">
    @push('css')
        <!-- Datatables CSS -->
        <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.bootstrap.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.bootstrap5.min.css">
    @endpush

    <!-- Page Header -->
    <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
        <h1 class="page-title fw-semibold fs-18 mb-0">Categories Management</h1>
        <div class="ms-md-1 ms-0">
            <nav>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Categories</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-12">
            <div class="card custom-card">
                <div class="card-header justify-content-between d-flex align-items-center">
                    <div class="card-title">Categories List</div>
                    @can('create categories')
                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#createCategoryModal">Add Category</button>
                    @endcan
                </div>
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show">{{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show">{{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table id="responsiveDataTable" class="table table-bordered text-nowrap" style="width:100%">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Icon</th>
                                    <th>Name</th>
                                    <th>Slug</th>
                                    <th>Order</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($categories as $key => $category)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td><i class="{{ $category->icon }} fs-20"></i></td>
                                        <td>{{ $category->name }}</td>
                                        <td>{{ $category->slug }}</td>
                                        <td>{{ $category->order }}</td>
                                        <td>
                                            @if ($category->is_active)
                                                <span class="badge bg-success-transparent">Active</span>
                                            @else
                                                <span class="badge bg-danger-transparent">Inactive</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="btn-list">
                                                @can('edit categories')
                                                <button type="button"
                                                    class="btn btn-sm btn-warning-light btn-icon edit-category"
                                                    data-id="{{ $category->id }}" 
                                                    data-name="{{ $category->name }}"
                                                    data-icon="{{ $category->icon }}"
                                                    data-order="{{ $category->order }}"
                                                    data-active="{{ $category->is_active }}"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#editCategoryModal">
                                                    <i class="ri-pencil-line"></i>
                                                </button>
                                                @endcan
                                                @can('delete categories')
                                                <form action="{{ route('categories.destroy', $category->id) }}" method="POST"
                                                    class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger-light btn-icon"
                                                        onclick="return confirm('Are you sure?')">
                                                        <i class="ri-delete-bin-line"></i>
                                                    </button>
                                                </form>
                                                @endcan
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Create Category Modal -->
    <div class="modal fade" id="createCategoryModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title">Add Category</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ route('categories.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-md-12">
                                <label class="form-label">Name</label>
                                <input type="text" name="name" class="form-control" placeholder="e.g. Photos" required>
                            </div>
                            <div class="col-md-12">
                                <label class="form-label">Icon Class (FontAwesome)</label>
                                <input type="text" name="icon" class="form-control" placeholder="e.g. fa-solid fa-image" required>
                            </div>
                            <div class="col-md-12">
                                <label class="form-label">Sort Order</label>
                                <input type="number" name="order" class="form-control" value="0">
                            </div>
                            <div class="col-md-12">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" name="is_active" id="flexSwitchCheckChecked" checked>
                                    <label class="form-check-label" for="flexSwitchCheckChecked">Active Status</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer mt-3">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Create Category</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Category Modal -->
    <div class="modal fade" id="editCategoryModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title">Edit Category</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form id="editCategoryForm" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-md-12">
                                <label class="form-label">Name</label>
                                <input type="text" name="name" id="edit_name" class="form-control" required>
                            </div>
                            <div class="col-md-12">
                                <label class="form-label">Icon Class</label>
                                <input type="text" name="icon" id="edit_icon" class="form-control" required>
                            </div>
                            <div class="col-md-12">
                                <label class="form-label">Sort Order</label>
                                <input type="number" name="order" id="edit_order" class="form-control">
                            </div>
                            <div class="col-md-12">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" name="is_active" id="edit_active">
                                    <label class="form-check-label" for="edit_active">Active Status</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer mt-3">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update Category</button>
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
        <script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>

        <script>
            $(document).ready(function() {
                $('#responsiveDataTable').DataTable();

                $(document).on('click', '.edit-category', function() {
                    const id = $(this).data('id');
                    const name = $(this).data('name');
                    const icon = $(this).data('icon');
                    const order = $(this).data('order');
                    const active = $(this).data('active');

                    $('#editCategoryForm').attr('action', `{{ url('categories') }}/${id}`);
                    $('#edit_name').val(name);
                    $('#edit_icon').val(icon);
                    $('#edit_order').val(order);
                    $('#edit_active').prop('checked', active == 1);
                });
            });
        </script>
    @endpush
</x-backend-layout>
