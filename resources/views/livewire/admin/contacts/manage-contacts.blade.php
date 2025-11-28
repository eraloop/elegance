<div>
    @section('title', 'Contacts Management')

    <x-admin.ui.card>
        <x-slot name="header">
            <div class="d-flex justify-content-between align-items-center w-100">
                <h5 class="mb-0 font-weight-bold text-primary">Inbox</h5>
                <div class="d-flex align-items-center">
                    <select wire:model.live="filterType" class="admin-select admin-select-sm mr-2"
                        style="width: 150px;">
                        <option value="">All Types</option>
                        <option value="manual">Manual Messages</option>
                        <option value="automated">Automated Emails</option>
                    </select>
                    <select wire:model.live="filterStatus" class="admin-select admin-select-sm mr-2"
                        style="width: 150px;">
                        <option value="">All Messages</option>
                        <option value="unread">Unread</option>
                        <option value="read">Read</option>
                    </select>
                    <input wire:model.live.debounce.300ms="search" type="text" class="admin-input admin-input-sm"
                        placeholder="Search...">
                </div>
            </div>
        </x-slot>

        <x-admin.ui.table :headers="['Status', 'Sender', 'Subject', 'Date', 'Actions']">
            @forelse($contacts as $contact)
                <tr class="{{ $contact->is_read ? '' : 'bg-light font-weight-bold' }}">
                    <td class="align-middle">
                        @if($contact->is_read)
                            <i class="fas fa-envelope-open text-muted" title="Read"></i>
                        @else
                            <i class="fas fa-envelope text-primary" title="Unread"></i>
                        @endif
                    </td>
                    <td class="align-middle">
                        <div class="text-dark">{{ $contact->name }}</div>
                        <small class="text-muted">{{ $contact->email }}</small>
                    </td>
                    <td class="align-middle">
                        {{ Str::limit($contact->subject, 50) }}
                    </td>
                    <td class="align-middle">
                        {{ $contact->created_at->format('M d, Y h:i A') }}
                    </td>
                    <td class="align-middle text-right">
                        <button wire:click="viewDetails({{ $contact->id }})"
                            class="admin-btn admin-btn-sm admin-btn-secondary mr-1" title="View Message">
                            <i class="fas fa-eye"></i>
                        </button>
                        @if($contact->is_read)
                            <button wire:click="markAsUnread({{ $contact->id }})"
                                class="admin-btn admin-btn-sm admin-btn-light mr-1" title="Mark as Unread">
                                <i class="fas fa-envelope text-secondary"></i>
                            </button>
                        @endif
                        <button wire:click="confirmDelete({{ $contact->id }})"
                            class="admin-btn admin-btn-sm admin-btn-danger" title="Delete">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center py-4 text-muted">No messages found.</td>
                </tr>
            @endforelse
        </x-admin.ui.table>

        <div class="mt-4">
            {{ $contacts->links() }}
        </div>
    </x-admin.ui.card>

    <!-- View Modal -->
    @if($isOpen && $selectedContact)
        <x-admin.ui.modal isOpen="true" title="Message Details" onClose="closeModal">
            <div class="d-flex justify-content-between mb-4 border-bottom pb-3">
                <div>
                    <h6 class="font-weight-bold mb-1 text-primary">{{ $selectedContact->name }}</h6>
                    <p class="text-muted mb-0">{{ $selectedContact->email }}</p>
                    <p class="text-muted mb-0">{{ $selectedContact->phone }}</p>
                </div>
                <div class="text-right">
                    <small class="text-muted">{{ $selectedContact->created_at->format('F d, Y h:i A') }}</small>
                </div>
            </div>

            <h6 class="font-weight-bold mb-3 text-dark">Subject: {{ $selectedContact->subject }}</h6>

            <div class="p-4 bg-light rounded border">
                <p class="mb-0 text-dark" style="white-space: pre-wrap;">{{ $selectedContact->message }}</p>
            </div>

            @php
                $isAutomated = str_contains($selectedContact->subject, 'Appointment');
            @endphp

            @if($isAutomated)
                <div class="mt-4 text-center">
                    <div class="alert alert-info d-inline-flex align-items-center">
                        <i class="fas fa-robot mr-2"></i>
                        <span>This is an automated system-generated message and cannot be replied to.</span>
                    </div>
                </div>
            @else
                <div class="mt-4 text-right">
                    <a href="mailto:{{ $selectedContact->email }}" class="admin-btn admin-btn-primary text-decoration-none">
                        <i class="fas fa-reply mr-2"></i> Reply via Email
                    </a>
                </div>
            @endif
        </x-admin.ui.modal>
    @endif

    <!-- Delete Confirmation Modal -->
    <x-admin.ui.modal isOpen="{{ $isDeleteOpen }}" title="Confirm Delete" onClose="closeDeleteModal">
        <div class="text-center p-3">
            <div class="mb-4">
                <i class="fas fa-exclamation-circle text-danger" style="font-size: 50px;"></i>
            </div>
            <h4 class="font-weight-bold mb-2">Are you sure?</h4>
            <p class="text-muted mb-4">You won't be able to revert this! This message will be permanently deleted.</p>
            <div class="d-flex justify-content-center">
                <button wire:click="closeDeleteModal" class="admin-btn admin-btn-secondary mr-3 px-4">Cancel</button>
                <button wire:click="delete" class="admin-btn admin-btn-danger px-4">Yes, Delete it!</button>
            </div>
        </div>
    </x-admin.ui.modal>
</div>