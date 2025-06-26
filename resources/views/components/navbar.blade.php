<nav class="navbar navbar-expand-lg futuristic-navbar">
    <div class="container-fluid">
        <!-- Brand Logo with Animation -->
        <a class="navbar-brand futuristic-brand" href="#">
            <div class="brand-container">
                    <i class="fa-solid fa-earth-americas"></i>
                </div>
                <div class="brand-text">
                    <span class="brand-main">{{ $title }}</span>
                </div>
            </div>
        </a>

        <!-- Mobile Toggle Button -->
        <button class="navbar-toggler futuristic-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <div class="toggler-icon">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Navigation Menu -->
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <!-- Home -->
                <li class="nav-item">
                    <a class="nav-link futuristic-link active" aria-current="page" href="{{ route('home')}}">
                        <div class="link-content">
                            <i class="fa-solid fa-house-chimney"></i>
                            <span>Home</span>
                            <div class="link-glow"></div>
                        </div>
                    </a>
                </li>

                <!-- Map -->
                <li class="nav-item">
                    <a class="nav-link futuristic-link" href="{{route('map')}}">
                        <div class="link-content">
                            <i class="fa-solid fa-map-location-dot"></i>
                            <span>Peta</span>
                            <div class="link-glow"></div>
                        </div>
                    </a>
                </li>

                @auth
                <!-- Data Dropdown -->
                <li class="nav-item dropdown futuristic-dropdown">
                    <a class="nav-link dropdown-toggle futuristic-link" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <div class="link-content">
                            <i class="fa-solid fa-database"></i>
                            <span>Data</span>
                            <div class="link-glow"></div>
                        </div>
                    </a>
                    <ul class="dropdown-menu futuristic-dropdown-menu">
                        <li>
                            <a class="dropdown-item futuristic-dropdown-item" href="{{ route('api.points')}}" target="_blank">
                                <i class="fa-solid fa-map-pin"></i>
                                <span>Points</span>
                                <div class="item-effect"></div>
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item futuristic-dropdown-item" href="{{ route('api.polylines')}}" target="_blank">
                                <i class="fa-solid fa-road"></i>
                                <span>Polylines</span>
                                <div class="item-effect"></div>
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item futuristic-dropdown-item" href="{{ route('api.polygons')}}" target="_blank">
                                <i class="fa-solid fa-draw-polygon"></i>
                                <span>Polygons</span>
                                <div class="item-effect"></div>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Table -->
                <li class="nav-item">
                    <a class="nav-link futuristic-link" href="{{route('table')}}">
                        <div class="link-content">
                            <i class="fa-solid fa-table-list"></i>
                            <span>Tabel</span>
                            <div class="link-glow"></div>
                        </div>
                    </a>
                </li>
                @endauth

                {{--jika user login--}}
                @auth
                <li class="nav-item">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button class="nav-link futuristic-link logout-btn" type="submit">
                            <div class="link-content">
                                <i class="fa-solid fa-right-from-bracket"></i>
                                <span>Logout</span>
                                <div class="link-glow logout-glow"></div>
                            </div>
                        </button>
                    </form>
                </li>
                @endauth

                {{--jika user belum login--}}
                @guest
                <li class="nav-item">
                    <a class="nav-link futuristic-link login-btn" href="{{route('login')}}">
                        <div class="link-content">
                            <i class="fa-solid fa-right-to-bracket"></i>
                            <span>Login</span>
                            <div class="link-glow login-glow"></div>
                        </div>
                    </a>
                </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>

<style>
/* Futuristic Navbar Base */
.futuristic-navbar {
    background: linear-gradient(135deg, #0a0a0a 0%, #1a1a2e 50%, #16213e 100%);
    backdrop-filter: blur(10px);
    border-bottom: 2px solid transparent;
    background-clip: padding-box;
    position: sticky !important;
    top: 0;
    z-index: 1000;
    padding: 0.75rem 1rem;
    box-shadow: 0 4px 30px rgba(0, 0, 0, 0.3);
    max-width: 100vw;
}


.futuristic-navbar::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(90deg, transparent, rgba(255, 193, 7, 0.1), transparent);
    z-index: -1;
}

.futuristic-navbar::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    height: 2px;
    background: linear-gradient(90deg, transparent, #ffc107, #0dcaf0, transparent);
    animation: borderGlow 3s ease-in-out infinite;
}

@keyframes borderGlow {
    0%, 100% { opacity: 0.5; }
    50% { opacity: 1; }
}

/* Brand Styling */
.futuristic-brand {
    text-decoration: none;
    padding: 0;
}

.brand-container {
    display: flex;
    align-items: center;
    gap: 1rem;
}

