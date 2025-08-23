@extends('layout.master')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/datatables.css') }}">
@endsection

@section('main_content')
    <style>
        input {
            border: 1px solid #d8f3d9 !important;
        }
    </style>
    <div class="container mt-4" style="padding:30px;background-color:white;">
        <h3 style="color: #0a566d" class="underlined-heading mb-4">Admin Settings</h3>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if (!$settings)
            <div class="text-center">
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#settingsModal">
                    <i class="fa fa-plus me-2"></i> Add Settings
                </button>
            </div>
        @else
            {{-- Existing settings edit form --}}
            <form id="settingsForm" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label>Site Name</label>
                        <input type="text" class="form-control" name="site_name" value="{{ $settings->site_name }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Email</label>
                        <input type="email" class="form-control" name="email" value="{{ $settings->email }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Phone</label>
                        <input type="text" class="form-control" name="phone" value="{{ $settings->phone }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Address</label>
                        <input type="text" class="form-control" name="address" value="{{ $settings->address }}">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="site_logo" class="form-label">Site Logo</label>

                        @if (!empty($settings->site_logo))
                            <div class="mb-2">
                                <img src="{{ asset('storage/' . $settings->site_logo) }}" alt="Site Logo"
                                    class="img-fluid rounded shadow-sm" style="max-height: 100px;">
                            </div>
                        @endif

                        <input type="file" class="form-control" id="site_logo" name="site_logo" accept="image/*">

                        <div class="mt-2">
                            <img id="previewSiteLogo" style="max-height: 100px; display: none;"
                                class="img-fluid rounded shadow-sm">
                        </div>
                    </div>

                    <div class="col-md-12 mb-3">
                        <label>About Us</label>
                        <textarea class="form-control" name="about_us" rows="3">{{ $settings->about_us }}</textarea>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label>Privacy Policy</label>
                        <textarea class="form-control" name="privacy_policy" rows="3">{{ $settings->privacy_policy }}</textarea>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label>Terms & Conditions</label>
                        <textarea class="form-control" name="terms_conditions" rows="3">{{ $settings->terms_conditions }}</textarea>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Facebook</label>
                        <input type="url" class="form-control" name="facebook_url"
                            value="{{ $settings->facebook_url }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Twitter</label>
                        <input type="url" class="form-control" name="twitter_url" value="{{ $settings->twitter_url }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Instagram</label>
                        <input type="url" class="form-control" name="instagram_url"
                            value="{{ $settings->instagram_url }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>LinkedIn</label>
                        <input type="url" class="form-control" name="linkedin_url"
                            value="{{ $settings->linkedin_url }}">
                    </div>

                    <div class="col-md-4 mb-3">
                        <label>Currency</label>
                        <input type="text" class="form-control" name="currency" value="{{ $settings->currency }}">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label>Timezone</label>
                        <input type="text" class="form-control" name="timezone" value="{{ $settings->timezone }}">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label>Maintenance Mode</label>
                        <select class="form-select" name="maintenance_mode">
                            <option value="0" {{ !$settings->maintenance_mode ? 'selected' : '' }}>Off</option>
                            <option value="1" {{ $settings->maintenance_mode ? 'selected' : '' }}>On</option>
                        </select>
                    </div>
                </div>

                <button class="btn btn-success mt-3 px-4" type="submit">
                    <i class="fa fa-save me-2"></i> Save Settings
                </button>
            </form>
        @endif
    </div>

    <div class="modal fade" id="cropperModalLogo" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Crop Site Logo</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body text-center">
                    <img id="cropperImageLogo" style="max-width:100%; max-height:500px;">
                </div>
                <div class="modal-footer">
                    <button type="button" id="cropButtonLogo" class="btn btn-success">Crop & Save</button>
                </div>
            </div>
        </div>
    </div>
    {{-- Add Settings Modal --}}
    <div class="modal fade" id="settingsModal" tabindex="-1" aria-labelledby="settingsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form id="settingsForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="settingsModalLabel">Add Admin Settings</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label>Site Name</label>
                                <input type="text" class="form-control" name="site_name">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Email</label>
                                <input type="email" class="form-control" name="email">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Phone</label>
                                <input type="text" class="form-control" name="phone">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Address</label>
                                <input type="text" class="form-control" name="address">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Site Logo</label>
                                <input type="file" class="form-control" name="site_logo">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Favicon</label>
                                <input type="file" class="form-control" name="favicon">
                            </div>
                            <div class="col-md-12 mb-3">
                                <label>About Us</label>
                                <textarea class="form-control" name="about_us" rows="3"></textarea>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label>Privacy Policy</label>
                                <textarea class="form-control" name="privacy_policy" rows="3"></textarea>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label>Terms & Conditions</label>
                                <textarea class="form-control" name="terms_conditions" rows="3"></textarea>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Facebook</label>
                                <input type="url" class="form-control" name="facebook_url">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Twitter</label>
                                <input type="url" class="form-control" name="twitter_url">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Instagram</label>
                                <input type="url" class="form-control" name="instagram_url">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>LinkedIn</label>
                                <input type="url" class="form-control" name="linkedin_url">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label>Currency</label>
                                <input type="text" class="form-control" name="currency">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label>Timezone</label>
                                <input type="text" class="form-control" name="timezone">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label>Maintenance Mode</label>
                                <select class="form-select" name="maintenance_mode">
                                    <option value="0">Off</option>
                                    <option value="1">On</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button class="btn btn-success" type="submit">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
