<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Post - Sosial</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100">
    <!-- Navigation -->
    <header class="bg-white shadow-sm py-3 mb-4">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-3">
                    <a href="{{ url('/Home') }}">
                        <img src="{{ asset('build/assets/sosial_logo.png') }}" alt="Sosial Logo" style="height: 60px;">
                    </a>
                </div>
                <div class="col-md-9">
                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ url('/Home') }}"
                            class="btn {{ request()->is('Home') ? 'btn-primary' : 'btn-outline-primary' }}">
                            <i class="fas fa-home me-1"></i>Home
                        </a>
                        <a href="{{ url('/connect') }}"
                            class="btn {{ request()->is('connect') ? 'btn-primary' : 'btn-outline-primary' }}">
                            <i class="fas fa-users me-1"></i>Connect
                        </a>
                        {{-- <a href="{{ url('/notification') }}"
                            class="btn {{ request()->is('notification') ? 'btn-primary' : 'btn-outline-primary' }}">
                            <i class="fas fa-bell me-1"></i>Notifications
                        </a> --}}
                        <a href="{{ route('profile', ['id' => Auth::user()->id]) }}"
                            class="btn {{ request()->is('profile*') ? 'btn-primary' : 'btn-outline-primary' }}">
                            <i class="fas fa-user me-1"></i>Profile
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div class="container mx-auto px-4 py-6">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <!-- Page Header -->
                <div class="bg-white rounded-lg shadow mb-6">
                    <div class="p-4 border-b">
                        <h2 class="text-2xl font-bold text-gray-800">Create New Post</h2>
                        <p class="text-gray-600 mt-1">Share what's on your mind with your friends</p>
                    </div>
                </div>

                <!-- Create Post Form -->
                <div class="bg-white rounded-lg shadow">
                    <form method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data">
                        @csrf

                        <!-- User Info -->
                        <div class="p-4 border-b">
                            <div class="flex items-center">
                                <img src="{{ asset('storage/' . Auth::user()->profile_pic) }}"
                                    class="rounded-circle me-3" alt="Profile"
                                    style="width: 50px; height: 50px; object-fit: cover;">
                                <div>
                                    <h3 class="font-semibold text-gray-800">{{ Auth::user()->name ?? 'Your Name' }}</h3>
                                </div>
                            </div>
                        </div>

                        <!-- Post Content -->
                        <div class="p-4">


                            <!-- Media Upload (as you have it) -->
                            <div class="mb-4">
                                <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-blue-400 transition"
                                    id="dropZone">
                                    <div id="uploadArea">
                                        <i class="fas fa-cloud-upload-alt text-4xl text-gray-400 mb-2"></i>
                                        <p class="text-gray-600 mb-2">Drop files here or click to upload</p>
                                        <p class="text-sm text-gray-500">Support: JPG, PNG, GIF, MP4 (Max 10MB)</p>
                                        <input type="file" name="image" id="mediaUpload" class="hidden" multiple
                                            accept="image/*,video/*">
                                        <button type="button" onclick="document.getElementById('mediaUpload').click()"
                                            class="mt-2 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                                            Choose Files
                                        </button>
                                    </div>
                                    <div id="previewArea" class="hidden">
                                        <div id="mediaPreview" class="grid grid-cols-2 md:grid-cols-3 gap-4 mt-4"></div>
                                        <button type="button" onclick="clearMedia()"
                                            class="mt-4 px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition">
                                            Clear All
                                        </button>
                                    </div>
                                </div>
                                @error('media')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <!-- ...existing media upload code... -->

                            <!-- Caption -->
                            <div class="mb-4">
                                <label for="caption"
                                    class="block text-sm font-medium text-gray-700 mb-2">Captions</label>
                                <input type="text" name="caption" id="caption"
                                    placeholder="Add captions (e.g., travel, food, friends)"
                                    class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <p class="text-xs text-gray-500 mt-1">We do it for the gram</p>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="p-4 border-t bg-gray-50 rounded-b-lg">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-4">

                                </div>
                                <div class="flex items-center space-x-3">
                                    <button type="button" onclick="document.getElementById('mediaUpload').click()"
                                        class="px-4 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 transition">
                                        <i class="fas fa-image"></i>
                                        <span class="hidden sm:inline">Photo/Video</span>
                                    </button>
                                    <button type="submit"
                                        class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-green-700 transition font-medium">
                                        Post
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Draft Posts -->
                @if(isset($drafts) && count($drafts) > 0)
                    <div class="bg-white rounded-lg shadow mt-6">
                        <div class="p-4 border-b">
                            <h3 class="font-semibold text-gray-800">Draft Posts</h3>
                        </div>
                        <div class="p-4">
                            @foreach($drafts as $draft)
                                <div class="flex items-center justify-between py-3 border-b last:border-b-0">
                                    <div class="flex-1">
                                        <p class="text-gray-800">{{ Str::limit($draft->content, 100) }}</p>
                                        <p class="text-sm text-gray-500 mt-1">Saved {{ $draft->created_at->diffForHumans() }}
                                        </p>
                                    </div>
                                    <div class="flex items-center space-x-2">
                                        <button onclick="loadDraft({{ $draft->id }})"
                                            class="px-3 py-1 bg-blue-600 text-white rounded text-sm hover:bg-blue-700 transition">
                                            Load
                                        </button>
                                        <button onclick="deleteDraft({{ $draft->id }})"
                                            class="px-3 py-1 bg-red-600 text-white rounded text-sm hover:bg-red-700 transition">
                                            Delete
                                        </button>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);"
        class="py-4 mt-5 shadow-sm text-white">
        <div class="container text-center">
            <!-- Logo centered with Flexbox -->
            <div class="d-flex justify-content-center mb-3">
                <img src="{{ asset('build/assets/sosial_logo.png') }}" alt="Sosial Logo" style="height: 50px;">
            </div>

            <p class="text-white text-decoration-none small">Connecting you with friends, moments & stories.</p>

            <hr class="my-3">

            <p class="text-white text-decoration-none small">&copy; {{ now()->year }} Sosial. All rights reserved.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Media upload functionality
        const mediaUpload = document.getElementById('mediaUpload');
        const uploadArea = document.getElementById('uploadArea');
        const previewArea = document.getElementById('previewArea');
        const mediaPreview = document.getElementById('mediaPreview');
        const dropZone = document.getElementById('dropZone');

        mediaUpload.addEventListener('change', handleFiles);
        dropZone.addEventListener('dragover', handleDragOver);
        dropZone.addEventListener('drop', handleDrop);

        function handleFiles(e) {
            const files = e.target.files;
            displayFiles(files);
        }

        function handleDragOver(e) {
            e.preventDefault();
            dropZone.classList.add('border-blue-400');
        }

        function handleDrop(e) {
            e.preventDefault();
            dropZone.classList.remove('border-blue-400');
            const files = e.dataTransfer.files;
            displayFiles(files);
        }

        function displayFiles(files) {
            if (files.length > 0) {
                uploadArea.classList.add('hidden');
                previewArea.classList.remove('hidden');

                mediaPreview.innerHTML = '';

                Array.from(files).forEach(file => {
                    const reader = new FileReader();
                    reader.onload = function (e) {
                        const div = document.createElement('div');
                        div.className = 'relative group';

                        if (file.type.startsWith('image/')) {
                            div.innerHTML = `
                                <img src="${e.target.result}" class="w-full h-32 object-cover rounded-lg">
                                <button type="button" onclick="removeMedia(this)" class="absolute top-2 right-2 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center opacity-0 group-hover:opacity-100 transition">
                                    <i class="fas fa-times text-xs"></i>
                                </button>
                            `;
                        } else if (file.type.startsWith('video/')) {
                            div.innerHTML = `
                                <video src="${e.target.result}" class="w-full h-32 object-cover rounded-lg" controls></video>
                                <button type="button" onclick="removeMedia(this)" class="absolute top-2 right-2 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center opacity-0 group-hover:opacity-100 transition">
                                    <i class="fas fa-times text-xs"></i>
                                </button>
                            `;
                        }

                        mediaPreview.appendChild(div);
                    };
                    reader.readAsDataURL(file);
                });
            }
        }

        function removeMedia(button) {
            button.parentElement.remove();
            if (mediaPreview.children.length === 0) {
                clearMedia();
            }
        }

        function clearMedia() {
            mediaPreview.innerHTML = '';
            uploadArea.classList.remove('hidden');
            previewArea.classList.add('hidden');
            mediaUpload.value = '';
        }

        function saveDraft() {
            const content = document.getElementById('postContent').value;
            if (content.trim() === '') {
                alert('Please write something before saving as draft');
                return;
            }

            // Here you would typically send an AJAX request to save the draft
            alert('Draft saved successfully!');
        }

        function loadDraft(draftId) {
            // Here you would typically load the draft content via AJAX
            alert('Loading draft...');
        }

        function deleteDraft(draftId) {
            if (confirm('Are you sure you want to delete this draft?')) {
                // Here you would typically send an AJAX request to delete the draft
                alert('Draft deleted successfully!');
            }
        }

        // Character counter
        const postContent = document.getElementById('postContent');
        postContent.addEventListener('input', function () {
            const maxLength = 5000;
            const currentLength = this.value.length;

            if (currentLength > maxLength) {
                this.value = this.value.substring(0, maxLength);
            }
        });
    </script>
</body>

</html>