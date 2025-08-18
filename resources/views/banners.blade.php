@extends('layout.master')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/datatables.css') }}">
@endsection

@section('main_content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4>Banners</h4>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addBannerModal">
                <i class="fa fa-plus me-1"></i> Add Banner
            </button>
        </div>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="card shadow-sm">
            <div class="card-body table-responsive">
                <table id="bannersTable" class="table table-striped align-middle">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Banner</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Redirect URL</th>
                            <th>Status</th>
                            <th>Created At</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($banners as $banner)
                            <tr>
                                <td>{{ $banner->id }}</td>
                                <td>
                                    @if ($banner->image)
                                        <img src="{{ asset('storage/' . $banner->image) }}" alt="Banner" width="100"
                                            class="rounded">
                                    @else
                                        <span class="text-muted">No Image</span>
                                    @endif
                                </td>
                                <td>{{ $banner->title }}</td>
                                <td>{{ Str::limit($banner->description, 50) }}</td>
                                <td>
                                    <a href="{{ $banner->redirect_url }}" target="_blank">{{ $banner->redirect_url }}</a>
                                </td>
                                <td>
                                    @if ($banner->is_active)
                                        <span class="badge bg-success">Active</span>
                                    @else
                                        <span class="badge bg-danger">Inactive</span>
                                    @endif
                                </td>
                                <td>{{ $banner->created_at->format('d M Y') }}</td>
                                <td class="text-center">
                                    <a href="" class="btn btn-xs p-1 btn-warning editBannerBtn"
                                        data-banner='@json($banner)'>
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <button class="btn btn-xs btn-danger deleteBannerBtn"
                                        data-id="{{ $banner->id }}">
                                        <i class="fa fa-trash"></i>
                                    </button>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="modal fade" id="addBannerModal" tabindex="-1" aria-labelledby="addBannerModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form id="addBannerDetails" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addBannerModalLabel">Add New Banner</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <div class="mb-3">
                            <label for="bannerTitle" class="form-label">Title</label>
                            <input type="text" class="form-control" id="bannerTitle" name="title" required>
                        </div>

                        <div class="mb-3">
                            <label for="bannerDescription" class="form-label">Description</label>
                            <textarea class="form-control" id="bannerDescription" name="description" rows="3"></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="bannerImage" class="form-label">Banner Image</label>
                            <input type="file" class="form-control" id="bannerImage" name="banner_image" accept="image/*"
                                required>
                        </div>

                        <div class="mb-3">
                            <label for="redirectUrl" class="form-label">Redirect URL</label>
                            <input type="url" class="form-control" id="redirectUrl" name="redirect_url">
                        </div>

                        <div class="mb-3">
                            <label for="isActive" class="form-label">Status</label>
                            <select id="isActive" name="is_active" class="form-select">
                                <option value="1" selected>Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-success px-4">
                            <i class="fa fa-save me-1"></i> Save Banner
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="modal fade" id="editBannerModal" tabindex="-1" aria-labelledby="editBannerModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form id="editBannerForm" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="banner_id" id="editBannerId">

                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editBannerModalLabel">Edit Banner</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">

                        <div class="mb-3">
                            <label for="editBannerTitle" class="form-label">Title</label>
                            <input type="text" class="form-control" id="editBannerTitle" name="title" required>
                        </div>

                        <div class="mb-3">
                            <label for="editBannerDescription" class="form-label">Description</label>
                            <textarea class="form-control" id="editBannerDescription" name="description" rows="3"></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="editBannerImage" class="form-label">Banner Image</label>
                            <input type="file" class="form-control" id="editBannerImage" name="banner_image"
                                accept="image/*">
                            <div class="mt-2">
                                <img id="currentBannerImage" src="" alt="Banner Preview"
                                    class="img-fluid rounded shadow-sm" style="max-height: 120px;">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="editRedirectUrl" class="form-label">Redirect URL</label>
                            <input type="url" class="form-control" id="editRedirectUrl" name="redirect_url">
                        </div>

                        <div class="mb-3">
                            <label for="editIsActive" class="form-label">Status</label>
                            <select id="editIsActive" name="is_active" class="form-select">
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="fa fa-save me-1"></i> Update Banner
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection





@section('scripts')
    <script src="{{ asset('assets/js/datatable/datatables/jquery.dataTables.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('#bannersTable').DataTable({
                pageLength: 10,
                order: [
                    [0, 'desc']
                ]
            });

            $(document).on('click', '.editBannerBtn', function(e) {
                e.preventDefault()
                let banner = $(this).data('banner');

                $('#editBannerId').val(banner.id);
                $('#editBannerTitle').val(banner.title);
                $('#editBannerDescription').val(banner.description);
                $('#editRedirectUrl').val(banner.redirect_url);
                $('#editIsActive').val(banner.is_active);

                if (banner.banner_image) {
                    $('#currentBannerImage').attr('src', '/storage/' + banner.banner_image).show();
                } else {
                    $('#currentBannerImage').hide();
                }

                $('#editBannerModal').modal('show');
            });

            $(document).on("submit", "#editBannerForm", function(e) {
                e.preventDefault();
                let formData = new FormData(this);
                let bannerId = $("#editBannerId").val();
                let myUrl = "{{ route('admin.banner.update', ':id') }}".replace(':id', bannerId);

                $.ajax({
                    url: myUrl,
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response.success) {
                            $("#editBannerModal").modal("hide");
                            Swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: `Banner Updated Successfully`,
                                confirmButtonColor: '#3085d6',
                                confirmButtonText: 'OK'
                            }).then(function(result) {
                                if (result.isConfirmed) {
                                    window.location.reload();
                                }
                            });
                        } else {
                            alert("Something went wrong.");
                        }
                    },
                    error: function(xhr) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: xhr.responseText,
                            confirmButtonColor: 'red',
                            confirmButtonText: 'OK'
                        });
                    }
                });
            });

            $('#addBannerDetails').on('submit', function(e) {
                e.preventDefault();

                let formData = new FormData(this);

                $.ajax({
                    url: "{{ route('admin.banners.store') }}",
                    method: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response.status == 200) {
                            $('#addBannerModal').modal('hide');
                            $('#addBannerDetails')[0].reset();
                            Swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: `Banner Updated Successfully`,
                                confirmButtonColor: '#3085d6',
                                confirmButtonText: 'OK'
                            }).then(function(result) {
                                if (result.isConfirmed) {
                                    window.location.reload();
                                }
                            });

                            $('#bannersTable').DataTable().ajax.reload();
                        } else {
                            alert('Something went wrong!');
                        }
                    },
                    error: function(xhr) {
                        let errors = xhr.responseJSON.errors;
                        let errorMessage = "Validation Error:\n";
                        $.each(errors, function(key, value) {
                            errorMessage += "- " + value + "\n";
                        });
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: errorMessage,
                            confirmButtonColor: 'red',
                            confirmButtonText: 'OK'
                        });
                    }
                });
            });

            $(document).on("click", ".deleteBannerBtn", function() {
                let bannerId = $(this).data("id");
                let myUrl = "{{ route('admin.banner.delete', ':id') }}".replace(':id', bannerId);
                // if (!confirm("Are you sure you want to delete this banner?")) {
                //     return;
                // }

                Swal.fire({
                    icon: 'alert',
                    title: 'Alert',
                    text: `Are You Sure Wanted To Delete`,
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: myUrl,
                            type: "POST",
                            data: {
                                _token: "{{ csrf_token() }}"
                            },
                            success: function(response) {
                                if (response.success) {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Success',
                                        text: `Banner Updated Successfully`,
                                        confirmButtonColor: '#3085d6',
                                        confirmButtonText: 'OK'
                                    }).then(function(result) {
                                        if (result.isConfirmed) {
                                            window.location.reload();
                                        }
                                    });
                                } else {
                                    alert("Failed to delete banner!");
                                }
                            },
                            error: function(xhr) {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error!',
                                    text: xhr.responseText,
                                    confirmButtonColor: 'red',
                                    confirmButtonText: 'OK'
                                });
                            }
                        });
                    }
                });


            });

        });
    </script>
@endsection
