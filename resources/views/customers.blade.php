@extends('layout.master')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/datatables.css') }}">
@endsection

@section('main_content')
    <div class="container-fluid">
        <div class="page-title">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h3>Your Customers</h3>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('dashboard') }}"><i data-feather="home"></i></a>
                            </li>
                            <li class="breadcrumb-item">Apps</li>
                            <li class="breadcrumb-item active">Customers</li>
                        </ol>
                    </div>
                </div>
            </div>

            <div class="container mt-4">
                <div class="card shadow-sm">
                       <div class="card-header bg-primary text-white py-2">
                            <div class="d-flex justify-content-between align-items-center">
                                Customers
                            </div>
                        </div>
                    <div class="card-body">
                        @if ($allCustomers->isEmpty())
                            <div class="alert alert-info mb-0">
                                No customers found yet.
                            </div>
                        @else
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped align-middle mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Bookings and details
                                            <th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($allCustomers as $index => $customer)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $customer->name }}</td>
                                                <td>{{ $customer->email }}</td>
                                                <td>{{ $customer->phone }}</td>
                                                <td>
                                                    <i class="fa fa-info-circle text-primary customer-info-btn"
                                                        style="cursor:pointer;" data-customer-id="{{ $customer->id }}">
                                                    </i>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="modal fade" id="customerServicesModal" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Customer Services</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>Service Name</th>
                                                        <th>Date</th>
                                                        <th>Status</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="servicesTableBody"></tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $(document).on('click', '.customer-info-btn', function() {
                let customerId = $(this).data('customer-id');

                $('#customerInfoContent').html('Loading...');
                $('#customerInfoModal').modal('show');

                $.ajax({
                    url: "{{ route('vendor.customer.services') }}",
                    method: "POST",
                    data: {
                        customer_id: customerId,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        if (response.status === 200) {
                            let rows = '';
                            response.data.forEach(service => {
                                rows += `
                        <tr>
                            <td>${service.name}</td>
                            <td>${service.date}</td>
                            <td>${service.status}</td>
                        </tr>
                    `;
                            });
                            $('#servicesTableBody').html(rows);
                            $('#customerServicesModal').modal('show');
                        }
                    },
                    error: function() {
                        $('#customerInfoContent').html(
                            '<div class="text-danger">Error loading data</div>');
                    }
                });
            });
        });
    </script>
@endsection