.brand-icon {
    position: relative;
    width: 50px;
    height: 50px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: linear-gradient(135deg, #ffc107, #fd7e14);
    border-radius: 50%;
    box-shadow: 0 0 20px rgba(255, 193, 7, 0.5);
}

.brand-icon i {
    font-size: 1.5rem;
    color: white;
    z-index: 2;
    position: relative;
    animation: rotate 10s linear infinite;
}

@keyframes rotate {
    from { transform: rotate(0deg); }
    to { transform: rotate(360deg); }
}

@keyframes orbit {
    from { transform: rotate(0deg); }
    to { transform: rotate(360deg); }
}

.brand-text {
    color: white;
}

.brand-main {
    font-size: 1.8rem;
    font-weight: 800;
    background: linear-gradient(135deg, #ffc107, #fd7e14, #0dcaf0);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    text-shadow: 0 0 30px rgba(255, 193, 7, 0.5);
}

.brand-subtitle {
    font-size: 0.7rem;
    color: rgba(255, 255, 255, 0.7);
    font-weight: 300;
    letter-spacing: 2px;
    text-transform: uppercase;
}

/* Mobile Toggle */
.futuristic-toggler {
    border: none;
    background: transparent;
    padding: 0.5rem;
}

.toggler-icon {
    width: 30px;
    height: 20px;
    position: relative;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}

.toggler-icon span {
    width: 100%;
    height: 2px;
    background: linear-gradient(90deg, #ffc107, #0dcaf0);
    border-radius: 2px;
    transition: all 0.3s ease;
}

.futuristic-toggler:hover .toggler-icon span {
    box-shadow: 0 0 10px rgba(255, 193, 7, 0.8);
}

/* Navigation Links */
.futuristic-link {
    position: relative;
    margin: 0 0.5rem;
    text-decoration: none;
    border: none;
    background: transparent;
    padding: 0.75rem 1.5rem;
    border-radius: 25px;
    transition: all 0.3s ease;
    overflow: hidden;
}

.link-content {
    position: relative;
    display: flex;
    align-items: center;
    gap: 0.5rem;
    color: rgba(255, 255, 255, 0.8);
    font-weight: 500;
    z-index: 2;
}

.link-content i {
    font-size: 1rem;
    transition: all 0.3s ease;
}

.link-glow {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(135deg, rgba(255, 193, 7, 0.1), rgba(13, 202, 240, 0.1));
    border-radius: 25px;
    opacity: 0;
    transition: all 0.3s ease;
    z-index: 1;
}

.futuristic-link:hover .link-glow,
.futuristic-link.active .link-glow {
    opacity: 1;
    box-shadow: 0 0 20px rgba(255, 193, 7, 0.3);
}

.futuristic-link:hover .link-content,
.futuristic-link.active .link-content {
    color: white;
    transform: translateY(-2px);
}

.futuristic-link:hover .link-content i,
.futuristic-link.active .link-content i {
    transform: scale(1.2);
    color: #ffc107;
}

/* Active State */
.futuristic-link.active .link-glow {
    background: linear-gradient(135deg, rgba(255, 193, 7, 0.2), rgba(13, 202, 240, 0.2));
    border: 1px solid rgba(255, 193, 7, 0.3);
}

/* Special Button Styles */
.logout-btn .logout-glow {
    background: linear-gradient(135deg, rgba(220, 53, 69, 0.1), rgba(255, 193, 7, 0.1));
}

.logout-btn:hover .logout-glow {
    background: linear-gradient(135deg, rgba(220, 53, 69, 0.2), rgba(255, 193, 7, 0.2));
    border: 1px solid rgba(220, 53, 69, 0.3);
}

.logout-btn:hover .link-content i {
    color: #dc3545;
}

.login-btn .login-glow {
    background: linear-gradient(135deg, rgba(13, 110, 253, 0.1), rgba(255, 193, 7, 0.1));
}

.login-btn:hover .login-glow {
    background: linear-gradient(135deg, rgba(13, 110, 253, 0.2), rgba(255, 193, 7, 0.2));
    border: 1px solid rgba(13, 110, 253, 0.3);
}

.login-btn:hover .link-content i {
    color: #0d6efd;
}

/* Dropdown Styles */
.futuristic-dropdown-menu {
    background: linear-gradient(135deg, rgba(26, 26, 46, 0.95), rgba(22, 33, 62, 0.95));
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 193, 7, 0.2);
    border-radius: 15px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
    padding: 0.5rem;
    margin-top: 0.5rem;
}

.futuristic-dropdown-item {
    position: relative;
    color: rgba(255, 255, 255, 0.8);
    padding: 0.75rem 1rem;
    border-radius: 10px;
    margin-bottom: 0.25rem;
    display: flex;
    align-items: center;
    gap: 0.75rem;
    text-decoration: none;
    transition: all 0.3s ease;
    overflow: hidden;
}

.futuristic-dropdown-item:last-child {
    margin-bottom: 0;
}

.item-effect {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(135deg, rgba(255, 193, 7, 0.1), rgba(13, 202, 240, 0.1));
    opacity: 0;
    transition: all 0.3s ease;
    z-index: 1;
}

.futuristic-dropdown-item:hover .item-effect {
    opacity: 1;
}

.futuristic-dropdown-item:hover {
    color: white;
    transform: translateX(5px);
}

.futuristic-dropdown-item i {
    z-index: 2;
    position: relative;
    transition: all 0.3s ease;
}

.futuristic-dropdown-item span {
    z-index: 2;
    position: relative;
}

.futuristic-dropdown-item:hover i {
    color: #ffc107;
    transform: scale(1.2);
}

/* Responsive Design */
@media (max-width: 991px) {
    .futuristic-navbar {
        padding: 0.75rem 0;
    }

    .brand-main {
        font-size: 1.5rem;
    }

    .brand-icon {
        width: 40px;
        height: 40px;
    }

    .brand-icon i {
        font-size: 1.2rem;
    }

    .orbit-ring:nth-child(2) {
        width: 50px;
        height: 50px;
        top: -5px;
        left: -5px;
    }

    .orbit-ring-2 {
        width: 60px;
        height: 60px;
        top: -10px;
        left: -10px;
    }

    .navbar-collapse {
        margin-top: 1rem;
        border-top: 1px solid rgba(255, 193, 7, 0.2);
        padding-top: 1rem;
    }

    .futuristic-link {
        margin: 0.25rem 0;
        justify-content: flex-start;
    }
}

/* Smooth Scrolling Effect */
@media (prefers-reduced-motion: no-preference) {
    .futuristic-navbar {
        transition: all 0.3s ease;
    }
}

/* Accessibility */
.futuristic-link:focus {
    outline: 2px solid #ffc107;
    outline-offset: 2px;
}

.futuristic-dropdown-item:focus {
    outline: 2px solid #ffc107;
    outline-offset: 2px;
}
</style>

<!-- Font Awesome CDN (if not already included) -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<script>
// Enhanced navbar interactions
document.addEventListener('DOMContentLoaded', function() {
    // Add dynamic glow effect on scroll
    let navbar = document.querySelector('.futuristic-navbar');
    let lastScrollTop = 0;

    window.addEventListener('scroll', function() {
        let scrollTop = window.pageYOffset || document.documentElement.scrollTop;

        if (scrollTop > lastScrollTop && scrollTop > 100) {
            // Scrolling down
            navbar.style.transform = 'translateY(-100%)';
        } else {
            // Scrolling up
            navbar.style.transform = 'translateY(0)';
        }

        // Add glow effect based on scroll
        if (scrollTop > 50) {
            navbar.classList.add('scrolled');
        } else {
            navbar.classList.remove('scrolled');
        }

        lastScrollTop = scrollTop;
    });

    // Add particle effect on hover
    document.querySelectorAll('.futuristic-link').forEach(link => {
        link.addEventListener('mouseenter', function() {
            createParticles(this);
        });
    });

    function createParticles(element) {
        for (let i = 0; i < 3; i++) {
            let particle = document.createElement('div');
            particle.className = 'particle';
            particle.style.cssText = `
                position: absolute;
                width: 4px;
                height: 4px;
                background: #ffc107;
                border-radius: 50%;
                pointer-events: none;
                z-index: 1000;
                animation: particleFloat 1s ease-out forwards;
            `;

            let rect = element.getBoundingClientRect();
            particle.style.left = (rect.left + Math.random() * rect.width) + 'px';
            particle.style.top = (rect.top + rect.height) + 'px';

            document.body.appendChild(particle);

            setTimeout(() => {
                particle.remove();
            }, 1000);
        }
    }

    // Add CSS for particle animation
    let style = document.createElement('style');
    style.textContent = `
        @keyframes particleFloat {
            0% {
                transform: translateY(0) scale(1);
                opacity: 1;
            }
            100% {
                transform: translateY(-50px) scale(0);
                opacity: 0;
            }
        }

        .futuristic-navbar.scrolled {
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.5);
        }

        .futuristic-navbar.scrolled::after {
            height: 3px;
            box-shadow: 0 0 10px rgba(255, 193, 7, 0.5);
        }
    `;
    document.head.appendChild(style);
});
</script>
