<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Users - Sosial</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <style>
        .search-card {
            transition: all 0.3s ease;
        }

        .search-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        }

        .avatar {
            border: 3px solid #e3f2fd;
        }

        .verified-badge {
            background: linear-gradient(45deg, #1da1f2, #0d8bd9);
        }

        .search-input {
            border-radius: 25px;
            border: 2px solid #e3f2fd;
            transition: all 0.3s ease;
        }

        .search-input:focus {
            border-color: #0d6efd;
            box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25);
        }

        .filter-badge {
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .filter-badge:hover {
            transform: scale(1.05);
        }

        .filter-badge.active {
            background: linear-gradient(45deg, #0d6efd, #0b5ed7);
            color: white;
        }

        .no-results {
            opacity: 0.7;
        }

        .loading-spinner {
            display: none;
        }

        .hover-shadow:hover {
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.08);
            transition: 0.3s ease;
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
    <div class="container my-4">
        <!-- Search Header -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="bg-white rounded shadow-sm p-4">
                    <h1 class="text-primary mb-3">
                        <i class="fas fa-search me-2"></i>Search Users
                    </h1>
                    <p class="text-muted mb-4">
                        Discover and connect with amazing people on sosial
                    </p>

                    <!-- Search Form -->
                    <form method="GET" action="{{ url('/connect') }}" class="mb-4" id="searchForm">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-end-0"
                                        style="border-radius: 25px 0 0 25px; border-right: none;">
                                        <i class="fas fa-search text-muted"></i>
                                    </span>
                                    <input type="text" name="search"
                                        class="form-control search-input border-start-0 ps-0"
                                        placeholder="Search by name, username, or bio..."
                                        value="{{ request('search') }}"
                                        style="border-radius: 0 25px 25px 0; border-left: none;">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-primary" style="border-radius: 25px;">
                                    <i class="fas fa-search me-2"></i>Search
                                </button>
                            </div>
                        </div>
                    </form>


                    <!-- Results Count -->
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="text-muted" id="resultsCount">
                            Found <span class="fw-bold text-primary">{{ $users->total() }}</span> users
                        </span>
                        <div class="loading-spinner" id="loadingSpinner">
                            <div class="spinner-border spinner-border-sm text-primary" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Search Results -->
        <div class="row">
            @forelse($users as $user)
                <div class="col-lg-6 col-xl-4 mb-4">
                    <div class="search-card card h-100">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-3">
                                <img src="{{ asset('storage/' . $user->profile_pic) }}" class="rounded-circle me-3"
                                    alt="Profile" style="width: 50px; height: 50px; object-fit: cover;">
                                <div class="flex-grow-1">
                                    <h5 class="card-title mb-1 d-flex align-items-center">
                                        {{ $user->name }}
                                        @if($user->is_verified)
                                            <span
                                                class="verified-badge text-white rounded-circle d-inline-flex align-items-center justify-content-center ms-1"
                                                style="width: 18px; height: 18px; font-size: 10px;">
                                                <i class="fas fa-check"></i>
                                            </span>
                                        @endif
                                    </h5>
                                    <p class="text-muted mb-0 small">{{ $user->email }}</p>
                                </div>
                            </div>

                            <p class="card-text text-muted mb-3" style="font-size: 0.9rem; line-height: 1.4;">
                                {{ $user->bio }}
                            </p>

                            <div class="row text-center mb-3 border rounded py-1 shadow-sm">
                                <div class="col-6 border-end">
                                    <div class="fw-bold">{{ number_format($user->followers->count() ?? 0) }}</div>
                                    <small class="text-muted">Followers</small>
                                </div>
                                <div class="col-6">
                                    <div class="fw-bold">{{ number_format($user->following->count() ?? 0) }}</div>
                                    <small class="text-muted">Following</small>
                                </div>
                            </div>


                            <div class="d-flex gap-2">
                                @php
                                    $isFollowing = Auth::user()->following->contains($user->id);
                                @endphp

                                <form method="POST"
                                    action="{{ $isFollowing ? route('user.unfollow', $user->id) : route('user.follow', $user->id) }}">
                                    @csrf
                                    <button type="submit"
                                        class="btn {{ $isFollowing ? 'btn-danger' : 'btn-primary' }} btn-sm flex-grow-1">
                                        <i class="fas {{ $isFollowing ? 'fa-user-minus' : 'fa-user-plus' }} me-1"></i>
                                        {{ $isFollowing ? 'Unfollow' : 'Follow' }}
                                    </button>
                                </form>

                                <a href="{{ route('profile', ['id' => $user->id]) }}"
                                    class="btn btn-outline-secondary btn-sm">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <i class="fas fa-search text-muted mb-3" style="font-size: 4rem;"></i>
                    <h3 class="text-muted mb-3">No users found</h3>
                    <p class="text-muted mb-4">Try searching with different keywords or filters.</p>
                    <a href="{{ url('/connect') }}" class="btn btn-outline-primary">
                        <i class="fas fa-times me-2"></i>Clear Search
                    </a>
                </div>
            @endforelse
        </div>

        <!-- Pagination Links -->
        <div class="d-flex justify-content-center mt-4">
            {{ $users->links('pagination::bootstrap-5') }}
        </div>


        <!-- No Results Message -->
        <div class="row no-results" id="noResults" style="display: none;">
            <div class="col-12">
                <div class="text-center py-5">
                    <i class="fas fa-search text-muted mb-3" style="font-size: 4rem;"></i>
                    <h3 class="text-muted mb-3">No users found</h3>
                    <p class="text-muted mb-4">Try searching with different keywords or adjust your filters.</p>
                    <button class="btn btn-outline-primary" onclick="clearSearch()">
                        <i class="fas fa-times me-2"></i>Clear Search
                    </button>
                </div>
            </div>
        </div>

        <!-- Load More Button -->
        <div class="text-center mt-4" id="loadMoreContainer" style="display: none;">
            {{-- <button class="btn btn-outline-primary btn-lg" onclick="loadMoreResults()">
                <i class="fas fa-plus me-2"></i>Load More Results
            </button> --}}
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

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
    </script>
</body>

</html>