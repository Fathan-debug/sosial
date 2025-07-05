<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifications - Sosial</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Font Awesome for icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    
    <style>
        .notification-card {
            border-radius: 15px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s ease;
        }
        
        .notification-card:hover {
            transform: translateY(-2px);
        }
        
        .notification-unread {
            background-color: #f8f9ff;
            border-left: 4px solid #667eea;
        }
        
        .notification-read {
            background-color: #ffffff;
            border-left: 4px solid #e9ecef;
        }
        
        .notification-icon {
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            color: white;
            font-size: 16px;
        }
        
        .icon-like { background-color: #e91e63; }
        .icon-comment { background-color: #2196f3; }
        .icon-follow { background-color: #4caf50; }
        .icon-share { background-color: #ff9800; }
        .icon-mention { background-color: #9c27b0; }
        .icon-friend { background-color: #00bcd4; }
        
        .time-ago {
            font-size: 0.85rem;
            color: #6c757d;
        }
        
        .notification-actions {
            opacity: 0;
            transition: opacity 0.2s ease;
        }
        
        .notification-card:hover .notification-actions {
            opacity: 1;
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
            <!-- Notifications Section -->
            <div class="col-lg-8 mx-auto">
                <!-- Page Header -->
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h3 class="mb-0">Notifications</h3>
                    <div class="d-flex gap-2">
                        <button class="btn btn-outline-secondary btn-sm" id="markAllRead">
                            <i class="fas fa-check-double me-1"></i>Mark all as read
                        </button>
                        <div class="dropdown">
                            <button class="btn btn-outline-secondary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                <i class="fas fa-filter me-1"></i>Filter
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#" data-filter="all">All Notifications</a></li>
                                <li><a class="dropdown-item" href="#" data-filter="unread">Unread Only</a></li>
                                <li><a class="dropdown-item" href="#" data-filter="likes">Likes</a></li>
                                <li><a class="dropdown-item" href="#" data-filter="comments">Comments</a></li>
                                <li><a class="dropdown-item" href="#" data-filter="follows">Follows</a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Notifications List -->
                <div id="notificationsList">
                    <!-- Unread Notifications -->
                    <div class="notification-card notification-unread mb-3 p-3" data-type="like" data-read="false">
                        <div class="d-flex align-items-start">
                            <div class="notification-icon icon-like me-3">
                                <i class="fas fa-heart"></i>
                            </div>
                            <div class="flex-grow-1">
                                <div class="d-flex align-items-start justify-content-between">
                                    <div>
                                        <p class="mb-1"><strong>Sarah Johnson</strong> and <strong>3 others</strong> liked your post</p>
                                        <p class="mb-0 text-muted small">"Just finished an amazing hike in the mountains!"</p>
                                        <span class="time-ago">2 minutes ago</span>
                                    </div>
                                    <div class="notification-actions">
                                        <button class="btn btn-sm btn-outline-primary me-1">View</button>
                                        <button class="btn btn-sm btn-outline-secondary mark-read">
                                            <i class="fas fa-check"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="notification-card notification-unread mb-3 p-3" data-type="comment" data-read="false">
                        <div class="d-flex align-items-start">
                            <div class="notification-icon icon-comment me-3">
                                <i class="fas fa-comment"></i>
                            </div>
                            <div class="flex-grow-1">
                                <div class="d-flex align-items-start justify-content-between">
                                    <div>
                                        <p class="mb-1"><strong>Mike Chen</strong> commented on your post</p>
                                        <p class="mb-0 text-muted small">"Great photo! Which trail did you take?"</p>
                                        <span class="time-ago">15 minutes ago</span>
                                    </div>
                                    <div class="notification-actions">
                                        <button class="btn btn-sm btn-outline-primary me-1">Reply</button>
                                        <button class="btn btn-sm btn-outline-secondary mark-read">
                                            <i class="fas fa-check"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="notification-card notification-unread mb-3 p-3" data-type="follow" data-read="false">
                        <div class="d-flex align-items-start">
                            <div class="notification-icon icon-follow me-3">
                                <i class="fas fa-user-plus"></i>
                            </div>
                            <div class="flex-grow-1">
                                <div class="d-flex align-items-start justify-content-between">
                                    <div>
                                        <p class="mb-1"><strong>Emma Wilson</strong> started following you</p>
                                        <span class="time-ago">1 hour ago</span>
                                    </div>
                                    <div class="notification-actions">
                                        <button class="btn btn-sm btn-outline-success me-1">Follow back</button>
                                        <button class="btn btn-sm btn-outline-secondary mark-read">
                                            <i class="fas fa-check"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Read Notifications -->
                    <div class="notification-card notification-read mb-3 p-3" data-type="share" data-read="true">
                        <div class="d-flex align-items-start">
                            <div class="notification-icon icon-share me-3">
                                <i class="fas fa-share"></i>
                            </div>
                            <div class="flex-grow-1">
                                <div class="d-flex align-items-start justify-content-between">
                                    <div>
                                        <p class="mb-1"><strong>Alex Rodriguez</strong> shared your post</p>
                                        <span class="time-ago">3 hours ago</span>
                                    </div>
                                    <div class="notification-actions">
                                        <button class="btn btn-sm btn-outline-primary">View</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="notification-card notification-read mb-3 p-3" data-type="mention" data-read="true">
                        <div class="d-flex align-items-start">
                            <div class="notification-icon icon-mention me-3">
                                <i class="fas fa-at"></i>
                            </div>
                            <div class="flex-grow-1">
                                <div class="d-flex align-items-start justify-content-between">
                                    <div>
                                        <p class="mb-1"><strong>Lisa Parker</strong> mentioned you in a post</p>
                                        <p class="mb-0 text-muted small">"Thanks @johndoe for the amazing recommendation!"</p>
                                        <span class="time-ago">5 hours ago</span>
                                    </div>
                                    <div class="notification-actions">
                                        <button class="btn btn-sm btn-outline-primary">View</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="notification-card notification-read mb-3 p-3" data-type="friend" data-read="true">
                        <div class="d-flex align-items-start">
                            <div class="notification-icon icon-friend me-3">
                                <i class="fas fa-user-friends"></i>
                            </div>
                            <div class="flex-grow-1">
                                <div class="d-flex align-items-start justify-content-between">
                                    <div>
                                        <p class="mb-1"><strong>David Kim</strong> accepted your friend request</p>
                                        <span class="time-ago">1 day ago</span>
                                    </div>
                                    <div class="notification-actions">
                                        <button class="btn btn-sm btn-outline-primary">View Profile</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="notification-card notification-read mb-3 p-3" data-type="like" data-read="true">
                        <div class="d-flex align-items-start">
                            <div class="notification-icon icon-like me-3">
                                <i class="fas fa-heart"></i>
                            </div>
                            <div class="flex-grow-1">
                                <div class="d-flex align-items-start justify-content-between">
                                    <div>
                                        <p class="mb-1"><strong>Jennifer Lee</strong> liked your comment</p>
                                        <p class="mb-0 text-muted small">"Absolutely agree! Great point about sustainability."</p>
                                        <span class="time-ago">2 days ago</span>
                                    </div>
                                    <div class="notification-actions">
                                        <button class="btn btn-sm btn-outline-primary">View</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="notification-card notification-read mb-3 p-3" data-type="comment" data-read="true">
                        <div class="d-flex align-items-start">
                            <div class="notification-icon icon-comment me-3">
                                <i class="fas fa-comment"></i>
                            </div>
                            <div class="flex-grow-1">
                                <div class="d-flex align-items-start justify-content-between">
                                    <div>
                                        <p class="mb-1"><strong>Tom Wilson</strong> replied to your comment</p>
                                        <p class="mb-0 text-muted small">"I had the same experience! Thanks for sharing."</p>
                                        <span class="time-ago">3 days ago</span>
                                    </div>
                                    <div class="notification-actions">
                                        <button class="btn btn-sm btn-outline-primary">View</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Load More Button -->
                <div class="text-center mt-4">
                    <button class="btn btn-outline-primary">
                        <i class="fas fa-plus me-1"></i>Load More Notifications
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Mark individual notification as read
        document.querySelectorAll('.mark-read').forEach(button => {
            button.addEventListener('click', function() {
                const notification = this.closest('.notification-card');
                notification.classList.remove('notification-unread');
                notification.classList.add('notification-read');
                notification.setAttribute('data-read', 'true');
                this.style.display = 'none';
            });
        });

        // Mark all notifications as read
        document.getElementById('markAllRead').addEventListener('click', function() {
            document.querySelectorAll('.notification-unread').forEach(notification => {
                notification.classList.remove('notification-unread');
                notification.classList.add('notification-read');
                notification.setAttribute('data-read', 'true');
            });
            
            document.querySelectorAll('.mark-read').forEach(button => {
                button.style.display = 'none';
            });
        });

        // Filter notifications
        document.querySelectorAll('[data-filter]').forEach(filter => {
            filter.addEventListener('click', function(e) {
                e.preventDefault();
                const filterType = this.getAttribute('data-filter');
                const notifications = document.querySelectorAll('.notification-card');
                
                notifications.forEach(notification => {
                    if (filterType === 'all') {
                        notification.style.display = 'block';
                    } else if (filterType === 'unread') {
                        notification.style.display = notification.getAttribute('data-read') === 'false' ? 'block' : 'none';
                    } else {
                        const notificationType = notification.getAttribute('data-type');
                        notification.style.display = notificationType === filterType ? 'block' : 'none';
                    }
                });
            });
        });
    </script>
    
    <!-- PHP Integration Points (Comments for development) -->
    <!--
    PHP Integration Notes:
    1. Replace static notification data with PHP database queries
    2. Add PHP session management for user authentication
    3. Implement PHP functions for marking notifications as read
    4. Add PHP pagination for loading more notifications
    5. Create PHP filters for different notification types
    6. Add real-time notification updates using PHP/Ajax
    
    
</body>
</html>