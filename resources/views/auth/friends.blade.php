<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Followers - Sosial</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <style>
        .follower-card {
            transition: all 0.3s ease;
        }
        .follower-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
        }
        .avatar {
            border: 3px solid #e3f2fd;
        }
        .verified-badge {
            background: linear-gradient(45deg, #1da1f2, #0d8bd9);
        }
    </style>
</head>
<body class="bg-gray-50">
    
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow">
        <div class="container">
            <a class="navbar-brand fw-bold fs-4" href="#">
                <i class="fas fa-users-cog me-2"></i>sosial
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fas fa-home me-1"></i>Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="#"><i class="fas fa-users me-1"></i>Followers</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fas fa-user-friends me-1"></i>Following</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fas fa-bell me-1"></i>Notifications</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container my-4">
        <!-- Header -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="bg-white rounded shadow-sm p-4">
                    <h1 class="text-primary mb-3">
                        <i class="fas fa-users me-2"></i>My Followers
                    </h1>
                    <p class="text-muted mb-0">
                        You have <span class="fw-bold text-primary" id="followerCount">0</span> followers
                    </p>
                </div>
            </div>
        </div>

        <!-- Followers List -->
        <div class="row" id="followersContainer">
            <!-- Followers will be populated here -->
        </div>

        <!-- Load More Button -->
        <div class="text-center mt-4">
            <button class="btn btn-outline-primary btn-lg" onclick="loadMoreFollowers()">
                <i class="fas fa-plus me-2"></i>Load More
            </button>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Sample follower data (in real app, this would come from PHP/database)
        const followersData = [
            {
                id: 1,
                username: 'alice_wonder',
                fullName: 'Alice Wonder',
                avatar: 'https://images.unsplash.com/photo-1494790108755-2616b612b002?w=100&h=100&fit=crop&crop=face',
                bio: 'Digital artist and coffee enthusiast ☕',
                followersCount: 1250,
                followingCount: 890,
                isVerified: true,
                followedDate: '2024-01-15'
            },
            {
                id: 2,
                username: 'tech_guru_mike',
                fullName: 'Mike Johnson',
                avatar: 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=100&h=100&fit=crop&crop=face',
                bio: 'Full-stack developer | Tech blogger 💻',
                followersCount: 3400,
                followingCount: 567,
                isVerified: false,
                followedDate: '2024-02-20'
            },
            {
                id: 3,
                username: 'sara_lifestyle',
                fullName: 'Sara Martinez',
                avatar: 'https://images.unsplash.com/photo-1438761681033-6461ffad8d80?w=100&h=100&fit=crop&crop=face',
                bio: 'Lifestyle blogger | Fitness enthusiast 💪',
                followersCount: 2800,
                followingCount: 1200,
                isVerified: true,
                followedDate: '2024-03-10'
            },
            {
                id: 4,
                username: 'photo_explorer',
                fullName: 'David Chen',
                avatar: 'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=100&h=100&fit=crop&crop=face',
                bio: 'Travel photographer | Adventure seeker 📸',
                followersCount: 5600,
                followingCount: 2100,
                isVerified: true,
                followedDate: '2024-01-28'
            },
            {
                id: 5,
                username: 'music_lover_jen',
                fullName: 'Jennifer Wilson',
                avatar: 'https://images.unsplash.com/photo-1544005313-94ddf0286df2?w=100&h=100&fit=crop&crop=face',
                bio: 'Music producer | Indie artist 🎵',
                followersCount: 890,
                followingCount: 445,
                isVerified: false,
                followedDate: '2024-04-05'
            },
            {
                id: 6,
                username: 'chef_antonio',
                fullName: 'Antonio Rodriguez',
                avatar: 'https://images.unsplash.com/photo-1560250097-0b93528c311a?w=100&h=100&fit=crop&crop=face',
                bio: 'Professional chef | Food blogger 👨‍🍳',
                followersCount: 4200,
                followingCount: 678,
                isVerified: true,
                followedDate: '2024-02-14'
            }
        ];

        // Format number function
        function formatNumber(num) {
            if (num >= 1000000) {
                return (num / 1000000).toFixed(1) + 'M';
            } else if (num >= 1000) {
                return (num / 1000).toFixed(1) + 'K';
            }
            return num.toString();
        }

        // Format date function
        function formatDate(dateString) {
            const date = new Date(dateString);
            return date.toLocaleDateString('en-US', { 
                year: 'numeric', 
                month: 'short', 
                day: 'numeric' 
            });
        }

        // Create follower card HTML
        function createFollowerCard(follower) {
            const verifiedBadge = follower.isVerified ? 
                `<span class="verified-badge text-white rounded-circle d-inline-flex align-items-center justify-content-center ms-1" 
                       style="width: 18px; height: 18px; font-size: 10px;">
                    <i class="fas fa-check"></i>
                </span>` : '';

            return `
                <div class="col-lg-6 col-xl-4 mb-4">
                    <div class="follower-card card h-100">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-3">
                                <img src="${follower.avatar}" 
                                     alt="${follower.fullName}" 
                                     class="avatar rounded-circle me-3"
                                     width="60" height="60"
                                     style="object-fit: cover;">
                                <div>
                                    <h5 class="card-title mb-1 d-flex align-items-center">
                                        ${follower.fullName}
                                        ${verifiedBadge}
                                    </h5>
                                    <p class="text-muted mb-0 small">@${follower.username}</p>
                                </div>
                            </div>
                            
                            <p class="card-text text-muted mb-3">${follower.bio}</p>
                            
                            <div class="d-flex justify-content-between text-center mb-3">
                                <div>
                                    <strong class="d-block">${formatNumber(follower.followersCount)}</strong>
                                    <small class="text-muted">Followers</small>
                                </div>
                                <div>
                                    <strong class="d-block">${formatNumber(follower.followingCount)}</strong>
                                    <small class="text-muted">Following</small>
                                </div>
                                <div>
                                    <strong class="d-block">${formatDate(follower.followedDate)}</strong>
                                    <small class="text-muted">Followed</small>
                                </div>
                            </div>
                            
                            <div class="d-flex gap-2">
                                <button class="btn btn-primary btn-sm flex-grow-1" onclick="followBack(${follower.id})">
                                    <i class="fas fa-user-plus me-1"></i>Follow Back
                                </button>
                                <button class="btn btn-outline-secondary btn-sm" onclick="viewProfile(${follower.id})">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button class="btn btn-outline-secondary btn-sm" onclick="sendMessage(${follower.id})">
                                    <i class="fas fa-envelope"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            `;
        }

        // Load followers
        function loadFollowers() {
            const container = document.getElementById('followersContainer');
            const followerCount = document.getElementById('followerCount');
            
            let html = '';
            followersData.forEach(follower => {
                html += createFollowerCard(follower);
            });
            
            container.innerHTML = html;
            followerCount.textContent = followersData.length;
        }

        // Follow back function
        function followBack(userId) {
            const button = event.target.closest('button');
            if (button.classList.contains('btn-success')) {
                // Unfollow
                button.innerHTML = '<i class="fas fa-user-plus me-1"></i>Follow Back';
                button.classList.remove('btn-success');
                button.classList.add('btn-primary');
            } else {
                // Follow
                button.innerHTML = '<i class="fas fa-check me-1"></i>Following';
                button.classList.remove('btn-primary');
                button.classList.add('btn-success');
            }
            
            // Here you would make an AJAX call to update the database
            console.log('Toggle follow status for user:', userId);
        }

        // View profile function
        function viewProfile(userId) {
            console.log('View profile for user:', userId);
            // Redirect to profile page
            // window.location.href = `/profile/${userId}`;
        }

        // Send message function
        function sendMessage(userId) {
            console.log('Send message to user:', userId);
            // Redirect to messages page
            // window.location.href = `/messages/${userId}`;
        }

        // Load more followers function
        function loadMoreFollowers() {
            // In a real app, this would load more data from the server
            console.log('Load more followers');
            alert('No more followers to load!');
        }

        // Initialize page
        document.addEventListener('DOMContentLoaded', function() {
            loadFollowers();
        });
    </script>
</body>
</html>