<script></script>
@section('scripts')
    <script>
        $(document).ready(function() {
            let cropperLogo;
            const inputLogo = $('#site_logo')[0];
            const modalLogo = new bootstrap.Modal($('#cropperModalLogo')[0], {
                backdrop: 'static', // prevents closing on outside click
                keyboard: false // prevents closing with escape
            });
            const cropperImageLogo = $('#cropperImageLogo')[0];
            const previewLogo = $('#previewSiteLogo')[0];

            // When user selects a new logo
            $('#site_logo').on('change', function(e) {
                const file = e.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function() {
                        cropperImageLogo.src = reader.result;
                        modalLogo.show();
                    };
                    reader.readAsDataURL(file);
                }
            });

            // Initialize Cropper when modal opens
            $('#cropperModalLogo').on('shown.bs.modal', function() {
                cropperLogo = new Cropper(cropperImageLogo, {
                    aspectRatio: 200 / 200, // fixed width x height
                    viewMode: 1,
                    autoCropArea: 1,
                    background: false,
                    responsive: true
                });
            }).on('hidden.bs.modal', function() {
                if (cropperLogo) {
                    cropperLogo.destroy();
                    cropperLogo = null;
                }
            });

            // Crop and replace file input
            $('#cropButtonLogo').on('click', function() {
                const canvas = cropperLogo.getCroppedCanvas({
                    width: 200,
                    height: 200,
                    imageSmoothingEnabled: true,
                    imageSmoothingQuality: 'high'
                });

                // Show preview
                previewLogo.src = canvas.toDataURL("image/png");
                previewLogo.style.display = "block";

                // Replace file input with blob
                canvas.toBlob(function(blob) {
                    const file = new File([blob], "site_logo.png", {
                        type: "image/png"
                    });
                    const dataTransfer = new DataTransfer();
                    dataTransfer.items.add(file);
                    inputLogo.files = dataTransfer.files;
                }, "image/png", 1);

                modalLogo.hide();
            });
            $('#settingsForm').on('submit', function(e) {
                e.preventDefault();

                let formData = new FormData(this);

                $.ajax({
                    url: "{{ route('admin.settings.store') }}",
                    type: "POST",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        if (response.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Success!',
                                text: response.message,
                            }).then(() => {
                                location.reload();
                            });
                        }
                    },
                    error: function(xhr) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: xhr.responseJSON?.message ?? 'Something went wrong',
                        });
                    }
                });
            });
        });
    </script>
@endsection
