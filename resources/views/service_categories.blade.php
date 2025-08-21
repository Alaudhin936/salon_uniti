@extends('layout.master')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/datatables.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
@endsection

@section('main_content')
    <div class="container-fluid mt-4">
        <div class="row">
            <div class="col-12">
                <div class="card shadow-sm border-0 rounded-4">
                    {{-- <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                        <span class="fw-bold">Service Categories</span>
                        <button class="btn btn-light btn-sm px-3 py-2 rounded-pill shadow-sm fw-semibold"
                            data-bs-toggle="modal" data-bs-target="#addServiceModal">
                            <i class="fas fa-plus-circle me-2 text-primary"></i> Add Catagory
                        </button>
                    </div> --}}

                    <div class="card-header p-4 text-white d-flex justify-content-between align-items-center">
                        <h4 class="mb-0 underlined-heading fw-bold" style="color: #0a566d">Service Categories</h4>
                        <button class="btn btn-light btn-md px-3 py-2 rounded-pill shadow-sm fw-semibold"
                            data-bs-toggle="modal" data-bs-target="#addServiceModal">
                            <i class="fas fa-plus-circle me-2 text-primary"></i>Add Catagory
                        </button>
                    </div>
                    <div class="card-body">
                        <table id="categoriesTable" class="table table-striped table-bordered">
                            <thead class="table-light">
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categories as $category)
                                    <tr>
                                        <td>{{ $category->id }}</td>
                                        <td>{{ $category->name }}</td>
                                        <td>
                                            <button class="btn btn-xs btn-warning editBtn" data-id="{{ $category->id }}"
                                                data-name="{{ $category->name }}">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="btn btn-xs btn-danger deleteBtn" data-id="{{ $category->id }}">
                                                <i class="fas fa-trash"></i>
                                            </button>
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

    <!-- Edit Modal -->
    <div class="modal fade" id="editCategoryModal" tabindex="-1" aria-labelledby="editCategoryLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form id="editCategoryForm" method="POST">
                @csrf
                <div class="modal-content rounded-4 shadow">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title" id="editCategoryLabel">Edit Service Category</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="editCategoryId" name="id">
                        <div class="mb-3">
                            <label for="editCategoryName" class="form-label">Category Name</label>
                            <input type="text" class="form-control" id="editCategoryName" name="name" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary rounded-3" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-success rounded-3">Save Changes</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="modal fade" id="addServiceModal" tabindex="-1" aria-labelledby="addServiceModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-4 shadow-lg">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title fw-bold" id="addServiceModalLabel">Add Service Category</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="addServiceCategoryForm">
                        @csrf
                        <div class="mb-3">
                            <label for="categoryName" class="form-label fw-semibold">Category Name</label>
                            <input type="text" class="form-control" id="categoryName" name="name"
                                placeholder="Enter category name" required>
                        </div>
                        <div class="text-end">
                            <button type="submit" class="btn btn-success rounded-pill px-4">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('assets/js/datatable/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function() {
            $('#categoriesTable').DataTable();

            // Open Edit Modal

            $('.editBtn').on('click', function() {
                let id = $(this).data('id');
                let name = $(this).data('name');

                $('#editCategoryId').val(id);
                $('#editCategoryName').val(name);

                $('#editCategoryModal').modal('show');
            });

            // Save Changes via AJAX

            $('#addServiceCategoryForm').on('submit', function(e) {
                e.preventDefault();

                $.ajax({
                    url: "{{ route('services.categories.store') }}",
                    type: "POST",
                    data: $(this).serialize(),
                    success: function(response) {
                        $('#addServiceModal').modal('hide');
                        Swal.fire('Success!', response.message, 'success')
                            .then(() => location.reload());
                    },
                    error: function(xhr) {
                        Swal.fire('Error!', 'Could not add category.', 'error');
                    }
                });
            });

            $('#editCategoryForm').on('submit', function(e) {
                e.preventDefault();

                let id = $('#editCategoryId').val();
                let name = $('#editCategoryName').val();
                let url_1 = "{{ route('services.categories.update', ':id') }}".replace(':id',
                    id);

                $.ajax({
                    url: url_1,
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        name: name
                    },
                    success: function(response) {
                        $('#editCategoryModal').modal('hide');
                        Swal.fire('Updated!', 'Category updated successfully.',
                                'success')
                            .then(() => location.reload());
                    },
                    error: function() {
                        Swal.fire('Error!', 'Something went wrong.', 'error');
                    }
                });
            });

            // Delete Category

            $('.deleteBtn').on('click', function() {
                let id = $(this).data('id');
                let url_1 = "{{ route('services.categories.destroy', ':id') }}".replace(':id',
                    id);

                Swal.fire({
                    title: 'Are you sure?',
                    text: "This category will be deleted permanently!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: url_1,
                            type: 'POST',
                            data: {
                                _token: '{{ csrf_token() }}',
                            },
                            success: function() {
                                Swal.fire('Deleted!',
                                        'Category has been deleted.',
                                        'success')
                                    .then(() => location.reload());
                            },
                            error: function() {
                                Swal.fire('Error!', 'Something went wrong.',
                                    'error');
                            }
                        });
                    }
                });
            });

            @if (session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: "{{ session('success') }}",
                    timer: 2000,
                    showConfirmButton: false
                });
            @endif
        });
    </script>
@endsection
