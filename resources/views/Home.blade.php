<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sosial - Connect with Friends</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Font Awesome for icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    <style>
        .hero-gradient {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .card-hover:hover {
            transform: translateY(-5px);
            transition: transform 0.3s ease;
        }

        .post-card {
            border-radius: 15px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
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
        <div class="row gy-4">
            <!-- Left Sidebar -->
            <div class="col-lg-3 col-md-4 mb-4">
                <div class="card post-card card-hover">
                    <div class="card-body">
                        @php
                            $user = Auth::user();
                        @endphp

                        @if ($user)
                            <div class="d-flex align-items-center mb-3">
                                <img src="{{ asset('storage/' . Auth::user()->profile_pic) }}" class="rounded-circle me-3"
                                    alt="Profile" style="width: 50px; height: 50px; object-fit: cover;">
                                <div>
                                    <h6 class="mb-0">{{ $user->name }}</h6>
                                    <small class="text-muted">{{ $user->email }}</small>
                                </div>
                            </div>
                        @else
                            <div class="alert alert-danger">
                                You are not logged in.
                            </div>
                        @endif

                        <hr>
                        <div class="d-grid gap-2">
                            <a href="{{ route('UpdateProfile', ['id' => Auth::user()->id]) }}"
                                class="btn btn-outline-primary btn-sm">
                                <i class="fas fa-edit me-1"></i>Edit Profile
                            </a>
                            </a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="btn btn-outline-danger btn-sm w-100 text-center">
                                    <i class="fas fa-sign-out-alt me-1"></i>Log Out
                                </button>
                            </form>

                        </div>
                    </div>
                </div>

                <!-- Quick Stats -->
                <div class="card post-card card-hover mt-3">
                    <div class="card-body">
                        <h6 class="card-title">Quick Stats</h6>
                        <div class="d-flex justify-content-around text-center mt-3">
                            <div>
                                <i class="fas fa-users fa-2x text-primary"></i>
                                <div class="fw-bold mt-1">{{ $user->followers()->count() }}</div>
                                <small class="text-muted">Followers</small>
                            </div>
                            <div>
                                <i class="fas fa-heart fa-2x text-success"></i>
                                <div class="fw-bold mt-1">{{ $user->likes()->count() }}</div>
                                <small class="text-muted">Likes</small>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <!-- Main Feed -->
            <div class="col-lg-6 col-md-8">
                <!-- Posts Feed -->
                @foreach ($posts as $post)
                    <div class="card post-card mb-4">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-3">
                                <img src="{{ asset('storage/' . $post->user->profile_pic) }}" class="rounded-circle me-3"
                                    alt="User avatar" style="width: 45px; height: 45px; object-fit: cover;">
                                <div class="flex-grow-1">
                                    <h6 class="mb-0">{{ $post->user->name }}</h6>
                                    <small class="text-muted">{{ $post->created_at->diffForHumans() }}</small>
                                </div>
                            </div>
                            <p class="mb-3">{{ $post->caption }}</p>
                            @if ($post->image)
                                <img src="{{ asset('storage/' . $post->image) }}" class="img-fluid rounded mb-3"
                                    alt="Post image">
                            @endif
                            <div class="d-flex align-items-center">
                                @php
                                    $liked = $post->likes->contains('user_id', auth()->id());
                                @endphp

                                <form
                                    action="{{ $liked ? route('posts.unlike', $post->id) : route('posts.like', $post->id) }}"
                                    method="POST" class="me-2">
                                    @csrf
                                    @if ($liked)
                                        @method('DELETE')
                                    @endif
                                    <button type="submit"
                                        class="btn btn-sm {{ $liked ? 'btn-primary' : 'btn-outline-primary' }}">
                                        <i class="fas fa-thumbs-up me-1"></i>
                                        {{ $post->likes->count() }} Like{{ $post->likes->count() !== 1 ? 's' : '' }}
                                    </button>
                                </form>

                                {{-- <button class="btn btn-outline-secondary btn-sm me-2">
                                    <i class="fas fa-comment me-1"></i>Comment
                                </button> --}}
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>

            <!-- Right Sidebar -->
            <div class="col-lg-3 d-none d-lg-block">
                <!-- Online Friends -->
                <div class="card post-card card-hover mb-4">
                    <div class="card-body">
                        <h6 class="card-title">Following</h6>

                        @forelse ($user->following as $followedUser)
                            <div class="d-flex align-items-center py-2 border-bottom">
                                <div class="position-relative">
                                    <img src="{{ asset('storage/' . $followedUser->profile_pic) }}"
                                        class="rounded-circle me-3" alt="{{ $followedUser->name }}"
                                        style="width: 40px; height: 40px; object-fit: cover;">
                                    <span
                                        class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-success"
                                        style="font-size: 0.5rem;">
                                        <span class="visually-hidden">online</span>
                                    </span>
                                </div>
                                <small>{{ $followedUser->name }}</small>
                            </div>
                        @empty
                            <p class="text-muted">Not following anyone yet.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Create Post Modal -->
    <div class="modal fade" id="postModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Create Post</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="d-flex align-items-center mb-3">
                        <img src="https://via.placeholder.com/40" class="rounded-circle me-3" alt="Your avatar">
                        <div>
                            <h6 class="mb-0">John Doe</h6>
                            <small class="text-muted">Public post</small>
                        </div>
                    </div>
                    <textarea class="form-control" rows="gy-4" placeholder="What's on your mind?"></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary">Post</button>
                </div>
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

    <!-- PHP Integration Points (Comments for development) -->
    <!--
    PHP Integration Notes:
    1. Replace static user data with PHP session variables
    2. Add PHP loops for dynamic post loading from database
    3. Include PHP form handling for post creation
    4. Add PHP authentication checks
    5. Implement PHP-based friend system
    6. Add PHP database connections for real-time data
    
    Example PHP structure:
    <?php
session_start();
// Database connection
// User authentication
// Post queries
// Friend queries
    ?>
    -->
</body>

</html>