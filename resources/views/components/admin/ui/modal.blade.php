@props(['isOpen' => false, 'title' => '', 'onClose' => '', 'submitAction' => null, 'submitLabel' => 'Save'])

@if($isOpen)
    <div class="modal fade show" style="display: block; background: rgba(0,0,0,0.5); z-index: 1050;" tabindex="-1"
        role="dialog" aria-modal="true" aria-labelledby="modal-title-{{ Str::slug($title) }}">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content admin-card border-0 shadow-lg m-0">
                <div class="modal-header border-bottom-0 pb-0 pt-4 px-4">
                    <h5 class="modal-title font-weight-bold" id="modal-title-{{ Str::slug($title) }}"
                        style="color: var(--admin-primary); font-size: 1.25rem;">
                        {{ $title }}
                    </h5>
                    <button wire:click="{{ $onClose }}" type="button" class="close" aria-label="Close"
                        style="outline: none;">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body px-4 pb-4 pt-2">
                    @if($submitAction)
                        <form wire:submit.prevent="{{ $submitAction }}">
                    @endif

                        <div class="mt-3">
                            {{ $slot }}
                        </div>

                        @if($submitAction)
                                <div class="d-flex justify-content-end mt-4">
                                    <button wire:click="{{ $onClose }}" type="button"
                                        class="admin-btn admin-btn-secondary mr-2">Cancel</button>
                                    <button type="submit" class="admin-btn admin-btn-primary px-4">{{ $submitLabel }}</button>
                                </div>
                            </form>
                        @else
                        <div class="d-flex justify-content-end mt-4">
                            <button wire:click="{{ $onClose }}" type="button"
                                class="admin-btn admin-btn-secondary">Close</button>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endif