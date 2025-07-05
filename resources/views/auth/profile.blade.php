<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alex Jordan - Sosial</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Bootstrap Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css"
        rel="stylesheet">
    <style>
        .cover-photo {
            height: 200px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .profile-pic {
            width: 120px;
            height: 120px;
            border: 4px solid white;
            margin-top: -60px;
        }

        .post-hover:hover {
            transform: scale(1.02);
            transition: all 0.3s ease;
        }

        .stats-card:hover {
            background-color: #f8f9fa;
            cursor: pointer;
        }
    </style>
</head>

<body class="bg-gray-100">
    <!-- Navigation -->
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

    <!-- Profile Header -->
    <div class="container mt-4">
        <div class="card shadow-sm">
            <!-- Cover Photo -->
            <div class="cover-photo position-relative">
                <button class="btn btn-light btn-sm position-absolute top-0 end-0 m-3">
                    <i class="bi bi-camera"></i> Edit Cover
                </button>
            </div>

            <!-- Profile Info -->
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3 text-center">
                        <!-- Profile Picture -->
                        <div class="position-relative d-inline-block">
                            <img src="https://picsum.photos/120/120?random=profile" class="rounded-circle profile-pic"
                                alt="Profile Picture">
                            <button class="btn btn-primary btn-sm rounded-circle position-absolute bottom-0 end-0">
                                <i class="bi bi-camera"></i>
                            </button>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <h2 class="fw-bold mb-1">Alex Jordan</h2>
                        <p class="text-muted mb-2">@alexjordan</p>
                        <p class="mb-3">Digital creator & photographer 📸 | Love exploring new places 🌍 | Coffee
                            enthusiast ☕</p>

                        <div class="d-flex flex-wrap gap-3 text-muted small mb-3">
                            <span><i class="bi bi-geo-alt"></i> San Francisco, CA</span>
                            <span><i class="bi bi-calendar"></i> Joined March 2020</span>
                            <span><i class="bi bi-link-45deg"></i> <a href="#"
                                    class="text-decoration-none">alexjordan.com</a></span>
                        </div>

                        <!-- Stats -->
                        <div class="row text-center">
                            <div class="col-4">
                                <div class="stats-card p-2 rounded">
                                    <div class="fw-bold fs-5">1,234</div>
                                    <div class="text-muted small">Posts</div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="stats-card p-2 rounded">
                                    <div class="fw-bold fs-5">45.2K</div>
                                    <div class="text-muted small">Followers</div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="stats-card p-2 rounded">
                                    <div class="fw-bold fs-5">892</div>
                                    <div class="text-muted small">Following</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3 text-end">
                        <button id="followBtn" class="btn btn-primary mb-2 w-100" onclick="toggleFollow()">
                            <i class="bi bi-person-plus"></i> Follow
                        </button>
                        <button class="btn btn-outline-secondary w-100">
                            <i class="bi bi-chat"></i> Message
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Content Tabs -->
    <div class="container mt-4">
        <div class="card shadow-sm">
            <div class="card-header bg-white">
                <ul class="nav nav-tabs card-header-tabs" id="profileTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="posts-tab" data-bs-toggle="tab" data-bs-target="#posts"
                            type="button">
                            <i class="bi bi-grid-3x3"></i> Posts
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="about-tab" data-bs-toggle="tab" data-bs-target="#about"
                            type="button">
                            <i class="bi bi-info-circle"></i> About
                        </button>
                    </li>
                    {{-- <li class="nav-item" role="presentation">
                        <button class="nav-link" id="photos-tab" data-bs-toggle="tab" data-bs-target="#photos"
                            type="button">
                            <i class="bi bi-images"></i> Photos
                        </button>
                    </li> --}}
                </ul>
            </div>

            <div class="card-body">
                <div class="tab-content" id="profileTabsContent">
                    <!-- Posts Tab -->
                    <div class="tab-pane fade show active" id="posts" role="tabpanel">
                        <div class="row g-3">
                            <!-- Post 1 -->
                            <div class="col-md-4">
                                <div class="card post-hover position-relative overflow-hidden">
                                    <img src="https://picsum.photos/300/300?random=1" class="card-img-top" alt="Post">
                                    <div
                                        class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center bg-dark bg-opacity-0 hover-overlay">
                                        <div class="text-white d-none hover-content">
                                            <span class="me-3"><i class="bi bi-heart-fill"></i> 124</span>
                                            <span><i class="bi bi-chat-fill"></i> 18</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Post 2 -->
                            <div class="col-md-4">
                                <div class="card post-hover position-relative overflow-hidden">
                                    <img src="https://picsum.photos/300/300?random=2" class="card-img-top" alt="Post">
                                    <div
                                        class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center bg-dark bg-opacity-0 hover-overlay">
                                        <div class="text-white d-none hover-content">
                                            <span class="me-3"><i class="bi bi-heart-fill"></i> 89</span>
                                            <span><i class="bi bi-chat-fill"></i> 12</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Post 3 -->
                            <div class="col-md-4">
                                <div class="card post-hover position-relative overflow-hidden">
                                    <img src="https://picsum.photos/300/300?random=3" class="card-img-top" alt="Post">
                                    <div
                                        class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center bg-dark bg-opacity-0 hover-overlay">
                                        <div class="text-white d-none hover-content">
                                            <span class="me-3"><i class="bi bi-heart-fill"></i> 156</span>
                                            <span><i class="bi bi-chat-fill"></i> 23</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Post 4 -->
                            <div class="col-md-4">
                                <div class="card post-hover position-relative overflow-hidden">
                                    <img src="https://picsum.photos/300/300?random=4" class="card-img-top" alt="Post">
                                    <div
                                        class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center bg-dark bg-opacity-0 hover-overlay">
                                        <div class="text-white d-none hover-content">
                                            <span class="me-3"><i class="bi bi-heart-fill"></i> 203</span>
                                            <span><i class="bi bi-chat-fill"></i> 34</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Post 5 -->
                            <div class="col-md-4">
                                <div class="card post-hover position-relative overflow-hidden">
                                    <img src="https://picsum.photos/300/300?random=5" class="card-img-top" alt="Post">
                                    <div
                                        class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center bg-dark bg-opacity-0 hover-overlay">
                                        <div class="text-white d-none hover-content">
                                            <span class="me-3"><i class="bi bi-heart-fill"></i> 78</span>
                                            <span><i class="bi bi-chat-fill"></i> 9</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Post 6 -->
                            <div class="col-md-4">
                                <div class="card post-hover position-relative overflow-hidden">
                                    <img src="https://picsum.photos/300/300?random=6" class="card-img-top" alt="Post">
                                    <div
                                        class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center bg-dark bg-opacity-0 hover-overlay">
                                        <div class="text-white d-none hover-content">
                                            <span class="me-3"><i class="bi bi-heart-fill"></i> 167</span>
                                            <span><i class="bi bi-chat-fill"></i> 28</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Load More Button -->
                        <div class="text-center mt-4">
                            <button class="btn btn-outline-primary">Load More Posts</button>
                        </div>
                    </div>

                    <!-- About Tab -->
                    <div class="tab-pane fade" id="about" role="tabpanel">
                        <div class="row">
                            <div class="col-md-6">
                                <h5>Contact Info</h5>
                                <ul class="list-unstyled">
                                    <li class="mb-2"><i class="bi bi-envelope"></i> alex.jordan@email.com</li>
                                    <li class="mb-2"><i class="bi bi-telephone"></i> +1 (555) 123-4567</li>
                                    <li class="mb-2"><i class="bi bi-geo-alt"></i> San Francisco, California</li>
                                    <li class="mb-2"><i class="bi bi-link-45deg"></i> <a href="#"
                                            class="text-decoration-none">alexjordan.com</a></li>
                                </ul>
                            </div>
                            <div class="col-md-6">
                                <h5>Basic Info</h5>
                                <ul class="list-unstyled">
                                    <li class="mb-2"><strong>Born:</strong> January 15, 1992</li>
                                    <li class="mb-2"><strong>Occupation:</strong> Digital Creator</li>
                                    <li class="mb-2"><strong>Interests:</strong> Photography, Travel, Coffee</li>
                                    <li class="mb-2"><strong>Languages:</strong> English, Spanish</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Photos Tab -->
                    <div class="tab-pane fade" id="photos" role="tabpanel">
                        <div class="row g-2">
                            <div class="col-6 col-md-3">
                                <img src="https://picsum.photos/200/200?random=7" class="img-fluid rounded" alt="Photo">
                            </div>
                            <div class="col-6 col-md-3">
                                <img src="https://picsum.photos/200/200?random=8" class="img-fluid rounded" alt="Photo">
                            </div>
                            <div class="col-6 col-md-3">
                                <img src="https://picsum.photos/200/200?random=9" class="img-fluid rounded" alt="Photo">
                            </div>
                            <div class="col-6 col-md-3">
                                <img src="https://picsum.photos/200/200?random=10" class="img-fluid rounded"
                                    alt="Photo">
                            </div>
                            <div class="col-6 col-md-3">
                                <img src="https://picsum.photos/200/200?random=11" class="img-fluid rounded"
                                    alt="Photo">
                            </div>
                            <div class="col-6 col-md-3">
                                <img src="https://picsum.photos/200/200?random=12" class="img-fluid rounded"
                                    alt="Photo">
                            </div>
                            <div class="col-6 col-md-3">
                                <img src="https://picsum.photos/200/200?random=13" class="img-fluid rounded"
                                    alt="Photo">
                            </div>
                            <div class="col-6 col-md-3">
                                <img src="https://picsum.photos/200/200?random=14" class="img-fluid rounded"
                                    alt="Photo">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-white mt-5 py-4 border-top">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    {{-- <h6 class="fw-bold text-primary">
                        <i class="bi bi-chat-dots-fill"></i> Sosial
                    </h6> --}}
                    <div style="text-align: center; margin-bottom: 24px;">
                        <img src="/images/your-logo.png" alt="Sosial Logo" style="height: 60px;">
                    </div>
                    <p class="text-muted small">Connect with friends and share your moments.</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <a href="#" class="text-muted text-decoration-none me-3">Privacy</a>
                    <a href="#" class="text-muted text-decoration-none me-3">Terms</a>
                    <a href="#" class="text-muted text-decoration-none">Help</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

    <script>
        // Toggle Follow Button
        function toggleFollow() {
            const btn = document.getElementById('followBtn');
            if (btn.textContent.trim().includes('Follow')) {
                btn.innerHTML = '<i class="bi bi-person-check"></i> Following';
                btn.classList.remove('btn-primary');
                btn.classList.add('btn-success');
            } else {
                btn.innerHTML = '<i class="bi bi-person-plus"></i> Follow';
                btn.classList.remove('btn-success');
                btn.classList.add('btn-primary');
            }
        }

        // Post hover effects
        document.addEventListener('DOMContentLoaded', function () {
            const postCards = document.querySelectorAll('.post-hover');

            postCards.forEach(card => {
                const overlay = card.querySelector('.hover-overlay');
                const content = card.querySelector('.hover-content');

                card.addEventListener('mouseenter', function () {
                    overlay.classList.remove('bg-opacity-0');
                    overlay.classList.add('bg-opacity-50');
                    content.classList.remove('d-none');
                });

                card.addEventListener('mouseleave', function () {
                    overlay.classList.remove('bg-opacity-50');
                    overlay.classList.add('bg-opacity-0');
                    content.classList.add('d-none');
                });
            });
        });

        // Stats hover effects
        document.querySelectorAll('.stats-card').forEach(card => {
            card.addEventListener('click', function () {
                const statType = this.querySelector('.text-muted').textContent;
                alert(`Viewing ${statType} details`);
            });
        });
    </script>
</body>

</html>