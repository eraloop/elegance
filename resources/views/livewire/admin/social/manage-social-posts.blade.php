<div>
    @section('title', 'Social Media Manager')

    <div class="row">
        <!-- Compose Section -->
        <div class="col-md-5">
            <x-admin.ui.card title="Compose Post">
                <form wire:submit.prevent="save">
                    <x-admin.ui.textarea label="Default Content" name="content" placeholder="What's on your mind?" />

                    <div class="admin-form-group">
                        <label class="admin-label">Image (Optional)</label>
                        <div class="admin-file-input-wrapper">
                            <input wire:model="image" type="file" accept="image/*">
                            <span class="text-muted">
                                <i class="fas fa-cloud-upload-alt mr-2"></i> Choose file
                            </span>
                        </div>
                        @if ($image)
                            <div class="mt-3">
                                <img src="{{ $image->temporaryUrl() }}" class="img-fluid rounded"
                                    style="max-height: 200px; border-radius: 12px;">
                            </div>
                        @endif
                        @error('image') <span class="text-danger small mt-1 d-block">{{ $message }}</span> @enderror
                    </div>

                    <div class="admin-form-group">
                        <label class="admin-label">Platforms & Customization</label>

                        <!-- WhatsApp -->
                        <div class="border rounded p-3 mb-3 bg-light">
                            <div class="custom-control custom-checkbox">
                                <input wire:model.live="platforms.whatsapp" type="checkbox" class="custom-control-input"
                                    id="whatsappCheck">
                                <label class="custom-control-label font-weight-bold" for="whatsappCheck">
                                    <i class="fab fa-whatsapp text-success mr-1"></i> WhatsApp
                                </label>
                            </div>
                            @if(isset($platforms['whatsapp']) && $platforms['whatsapp'])
                                <div class="mt-3">
                                    <x-admin.ui.textarea name="whatsapp_content" rows="2"
                                        placeholder="Customize for WhatsApp (Optional)..." />
                                </div>
                            @endif
                        </div>

                        <!-- Facebook -->
                        <div class="border rounded p-3 mb-3 bg-light">
                            <div class="custom-control custom-checkbox">
                                <input wire:model.live="platforms.facebook" type="checkbox" class="custom-control-input"
                                    id="facebookCheck">
                                <label class="custom-control-label font-weight-bold" for="facebookCheck">
                                    <i class="fab fa-facebook text-primary mr-1"></i> Facebook
                                </label>
                            </div>
                            @if(isset($platforms['facebook']) && $platforms['facebook'])
                                <div class="mt-3">
                                    <x-admin.ui.textarea name="facebook_content" rows="2"
                                        placeholder="Customize for Facebook (Optional)..." />
                                </div>
                            @endif
                        </div>

                        <!-- Instagram -->
                        <div class="border rounded p-3 mb-3 bg-light">
                            <div class="custom-control custom-checkbox">
                                <input wire:model.live="platforms.instagram" type="checkbox"
                                    class="custom-control-input" id="instagramCheck">
                                <label class="custom-control-label font-weight-bold" for="instagramCheck">
                                    <i class="fab fa-instagram text-danger mr-1"></i> Instagram
                                </label>
                            </div>
                            @if(isset($platforms['instagram']) && $platforms['instagram'])
                                <div class="mt-3">
                                    <x-admin.ui.textarea name="instagram_content" rows="2"
                                        placeholder="Customize for Instagram (Optional)..." />
                                </div>
                            @endif
                        </div>

                        @error('platforms') <span class="d-block text-danger small mt-1">{{ $message }}</span> @enderror
                    </div>

                    <x-admin.ui.button type="submit" class="w-100" icon="fas fa-paper-plane" label="Create Post" />
                </form>
            </x-admin.ui.card>
        </div>

        <!-- History Section -->
        <div class="col-md-7">
            <x-admin.ui.card title="Recent Posts">
                <div class="list-group list-group-flush">
                    @forelse($posts as $post)
                        <div class="list-group-item border-bottom py-3">
                            <div class="d-flex w-100 justify-content-between align-items-center mb-2">
                                <h6 class="mb-0 font-weight-bold text-truncate"
                                    style="max-width: 70%; color: var(--admin-primary);">
                                    {{ Str::limit($post->content, 50) }}
                                </h6>
                                <small class="text-muted">{{ $post->created_at->diffForHumans() }}</small>
                            </div>
                            <p class="mb-3 text-muted small">{{ Str::limit($post->content, 100) }}</p>

                            @if($post->image_path)
                                <img src="{{ asset('storage/' . $post->image_path) }}" class="rounded mb-3 shadow-sm"
                                    style="height: 80px; width: auto;">
                            @endif

                            <div class="d-flex align-items-center justify-content-between">
                                <div>
                                    @foreach($post->platforms ?? [] as $platform)
                                        <span class="badge badge-light border mr-1">{{ ucfirst($platform) }}</span>
                                    @endforeach
                                </div>

                                <div class="d-flex align-items-center">
                                    @if(in_array('whatsapp', $post->platforms ?? []))
                                        <a href="{{ $this->getWhatsappUrl($post->id) }}" target="_blank"
                                            class="admin-btn admin-btn-sm admin-btn-secondary mr-2"
                                            style="text-decoration: none;">
                                            <i class="fab fa-whatsapp text-success"></i> Share
                                        </a>
                                    @endif

                                    <button wire:click="delete({{ $post->id }})"
                                        class="admin-btn admin-btn-sm admin-btn-danger">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-5">
                            <div class="mb-3">
                                <i class="fas fa-inbox fa-3x text-muted opacity-50"></i>
                            </div>
                            <p class="text-muted">No posts yet.</p>
                        </div>
                    @endforelse
                </div>
            </x-admin.ui.card>
        </div>
    </div>
</div>