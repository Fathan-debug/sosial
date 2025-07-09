<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Profile - Sosial</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <!-- Bootstrap CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Font Awesome for icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    <style>
        .profile-card {
            border-radius: 15px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .profile-avatar {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            border: 4px solid #e9ecef;
            object-fit: cover;
        }

        .upload-area {
            border: 2px dashed #dee2e6;
            border-radius: 10px;
            padding: 20px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .upload-area:hover {
            border-color: #6c757d;
            background-color: #f8f9fa;
        }

        .upload-area.dragover {
            border-color: #0d6efd;
            background-color: #e7f3ff;
        }

        .form-floating>.form-control {
            border-radius: 10px;
        }

        .btn-custom {
            border-radius: 25px;
            padding: 10px 30px;
        }

        .section-title {
            color: #495057;
            font-weight: 600;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid #e9ecef;
        }

        .privacy-option {
            padding: 15px;
            border: 1px solid #dee2e6;
            border-radius: 10px;
            margin-bottom: 10px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .privacy-option:hover {
            background-color: #f8f9fa;
        }

        .privacy-option.selected {
            border-color: #4f46e5;
            background-color: #e7f3ff;
        }
    </style>
</head>

<body class="bg-gray-50">
    <!-- Simple Header with Logo and Navigation Buttons -->
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

    <!-- Main Content -->
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <!-- Page Header -->
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h3 class="mb-0">Update Profile</h3>
                </div>

                <!-- Profile Update Form -->
                <form action="{{ route('test.update') }}" method="POST" enctype="multipart/form-data"
                    id="profileUpdateForm">
                    @method('POST')
                    <!-- Profile Picture Section -->
                    @csrf
                    <div class="profile-card bg-white p-4 mb-4">
                        <h5 class="section-title">Profile Picture</h5>
                        <div class="row align-items-center">
                            <div class="col-md-3 d-flex flex-column align-items-center">
                                <img src="{{ asset('storage/' . Auth::user()->profile_pic) }}" alt="Profile Picture"
                                    class="profile-avatar mb-2" id="profilePreview"
                                    style="width: 120px; height: 120px; object-fit: cover; border-radius: 50%; border-color: #7a7b7d;">
                                <small class="text-muted">Current Photo</small>
                            </div>
                            <div class="col-md-9">
                                <div class="upload-area" id="uploadArea">
                                    <i class="fas fa-cloud-upload-alt fa-2x text-muted mb-2"></i>
                                    <p class="mb-2">Drag & drop your photo here or click to browse</p>
                                    <small class="text-muted">Supported formats: JPG, PNG, GIF (Max: 5MB)</small>
                                    <input type="file" class="d-none" id="profilePicture" name="profile_pic"
                                        accept="image/*">
                                </div>

                            </div>
                        </div>
                    </div>

                    <!-- Basic Information -->
                    <!-- filepath: resources/views/auth/UpdateProfile.blade.php -->
                    <div class="profile-card bg-white p-4 mb-4">
                        <h5 class="section-title">Basic Information</h5>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="Name" name="name" placeholder="Name"
                                        value="{{ old('name', Auth::user()->name ?? '') }}">
                                    <label for="Name">Name</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="form-floating">
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Email"
                                        value="{{ old('email', Auth::user()->email ?? '') }}">
                                    <label for="email">Email Address</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="form-floating">
                                    <input type="tel" class="form-control" id="phone" name="phone" placeholder="phone"
                                        value="{{ old('phone', Auth::user()->phone ?? '') }}">
                                    <label for="phone">Phone Number</label>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-floating">
                                    <input type="date" class="form-control" id="birthDate" name="birthDate"
                                        value="{{ old('birthDate', Auth::user()->birthDate ? \Carbon\Carbon::parse(Auth::user()->birthDate)->format('Y-m-d') : '') }}">
                                    <label for="birthDate">Birth Date</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Bio and Location -->
                    <div class="profile-card bg-white p-4 mb-4">
                        <h5 class="section-title">About Me</h5>
                        <div class="row">
                            <div class="col-12 mb-3">
                                <div class="form-floating">
                                    <textarea class="form-control" id="bio" name="bio" placeholder="Bio"
                                        style="height: 100px">{{ old('bio', Auth::user()->bio ?? '') }}</textarea>
                                    <label for="bio">Bio</label>
                                </div>
                                <div class="form-text">
                                    <span id="bioCount">{{ strlen(old('bio', Auth::user()->bio ?? '')) }}</span>/500
                                    characters
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="form-floating">
                                    <input type="text" class="form-control" name="location" id="location"
                                        placeholder="Location"
                                        value="{{ old('location', Auth::user()->location ?? '') }}">
                                    <label for="location">Location</label>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-floating">
                                    <input type="text" class="form-control" name="website" id="website"
                                        placeholder="Website" value="{{ old('website', Auth::user()->website ?? '') }}">
                                    <label for="website">Website</label>
                                </div>
                            </div>
                        </div>
                    </div>


                    <!-- Action Buttons -->
                    <div class="profile-card bg-white p-4 mb-4">
                        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                            <div>
                                <a href="{{ route('profile', ['id' => Auth::user()->id]) }}"
                                    class="btn btn-danger me-2">
                                    <i class="fas fa-times me-1"></i>Cancel
                                </a>
                            </div>
                            <div>
                                <button type="submit" class="btn btn-success btn-custom">
                                    <i class="fas fa-save me-1"></i>Save Changes
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
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

    <!-- Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>


    <script>
        // File upload handling
        const uploadArea = document.getElementById('uploadArea');
        const profilePicture = document.getElementById('profilePicture');
        const profilePreview = document.getElementById('profilePreview');

        uploadArea.addEventListener('click', () => {
            profilePicture.click();
        });

        uploadArea.addEventListener('dragover', (e) => {
            e.preventDefault();
            uploadArea.classList.add('dragover');
        });

        uploadArea.addEventListener('dragleave', () => {
            uploadArea.classList.remove('dragover');
        });

        uploadArea.addEventListener('drop', (e) => {
            e.preventDefault();
            uploadArea.classList.remove('dragover');
            const files = e.dataTransfer.files;
            if (files.length > 0) {
                handleFileUpload(files[0]);
            }
        });

        profilePicture.addEventListener('change', (e) => {
            if (e.target.files.length > 0) {
                handleFileUpload(e.target.files[0]);
            }
        });

        function handleFileUpload(file) {
            if (file.type.startsWith('image/')) {
                const reader = new FileReader();
                reader.onload = (e) => {
                    profilePreview.src = e.target.result;
                };
                reader.readAsDataURL(file);
            } else {
                alert('Please select a valid image file.');
            }
        }

        // Bio character count
        const bioTextarea = document.getElementById('bio');
        const bioCount = document.getElementById('bioCount');

        bioTextarea.addEventListener('input', () => {
            const count = bioTextarea.value.length;
            bioCount.textContent = count;
            if (count > 500) {
                bioCount.classList.add('text-danger');
            } else {
                bioCount.classList.remove('text-danger');
            }
        });

        // Privacy settings
        document.querySelectorAll('.privacy-option').forEach(option => {
            option.addEventListener('click', () => {
                document.querySelectorAll('.privacy-option').forEach(opt => {
                    opt.classList.remove('selected');
                });
                option.classList.add('selected');
            });
        });

        // Form submission
        // document.getElementById('profileUpdateForm').addEventListener('submit', async (e) => {
        //     e.preventDefault();

        //     try {
        //         const formData = new FormData(e.target);
        //         const response = await fetch('/profile', {
        //             method: 'PATCH',
        //             body: formData,
        //             headers: {
        //                 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        //             }
        //         });

        //         if (!response.ok) {
        //             throw new Error('Network response was not ok');
        //         }

        //         const result = await response.json();
        //         if (result.success) {
        //             alert('Profile updated successfully!');
        //         } else {
        //             alert('Error updating profile: ' + result.message);
        //         }
        //     } catch (error) {
        //         console.error('Error:', error);
        //         alert('An error occurred while updating the profile.');
        //     }

        //     // Show success message
        //     const successAlert = document.createElement('div');
        //     successAlert.className = 'alert alert-success alert-dismissible fade show';
        //     successAlert.innerHTML = `
        //         <i class="fas fa-check-circle me-2"></i>Profile updated successfully!
        //         <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        //     `;

        //     document.querySelector('.container').insertBefore(successAlert, document.querySelector('.container').firstChild);

        //     // Scroll to top
        //     window.scrollTo({ top: 0, behavior: 'smooth' });
        // });

        // // Preview button
        // document.querySelector('.btn-outline-primary').addEventListener('click', (e) => {
        //     e.preventDefault();
        //     alert('Preview functionality would show a modal with profile preview');
        // });
    </script>

    <!-- PHP Integration Points (Comments for development) -->
    <!--
    PHP Integration Notes:
    1. Add PHP form processing for profile updates
    2. Include file upload handling for profile pictures
    3. Add PHP validation for form fields
    4. Implement PHP database updates for user profile
    5. Add PHP session management and authentication
    6. Include PHP image processing (resize, crop, etc.)
    
    Example PHP structure:
   
    -->
</body>

</html>