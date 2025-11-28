<div>
    @section('title', 'FAQ Management')

    <x-admin.ui.card>
        <x-slot name="header">
            <div class="d-flex justify-content-between align-items-center w-100">
                <h5 class="mb-0 font-weight-bold text-primary">Frequently Asked Questions</h5>
                <x-admin.ui.button wire:click="create" icon="fas fa-plus-circle" label="Add New FAQ" />
            </div>
        </x-slot>

        <x-admin.ui.table :headers="['Question', 'Category', 'Actions']">
            @forelse($faqs as $faq)
                <tr>
                    <td class="align-middle">
                        <div class="font-weight-bold text-dark">{{ $faq->question }}</div>
                        <small class="text-muted">{{ Str::limit($faq->answer, 80) }}</small>
                    </td>
                    <td class="align-middle">
                        <span class="admin-badge admin-badge-info">{{ $faq->category }}</span>
                    </td>
                    <td class="align-middle text-right">
                        <button wire:click="edit({{ $faq->id }})" class="admin-btn admin-btn-sm admin-btn-secondary mr-2"
                            title="Edit">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button wire:click="confirmDelete({{ $faq->id }})" class="admin-btn admin-btn-sm admin-btn-danger"
                            title="Delete">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="text-center py-4 text-muted">No FAQs found.</td>
                </tr>
            @endforelse
        </x-admin.ui.table>
    </x-admin.ui.card>

    <!-- Create/Edit Modal -->
    <x-admin.ui.modal isOpen="{{ $isOpen }}" title="{{ $faqId ? 'Edit FAQ' : 'Create New FAQ' }}" onClose="closeModal"
        submitAction="store" submitLabel="{{ $faqId ? 'Update' : 'Create' }}">
        <x-admin.ui.input label="Question" name="question" placeholder="e.g. What are your opening hours?" />

        <x-admin.ui.textarea label="Answer" name="answer" placeholder="Enter the answer" rows="4" />

        <div class="admin-form-group">
            <label class="admin-label">Category</label>
            <select wire:model="category" class="admin-select">
                <option value="General">General</option>
                <option value="Services">Services</option>
                <option value="Booking">Booking</option>
                <option value="Payments">Payments</option>
            </select>
            @error('category') <span class="text-danger small mt-1 d-block">{{ $message }}</span> @enderror
        </div>
    </x-admin.ui.modal>

    <!-- Delete Confirmation Modal -->
    <x-admin.ui.modal isOpen="{{ $isDeleteOpen }}" title="Confirm Delete" onClose="closeDeleteModal">
        <div class="text-center p-3">
            <div class="mb-4">
                <i class="fas fa-exclamation-circle text-danger" style="font-size: 50px;"></i>
            </div>
            <h4 class="font-weight-bold mb-2">Are you sure?</h4>
            <p class="text-muted mb-4">You won't be able to revert this! This FAQ will be permanently deleted.</p>
            <div class="d-flex justify-content-center">
                <button wire:click="closeDeleteModal" class="admin-btn admin-btn-secondary mr-3 px-4">Cancel</button>
                <button wire:click="delete" class="admin-btn admin-btn-danger px-4">Yes, Delete it!</button>
            </div>
        </div>
    </x-admin.ui.modal>
</div>