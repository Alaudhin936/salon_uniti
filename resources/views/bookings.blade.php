@extends('layout.master')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/datatables.css') }}">
@endsection

@section('main_content')
    <div class="container-fluid">
        <!-- Page Header -->
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-body bg-light rounded-3 p-4">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h3 class="mb-2 fw-bold text-dark">
                            <i class="fas fa-calendar-day me-2 text-primary"></i>
                            Available Slots for {{ $date }}
                        </h3>
                        <p class="mb-0 text-muted">
                            <i class="fas fa-info-circle me-1"></i>
                            Select your preferred time slot to proceed with booking
                        </p>
                    </div>
                    <div class="col-md-4 text-md-end mt-3 mt-md-0">
                        <a href="{{ route('appointments') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-arrow-left me-1"></i>
                            Back to Appointments
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Slots Container -->
        <div class="card border-0 shadow-sm">
            <div class="card-body p-4">
                <!-- Legend -->
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="d-flex flex-wrap gap-3 align-items-center p-3 bg-light rounded-3 border">
                            <div class="d-flex align-items-center">
                                <div class="bg-success rounded-circle me-2" style="width: 12px; height: 12px;"></div>
                                <small class="text-muted">Available</small>
                            </div>
                            <div class="d-flex align-items-center">
                                <div class= "rounded-circle me-2" style="background:#dc2626;width: 12px; height: 12px;"></div>
                                <small class="text-muted">Booked</small>
                            </div>
                            <div class="ms-auto text-muted">
                                <i class="fas fa-clock me-1"></i>
                                <small>Select your preferred time</small>
                            </div>
                        </div>
                    </div>
                </div>
                <style>
                    .btn.btn-time-slot {
                        border-radius: 10px;
                        width: 50px !important;
                        height: 50px !important;
                    }

                    .btn-time-slot {
                        min-width: 68px;
                        max-width: 72px;
                        height: 36px;
                        padding: 2px 6px;
                        border-radius: 6px;
                        border: 1px solid #e2e8f0;
                        transition: all 0.15s ease;
                        position: relative;
                        font-size: 0.7rem;
                        font-weight: 500;
                        letter-spacing: 0.2px;
                        background: white;
                        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
                    }

                    .btn-time-slot:not(:disabled):hover {
                        transform: translateY(-1px);
                        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.08);
                        border-color: #cbd5e1;
                    }

                    .btn-time-slot:not(:disabled):active {
                        transform: translateY(0);
                        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
                    }

                    /* Available slots - BookMyShow style blue */
                    .btn-time-slot.btn-success {
                        background: #42f168 !important;
                        border-color: #42f168 !important;
                        color: white;
                    }

                    .btn-time-slot.btn-success:hover {
                        background: #09f514 !important;
                        border-color: #09f514 !important;
                        box-shadow: 0 2px 6px rgba(30, 64, 175, 0.2);
                    }

                    /* Booked slots - Light gray with red accent */
                    .btn-time-slot.btn-secondary {
                        background: #fef2f2 !important;
                        border-color: #fecaca !important;
                        color: #dc2626 !important;
                    }

                    /* Past/Expired slots - Neutral gray */
                    .btn-time-slot.btn-dark {
                        background: #f8fafc;
                        border-color: #e2e8f0;
                        color: #64748b;
                    }

                    .btn-time-slot:disabled {
                        opacity: 0.8;
                        cursor: not-allowed;
                    }

                    .time-main {
                        font-weight: 600;
                        font-size: 0.7rem;
                        line-height: 1;
                        margin-bottom: 2px;
                    }

                    .time-duration {
                        font-size: 0.55rem;
                        font-weight: 400;
                        opacity: 0.85;
                        line-height: 1;
                        text-transform: capitalize;
                        letter-spacing: 0.3px;
                    }

                    .d-flex.flex-wrap.gap-3 {
                        gap: 0.4rem !important;
                    }

                    .text-center.py-5 {
                        padding: 2rem 0;
                    }

                    .fa-calendar-times {
                        opacity: 0.7;
                    }

                    .fs-5 {
                        font-size: 1.1rem !important;
                    }
                </style>
                <div class="row">
                    <div class="col-12">
                        <div class="d-flex flex-wrap gap-3">
                            @forelse($slots as $slot)
                                <button
                                    class="btn
                        {{ $slot['isBooked'] ? 'btn-secondary' : ($slot['isPast'] ? 'btn-dark' : 'btn-success') }}
                        btn-time-slot"
                                    {{ $slot['isBooked'] || $slot['isPast'] ? 'disabled' : '' }}
                                    data-start="{{ $slot['start_time'] }}" data-end="{{ $slot['end_time'] }}">

                                    <div class="text-center">
                                        <div class="time-main">{{ $slot['time'] }}</div>
                                        <div class="time-duration">
                                            @if ($slot['isBooked'])
                                                Booked
                                            @elseif($slot['isPast'])
                                                Expired
                                            @else
                                                Available
                                            @endif
                                        </div>
                                    </div>
                                </button>
                            @empty
                                <div class="col-12">
                                    <div class="text-center py-5">
                                        <i class="fas fa-calendar-times fa-3x mb-3 text-danger"></i>
                                        <p class="text-danger fs-5 fw-semibold">No slots available.</p>
                                        <p class="text-muted">Please select a different date or check back later.</p>
                                    </div>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>

                <div class="card border-0 shadow-sm mt-4" id="selectedSlotCard">
                    <div class="card-body p-4">
                        <div class="row align-items-center">
                            <div class="col-md-8">
                                <h5 class="mb-1"><i class="fas fa-clock me-2"></i>Selected Time Slot</h5>
                                <p class="mb-0 text-muted" id="selectedSlotText"></p>
                            </div>
                            <div class="col-md-4 text-md-end mt-3 mt-md-0">
                                <style>
                                    #bookSlotBtn {
                                        background: #5cce5c !important;
                                        border: none;
                                        color: white;
                                        padding: 0.875rem 2.5rem;
                                        font-size: 1rem;
                                        font-weight: 600;
                                        border-radius: 12px;
                                        box-shadow: 0 4px 12px rgba(30, 64, 175, 0.15);
                                        transition: all 0.3s ease;
                                        position: relative;
                                        overflow: hidden;
                                        letter-spacing: 0.025em;
                                        min-width: 160px;
                                    }

                                    #bookSlotBtn::before {
                                        content: '';
                                        position: absolute;
                                        top: 0;
                                        left: -100%;
                                        width: 100%;
                                        height: 100%;
                                        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
                                        transition: all 0.3s ease;
                                    }

                                    #bookSlotBtn:hover {
                                        background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
                                        transform: translateY(-2px);
                                        box-shadow: 0 6px 20px rgba(59, 130, 246, 0.3);
                                        color: white;
                                    }

                                    #bookSlotBtn:hover::before {
                                        left: 100%;
                                    }

                                    #bookSlotBtn:active {
                                        transform: translateY(0);
                                        box-shadow: 0 2px 8px rgba(30, 64, 175, 0.2);
                                    }

                                    #bookSlotBtn i {
                                        font-size: 0.9rem;
                                        transition: transform 0.3s ease;
                                    }

                                    #bookSlotBtn:hover i {
                                        transform: translateX(4px);
                                    }

                                    /* Focus state for accessibility */
                                    #bookSlotBtn:focus {
                                        outline: none;
                                        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.3);
                                    }

                                    /* Loading state (optional) */
                                    #bookSlotBtn.loading {
                                        pointer-events: none;
                                        opacity: 0.8;
                                    }

                                    #bookSlotBtn.loading i {
                                        animation: spin 1s linear infinite;
                                    }

                                    @keyframes spin {
                                        from {
                                            transform: rotate(0deg);
                                        }

                                        to {
                                            transform: rotate(360deg);
                                        }
                                    }

                                    /* Alternative styles for different contexts */
                                    .btn-proceed-alt {
                                        background: white;
                                        border: 2px solid #3b82f6;
                                        color: #3b82f6;
                                        padding: 0.875rem 2.5rem;
                                        font-size: 1rem;
                                        font-weight: 600;
                                        border-radius: 12px;
                                        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
                                        transition: all 0.3s ease;
                                        min-width: 160px;
                                    }

                                    .btn-proceed-alt:hover {
                                        background: #3b82f6;
                                        color: white;
                                        transform: translateY(-2px);
                                        box-shadow: 0 4px 15px rgba(59, 130, 246, 0.25);
                                    }

                                    .demo-container {
                                        background: white;
                                        padding: 2rem;
                                        border-radius: 16px;
                                        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
                                        margin-bottom: 2rem;
                                    }
                                </style>
                                <button id="bookSlotBtn"
                                    class="btn btn-light btn-lg px-5 py-3 rounded-pill shadow-sm fw-semibold"
                                    data-bs-toggle="modal" data-bs-target="#bookAppointmentModal">
                                    <i class="fas fa-arrow-right me-2"></i>
                                    Proceed
                                </button>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .btn-time-slot {
            height: 70px;
            min-width: 140px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            border-radius: 12px;
            font-weight: 500;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            border: 2px solid transparent;
        }

        .btn-time-slot:not(:disabled):hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
            border-color: rgba(255, 255, 255, 0.3);
        }

        .btn-time-slot:not(:disabled):focus,
        .btn-time-slot:not(:disabled):active {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        .btn-time-slot .time-main {
            font-size: 1rem;
            font-weight: 600;
            line-height: 1.2;
            margin-bottom: 2px;
        }

        .btn-time-slot .time-duration {
            font-size: 0.75rem;
            opacity: 0.85;
            font-weight: 500;
        }

        .btn-time-slot:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            transform: none !important;
            box-shadow: none !important;
        }

        .btn-time-slot:disabled .time-duration {
            font-weight: 600;
        }

        @media (max-width: 576px) {
            .btn-time-slot {
                min-width: 120px;
                height: 60px;
                font-size: 0.9rem;
            }

            .btn-time-slot .time-main {
                font-size: 0.9rem;
            }

            .btn-time-slot .time-duration {
                font-size: 0.7rem;
            }
        }

        @media (max-width: 480px) {
            .d-flex.flex-wrap.gap-3 {
                gap: 0.75rem !important;
            }

            .btn-time-slot {
                min-width: 110px;
                height: 55px;
            }
        }
    </style>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            document.querySelectorAll('.btn-time-slot:not(:disabled)').forEach(button => {
                button.addEventListener('click', function() {
                    document.querySelectorAll('.btn-time-slot').forEach(btn => {
                        btn.classList.remove('btn-primary');
                        if (!btn.disabled) {
                            btn.classList.add('btn-success');
                        }
                    });

                    this.classList.remove('btn-success');
                    this.classList.add('btn-primary');

                    const start = this.dataset.start;
                    const end = this.dataset.end;
                    const timeText = this.querySelector('.time-main').textContent;

                    console.log(`Selected slot: ${start} to ${end} (${timeText})`);

                    this.style.transform = 'translateY(-4px)';
                    setTimeout(() => {
                        this.style.transform = 'translateY(-2px)';
                    }, 150);
                });
            });

            let selectedSlot = null;

            // Slot selection handler
            $('.btn-time-slot:not(:disabled)').click(function() {
                // Remove active class from all buttons
                $('.btn-time-slot').removeClass('active');

                // Add active class to selected button
                $(this).addClass('active');

                // Store selected slot data
                selectedSlot = {
                    start: $(this).data('start'),
                    end: $(this).data('end'),
                    date: '{{ $date }}',
                    service_id: '{{ $serviceId }}',
                    user_id: '{{ $userId }}'
                };

                // Update UI
                $('#selectedSlotText').text(`${selectedSlot.start} - ${selectedSlot.end}`);
                $('#selectedSlotCard').fadeIn();
            });

            // Book slot handler
            $('#bookSlotBtn').click(function() {
                if (!selectedSlot) return;
                bookSlot(selectedSlot);
            });

            function bookSlot(slotData) {
                $.ajax({
                    url: '{{ route('bookings.store') }}',
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        user_id: slotData.user_id,
                        service_id: slotData.service_id,
                        date: slotData.date,
                        slot_start: slotData.start,
                        slot_end: slotData.end
                    },
                    beforeSend: function() {
                        $('#bookSlotBtn').prop('disabled', true).html(
                            '<i class="fas fa-spinner fa-spin me-1"></i> Booking...');
                    },
                    success: function(response) {
                        if (response.success) {
                            window.location.href = "bookings/payments/create";
                        } else {
                            showError(response.message || 'Booking failed');
                        }
                    },
                    error: function(xhr) {
                        let error = xhr.responseJSON?.message || 'An error occurred';
                        showError(error);
                    },
                    complete: function() {
                        $('#bookSlotBtn').prop('disabled', false).html(
                            '<i class="fas fa-calendar-check me-1"></i> Book Slot');
                    }
                });
            }

            function showError(message) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: message,
                    confirmButtonText: 'Try Again'
                });
            }
        });
    </script>
@endsection
