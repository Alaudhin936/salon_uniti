@extends('layout.master')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/datatables.css') }}">
@endsection

@section('main_content')
    <div class="container mt-4" style="padding:30px;background-color:white;">
        <div class="d-flex align-items-center justify-content-between mb-3">
            <h3 style="color: #0a566d" class="underlined-heading mb-0">Payment Types</h3>
            <button class="btn btn-light btn-md px-5 py-3 rounded-pill shadow-sm fw-semibold" data-bs-toggle="modal" data-bs-target="#addPaymentTypeModal">
                <i class="fas fa-plus me-2 text-success"></i> Add New Payment Type
            </button>
        </div>

        <table class="table table-bordered" id="paymentTypesTable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($paymentTypes as $type)
                    <tr>
                        <td>{{ $type->id }}</td>
                        <td>{{ $type->name }}</td>
                        <td>
                            <span class="badge bg-{{ $type->is_active ? 'success' : 'danger' }}">
                                {{ $type->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td>
                            <button class="btn btn-warning btn-xs py-1 editBtn" data-id="{{ $type->id }}"
                                data-name="{{ $type->name }}" data-icon="{{ $type->icon }}"
                                data-status="{{ $type->is_active }}" data-bs-toggle="modal"
                                data-bs-target="#editPaymentTypeModal">
                                <i class="fas fa-edit"></i>
                            </button>

                            <button class="btn btn-danger btn-xs py-1 deleteBtn" data-id="{{ $type->id }}">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Add Payment Type Modal -->
    <div class="modal fade" id="addPaymentTypeModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="addPaymentTypeForm">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Add Payment Type</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Payment Type Name</label>
                            <input type="text" name="name" class="form-control" placeholder="e.g., GPay, PhonePe"
                                required>
                        </div>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="is_active" id="is_active" checked>
                            <label class="form-check-label" for="is_active">Active</label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Payment Type Modal -->
    <div class="modal fade" id="editPaymentTypeModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="editPaymentTypeForm">
                    @csrf
                    <input type="hidden" name="id" id="edit_id">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Payment Type</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Payment Type Name</label>
                            <input type="text" name="name" id="edit_name" class="form-control" required>
                        </div>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="is_active" id="edit_is_active">
                            <label class="form-check-label" for="edit_is_active">Active</label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('assets/js/datatable/datatables/jquery.dataTables.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#paymentTypesTable').DataTable({
                responsive: true,
                pageLength: 5,
                lengthMenu: [5, 10, 25, 50],
                language: {
                    search: "_INPUT_",
                    searchPlaceholder: "Search payment types..."
                }
            });

            // Add Payment Type
            $("#addPaymentTypeForm").submit(function(e) {
                e.preventDefault();
                $.ajax({
                    url: "{{ route('admin.payment.types.store') }}",
                    type: "POST",
                    data: $(this).serialize(),
                    success: function(res) {
                        if (res.status == 200) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: 'Payment Type Added Successfully',
                                confirmButtonColor: '#3085d6',
                                confirmButtonText: 'OK'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    location.reload();
                                }
                            });
                        }
                    },
                    error: function(xhr) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: xhr.responseJSON.message || 'Something went wrong'
                        });
                    }
                });
            });

            $("#editPaymentTypeForm").submit(function(e) {
                e.preventDefault();
                let payment_type_id = $("#edit_id").val();
                let myUrl = " {{ route('admin.payment.types.update', ':id') }}".replace(':id',
                    payment_type_id);

                $.ajax({
                    url: myUrl,
                    type: "POST",
                    data: $(this).serialize(),
                    success: function(res) {
                        if (res.status == 200) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: 'Payment Type Updated Successfully',
                                confirmButtonColor: '#3085d6',
                                confirmButtonText: 'OK'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    location.reload();
                                }
                            });
                        }
                    },
                    error: function(xhr) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: xhr.responseJSON.message || 'Something went wrong'
                        });
                    }
                });
            });

            $(document).on("click", ".editBtn", function() {
                let id = $(this).data("id");
                let name = $(this).data("name");
                let icon = $(this).data("icon");
                let status = $(this).data("status");

                $("#edit_id").val(id);
                $("#edit_name").val(name);
                $("#edit_icon").val(icon);
                $("#edit_is_active").prop('checked', status);
            });

            $(document).on("click", ".deleteBtn", function() {
                let id = $(this).data("id");
                let myUrl = "{{route('admin.payment.types.delete', ':id')}}".replace(':id', id);

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: myUrl,
                            type: "POST",
                            data: {
                                _token: "{{ csrf_token() }}"
                            },
                            success: function(res) {
                                if (res.status == 200) {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Deleted!',
                                        text: 'Payment Type has been deleted.',
                                        confirmButtonColor: '#3085d6',
                                        confirmButtonText: 'OK'
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            location.reload();
                                        }
                                    });
                                }
                            },
                            error: function(xhr) {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: xhr.responseJSON.message ||
                                        'Failed to delete'
                                });
                            }
                        });
                    }
                });
            });
        });
    </script>
@endsection
