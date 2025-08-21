@extends('layout.master')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/datatables.css') }}">
@endsection

@section('main_content')
    <div class="container-fluid" style="padding:30px;background-color:white;">
        <div class="page-title">

            <div class="card-header p-4 text-white d-flex justify-content-between align-items-center">
                <h4 class="mb-0 underlined-heading fw-bold" style="color: #0a566d">Bookings</h4>
                <button class="btn btn-light btn-md px-3 py-2 rounded-pill shadow-sm fw-semibold" data-bs-toggle="modal"
                    data-bs-target="#bookAppointmentModal">
                    <i class="fas fa-plus-circle me-2 text-primary"></i>Book Appointment
                </button>
            </div>

            <div class="d-flex justify-content-center my-3 ">
                <ul class="nav nav-pills d-flex gap-3" id="appointmentFilter">
                    <li class="nav-item">
                        <button class="btn active nav-link" data-filter="all">All</button>
                    </li>
                    <li class="nav-item">
                        <button class="btn nav-link" data-filter="upcoming">Upcoming</button>
                    </li>
                    <li class="nav-item">
                        <button class="btn nav-link" data-filter="completed">Completed</button>
                    </li>
                    <li class="nav-item">
                        <button class="btn nav-link" data-filter="cancelled">Cancelled</button>
                    </li>
                </ul>
            </div>


            <div class="container-fluid mt-5">
                @foreach ($appointments as $date => $bookings)
                    @php
                        $tableId = 'appointmentsTable_' . \Carbon\Carbon::parse($date)->format('Y_m_d');
                    @endphp

                    <div class="card mb-4 shadow-sm">
                        <div class="card-header bg-primary text-white py-2">
                            <div class="d-flex justify-content-between align-items-center">
                                <b class="card-title mb-0" style="font-size: 1rem;">
                                    <i
                                        class="fa fa-calendar me-2"></i>{{ \Carbon\Carbon::parse($date)->format('l, d M Y') }}
                                </b>
                                <span class="badge bg-light text-primary rounded-pill">
                                    {{ count($bookings) }} Appointments
                                </span>
                            </div>
                        </div>


                        <div class="card-body p-3">
                            <div class="table-responsive">
                                <table id="{{ $tableId }}" class="table table-hover table-striped mb-0">
                                    <thead class="">
                                        <tr>
                                            <th>Customer</th>
                                            <th>Service</th>
                                            <th>Time Slot</th>
                                            <th class="text-center">Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($bookings as $index => $appointment)
                                            <tr class="align-middle appointment-row"
                                                data-status="{{ strtolower($appointment->status) }}">
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
                                                        <div class="bg-success rounded-circle d-flex align-items-center justify-content-center me-3"
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
                                                        class="badge fs-7 px-2 py-1
                                        @if ($appointment->status == 'booked') bg-success
                                        @elseif($appointment->status == 'cancelled') bg-danger
                                        @elseif($appointment->status == 'completed') bg-success
                                        @elseif($appointment->status == 'pending') bg-warning text-dark
                                        @else bg-secondary @endif">
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
                                                <td>
                                                    <div class="d-flex align-items-center gap-2">
                                                        {{-- Mark as Done --}}
                                                        <i style="cursor: {{ $appointment->status === 'completed' ? 'not-allowed' : 'pointer' }};"
                                                            data-appointment-id="{{ $appointment->id }}"
                                                            data-status="disable"
                                                            class="fa fa-check-circle text-success fa-lg appointment-mark-done
               {{ $appointment->status === 'completed' ? 'disabled-icon disabled' : '' }}">
                                                        </i>

                                                        {{-- Reject --}}
                                                        <i style="cursor: {{ $appointment->status === 'cancelled' ? 'not-allowed' : 'pointer' }};"
                                                            data-appointment-id="{{ $appointment->id }}"
                                                            data-status="enable"
                                                            class="fa fa-times-circle text-danger fa-lg appointment-mark-reject
               {{ $appointment->status === 'cancelled' ? 'disabled-icon disabled' : '' }}">
                                                        </i>
                                                    </div>
                                                    <style>
                                                        .disabled-icon {
                                                            opacity: 0.5;
                                                            pointer-events: none;
                                                            /* This makes it unclickable */
                                                        }
                                                    </style>
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
                <form id="bookAppointmentForm" method="GET" action="{{ route('bookings.index') }}">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="bookAppointmentModalLabel">Book Appointment</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="user_id" class="form-label">Select Customer</label>
                            <select class="form-control" name="user_id" required>
                                <option value="">-- Choose Customer --</option>
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
                            <input type="text" class="form-control datepicker" name="date" id="date"
                                placeholder="Select Date" required
                                data-mindate="{{ \Carbon\Carbon::today()->format('Y-m-d') }}">
                        </div>

                        {{-- <!-- Slot Start -->
                        <div class="mb-3">
                            <label for="slot_start" class="form-label">Slot Start</label>
                            <input type="time" class="form-control" name="slot_start" required>
                        </div>

                        <!-- Slot End -->
                        <div class="mb-3">
                            <label for="slot_end" class="form-label">Slot End</label>
                            <input type="time" class="form-control" name="slot_end" readonly>
                        </div> --}}
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" style="border-radius:8px">> Proceed</button>
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
            flatpickr(".datepicker", {
                dateFormat: "Y-m-d",
                minDate: "today",
                disable: [
                    function(date) {
                        return;
                    }
                ],
                locale: {
                    firstDayOfWeek: 1
                }
            });
            $("table[id^='appointmentsTable_']").each(function() {
                $(this).DataTable({
                    paging: true,
                    searching: true,
                    ordering: true,
                    info: true,
                    pageLength: 5,
                    lengthMenu: [5, 10, 25, 50],
                    columnDefs: [{
                        orderable: false,
                        targets: [3]
                    }]
                });
            });

            function calculateEndTime() {
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

            function setMinStartTime(date) {
                if (!date) return;
                let duration = $('select[name="service_id"] option:selected').data('duration');
                $.ajax({
                    url: "{{ route('vendor.date.validate') }}",
                    method: "POST",
                    data: {
                        date: date,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response.start_slot) {
                            $('input[name="slot_start"]').attr('min', response.start_slot);
                            let [endHours, endMinutes] = response.end_slot.split(':').map(Number);
                            let totalEndMinutes = endHours * 60 + endMinutes;

                            let adjustedEndMinutes = totalEndMinutes - duration;

                            let adjHours = Math.floor(adjustedEndMinutes / 60);
                            let adjMinutes = adjustedEndMinutes % 60;
                            let formattedEnd = String(adjHours).padStart(2, '0') + ':' + String(
                                adjMinutes).padStart(2, '0');

                            $('input[name="slot_start"]').attr('max', formattedEnd);
                        }
                    }
                });
            };

            $('input[name="date"]').on('change', function() {
                setMinStartTime($(this).val());
            });
            $('select[name="service_id"], input[name="slot_start"]').on('change', calculateEndTime);
            // $('#bookAppointmentForm').on('submit', function(e) {
            //     e.preventDefault();

            //     $.ajax({
            //         url: "{{ route('appointments.store') }}",
            //         type: "POST",
            //         data: $(this).serialize(),
            //         success: function(response) {
            //             Swal.fire({
            //                 icon: 'success',
            //                 title: 'Success',
            //                 text: 'Service Competed Successfully',
            //                 confirmButtonColor: '#3085d6',
            //                 confirmButtonText: 'OK'
            //             }).then(function(result) {
            //                 if (result.isConfirmed) {
            //                     window.location.reload();
            //                 }
            //             });
            //         },
            //         error: function(xhr) {
            //             if (xhr.status === 422) {
            //                 let errors = xhr.responseJSON.errors;
            //                 alert("Validation error: " + Object.values(errors).join(", "));
            //             } else {
            //                 alert("Server error!");
            //             }
            //         }
            //     });

            // });


            $('#appointmentFilter button').on('click', function() {
                const filter = $(this).data('filter');

                // Update active button style
                $('#appointmentFilter .nav-link').removeClass('active');
                $(this).addClass('active');

                // Loop over each card
                $('.card').each(function() {
                    const $card = $(this);
                    let hasVisibleRows = false;

                    // Loop over each appointment row inside the card
                    $card.find('.appointment-row').each(function() {
                        const status = $(this).data('status');

                        // Check if row matches filter
                        const matches =
                            filter === 'all' ||
                            (filter === 'upcoming' && (status === 'booked' || status ===
                                'pending')) ||
                            status === filter;

                        // Show or hide the row
                        $(this).toggle(matches);

                        if (matches) {
                            hasVisibleRows = true;
                        }
                    });

                    // Show card only if it has matching rows
                    $card.toggle(hasVisibleRows);
                });
            });


            $('.appointment-mark-done, .appointment-mark-reject').on('click', (e) => {
                let appointmentId = $(e.target).data('appointment-id');
                let status = $(e.target).data('status');
                let myUrl = "{{ route('appointments.markdone', [':id', ':status']) }}"
                    .replace(':id', appointmentId)
                    .replace(':status', status);

                $.ajax({
                    url: myUrl,
                    type: "POST",
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response.status == 200) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: `Service ${response.data} Successfully`,
                                confirmButtonColor: '#3085d6',
                                confirmButtonText: 'OK'
                            }).then(function(result) {
                                if (result.isConfirmed) {
                                    window.location.reload();
                                }
                            });
                        }
                    },
                    error: function(xhr) {
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
