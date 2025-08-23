@extends('layout.master')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/datatables.css') }}">
@endsection

@section('main_content')
    <div class="page-title">
        <div class="row">
            <div class="col-sm-6">

            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-end">
                    <li class="breadcrumb-item"><a href="#" class="text-decoration-none">Home</a></li>
                    <li class="breadcrumb-item active text-primary">Time Slots</li>
                </ol>
            </div>
        </div>
    </div>
    <div class="container-fluid" style="padding:30px;background-color:white;">
        @if ($weeklySchedules->isEmpty())
            <button class="btn btn-light btn-lg px-5 py-3 rounded-pill shadow-sm fw-semibold" data-bs-toggle="modal"
                data-bs-target="#addScheduleModal">
                <i class="fas fa-plus-circle me-2 text-primary"></i>
                Add New Schedule
            </button>
        @else
            <div class="p-4 mb-3 card-header text-white d-flex justify-content-between align-items-center">
                <h4 class="mb-0 underlined-heading fw-bold" style="color: #0a566d">Weekly Schedule</h4>
                <button class="btn btn-light btn-md px-3 py-2 rounded-pill shadow-sm fw-semibold" data-bs-toggle="modal"
                    data-bs-target="#addScheduleModal">
                    <i class="fas fa-plus-circle me-2 text-primary"></i>Add Schedule
                </button>
            </div>
            <table class="p-3 table table-bordered">
                <thead>
                    <tr>
                        <th>Day</th>
                        <th>Open Time</th>
                        <th>Close Time</th>
                        {{-- <th>Breaks</th> --}}
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($weeklySchedules as $schedule)
                        <tr>
                            <td>{{ $daysOfWeek[$schedule->day_of_week] }}</td>
                            <td class="editable-time position-relative" data-field="open_time"
                                data-schedule-id="{{ $schedule->id }}">
                                <span class="time-display">{{ $schedule->open_time }}</span>
                                <button class="btn text-dark btn-xs btn-outline-success edit-time-btn">
                                    Edit
                                </button>
                            </td>


                            <td class="editable-time position-relative" data-field="close_time"
                                data-schedule-id="{{ $schedule->id }}">
                                <span class="time-display">{{ $schedule->close_time }}</span>
                                <button class="btn btn-xs text-dark btn-outline-success edit-time-btn">
                                    Edit
                                </button>
                            </td>
                            <style>
                                .editable-time:hover .edit-time-btn {
                                    display: inline-block;
                                    position: absolute;
                                    right: 5px;
                                    top: 50%;
                                    transform: translateY(-50%);
                                }

                                .edit-time-btn {
                                    display: none;
                                }
                            </style>
                            {{-- <td class="breaks-cell position-relative">
                            @if ($schedule->breaks->isNotEmpty())
                                <ul class="list-unstyled mb-0">
                                    @foreach ($schedule->breaks as $break)
                                        <li>
                                            {{ $break->break_start }} - {{ $break->break_end }}
                                            <button class="btn btn-xs btn-outline-success text-dark edit-break-btn"
                                                data-break-id="{{ $break->id }}" data-schedule-id="{{ $schedule->id }}"
                                                data-type="weekly" data-open="{{ $schedule->open_time }}"
                                                data-close="{{ $schedule->close_time }}"
                                                data-start="{{ $break->break_start }}" data-end="{{ $break->break_end }}">
                                                Edit
                                            </button>
                                        </li>
                                    @endforeach
                                </ul>
                            @else
                                <span class="text-muted">No breaks</span>
                            @endif

                            <!-- Add Break button -->
                            <button class="btn btn-xs btn-outline-success text-dark add-break-btn"
                                data-schedule-id="{{ $schedule->id }}" data-type="weekly"
                                data-open="{{ $schedule->open_time }}" data-close="{{ $schedule->close_time }}">
                                + Add Break
                            </button>


                        </td> --}}
                            <style>
                                .breaks-cell .add-break-btn {
                                    display: none;
                                    position: absolute;
                                    right: 5px;
                                    bottom: 5px;
                                    font-size: 0.75rem;
                                    padding: 2px 6px;
                                }

                                .breaks-cell:hover .add-break-btn {
                                    display: inline-block;
                                }
                            </style>


                            <td class="text-center align-middle">
                                <div class="d-flex flex-column align-items-center justify-content-center gap-2">
                                    <!-- Modern Toggle Switch -->
                                    <label class="switch m-0">
                                        <input type="checkbox" class="schedule-status-toggle"
                                            data-schedule-id="{{ $schedule->id }}"
                                            {{ $schedule->is_closed ? '' : 'checked' }}>
                                        <span class="slider round"></span>
                                    </label>

                                    <!-- Status Badge -->
                                    <span
                                        class="badge status-badge {{ $schedule->is_closed ? 'bg-danger' : 'bg-success' }} text-white px-2 py-1 rounded-pill"
                                        style="font-size: 0.65rem; min-width: 60px;">
                                        {{ $schedule->is_closed ? 'Closed' : 'Open' }}
                                    </span>
                                </div>
                            </td>
                            <style>
                                /* Custom Switch Styling */
                                .switch {
                                    position: relative;
                                    display: inline-block;
                                    width: 42px;
                                    height: 22px;
                                }

                                .switch input {
                                    opacity: 0;
                                    width: 0;
                                    height: 0;
                                }

                                .slider {
                                    position: absolute;
                                    cursor: pointer;
                                    top: 0;
                                    left: 0;
                                    right: 0;
                                    bottom: 0;
                                    background-color: #dc3545;
                                    /* Danger color when off */
                                    transition: .4s;
                                }

                                .slider:before {
                                    position: absolute;
                                    content: "";
                                    height: 16px;
                                    width: 16px;
                                    left: 3px;
                                    bottom: 3px;
                                    background-color: white;
                                    transition: .4s;
                                }

                                input:checked+.slider {
                                    background-color: #28a745;
                                    /* Success color when on */
                                }

                                input:checked+.slider:before {
                                    transform: translateX(20px);
                                }

                                .slider.round {
                                    border-radius: 34px;
                                }

                                .slider.round:before {
                                    border-radius: 50%;
                                }
                            </style>


                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
    {{-- Exceptions --}}
    {{-- @if ($exceptions->isEmpty())
        <button class="btn btn-light btn-lg px-5 py-3 rounded-pill shadow-sm fw-semibold" data-bs-toggle="modal"
            data-bs-target="#addExceptionModal">
            <i class="fas fa-plus-circle me-2 text-primary"></i> Add Exception
        </button>
    @else
        <div class="d-flex justify-content-between align-items-center mb-2 mt-4">
            <h5>Exceptions</h5>
            <button class="btn btn-light btn-lg px-5 py-3 rounded-pill shadow-sm fw-semibold" data-bs-toggle="modal"
                data-bs-target="#addExceptionModal">
                <i class="fas fa-plus-circle me-2 text-primary"></i> Add Exception
            </button>
        </div>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Open Time</th>
                    <th>Close Time</th>
                    <th>Breaks</th>
                    <th >Status</th>
                    <th>Note</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($exceptions as $exception)
                    <tr>
                        <td>{{ $exception->date }}</td>
                        <td>{{ $exception->open_time ?? '-' }}</td>
                        <td>{{ $exception->close_time ?? '-' }}</td>
                        <td>{{ $exception->breaks_count }}</td>
                        <td>
                            @if ($exception->is_closed)
                                <span class="badge bg-danger">Closed</span>
                            @else
                                <span class="badge bg-success">Open</span>
                            @endif
                        </td>
                        <td>{{ $exception->note ?? '-' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif --}}


    <div class="modal fade" id="addBreakModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <form id="breakForm" class="modal-content">
                @csrf
                <input type="hidden" name="schedule_id">
                <input type="hidden" name="type"> <!-- weekly | exception -->

                <div class="modal-header">
                    <h5 class="modal-title">Add Break</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-2">
                        <label>Start Time</label>
                        <input type="time" name="start_time" class="form-control" required>
                    </div>
                    <div class="mb-2">
                        <label>End Time</label>
                        <input type="time" name="end_time" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save Break</button>
                </div>
            </form>
        </div>
    </div>
    {{-- Add Schedule Modal --}}
    <div class="modal fade" id="addScheduleModal" tabindex="-1" aria-labelledby="addScheduleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form id="scheduleForm" method="POST" class="modal-content">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="addScheduleModalLabel">Add Weekly Schedule</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-2">
                        <label>Day</label>
                        <select name="day_of_week" class="form-select" required>
                            @foreach ($daysOfWeek as $key => $day)
                                <option value="{{ $key }}">{{ $day }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-2">
                        <label>Open Time</label>
                        <input type="time" name="open_time" class="form-control" required>
                    </div>
                    <div class="mb-2">
                        <label>Close Time</label>
                        <input type="time" name="close_time" class="form-control" required>
                    </div>
                    <div class="mb-2">
                        <label>Closed?</label>
                        <input type="checkbox" name="is_closed" value="1">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save Schedule</button>
                </div>
            </form>
        </div>
    </div>

    {{-- Add Exception Modal --}}
    <div class="modal fade" id="addExceptionModal" tabindex="-1" aria-labelledby="addExceptionModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <form id="exceptionForm" method="POST" class="modal-content">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="addExceptionModalLabel">Add Exception</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-2">
                        <label>Date</label>
                        <input type="date" name="date" class="form-control" required>
                    </div>
                    <div class="mb-2">
                        <label>Open Time</label>
                        <input type="time" name="open_time" class="form-control">
                    </div>
                    <div class="mb-2">
                        <label>Close Time</label>
                        <input type="time" name="close_time" class="form-control">
                    </div>
                    <div class="mb-2">
                        <label>Closed?</label>
                        <input type="checkbox" name="is_closed" value="1">
                    </div>
                    <div class="mb-2">
                        <label>Note</label>
                        <textarea name="note" class="form-control"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save Exception</button>
                </div>
            </form>
        </div>
    </div>
    <div class="modal fade" id="editBreakModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <form id="editBreakForm" class="modal-content">
                @csrf

                <input type="hidden" name="break_id">
                <input type="hidden" name="schedule_id">
                <input type="hidden" name="type">

                <div class="modal-header">
                    <h5 class="modal-title">Edit Break</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <div class="mb-2">
                        <label>Start Time</label>
                        <input type="time" name="start_time" class="form-control" required>
                    </div>
                    <div class="mb-2">
                        <label>End Time</label>
                        <input type="time" name="end_time" class="form-control" required>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Update Break</button>
                </div>
            </form>
        </div>
    </div>


@endsection

@section('scripts')
    <script src="{{ asset('assets/js/datatable/datatables/jquery.dataTables.min.js') }}"></script>
    <script>
        $(function() {
            $('.table').DataTable();




            $(document).on('click', '.save-time-btn', function() {
                let $td = $(this).closest('.editable-time');
                let newTime = $td.find('.new-time-input').val();
                let field = $td.data('field');
                let scheduleId = $td.data('schedule-id');

                let myUrl = "{{ route('vendor.schedule.updateTime', ':id') }}".replace(':id', scheduleId);

                $.ajax({
                    url: myUrl,
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        field: field,
                        value: newTime
                    },
                    success: function(response) {
                        if (response.status === 200) {
                            $td.html(`
                    <span class="time-display">${newTime}</span>
                    <button class="btn btn-xs text-dark btn-outline-success edit-time-btn">Edit</button>
                `);
                        } else {
                            alert('Failed to update time!');
                            restoreOriginalCell($td);
                        }
                    },
                    error: function() {
                        alert('Error updating time!');
                        restoreOriginalCell($td);
                    }
                });
            });



            $(document).on('click', '.edit-time-btn', function(e) {
                e.preventDefault();

                let $td = $(this).closest('.editable-time');
                let currentTime = $td.find('.time-display').text().trim();
                let field = $td.data('field'); // open_time | close_time
                let scheduleId = $td.data('schedule-id');

                // Replace display with input + save button
                $td.data('original-html', $td.html()); // store original in case of cancel
                $td.html(`
        <div class="d-flex align-items-center gap-1">
            <input type="time" class="form-control form-control-sm new-time-input" value="${currentTime}">
            <button class="btn btn-sm btn-success text-center save-time-btn">Save</button>
            <button class="btn btn-sm text-dark btn-light cancel-time-btn">Cancel</button>
        </div>
    `);

                $td.find('input').focus();
            });

            $(document).on('click', '.cancel-time-btn', function() {
                let $td = $(this).closest('.editable-time');
                restoreOriginalCell($td);
            });

            $(document).on('change', '.schedule-status-toggle', function() {
                let $toggle = $(this);
                let scheduleId = $toggle.data('schedule-id');
                let isClosed = !$toggle.is(':checked');
                let $statusBadge = $toggle.closest('td').find('.status-badge');
                let myUrl = "{{ route('vendor.schedule.status', ':id') }}".replace(':id', scheduleId)

                $.ajax({
                    url: myUrl,
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        is_closed: isClosed ? 1 : 0
                    },
                    success: function(response) {
                        if (response.status === 200) {
                            if (isClosed) {
                                $statusBadge
                                    .removeClass('bg-success text-success bg-opacity-25')
                                    .addClass('bg-danger text-danger bg-opacity-25')
                                    .text('Closed');
                            } else {
                                $statusBadge
                                    .removeClass('bg-danger text-danger bg-opacity-25')
                                    .addClass('bg-success text-success bg-opacity-25')
                                    .text('Opened');
                            }
                        } else {
                            alert('Failed to update status!');
                            $toggle.prop('checked', !isClosed);
                        }
                    },
                    error: function() {
                        alert('Error updating status!');
                        $toggle.prop('checked', !isClosed);
                    }
                });
            });


            function restoreOriginalCell($td) {
                $td.html($td.data('original-html'));
            }

            $(document).on('click', '.edit-break-btn', function() {
                let modal = $('#editBreakModal');

                modal.find('input[name="break_id"]').val($(this).data('break-id'));
                modal.find('input[name="schedule_id"]').val($(this).data('schedule-id'));
                modal.find('input[name="type"]').val($(this).data('type'));

                modal.find('input[name="start_time"]').val($(this).data('start'));
                modal.find('input[name="end_time"]').val($(this).data('end'));

                modal.find('input[name="start_time"]').attr('min', $(this).data('open'));
                modal.find('input[name="end_time"]').attr('max', $(this).data('close'));

                modal.modal('show');
            });
            $('#editBreakForm').on('submit', function(e) {
                e.preventDefault();

                let breakId = $(this).find('input[name="break_id"]').val();
                let myUrl = "{{ route('vendor.break.update', ':id') }}".replace(':id', breakId)

                $.ajax({
                    url: myUrl,
                    method: 'POST',
                    data: $(this).serialize(),
                    success: function(res) {
                        $('#editBreakModal').modal('hide');
                        if (res.status == 200) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Break Added',
                                text: 'Break saved successfully.',
                            }).then(() => window.location.reload());
                        }
                    },
                    error: function(xhr) {
                        toastr.error(xhr.responseJSON?.message || 'Something went wrong');
                    }
                });
            });


            $(document).on('click', '.add-break-btn', function() {
                let scheduleId = $(this).data('schedule-id');
                let type = $(this).data('type');
                let openTime = $(this).data('open');
                let closeTime = $(this).data('close');

                $('#breakForm [name="schedule_id"]').val(scheduleId);
                $('#breakForm [name="type"]').val(type);

                $('#breakForm [name="start_time"]').attr('min', openTime).attr('max', closeTime);
                $('#breakForm [name="end_time"]').attr('min', openTime).attr('max', closeTime);

                $('#breakForm')[0].reset();

                $('#addBreakModal').modal('show');
            });

            $('#breakForm [name="start_time"]').on('change', function() {
                let start = $(this).val();
                $('#breakForm [name="end_time"]').attr('min', start);
            });


            $('#breakForm').on('submit', function(e) {
                e.preventDefault();

                $.ajax({
                    url: "{{ route('vendor.breaks.store') }}",
                    method: "POST",
                    data: $(this).serialize(),
                    success: function(response) {
                        if (response.status == 200) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Break Added',
                                text: 'Break saved successfully.',
                            }).then(() => window.location.reload());
                        }
                    },
                    error: function(xhr) {
                        alert("Error: " + xhr.responseText);
                    }
                });
            });


            $('#scheduleForm').on('submit', function(e) {
                e.preventDefault();
                $.ajax({
                    url: "{{ route('vendor.schedule.store') }}",
                    method: "POST",
                    data: $(this).serialize(),
                    success: function(response) {
                        if (response.status == 200) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: 'Schedule Added Successfully',
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
                        alert("Something went wrong: " + xhr.responseText);
                    }
                });
            });

            $('#exceptionForm').on('submit', function(e) {
                e.preventDefault();
                $.ajax({
                    url: "{{ route('vendor.exception.store') }}",
                    method: "POST",
                    data: $(this).serialize(),
                    success: function(response) {
                        if (response.status == 200) {
                            if (response.status == 200) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Success',
                                    text: 'Exception Added Successfully',
                                    confirmButtonColor: '#3085d6',
                                    confirmButtonText: 'OK'
                                }).then(function(result) {
                                    if (result.isConfirmed) {
                                        window.location.reload();
                                    }
                                });
                            }
                        }
                    },
                    error: function(xhr) {
                        alert("Something went wrong: " + xhr.responseText);
                    }
                });
            });
        });
    </script>
@endsection
