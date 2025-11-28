<div>
    @section('title', 'Appointments Management')

    <x-admin.ui.card>
        <x-slot name="header">
            <div class="d-flex justify-content-between align-items-center w-100">
                <h5 class="mb-0 font-weight-bold text-primary">All Appointments</h5>
                <div class="d-flex align-items-center">
                    <select wire:model.live="filterStatus" class="admin-select">
                        <option value="">All Status</option>
                        <option value="pending">Pending</option>
                        <option value="confirmed">Confirmed</option>
                        <option value="canceled">Canceled</option>
                        <option value="completed">Completed</option>
                    </select>
                    <input wire:model.live.debounce.300ms="search" type="text" class="admin-input admin-input-sm"
                        placeholder="Search customer...">
                </div>
            </div>
        </x-slot>

        <x-admin.ui.table :headers="['ID', 'Customer', 'Service', 'Date & Time', 'Status', 'Price', 'Actions']">
            @forelse($appointments as $appointment)
                <tr>
                    <td class="align-middle font-weight-bold text-muted">#{{ $appointment->id }}</td>
                    <td class="align-middle">
                        <div class="font-weight-bold text-dark">{{ $appointment->customer_name }}</div>
                        <small class="text-muted">{{ $appointment->customer_phone }}</small>
                    </td>
                    <td class="align-middle">{{ $appointment->service->name ?? 'N/A' }}</td>
                    <td class="align-middle">
                        <div class="font-weight-bold">
                            {{ \Carbon\Carbon::parse($appointment->appointment_date)->format('M d, Y') }}
                        </div>
                        <small
                            class="text-muted">{{ \Carbon\Carbon::parse($appointment->appointment_time)->format('h:i A') }}</small>
                    </td>
                    <td class="align-middle">
                        @if($appointment->status == 'pending')
                            <span class="admin-badge admin-badge-warning">Pending</span>
                        @elseif($appointment->status == 'confirmed')
                            <span class="admin-badge admin-badge-primary">Confirmed</span>
                        @elseif($appointment->status == 'completed')
                            <span class="admin-badge admin-badge-success">Completed</span>
                        @elseif($appointment->status == 'canceled')
                            <span class="admin-badge admin-badge-danger">Cancelled</span>
                        @endif
                    </td>
                    <td class="align-middle font-weight-bold">${{ number_format($appointment->price, 2) }}</td>
                    <td class="align-middle text-right">
                        <button wire:click="viewDetails({{ $appointment->id }})"
                            class="admin-btn admin-btn-sm admin-btn-secondary" title="View Details">
                            <i class="fas fa-eye"></i>
                        </button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center py-4 text-muted">No appointments found.</td>
                </tr>
            @endforelse
        </x-admin.ui.table>

        <div class="mt-4">
            {{ $appointments->links() }}
        </div>
    </x-admin.ui.card>

    <!-- View/Edit Modal -->
    @if($isOpen && $selectedAppointment)
        <x-admin.ui.modal isOpen="true" title="Appointment Details #{{ $selectedAppointment->id }}" onClose="closeModal">
            <div class="row">
                <div class="col-md-6">
                    <h6 class="font-weight-bold text-primary mb-3 text-uppercase small">Customer Information</h6>
                    <p class="mb-2"><strong class="text-muted">Name:</strong> <span
                            class="text-dark">{{ $selectedAppointment->customer_name }}</span></p>
                    <p class="mb-2"><strong class="text-muted">Email:</strong> <span
                            class="text-dark">{{ $selectedAppointment->customer_email ?? 'N/A' }}</span></p>
                    <p class="mb-2"><strong class="text-muted">Phone:</strong> <span
                            class="text-dark">{{ $selectedAppointment->customer_phone }}</span></p>
                </div>
                <div class="col-md-6">
                    <h6 class="font-weight-bold text-primary mb-3 text-uppercase small">Service Details</h6>
                    <p class="mb-2"><strong class="text-muted">Service:</strong> <span
                            class="text-dark">{{ $selectedAppointment->service->name ?? 'N/A' }}</span></p>
                    <p class="mb-2"><strong class="text-muted">Date:</strong> <span
                            class="text-dark">{{ \Carbon\Carbon::parse($selectedAppointment->appointment_date)->format('F d, Y') }}</span>
                    </p>
                    <p class="mb-2"><strong class="text-muted">Time:</strong> <span
                            class="text-dark">{{ \Carbon\Carbon::parse($selectedAppointment->appointment_time)->format('h:i A') }}</span>
                    </p>
                    <p class="mb-2"><strong class="text-muted">Price:</strong> <span
                            class="text-dark font-weight-bold">${{ number_format($selectedAppointment->price, 2) }}</span>
                    </p>
                </div>
            </div>

            @if($selectedAppointment->notes)
                <div class="mt-4 p-3 bg-light rounded border">
                    <h6 class="font-weight-bold mb-2 text-dark">Customer Notes:</h6>
                    <p class="mb-0 text-muted">{{ $selectedAppointment->notes }}</p>
                </div>
            @endif

            <div class="mt-4 border-top pt-4">
                <h6 class="font-weight-bold mb-3 text-dark">Update Status</h6>
                <div class="d-flex flex-wrap gap-2">
                    <button 
                        wire:click="updateStatus('confirmed')"
                        @if(!$this->isValidTransition('confirmed')) disabled @endif
                        class="admin-btn mr-2 
                            @if($selectedAppointment->status == 'confirmed') 
                                admin-btn-primary 
                            @elseif($this->isValidTransition('confirmed')) 
                                admin-btn-outline-primary 
                            @else 
                                admin-btn-secondary opacity-50 
                            @endif"
                        style="@if(!$this->isValidTransition('confirmed')) cursor: not-allowed; @endif">
                        <i class="fas fa-check-circle mr-1"></i> 
                        @if($selectedAppointment->status == 'confirmed') Current: @endif Confirmed
                    </button>
                    
                    <button 
                        wire:click="updateStatus('completed')"
                        @if(!$this->isValidTransition('completed')) disabled @endif
                        class="admin-btn mr-2 
                            @if($selectedAppointment->status == 'completed') 
                                admin-btn-success 
                            @elseif($this->isValidTransition('completed')) 
                                admin-btn-outline-success 
                            @else 
                                admin-btn-secondary opacity-50 
                            @endif"
                        style="@if(!$this->isValidTransition('completed')) cursor: not-allowed; @endif">
                        <i class="fas fa-check-double mr-1"></i> 
                        @if($selectedAppointment->status == 'completed') Current: @endif Completed
                    </button>
                    
                    <button 
                        wire:click="updateStatus('canceled')"
                        @if(!$this->isValidTransition('canceled')) disabled @endif
                        class="admin-btn 
                            @if($selectedAppointment->status == 'canceled') 
                                admin-btn-danger 
                            @elseif($this->isValidTransition('canceled')) 
                                admin-btn-outline-danger 
                            @else 
                                admin-btn-secondary opacity-50 
                            @endif"
                        style="@if(!$this->isValidTransition('canceled')) cursor: not-allowed; @endif">
                        <i class="fas fa-times-circle mr-1"></i> 
                        @if($selectedAppointment->status == 'canceled') Current: @endif Canceled
                    </button>
                </div>
            </div>
        </x-admin.ui.modal>
    @endif
</div>