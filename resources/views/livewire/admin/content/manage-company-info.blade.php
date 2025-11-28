<div>
    @section('title', 'General Settings')

    <div class="row">
        <div class="col-md-12">
            <x-admin.ui.card>
                <x-slot name="header">
                    <h5 class="mb-0 font-weight-bold text-primary">Company Information</h5>
                </x-slot>

                <form wire:submit.prevent="save">
                    <!-- Contact Info -->
                    <h6 class="font-weight-bold text-dark mb-3 border-bottom pb-2">Contact Details</h6>
                    <div class="row">
                        <div class="col-md-6">
                            <x-admin.ui.input label="Company Name" name="name" />
                        </div>
                        <div class="col-md-6">
                            <x-admin.ui.input label="Email Address" name="email" type="email" />
                        </div>
                        <div class="col-md-6">
                            <x-admin.ui.input label="Phone Number" name="phone" />
                        </div>
                        <div class="col-md-6">
                            <x-admin.ui.input label="Address" name="address" />
                        </div>
                        <div class="col-md-6">
                            <x-admin.ui.input label="Working Hours" name="working_hours"
                                placeholder="e.g. Mon-Fri: 9am - 6pm" />
                        </div>
                        <div class="col-md-6">
                            <x-admin.ui.input label="Founded Year" name="founded_year" />
                        </div>
                    </div>

                    <div class="my-4"></div>

                    <!-- Social Media -->
                    <h6 class="font-weight-bold text-dark mb-3 border-bottom pb-2">Social Media Links</h6>
                    <div class="row">
                        <div class="col-md-6">
                            <x-admin.ui.input label="Facebook" name="facebook" />
                        </div>
                        <div class="col-md-6">
                            <x-admin.ui.input label="Instagram" name="instagram" />
                        </div>
                        <div class="col-md-6">
                            <x-admin.ui.input label="Twitter" name="twitter" />
                        </div>
                        <div class="col-md-6">
                            <x-admin.ui.input label="LinkedIn" name="linkedin" />
                        </div>
                    </div>

                    <div class="my-4"></div>

                    <!-- About Section -->
                    <h6 class="font-weight-bold text-dark mb-3 border-bottom pb-2">About Section Content</h6>
                    <div class="row">
                        <div class="col-md-12">
                            <x-admin.ui.input label="About Title" name="about_title" />
                        </div>
                        <div class="col-md-12">
                            <x-admin.ui.input label="About Subtitle" name="about_subtitle" />
                        </div>
                        <div class="col-md-12">
                            <x-admin.ui.textarea label="About Description" name="about_us" rows="4" />
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-6">
                            <div class="admin-form-group">
                                <label class="admin-label">About Image 1</label>
                                <div class="custom-file mb-2">
                                    <input wire:model="new_about_image" type="file" class="custom-file-input"
                                        id="aboutImage1">
                                    <label class="custom-file-label" for="aboutImage1">Choose file</label>
                                </div>
                                @if ($new_about_image)
                                    <img src="{{ $new_about_image->temporaryUrl() }}" class="img-fluid rounded shadow-sm"
                                        style="max-height: 150px;">
                                @elseif($about_image)
                                    <img src="{{ asset('storage/' . $about_image) }}" class="img-fluid rounded shadow-sm"
                                        style="max-height: 150px;">
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="admin-form-group">
                                <label class="admin-label">About Image 2</label>
                                <div class="custom-file mb-2">
                                    <input wire:model="new_about_image_2" type="file" class="custom-file-input"
                                        id="aboutImage2">
                                    <label class="custom-file-label" for="aboutImage2">Choose file</label>
                                </div>
                                @if ($new_about_image_2)
                                    <img src="{{ $new_about_image_2->temporaryUrl() }}" class="img-fluid rounded shadow-sm"
                                        style="max-height: 150px;">
                                @elseif($about_image_2)
                                    <img src="{{ asset('storage/' . $about_image_2) }}" class="img-fluid rounded shadow-sm"
                                        style="max-height: 150px;">
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="my-4"></div>

                    <!-- Video Section -->
                    <h6 class="font-weight-bold text-dark mb-3 border-bottom pb-2">Why Choose Us / Video Section</h6>
                    <div class="row">
                        <div class="col-md-6">
                            <x-admin.ui.input label="Section Title" name="why_choose_us_title"
                                placeholder="Why Choose us ?" />
                        </div>
                        <div class="col-md-6">
                            <x-admin.ui.input label="Section Subtitle" name="why_choose_us_subtitle"
                                placeholder="Are you Ready to Make a Big Change?" />
                        </div>
                        <div class="col-md-12 mt-3">
                            <x-admin.ui.input label="Video URL (YouTube/Vimeo) - Optional" name="video_url"
                                placeholder="https://www.youtube.com/watch?v=..." />
                            <small class="text-muted">Leave empty if uploading a video file below</small>
                        </div>
                        <div class="col-md-12 mt-3">
                            <div class="admin-form-group">
                                <label class="admin-label">Upload Video File (Max: 50MB)</label>
                                <div class="custom-file mb-2">
                                    <input wire:model="new_video_file" type="file" class="custom-file-input"
                                        id="videoFile"
                                        accept="video/mp4,video/quicktime,video/x-msvideo,video/x-ms-wmv,video/webm">
                                    <label class="custom-file-label" for="videoFile">Choose video file</label>
                                </div>
                                <small class="text-muted d-block mb-2">Supported formats: MP4, MOV, AVI, WMV,
                                    WEBM</small>
                                @if ($new_video_file)
                                    <div class="alert alert-info">
                                        <i class="fas fa-video mr-2"></i>New video selected:
                                        {{ $new_video_file->getClientOriginalName() }}
                                    </div>
                                @elseif($video_file)
                                    <div class="border rounded p-3 bg-light">
                                        <h6 class="mb-2">Current Video Preview:</h6>
                                        <video controls style="max-width: 100%; max-height: 300px;" class="rounded">
                                            <source src="{{ asset('storage/' . $video_file) }}" type="video/mp4">
                                            Your browser does not support the video tag.
                                        </video>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6 mt-3">
                            <div class="admin-form-group">
                                <label class="admin-label">Video Thumbnail/Poster Image (Optional)</label>
                                <div class="custom-file mb-2">
                                    <input wire:model="new_video_image" type="file" class="custom-file-input"
                                        id="videoImage">
                                    <label class="custom-file-label" for="videoImage">Choose file</label>
                                </div>
                                <small class="text-muted d-block mb-2">Image shown before video plays</small>
                                @if ($new_video_image)
                                    <img src="{{ $new_video_image->temporaryUrl() }}" class="img-fluid rounded shadow-sm"
                                        style="max-height: 150px;">
                                @elseif($video_image)
                                    <img src="{{ asset('storage/' . $video_image) }}" class="img-fluid rounded shadow-sm"
                                        style="max-height: 150px;">
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="admin-form-group mt-3">
                        <label class="admin-label">Key Points</label>
                        @foreach($about_points as $index => $point)
                            <div class="input-group mb-2">
                                <input wire:model="about_points.{{ $index }}" type="text"
                                    class="form-control admin-input border-right-0" placeholder="Enter a key point">
                                <div class="input-group-append">
                                    <button wire:click.prevent="removePoint({{ $index }})"
                                        class="btn btn-outline-danger border-left-0" type="button">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                        @endforeach
                        <button wire:click.prevent="addPoint"
                            class="admin-btn admin-btn-sm admin-btn-outline-primary mt-2">
                            <i class="fas fa-plus mr-1"></i> Add Point
                        </button>
                    </div>

                    <div class="mt-4 text-right">
                        <x-admin.ui.button type="submit" label="Save Changes" class="px-5" />
                    </div>
                </form>
            </x-admin.ui.card>
        </div>
    </div>
</div>