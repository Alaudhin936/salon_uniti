@extends('layout.master')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/datatables.css') }}">
@endsection

@section('main_content')
    <div class="container">
        <h2 class="mb-4" style="color: #0a566d;">Your Profile</h2>

        <form id="vendorForm" method="POST">
            @csrf

            {{-- Vendor Details --}}
            <div class="card mb-4 shadow-sm">
                <div class="card-header bg-primary text-white py-2">
                    <div class="d-flex justify-content-between align-items-center">
                        Vendor Details
                    </div>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="name" class="form-label">Full Name</label>
                            <input type="text" id="name" name="name" value="{{ auth()->user()->name }}"
                                class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" id="email" name="email" value="{{ auth()->user()->email }}"
                                class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label for="phone" class="form-label">Phone</label>
                            <input type="text" id="phone" name="phone" value="{{ auth()->user()->phone }}"
                                class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label for="password" class="form-label">Password (leave blank to keep current)</label>
                            <input type="password" id="password" name="password" class="form-control">
                        </div>
                    </div>
                </div>
            </div>

            {{-- Shop Details --}}
            <div class="card mb-4 shadow-sm">
                <div class="card-header bg-primary text-white py-2">
                    <div class="d-flex justify-content-between align-items-center">
                        Business Details
                    </div>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="business_name" class="form-label">Business Name</label>
                            <input type="text" id="business_name" name="business_name"
                                value="{{ $vendor->business_name }}" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label for="slogan" class="form-label">Slogan</label>
                            <input type="text" id="slogan" name="slogan" value="{{ $vendor->slogan }}"
                                class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label for="type" class="form-label">Type</label>
                            <select id="type" name="type" class="form-select">
                                <option value="Unisex" {{ $vendor->type == 'Unisex' ? 'selected' : '' }}>Unisex</option>
                                <option value="Male" {{ $vendor->type == 'Male' ? 'selected' : '' }}>Male</option>
                                <option value="Female" {{ $vendor->type == 'Female' ? 'selected' : '' }}>Female</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="location" class="form-label">Location</label>
                            <input type="text" id="location" name="location" value="{{ $vendor->location }}"
                                class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label for="gst_number" class="form-label">GST Number</label>
                            <input type="text" id="gst_number" placeholder="ABCDE1234F" name="gst_number"
                                value="{{ $vendor->gst_number }}" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label for="shop_open" class="form-label">Shop Open Time</label>
                            <input type="time" id="shop_open" name="shop_open" value="{{ $vendor->shop_open }}"
                                class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label for="shop_close" class="form-label">Shop Close Time</label>
                            <input type="time" id="shop_close" name="shop_close" value="{{ $vendor->shop_close }}"
                                class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label for="is_active" class="form-label">Status</label>
                            <select id="is_active" name="is_active" class="form-select">
                                <option value="1" {{ $vendor->is_active ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ !$vendor->is_active ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Submit --}}
            <div class="text-end">
                <button type="submit" class="btn btn-success px-4" id="saveBtn">
                    <i class="fa fa-save me-2"></i>
                    <span class="btn-text">Save Changes</span>
                    <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                </button>
            </div>
        </form>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('assets/js/counter/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('assets/js/counter/jquery.counterup.min.js') }}"></script>
    <script src="{{ asset('assets/js/counter/counter-custom.js') }}"></script>
    <script src="{{ asset('assets/js/datatable/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/support-ticket-custom.js') }}"></script>

    <script>
        $('#vendorForm').on('submit', function(e) {
            e.preventDefault();
            let btn = $('#saveBtn');

            // Disable button
            btn.prop('disabled', true);
            btn.find('.btn-text').text('Saving...');
            btn.find('.spinner-border').removeClass('d-none');
            $.ajax({
                url: "{{ route('salon.profileupdate') }}",
                type: "POST",
                data: $(this).serialize(),
                headers: {
                    'X-CSRF-TOKEN': $('input[name="_token"]').val()
                },
                success: function(response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: 'Business Details saved successfully!',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'OK'
                    });
                    btn.prop('disabled', false);
                    btn.find('.btn-text').text('Save Changes');
                    btn.find('.spinner-border').addClass('d-none');
                },
                error: function(xhr) {
                    alert("Error: " + xhr.responseText);
                     Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'Something Went Wrong',
                        confirmButtonColor: 'red',
                        confirmButtonText: 'OK'
                    });
                    btn.prop('disabled', false);
                    btn.find('.btn-text').text('Save Changes');
                    btn.find('.spinner-border').addClass('d-none');
                }
            });
        });
    </script>
@endsection
