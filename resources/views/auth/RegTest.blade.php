<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Join Sosial - Create Your Account</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        
        * {
            font-family: 'Inter', sans-serif;
        }
        
        .animated-gradient {
            background: linear-gradient(-45deg, #667eea, #764ba2, #f093fb, #f5576c);
            background-size: 400% 400%;
            animation: gradientShift 15s ease infinite;
        }
        
        @keyframes gradientShift {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        
        .glass-card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.1);
        }
        
        .input-group {
            position: relative;
        }
        
        .floating-label {
            position: absolute;
            top: 50%;
            left: 12px;
            transform: translateY(-50%);
            color: #9ca3af;
            transition: all 0.3s ease;
            pointer-events: none;
            font-size: 14px;
        }
        
        .form-input {
            background: rgba(255, 255, 255, 0.9);
            border: 1px solid rgba(255, 255, 255, 0.3);
            transition: all 0.3s ease;
        }
        
        .form-input:focus {
            background: rgba(255, 255, 255, 0.95);
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }
        
        .form-input:focus + .floating-label,
        .form-input:not(:placeholder-shown) + .floating-label {
            top: -8px;
            left: 8px;
            font-size: 12px;
            color: #667eea;
            background: white;
            padding: 0 4px;
            border-radius: 4px;
        }
        
        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }
        
        .btn-primary::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }
        
        .btn-primary:hover::before {
            left: 100%;
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(102, 126, 234, 0.3);
        }
        
        .floating-shapes {
            position: absolute;
            width: 100%;
            height: 100%;
            overflow: hidden;
            pointer-events: none;
        }
        
        .shape {
            position: absolute;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            animation: float 6s ease-in-out infinite;
        }
        
        .shape:nth-child(1) {
            width: 80px;
            height: 80px;
            top: 20%;
            left: 10%;
            animation-delay: 0s;
        }
        
        .shape:nth-child(2) {
            width: 60px;
            height: 60px;
            top: 60%;
            left: 80%;
            animation-delay: 2s;
        }
        
        .shape:nth-child(3) {
            width: 40px;
            height: 40px;
            top: 80%;
            left: 20%;
            animation-delay: 4s;
        }
        
        .shape:nth-child(4) {
            width: 100px;
            height: 100px;
            top: 10%;
            left: 80%;
            animation-delay: 1s;
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(180deg); }
        }
        
        .fade-in {
            opacity: 0;
            transform: translateY(20px);
            animation: fadeIn 0.6s ease forwards;
        }
        
        @keyframes fadeIn {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .stagger-1 { animation-delay: 0.1s; }
        .stagger-2 { animation-delay: 0.2s; }
        .stagger-3 { animation-delay: 0.3s; }
        .stagger-4 { animation-delay: 0.4s; }
        .stagger-5 { animation-delay: 0.5s; }
        .stagger-6 { animation-delay: 0.6s; }
        
        .icon-input {
            position: relative;
        }
        
        .icon-input i {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: #9ca3af;
            transition: color 0.3s ease;
        }
        
        .icon-input input:focus ~ i {
            color: #667eea;
        }
        
        .social-btn {
            background: rgba(255, 255, 255, 0.9);
            border: 1px solid rgba(255, 255, 255, 0.3);
            transition: all 0.3s ease;
        }
        
        .social-btn:hover {
            background: rgba(255, 255, 255, 1);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body class="min-h-screen animated-gradient relative">
    <!-- Floating Shapes -->
    <div class="floating-shapes">
        <div class="shape"></div>
        <div class="shape"></div>
        <div class="shape"></div>
        <div class="shape"></div>
    </div>
    
    <!-- Main Content -->
    <div class="flex min-h-screen items-center justify-center py-12 px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="max-w-2xl w-full space-y-8">
            <!-- Header -->
            <div class="text-center fade-in">
                <div class="mb-6">
                    <h1 class="text-4xl font-bold text-white mb-2">
                        {{-- <i class="fas fa-share-alt mr-3 text-yellow-300"></i> --}}
                        Join SoSial
                    </h1>
                    <div class="w-20 h-1 bg-gradient-to-r from-yellow-300 to-pink-300 mx-auto rounded-full"></div>
                </div>
                <h2 class="text-2xl font-semibold text-white mb-2">
                    Create your account
                </h2>
                <p class="text-lg text-white/80">
                    Connect with friends and share your moments
                </p>
            </div>
            
            <!-- Registration Form -->
            <div class="glass-card rounded-2xl p-8 fade-in stagger-2">
                <form class="space-y-6" method="POST" action="{{ route('register') }}">
                    @csrf
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Name -->
                        <div class="input-group icon-input fade-in stagger-3">
                            <input 
                                id="name" 
                                name="name" 
                                type="text" 
                                placeholder=" "
                                autocomplete="name" 
                                required 
                                class="form-input w-full px-4 py-3 rounded-xl border-0 focus:ring-0 focus:outline-none text-gray-800 placeholder-transparent"
                                value="{{ old('name') }}"
                            >
                            <label for="name" class="floating-label">Full Name</label>
                            <i class="fas fa-user"></i>
                        </div>

                        <!-- Email -->
                        <div class="input-group icon-input fade-in stagger-4">
                            <input 
                                id="email" 
                                name="email" 
                                type="email" 
                                placeholder=" "
                                autocomplete="email" 
                                required 
                                class="form-input w-full px-4 py-3 rounded-xl border-0 focus:ring-0 focus:outline-none text-gray-800 placeholder-transparent"
                                value="{{ old('email') }}"
                            >
                            <label for="email" class="floating-label">Email Address</label>
                            <i class="fas fa-envelope"></i>
                        </div>

                        <!-- Password -->
                        <div class="input-group icon-input fade-in stagger-5">
                            <input 
                                id="password" 
                                name="password" 
                                type="password" 
                                placeholder=" "
                                autocomplete="new-password" 
                                required 
                                class="form-input w-full px-4 py-3 rounded-xl border-0 focus:ring-0 focus:outline-none text-gray-800 placeholder-transparent"
                            >
                            <label for="password" class="floating-label">Password</label>
                            <i class="fas fa-lock"></i>
                        </div>

                        <!-- Gender -->
                        <div class="input-group fade-in stagger-6">
                            <select 
                                id="gender" 
                                name="gender" 
                                required 
                                class="form-input w-full px-4 py-3 rounded-xl border-0 focus:ring-0 focus:outline-none text-gray-800 appearance-none"
                            >
                                <option value="">Select Gender</option>
                                <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
                                <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
                                <option value="other" {{ old('gender') == 'other' ? 'selected' : '' }}>Other</option>
                            </select>
                            <i class="fas fa-chevron-down absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-400 pointer-events-none"></i>
                        </div>

                        <!-- Birth Date -->
                        <div class="input-group icon-input md:col-span-2 fade-in stagger-6">
                            <input 
                                id="birth_day" 
                                name="birth_date" 
                                type="date" 
                                required 
                                class="form-input w-full px-4 py-3 rounded-xl border-0 focus:ring-0 focus:outline-none text-gray-800"
                                value="{{ old('birth_day') }}"
                            >
                            <i class="fas fa-calendar-alt"></i>
                        </div>
                    </div>

                    <!-- Terms and Conditions -->
                    <div class="flex items-center fade-in stagger-6">
                        <input 
                            id="terms" 
                            name="terms" 
                            type="checkbox" 
                            required 
                            class="w-4 h-4 text-indigo-600 bg-gray-100 rounded border-gray-300 focus:ring-indigo-500 focus:ring-2"
                        >
                        <label for="terms" class="ml-3 text-sm text-white/90">
                            I agree to the 
                            <a href="#" class="text-yellow-300 hover:text-yellow-400 underline">Terms and Conditions</a>
                            and 
                            <a href="#" class="text-yellow-300 hover:text-yellow-400 underline">Privacy Policy</a>
                        </label>
                    </div>

                    <!-- Submit Button -->
                    <div class="fade-in stagger-6">
                        <button 
                            type="submit" 
                            class="btn-primary w-full flex justify-center items-center py-4 px-6 border border-transparent text-lg font-semibold rounded-xl text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all duration-300"
                        >
                            <i class="fas fa-user-plus mr-2"></i>
                            Create Account
                        </button>
                    </div>

                    <!-- Sign In Link -->
                    <div class="text-center fade-in stagger-6">
                        <p class="text-white/80">
                            Already have an account?
                            <a href="{{ route('test') }}" class="font-semibold text-yellow-300 hover:text-yellow-400 transition-colors duration-300 ml-1">
                                Sign in here
                            </a>
                        </p>
                    </div>
                </form>
            </div>
            
            <!-- Footer -->
            <div class="text-center text-white/60 text-sm fade-in stagger-6">
                <p>© 2024 Sosial. All rights reserved.</p>
            </div>
        </div>
    </div>
    
    <script>
        // Add some interactive effects
        document.addEventListener('DOMContentLoaded', function() {
            // Password visibility toggle
            const passwordInput = document.getElementById('password');
            const passwordIcon = passwordInput.nextElementSibling;
            
            if (passwordIcon && passwordIcon.classList.contains('fa-lock')) {
                passwordIcon.style.cursor = 'pointer';
                passwordIcon.addEventListener('click', function() {
                    if (passwordInput.type === 'password') {
                        passwordInput.type = 'text';
                        passwordIcon.classList.remove('fa-lock');
                        passwordIcon.classList.add('fa-eye-slash');
                    } else {
                        passwordInput.type = 'password';
                        passwordIcon.classList.remove('fa-eye-slash');
                        passwordIcon.classList.add('fa-lock');
                    }
                });
            }

            
            
            // Form validation feedback
            const inputs = document.querySelectorAll('input, select');
            inputs.forEach(input => {
                input.addEventListener('blur', function() {
                    if (this.value.trim() !== '') {
                        this.classList.add('border-green-400');
                        this.classList.remove('border-red-400');
                    } else if (this.required) {
                        this.classList.add('border-red-400');
                        this.classList.remove('border-green-400');
                    }
                });
            });
            
            // Smooth scroll for links
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function (e) {
                    e.preventDefault();
                    document.querySelector(this.getAttribute('href')).scrollIntoView({
                        behavior: 'smooth'
                    });
                });
            });
        });
    </script>
</body>
</html>