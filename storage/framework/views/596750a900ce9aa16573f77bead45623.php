<?php $__env->startSection('css'); ?>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/vendors/datatables.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('main_content'); ?>
    <div class="container-fluid">
        <div class="page-title">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h3 style="color: #0a566d">Bookings</h3>
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
                            <a href="<?php echo e(route('dashboard')); ?>"><i data-feather="home"></i></a>
                        </li>
                        <li class="breadcrumb-item">Apps</li>
                        <li class="breadcrumb-item active">Bookings</li>
                    </ol>
                </div>
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
                <?php $__currentLoopData = $appointments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $date => $bookings): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                        $tableId = 'appointmentsTable_' . \Carbon\Carbon::parse($date)->format('Y_m_d');
                    ?>

                    <div class="card mb-4 shadow-sm">
                        <div class="card-header bg-primary text-white py-2">
                            <div class="d-flex justify-content-between align-items-center">
                                <b class="card-title mb-0" style="font-size: 1rem;">
                                    <i
                                        class="fa fa-calendar me-2"></i><?php echo e(\Carbon\Carbon::parse($date)->format('l, d M Y')); ?>

                                </b>
                                <span class="badge bg-light text-primary rounded-pill">
                                    <?php echo e(count($bookings)); ?> Appointments
                                </span>
                            </div>
                        </div>


                        <div class="card-body p-3">
                            <div class="table-responsive">
                                <table id="<?php echo e($tableId); ?>" class="table table-hover table-striped mb-0">
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
                                        <?php $__currentLoopData = $bookings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $appointment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr class="align-middle appointment-row"
                                                data-status="<?php echo e(strtolower($appointment->status)); ?>">
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="bg-secondary rounded-circle d-flex align-items-center justify-content-center me-3"
                                                            style="width: 35px; height: 35px;">
                                                            <i class="fa fa-user text-white small"></i>
                                                        </div>
                                                        <div>
                                                            <strong
                                                                class="text-dark"><?php echo e($appointment->customer_name); ?></strong>
                                                            <br>
                                                            <small class="text-muted">
                                                                <i class="fa fa-hashtag me-1"></i>Booking
                                                                #<?php echo e($appointment->id ?? $index + 1); ?>

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
                                                        <span class="fw-semibold"><?php echo e($appointment->service_name); ?></span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <i class="fa fa-clock text-info me-2"></i>
                                                        <div>
                                                            <span class="fw-bold"><?php echo e($appointment->slot_start); ?></span>
                                                            <span class="text-muted mx-1">to</span>
                                                            <span class="fw-bold"><?php echo e($appointment->slot_end); ?></span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    <span
                                                        class="badge fs-7 px-2 py-1
                                        <?php if($appointment->status == 'booked'): ?> bg-success
                                        <?php elseif($appointment->status == 'cancelled'): ?> bg-danger
                                        <?php elseif($appointment->status == 'completed'): ?> bg-primary
                                        <?php elseif($appointment->status == 'pending'): ?> bg-warning text-dark
                                        <?php else: ?> bg-secondary <?php endif; ?>">
                                                        <?php if($appointment->status == 'booked'): ?>
                                                            <i class="fa fa-check-circle me-1"></i>
                                                        <?php elseif($appointment->status == 'cancelled'): ?>
                                                            <i class="fa fa-times-circle me-1"></i>
                                                        <?php elseif($appointment->status == 'completed'): ?>
                                                            <i class="fa fa-check-double me-1"></i>
                                                        <?php elseif($appointment->status == 'pending'): ?>
                                                            <i class="fa fa-hourglass-half me-1"></i>
                                                        <?php else: ?>
                                                            <i class="fa fa-question-circle me-1"></i>
                                                        <?php endif; ?>
                                                        <?php echo e(ucfirst($appointment->status)); ?>

                                                    </span>
                                                </td>
                                                <td>
                                                    <div class="d-flex align-items-center gap-2">
                                                        
                                                        <i style="cursor: <?php echo e($appointment->status === 'completed' ? 'not-allowed' : 'pointer'); ?>;"
                                                            data-appointment-id="<?php echo e($appointment->id); ?>"
                                                            data-status="disable"
                                                            class="fa fa-check-circle text-success fa-lg appointment-mark-done
               <?php echo e($appointment->status === 'completed' ? 'disabled-icon disabled' : ''); ?>">
                                                        </i>

                                                        
                                                        <i style="cursor: <?php echo e($appointment->status === 'cancelled' ? 'not-allowed' : 'pointer'); ?>;"
                                                            data-appointment-id="<?php echo e($appointment->id); ?>"
                                                            data-status="enable"
                                                            class="fa fa-times-circle text-danger fa-lg appointment-mark-reject
               <?php echo e($appointment->status === 'cancelled' ? 'disabled-icon disabled' : ''); ?>">
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
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="card-footer bg-light">
                            <div class="row text-center g-0">
                                <div class="col-3">
                                    <small class="text-muted d-block">Booked</small>
                                    <strong
                                        class="text-success"><?php echo e(collect($bookings)->where('status', 'booked')->count()); ?></strong>
                                </div>
                                <div class="col-3 border-start">
                                    <small class="text-muted d-block">Completed</small>
                                    <strong
                                        class="text-primary"><?php echo e(collect($bookings)->where('status', 'completed')->count()); ?></strong>
                                </div>
                                <div class="col-3 border-start">
                                    <small class="text-muted d-block">Cancelled</small>
                                    <strong
                                        class="text-danger"><?php echo e(collect($bookings)->where('status', 'cancelled')->count()); ?></strong>
                                </div>
                                <div class="col-3 border-start">
                                    <small class="text-muted d-block">Total</small>
                                    <strong class="text-dark"><?php echo e(count($bookings)); ?></strong>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            </div>
        </div>
    </div>

    <div class="modal fade" id="bookAppointmentModal" tabindex="-1" aria-labelledby="bookAppointmentModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="bookAppointmentForm" method="GET" action="<?php echo e(route('bookings.index')); ?>">
                    <?php echo csrf_field(); ?>
                    <div class="modal-header">
                        <h5 class="modal-title" id="bookAppointmentModalLabel">Book Appointment</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="user_id" class="form-label">Select Customer</label>
                            <select class="form-control" name="user_id" required>
                                <option value="">-- Choose Customer --</option>
                                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($user->id); ?>"><?php echo e($user->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>

                        <!-- Select Service -->
                        <div class="mb-3">
                            <label for="service_id" class="form-label">Select Service</label>
                            <select class="form-control" name="service_id" required>
                                <option value="">-- Choose Service --</option>
                                <?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option data-duration="<?php echo e($service->duration); ?>" value="<?php echo e($service->id); ?>">
                                        <?php echo e($service->name); ?> - <?php echo e($service->price); ?>

                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>

                        <!-- Date -->
                        <div class="mb-3">
                            <label for="date" class="form-label">Date</label>
                            <input type="text" class="form-control datepicker" name="date" id="date"
                                placeholder="Select Date" required
                                data-mindate="<?php echo e(\Carbon\Carbon::today()->format('Y-m-d')); ?>">
                        </div>

                        
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Proceed</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    <script src="<?php echo e(asset('assets/js/counter/jquery.waypoints.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/counter/jquery.counterup.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/counter/counter-custom.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/datatable/datatables/jquery.dataTables.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/support-ticket-custom.js')); ?>"></script>
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
                    url: "<?php echo e(route('vendor.date.validate')); ?>",
                    method: "POST",
                    data: {
                        date: date,
                        _token: '<?php echo e(csrf_token()); ?>'
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
            //         url: "<?php echo e(route('appointments.store')); ?>",
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
                let myUrl = "<?php echo e(route('appointments.markdone', [':id', ':status'])); ?>"
                    .replace(':id', appointmentId)
                    .replace(':status', status);

                $.ajax({
                    url: myUrl,
                    type: "POST",
                    data: {
                        _token: '<?php echo e(csrf_token()); ?>'
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp8.2\htdocs\salon_unitiii\resources\views/appointments.blade.php ENDPATH**/ ?>