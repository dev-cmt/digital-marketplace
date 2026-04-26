<x-backend-layout title="Pricing Plans">
    @push('css')
        <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.bootstrap.min.css">
    @endpush

    <!-- Page Header -->
    <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
        <h1 class="page-title fw-semibold fs-18 mb-0">Pricing Plans Management</h1>
        <div class="ms-md-1 ms-0">
            <nav>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Pricing Plans</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-12">
            <div class="card custom-card">
                <div class="card-header justify-content-between d-flex align-items-center">
                    <div class="card-title">Pricing Plans List</div>
                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#createPlanModal">Add Plan</button>
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
                                    <th>Name</th>
                                    <th>Monthly</th>
                                    <th>Annual</th>
                                    <th>Order</th>
                                    <th>Popular</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($plans as $plan)
                                    <tr>
                                        <td><strong>{{ $plan->name }}</strong></td>
                                        <td>${{ number_format($plan->monthly_price, 2) }}</td>
                                        <td>${{ number_format($plan->annual_price, 2) }}</td>
                                        <td>{{ $plan->order }}</td>
                                        <td>
                                            @if ($plan->is_popular)
                                                <span class="badge bg-warning-transparent">Yes</span>
                                            @else
                                                <span class="badge bg-light text-muted">No</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($plan->is_active)
                                                <span class="badge bg-success-transparent">Active</span>
                                            @else
                                                <span class="badge bg-danger-transparent">Inactive</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="btn-list">
                                                <button type="button"
                                                    class="btn btn-sm btn-warning-light btn-icon edit-plan"
                                                    data-id="{{ $plan->id }}" 
                                                    data-name="{{ $plan->name }}"
                                                    data-description="{{ $plan->description }}"
                                                    data-monthly="{{ $plan->monthly_price }}"
                                                    data-annual="{{ $plan->annual_price }}"
                                                    data-order="{{ $plan->order }}"
                                                    data-popular="{{ $plan->is_popular }}"
                                                    data-active="{{ $plan->is_active }}"
                                                    data-features="{{ json_encode($plan->features ?? []) }}"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#editPlanModal">
                                                    <i class="ri-pencil-line"></i>
                                                </button>
                                                
                                                <form action="{{ route('pricing_plans.destroy', $plan->id) }}" method="POST"
                                                    class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger-light btn-icon"
                                                        onclick="return confirm('Are you sure?')">
                                                        <i class="ri-delete-bin-line"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Create Modal -->
    <div class="modal fade" id="createPlanModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title">Add Pricing Plan</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ route('pricing_plans.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-md-12">
                                <label class="form-label">Plan Name</label>
                                <input type="text" name="name" class="form-control" placeholder="e.g. Pro" required>
                            </div>
                            <div class="col-md-12">
                                <label class="form-label">Description</label>
                                <textarea name="description" class="form-control" rows="2"></textarea>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Monthly Price ($)</label>
                                <input type="number" step="0.01" name="monthly_price" class="form-control" value="0">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Annual Price ($)</label>
                                <input type="number" step="0.01" name="annual_price" class="form-control" value="0">
                            </div>
                            
                            <div class="col-md-12">
                                <label class="form-label">Features</label>
                                <div id="create-features-container">
                                    <div class="input-group mb-2">
                                        <input type="text" name="features[]" class="form-control" placeholder="Feature description">
                                        <button class="btn btn-danger remove-feature" type="button"><i class="ri-delete-bin-line"></i></button>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-sm btn-success mt-1" id="add-create-feature">+ Add Feature</button>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Sort Order</label>
                                <input type="number" name="order" class="form-control" value="0">
                            </div>
                            <div class="col-md-6 d-flex align-items-center gap-4 mt-4">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" name="is_popular" id="create_popular">
                                    <label class="form-check-label" for="create_popular">Most Popular</label>
                                </div>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" name="is_active" id="create_active" checked>
                                    <label class="form-check-label" for="create_active">Active</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer mt-3">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Create Plan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Modal -->
    <div class="modal fade" id="editPlanModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title">Edit Pricing Plan</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form id="editPlanForm" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-md-12">
                                <label class="form-label">Plan Name</label>
                                <input type="text" name="name" id="edit_name" class="form-control" required>
                            </div>
                            <div class="col-md-12">
                                <label class="form-label">Description</label>
                                <textarea name="description" id="edit_description" class="form-control" rows="2"></textarea>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Monthly Price ($)</label>
                                <input type="number" step="0.01" name="monthly_price" id="edit_monthly" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Annual Price ($)</label>
                                <input type="number" step="0.01" name="annual_price" id="edit_annual" class="form-control">
                            </div>
                            
                            <div class="col-md-12">
                                <label class="form-label">Features</label>
                                <div id="edit-features-container">
                                    <!-- Populated by JS -->
                                </div>
                                <button type="button" class="btn btn-sm btn-success mt-1" id="add-edit-feature">+ Add Feature</button>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Sort Order</label>
                                <input type="number" name="order" id="edit_order" class="form-control">
                            </div>
                            <div class="col-md-6 d-flex align-items-center gap-4 mt-4">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" name="is_popular" id="edit_popular">
                                    <label class="form-check-label" for="edit_popular">Most Popular</label>
                                </div>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" name="is_active" id="edit_active">
                                    <label class="form-check-label" for="edit_active">Active</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer mt-3">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update Plan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('js')
        <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
        <script src="https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.min.js"></script>

        <script>
            $(document).ready(function() {
                $('#responsiveDataTable').DataTable();

                // Dynamic features for Create
                $('#add-create-feature').click(function() {
                    $('#create-features-container').append(`
                        <div class="input-group mb-2">
                            <input type="text" name="features[]" class="form-control" placeholder="Feature description">
                            <button class="btn btn-danger remove-feature" type="button"><i class="ri-delete-bin-line"></i></button>
                        </div>
                    `);
                });

                // Dynamic features for Edit
                $('#add-edit-feature').click(function() {
                    $('#edit-features-container').append(`
                        <div class="input-group mb-2">
                            <input type="text" name="features[]" class="form-control" placeholder="Feature description">
                            <button class="btn btn-danger remove-feature" type="button"><i class="ri-delete-bin-line"></i></button>
                        </div>
                    `);
                });

                // Remove feature row
                $(document).on('click', '.remove-feature', function() {
                    $(this).closest('.input-group').remove();
                });

                // Edit button click
                $(document).on('click', '.edit-plan', function() {
                    const id = $(this).data('id');
                    
                    $('#editPlanForm').attr('action', `{{ url('pricing-plans') }}/${id}`);
                    $('#edit_name').val($(this).data('name'));
                    $('#edit_description').val($(this).data('description'));
                    $('#edit_monthly').val($(this).data('monthly'));
                    $('#edit_annual').val($(this).data('annual'));
                    $('#edit_order').val($(this).data('order'));
                    $('#edit_popular').prop('checked', $(this).data('popular') == 1);
                    $('#edit_active').prop('checked', $(this).data('active') == 1);

                    // Handle Features Array
                    const features = $(this).data('features');
                    const container = $('#edit-features-container');
                    container.empty();
                    
                    if (features && features.length > 0) {
                        features.forEach(function(f) {
                            container.append(`
                                <div class="input-group mb-2">
                                    <input type="text" name="features[]" class="form-control" value="${f}" placeholder="Feature description">
                                    <button class="btn btn-danger remove-feature" type="button"><i class="ri-delete-bin-line"></i></button>
                                </div>
                            `);
                        });
                    } else {
                        container.append(`
                            <div class="input-group mb-2">
                                <input type="text" name="features[]" class="form-control" placeholder="Feature description">
                                <button class="btn btn-danger remove-feature" type="button"><i class="ri-delete-bin-line"></i></button>
                            </div>
                        `);
                    }
                });
            });
        </script>
    @endpush
</x-backend-layout>
