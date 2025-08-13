@extends('layout.master')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/datatables.css') }}">
@endsection

@section('main_content')
    <div class="container-fluid">
        <div class="page-title">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h3  style="color: #0a566d" >Your Appointments</h3>
                </div>
                <div class="col-sm-6 text-sm-end text-start">
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#bookAppointmentModal">
                        <i class="fa fa-plus me-1"></i> Book Appointment
                    </button>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-sm-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('dashboard') }}"><i data-feather="home"></i></a>
                        </li>
                        <li class="breadcrumb-item">Apps</li>
                        <li class="breadcrumb-item active">Appointments</li>
                    </ol>
                </div>
            </div>

            <div class="container-fluid mt-5">
                @foreach ($appointments as $date => $bookings)
                    <div class="card mb-4 shadow-sm">
                        <div class="card-header bg-primary text-white">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="card-title mb-0">
                                    <i
                                        class="fa fa-calendar me-2"></i>{{ \Carbon\Carbon::parse($date)->format('l, d M Y') }}
                                </h5>
                                <span class="badge bg-light text-primary rounded-pill">
                                    {{ count($bookings) }} Appointments
                                </span>
                            </div>
                        </div>

                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover table-striped mb-0">
                                    <thead class="table-dark">
                                        <tr>
                                            <th scope="col" style="width: 25%;">
                                                <i class="fa fa-user me-1"></i>Customer
                                            </th>
                                            <th scope="col" style="width: 30%;">
                                                <i class="fa fa-scissors me-1"></i>Service
                                            </th>
                                            <th scope="col" style="width: 25%;">
                                                <i class="fa fa-clock me-1"></i>Time Slot
                                            </th>
                                            <th scope="col" class="text-center" style="width: 20%;">
                                                <i class="fa fa-info-circle me-1"></i>Status
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($bookings as $index => $appointment)
                                            <tr class="align-middle">
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="bg-secondary rounded-circle d-flex align-items-center justify-content-center me-3"
                                                            style="width: 35px; height: 35px;">
                                                            <i class="fa fa-user text-white small"></i>
                                                        </div>
                                                        <div>
                                                            <strong
                                                                class="text-dark">{{ $appointment->customer_name }}</strong>
                                                            <br>
                                                            <small class="text-muted">
                                                                <i class="fa fa-hashtag me-1"></i>Booking
                                                                #{{ $appointment->id ?? $index + 1 }}
                                                            </small>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center me-3"
                                                            style="width: 30px; height: 30px;">
                                                            <i class="fa fa-scissors text-white"
                                                                style="font-size: 12px;"></i>
                                                        </div>
                                                        <span class="fw-semibold">{{ $appointment->service_name }}</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <i class="fa fa-clock text-info me-2"></i>
                                                        <div>
                                                            <span class="fw-bold">{{ $appointment->slot_start }}</span>
                                                            <span class="text-muted mx-1">to</span>
                                                            <span class="fw-bold">{{ $appointment->slot_end }}</span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    <span
                                                        class="badge fs-6 px-3 py-2
                                            @if ($appointment->status == 'booked') bg-success
                                            @elseif($appointment->status == 'cancelled')
                                                bg-danger
                                            @elseif($appointment->status == 'completed')
                                                bg-primary
                                            @elseif($appointment->status == 'pending')
                                                bg-warning text-dark
                                            @else
                                                bg-secondary @endif">
                                                        @if ($appointment->status == 'booked')
                                                            <i class="fa fa-check-circle me-1"></i>
                                                        @elseif($appointment->status == 'cancelled')
                                                            <i class="fa fa-times-circle me-1"></i>
                                                        @elseif($appointment->status == 'completed')
                                                            <i class="fa fa-check-double me-1"></i>
                                                        @elseif($appointment->status == 'pending')
                                                            <i class="fa fa-hourglass-half me-1"></i>
                                                        @else
                                                            <i class="fa fa-question-circle me-1"></i>
                                                        @endif
                                                        {{ ucfirst($appointment->status) }}
                                                    </span>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="card-footer bg-light">
                            <div class="row text-center g-0">
                                <div class="col-3">
                                    <small class="text-muted d-block">Booked</small>
                                    <strong
                                        class="text-success">{{ collect($bookings)->where('status', 'booked')->count() }}</strong>
                                </div>
                                <div class="col-3 border-start">
                                    <small class="text-muted d-block">Completed</small>
                                    <strong
                                        class="text-primary">{{ collect($bookings)->where('status', 'completed')->count() }}</strong>
                                </div>
                                <div class="col-3 border-start">
                                    <small class="text-muted d-block">Cancelled</small>
                                    <strong
                                        class="text-danger">{{ collect($bookings)->where('status', 'cancelled')->count() }}</strong>
                                </div>
                                <div class="col-3 border-start">
                                    <small class="text-muted d-block">Total</small>
                                    <strong class="text-dark">{{ count($bookings) }}</strong>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="modal fade" id="bookAppointmentModal" tabindex="-1" aria-labelledby="bookAppointmentModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="bookAppointmentForm">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="bookAppointmentModalLabel">Book Appointment</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="user_id" class="form-label">Select User</label>
                            <select class="form-control" name="user_id" required>
                                <option value="">-- Choose User --</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Select Service -->
                        <div class="mb-3">
                            <label for="service_id" class="form-label">Select Service</label>
                            <select class="form-control" name="service_id" required>
                                <option value="">-- Choose Service --</option>
                                @foreach ($services as $service)
                                    <option data-duration="{{ $service->duration }}" value="{{ $service->id }}">
                                        {{ $service->name }} - {{ $service->price }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Date -->
                        <div class="mb-3">
                            <label for="date" class="form-label">Date</label>
                            <input type="date" class="form-control" name="date" required>
                        </div>

                        <!-- Slot Start -->
                        <div class="mb-3">
                            <label for="slot_start" class="form-label">Slot Start</label>
                            <input type="time" class="form-control" name="slot_start" required>
                        </div>

                        <!-- Slot End -->
                        <div class="mb-3">
                            <label for="slot_end" class="form-label">Slot End</label>
                            <input type="time" class="form-control" name="slot_end" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Book</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('assets/js/counter/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('assets/js/counter/jquery.counterup.min.js') }}"></script>
    <script src="{{ asset('assets/js/counter/counter-custom.js') }}"></script>
    <script src="{{ asset('assets/js/datatable/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/support-ticket-custom.js') }}"></script>
    <script>
        $(document).ready(function() {
            function calculateEndTime() {
                debugger
                let startTime = $('input[name="slot_start"]').val();
                let duration = $('select[name="service_id"] option:selected').data('duration');

                if (startTime && duration) {
                    let [hours, minutes] = startTime.split(':').map(Number);
                    let endMinutes = minutes + parseInt(duration);

                    // Add minutes properly
                    hours += Math.floor(endMinutes / 60);
                    minutes = endMinutes % 60;

                    // Format back to HH:MM
                    let formattedHours = String(hours).padStart(2, '0');
                    let formattedMinutes = String(minutes).padStart(2, '0');

                    $('input[name="slot_end"]').val(`${formattedHours}:${formattedMinutes}`);
                }
            }
            $('select[name="service_id"], input[name="slot_start"]').on('change', calculateEndTime);
            $('#bookAppointmentForm').on('submit', function(e) {
                e.preventDefault();

                $.ajax({
                    url: "{{ route('appointments.store') }}",
                    type: "POST",
                    data: $(this).serialize(),
                    success: function(response) {
                        window.location.reload();
                    },
                    error: function(xhr) {
                        debugger
                        if (xhr.status === 422) {
                            let errors = xhr.responseJSON.errors;
                            alert("Validation error: " + Object.values(errors).join(", "));
                        } else {
                            alert("Server error!");
                        }
                    }
                });

            });
        })
    </script>
@endsection
