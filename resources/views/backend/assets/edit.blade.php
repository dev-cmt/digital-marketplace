<x-backend-layout title="Edit Asset">
    <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
        <h1 class="page-title fw-semibold fs-18 mb-0">Edit Asset: {{ $asset->title }}</h1>
        <div class="ms-md-1 ms-0">
            <nav>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('assets.index') }}">Assets</a></li>
                    <li class="breadcrumb-item active">Edit Asset</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-12">
            <div class="card custom-card">
                <div class="card-body">
                    <form action="{{ route('assets.update', $asset->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row g-4">
                            <div class="col-md-8">
                                <div class="row g-3">
                                    <div class="col-md-12">
                                        <label class="form-label">Asset Title</label>
                                        <input type="text" name="title" class="form-control" value="{{ $asset->title }}" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Category</label>
                                        <select name="category_id" class="form-select" required>
                                            @foreach($categories as $cat)
                                            <option value="{{ $cat->id }}" {{ $asset->category_id == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                     <div class="col-md-6" id="type_detect_wrapper">
                                          <label class="form-label">Asset Type</label>
                                          <div id="type_badge" class="form-control bg-light">
                                              <span class="badge bg-primary-transparent text-primary">
                                                  <i class="fa-solid fa-tag me-1"></i> {{ ucfirst($asset->type) }}
                                              </span>
                                              <small class="text-muted ms-2">(Auto-detected from file)</small>
                                          </div>
                                          <input type="hidden" name="type" id="detected_type" value="{{ $asset->type }}">
                                      </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Resolution / Details</label>
                                        <input type="text" name="resolution" class="form-control" value="{{ $asset->resolution }}" placeholder="e.g. 4K UHD, 300 DPI">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">License Type</label>
                                        <input type="text" name="license" class="form-control" value="{{ $asset->license }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Price ($)</label>
                                        <input type="number" step="0.01" name="price" id="price_input" class="form-control" value="{{ $asset->price }}" {{ $asset->is_free ? 'disabled' : '' }}>
                                    </div>
                                    <div class="col-md-6 d-flex align-items-end">
                                        <div class="form-check form-switch mb-2">
                                            <input class="form-check-input" type="checkbox" name="is_free" id="is_free_switch" {{ $asset->is_free ? 'checked' : '' }}>
                                            <label class="form-check-label" for="is_free_switch">Mark as Free</label>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <label class="form-label">Description</label>
                                        <textarea name="description" class="form-control" rows="5">{{ $asset->description }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="row g-3">
                                    <div class="col-md-12">
                                        <label class="form-label">Thumbnail Image</label>
                                        <input type="file" name="thumbnail" class="form-control">
                                        <div class="mt-2">
                                            <img src="{{ asset($asset->thumbnail) }}" class="rounded img-thumbnail" width="150">
                                        </div>
                                    </div>
                                     <div class="col-md-12">
                                          <label class="form-label">Preview File (Image/Video)</label>
                                          <input type="file" name="preview_url" id="preview_input" class="form-control" accept="image/*,video/*">
                                          <div id="live_preview_container" class="mt-2 text-center" style="display:none; border: 1px solid var(--border-color); border-radius: 8px; padding: 10px; background: rgba(255,255,255,0.02);"></div>
                                         @if($asset->preview_url)
                                         <div class="mt-2 text-center bg-dark rounded p-2 border">
                                             @if($asset->type == 'video')
                                                 <video width="100%" height="auto" controls class="rounded shadow-sm">
                                                     <source src="{{ asset($asset->preview_url) }}" type="video/mp4">
                                                     Your browser does not support the video tag.
                                                 </video>
                                             @else
                                                 <img src="{{ asset($asset->preview_url) }}" class="rounded img-fluid shadow-sm" style="max-height: 200px;">
                                             @endif
                                         </div>
                                         @endif
                                     </div>
                                     <div class="col-md-12">
                                         <label class="form-label text-primary fw-bold">Main Asset File (Source)</label>
                                         <input type="file" name="file_path" class="form-control border-dashed" style="border: 2px dashed #6c63ff;">
                                         @if($asset->file_path)
                                         <div class="mt-2">
                                             <span class="badge bg-success-transparent text-success border border-success">
                                                 <i class="fa-solid fa-file-shield me-1"></i> Source file exists
                                             </span>
                                             <small class="text-muted d-block mt-1">Uploaded: {{ basename($asset->file_path) }}</small>
                                         </div>
                                         @endif
                                     </div>
                                    <div class="col-md-12 mt-4">
                                        <div class="form-check form-switch mb-3">
                                            <input class="form-check-input" type="checkbox" name="is_active" id="active_switch" {{ $asset->is_active ? 'checked' : '' }}>
                                            <label class="form-check-label" for="active_switch">Active (Visible on Frontend)</label>
                                        </div>
                                        <div class="form-check form-switch mb-3">
                                            <input class="form-check-input" type="checkbox" name="is_trending" id="trend_switch" {{ $asset->is_trending ? 'checked' : '' }}>
                                            <label class="form-check-label" for="trend_switch">Mark as Trending</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 border-top pt-4">
                                <button type="submit" class="btn btn-primary px-5">Update Asset</button>
                                <a href="{{ route('assets.index') }}" class="btn btn-light ms-2">Cancel</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('js')
    <script>
        document.getElementById('is_free_switch').addEventListener('change', function() {
            const priceInput = document.getElementById('price_input');
            if (this.checked) {
                priceInput.value = '0';
                priceInput.disabled = true;
            } else {
                priceInput.disabled = false;
            }
        });

        // Live Type Detection & Preview
        document.getElementById('preview_input').addEventListener('change', function(e) {
            const file = e.target.files[0];
            const container = document.getElementById('live_preview_container');
            const typeBadge = document.getElementById('type_badge');
            const typeInput = document.getElementById('detected_type');
            
            if (file) {
                const extension = file.name.split('.').pop().toLowerCase();
                let type = 'photo';
                let icon = 'fa-image';
                let color = '#2e9aff';

                if (['mp4', 'mov', 'avi', 'mpeg'].includes(extension)) {
                    type = 'video';
                    icon = 'fa-video';
                    color = '#6c63ff';
                } else if (['mp3', 'wav', 'ogg'].includes(extension)) {
                    type = 'audio';
                    icon = 'fa-music';
                    color = '#2ed573';
                } else if (['zip', 'rar', 'psd', 'ai', 'eps'].includes(extension)) {
                    type = 'template';
                    icon = 'fa-box-open';
                    color = '#ffa502';
                }

                // Update UI
                typeInput.value = type;
                typeBadge.innerHTML = `<span style="color:${color}; font-weight:700;"><i class="fa-solid ${icon} me-2"></i> Detected: ${type.toUpperCase()}</span>`;
                typeBadge.className = 'form-control bg-light d-flex align-items-center justify-content-between';
                typeBadge.style.borderStyle = 'solid';
                typeBadge.style.borderColor = color;

                // Live Preview
                container.style.display = 'block';
                const reader = new FileReader();
                reader.onload = function(e) {
                    if (file.type.startsWith('video/')) {
                        container.innerHTML = `<video src="${e.target.result}" style="max-width:100%; max-height:200px; border-radius:4px;" controls></video>`;
                    } else if (file.type.startsWith('image/')) {
                        container.innerHTML = `<img src="${e.target.result}" style="max-width:100%; max-height:200px; border-radius:4px;">`;
                    } else {
                        container.innerHTML = `<div class="p-3 text-muted"><i class="fa-solid ${icon} fa-3x mb-2"></i><br>${file.name}</div>`;
                    }
                }
                reader.readAsDataURL(file);
            }
        });
    </script>
    @endpush
</x-backend-layout>
