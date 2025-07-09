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

    <!-- Profile Header -->
    <div class="container mt-4">
        <div class="card shadow-sm">
            <!-- Cover Photo -->
            <div class="cover-photo position-relative">

            </div>

            <!-- Profile Info -->
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3 text-center">
                        <!-- Profile Picture -->
                        <div class="position-relative d-inline-block">
                            <img src="{{ asset('storage/' . $user->profile_pic) }}" class="rounded-circle profile-pic"
                                alt="Profile Picture">
                            <button class="btn btn-primary btn-sm rounded-circle position-absolute bottom-0 end-0">
                                <i class="fas fa-user me"></i>
                            </button>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <h2 class="fw-bold mb-1">{{ $user->name }}</h2>
                        <p class="text-muted mb-2">{{ $user->email }}</p>
                        <p class="mb-3">{{ $user->bio }}</p>

                        <div class="d-flex flex-wrap gap-3 text-muted small mb-3">
                            <span><i class="bi bi-geo-alt"></i> {{ $user->location }}</span>
                            <span><i class="bi bi-calendar"></i> {{ $user->birthDate }}</span>
                            <span><i class="bi bi-link-45deg"></i> <a href="#" class="text-decoration-none">
                                    {{ $user->website }}</a></span>
                        </div>

                        <!-- Stats -->
                        <div class="row text-center">
                            <div class="col-4">
                                <div class="stats-card p-2 rounded">
                                    <div class="fw-bold fs-5">{{ $user->posts()->count() }}</div>
                                    <div class="text-muted small">Posts</div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="stats-card p-2 rounded">
                                    <div class="fw-bold fs-5">{{ $user->followers()->count() }}</div>
                                    <div class="text-muted small">Followers</div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="stats-card p-2 rounded">
                                    <div class="fw-bold fs-5">{{ $user->following()->count() }}</div>
                                    <div class="text-muted small">Following</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    @if (Auth::check() && Auth::user()->id !== $user->id)
                        <div class="col-md-3 text-end">
                            @php
                                $isFollowing = Auth::user()->following->contains($user->id);
                            @endphp

                            <form method="POST"
                                action="{{ $isFollowing ? route('user.unfollow', $user->id) : route('user.follow', $user->id) }}">
                                @csrf
                                <button type="submit"
                                    class="btn {{ $isFollowing ? 'btn-success' : 'btn-primary' }} w-100 mb-2">
                                    <i class="bi {{ $isFollowing ? 'bi-person-check' : 'bi-person-plus' }}"></i>
                                    {{ $isFollowing ? 'Following' : 'Follow' }}
                                </button>
                            </form>
                        </div>
                    @else
                        <div class="col-md-3 text-end">
                            <a href="{{ route('UpdateProfile', ['id' => Auth::user()->id]) }}"
                                class="btn btn-primary mb-2 w-100">
                                <i class="bi bi-pencil-square"></i> Edit
                            </a>
                            <a href="{{ url('/CreatePost') }}" class="btn btn-primary mb-2 w-100">
                                <i class="bi bi-plus"></i> New Post
                            </a>
                            <form method="POST" action="{{ route('logout') }}" class="btn btn-danger mb-2 w-100">
                                @csrf
                                <button type="submit">
                                    <i class="fas fa-sign-out-alt me-1"></i>Log Out
                                </button>
                            </form>
                        </div>
                    @endif
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
                    {{-- # --}}
                </ul>
            </div>

            <div class="card-body">
                <div class="tab-content" id="profileTabsContent">
                    <!-- Posts Tab -->
                    <div class="tab-pane fade show active" id="posts" role="tabpanel">
                        <div class="row g-3">
                            <!-- Post 1 -->
                            @forelse ($posts as $post)
                                <div class="card mb-4">
                                    <div class="card-body">
                                        <p>{{ $post->caption }}</p>
                                        @if ($post->image)
                                            <img src="{{ asset('storage/' . $post->image) }}" class="img-fluid mt-2"
                                                alt="Post media">
                                            <br>
                                        @endif

                                        <div class="d-flex justify-content-between align-items-center">
                                            <p class="text-muted mt-2 mb-0">
                                                Posted on {{ $post->created_at->format('d M Y h:i A') }}
                                            </p>

                                            <div class="d-flex gap-2">
                                                @php
                                                    $liked = $post->likes->contains('user_id', auth()->id());
                                                @endphp

                                                <form
                                                    action="{{ $liked ? route('posts.unlike', $post->id) : route('posts.like', $post->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @if ($liked)
                                                        @method('DELETE')
                                                    @endif
                                                    <button type="submit"
                                                        class="btn btn-sm {{ $liked ? 'btn-primary' : 'btn-outline-primary' }}">
                                                        <i class="fas fa-thumbs-up me-1"></i>
                                                        {{ $post->likes->count() }}
                                                        Like{{ $post->likes->count() !== 1 ? 's' : '' }}
                                                    </button>
                                                </form>

                                                @if(auth()->id() === $post->user_id)
                                                    <form action="{{ route('posts.destroy', $post->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger"
                                                            onclick="return confirm('Are you sure you want to delete this post?')">
                                                            <i class="fas fa-trash-alt me-1"></i> Delete
                                                        </button>
                                                    </form>
                                                @endif
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            @empty
                                <div class="text-center py-5">
                                    <i class="bi bi-camera text-secondary fs-1 mb-3"></i>
                                    <h5 class="text-muted">No posts to show</h5>
                                    <p class="text-muted">Start sharing your thoughts, photos, or moments!</p>
                                    @if(Auth::id() === $user->id)
                                        <a href="{{ url('/CreatePost') }}" class="btn btn-outline-primary mt-2">
                                            <i class="bi bi-plus-circle"></i> Create your first post
                                        </a>
                                    @endif
                                </div>
                            @endforelse
                        </div>


                    </div>

                    <!-- About Tab -->
                    <div class="tab-pane fade" id="about" role="tabpanel">
                        <div class="row">
                            <div class="col-md-6">
                                <h5>Contact Info</h5>
                                <ul class="list-unstyled">
                                    <li class="mb-2"><i class="bi bi-envelope"></i> {{ $user->email }}</li>
                                    <li class="mb-2"><i class="bi bi-telephone"></i> +60 {{ $user->phone }}</li>
                                    <li class="mb-2"><i class="bi bi-geo-alt"></i> {{ $user->location }}</li>
                                    <li class="mb-2"><i class="bi bi-link-45deg"></i> <a href="#"
                                            class="text-decoration-none"> {{ $user->website }}</a></li>
                                </ul>
                            </div>
                            <div class="col-md-6">
                                <h5>Basic Info</h5>
                                <ul class="list-unstyled">
                                    <li class="mb-2"><strong>Born:</strong> {{ $user->birthDate }}</li>
                                    <li class="mb-2"><strong>Biography:</strong> {{ $user->bio }}</li>
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
                alert(Viewing ${ statType } details);
            });
        });
    </script>
</body>

</html>