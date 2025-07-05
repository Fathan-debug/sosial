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
                    <h2 class="mb-0 text-primary fw-bold">
                        <i class="fas fa-share-alt me-2"></i>sosial
                    </h2>
                </div>
                <div class="col-md-9">
                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ url('/Home') }}"
                            class="btn {{ request()->is('Home') ? 'btn-primary' : 'btn-outline-primary' }}">
                            <i class="fas fa-home me-1"></i>Home
                        </a>
                        <a href="{{ url('/friends') }}"
                            class="btn {{ request()->is('friends') ? 'btn-primary' : 'btn-outline-primary' }}">
                            <i class="fas fa-users me-1"></i>Friends
                        </a>
                        <a href="{{ url('/notification') }}"
                            class="btn {{ request()->is('notification') ? 'btn-primary' : 'btn-outline-primary' }}">
                            <i class="fas fa-bell me-1"></i>Notifications
                        </a>
                        <a href="{{ url('/profile') }}"
                            class="btn {{ request()->is('profile') ? 'btn-primary' : 'btn-outline-primary' }}">
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
            <!-- Left Sidebar -->
            <div class="col-lg-3 col-md-4 mb-4">
                <div class="card post-card card-hover">
                    <div class="card-body">
                        @php
                            $user = Auth::user();
                        @endphp

                        @if ($user)
                            <div class="d-flex align-items-center mb-3">
                                <img src="{{ $user->profile_picture ?? asset('images/default-avatar.png') }}"
                                    class="rounded-circle me-3" alt="Profile"
                                    style="width: 50px; height: 50px; object-fit: cover;">
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
                            <a href="{{ route('UpdateProfile') }}" class="btn btn-outline-primary btn-sm">
                                <i class="fas fa-edit me-1"></i>Edit Profile
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
                        <div class="row text-center">
                            <div class="col-4">
                                <div class="text-primary">
                                    <i class="fas fa-users fa-2x"></i>
                                    <p class="mb-0 mt-1"><strong>156</strong></p>
                                    <small class="text-muted">Followers</small>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="text-success">
                                    <i class="fas fa-heart fa-2x"></i>
                                    <p class="mb-0 mt-1"><strong>1.2K</strong></p>
                                    <small class="text-muted">Likes</small>
                                </div>
                            </div>
                            {{-- <div class="col-4">
                                <div class="text-warning">
                                    <i class="fas fa-share fa-2x"></i>
                                    <p class="mb-0 mt-1"><strong>89</strong></p>
                                    <small class="text-muted">Shares</small>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Feed -->
            <div class="col-lg-6 col-md-8">
                <!-- Create Post -->
                {{-- <div class="card post-card mb-4">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                            <img src="https://via.placeholder.com/40" class="rounded-circle me-3" alt="Your avatar">
                            <input type="text" class="form-control rounded-pill"
                                placeholder="What's on your mind, John?" data-bs-toggle="modal"
                                data-bs-target="#postModal">
                        </div>
                        <hr>
                        <div class="d-flex justify-content-around">
                            <button class="btn btn-outline-primary btn-sm">
                                <i class="fas fa-photo-video me-1"></i>Photo/Video
                            </button>
                            <button class="btn btn-outline-success btn-sm">
                                <i class="fas fa-smile me-1"></i>Feeling
                            </button>
                            <button class="btn btn-outline-warning btn-sm">
                                <i class="fas fa-map-marker-alt me-1"></i>Location
                            </button>
                        </div>
                    </div>
                </div> --}}

                <!-- Posts Feed -->
                <div class="card post-card mb-4">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                            <img src="https://via.placeholder.com/45" class="rounded-circle me-3" alt="User avatar">
                            <div class="flex-grow-1">
                                <h6 class="mb-0">Sarah Johnson</h6>
                                <small class="text-muted">2 hours ago</small>
                            </div>
                            <div class="dropdown">
                                <button class="btn btn-sm" type="button" data-bs-toggle="dropdown">
                                    <i class="fas fa-ellipsis-h"></i>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#">Save Post</a></li>
                                    <li><a class="dropdown-item" href="#">Hide Post</a></li>
                                    <li><a class="dropdown-item" href="#">Report</a></li>
                                </ul>
                            </div>
                        </div>
                        <p class="mb-3">Just finished an amazing hike in the mountains! The view was absolutely
                            breathtaking. Nature never fails to amaze me 🏔️ #hiking #nature #adventure</p>
                        <img src="https://via.placeholder.com/500x300" class="img-fluid rounded mb-3" alt="Post image">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <button class="btn btn-outline-primary btn-sm me-2">
                                    <i class="fas fa-thumbs-up me-1"></i>Like (24)
                                </button>
                                <button class="btn btn-outline-secondary btn-sm me-2">
                                    <i class="fas fa-comment me-1"></i>Comment (8)
                                </button>
                                <button class="btn btn-outline-success btn-sm">
                                    <i class="fas fa-share me-1"></i>Share
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card post-card mb-4">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                            <img src="https://via.placeholder.com/45" class="rounded-circle me-3" alt="User avatar">
                            <div class="flex-grow-1">
                                <h6 class="mb-0">Mike Chen</h6>
                                <small class="text-muted">5 hours ago</small>
                            </div>
                        </div>
                        <p class="mb-3">Excited to announce that I've started a new job at Tech Solutions! Looking
                            forward to new challenges and opportunities. Thanks everyone for the support! 🚀 #newjob
                            #career #excited</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <button class="btn btn-outline-primary btn-sm me-2">
                                    <i class="fas fa-thumbs-up me-1"></i>Like (42)
                                </button>
                                <button class="btn btn-outline-secondary btn-sm me-2">
                                    <i class="fas fa-comment me-1"></i>Comment (15)
                                </button>
                                <button class="btn btn-outline-success btn-sm">
                                    <i class="fas fa-share me-1"></i>Share
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Sidebar -->
            <div class="col-lg-3 d-none d-lg-block">
                <!-- Online Friends -->
                <div class="card post-card card-hover mb-4">
                    <div class="card-body">
                        <h6 class="card-title">Following</h6>
                        <div class="d-flex align-items-center mb-2">
                            <div class="position-relative">
                                <img src="https://via.placeholder.com/35" class="rounded-circle me-3" alt="Friend">
                                <span
                                    class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-success"
                                    style="font-size: 0.5rem;">
                                    <span class="visually-hidden">online</span>
                                </span>
                            </div>
                            <small>Emma Wilson</small>
                        </div>
                        <div class="d-flex align-items-center mb-2">
                            <div class="position-relative">
                                <img src="https://via.placeholder.com/35" class="rounded-circle me-3" alt="Friend">
                                <span
                                    class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-success"
                                    style="font-size: 0.5rem;">
                                    <span class="visually-hidden">online</span>
                                </span>
                            </div>
                            <small>Alex Rodriguez</small>
                        </div>
                        <div class="d-flex align-items-center mb-2">
                            <div class="position-relative">
                                <img src="https://via.placeholder.com/35" class="rounded-circle me-3" alt="Friend">
                                <span
                                    class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-success"
                                    style="font-size: 0.5rem;">
                                    <span class="visually-hidden">online</span>
                                </span>
                            </div>
                            <small>Lisa Parker</small>
                        </div>
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
                    <textarea class="form-control" rows="4" placeholder="What's on your mind?"></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary">Post</button>
                </div>
            </div>
        </div>
    </div>

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