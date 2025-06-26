@extends('layout/template')

@section('content')
<!-- Hero Section -->
<div class="hero-section position-relative overflow-hidden">
    <div class="hero-bg"></div>
    <div class="container position-relative">
        <div class="row align-items-center min-vh-100 py-5">
            <div class="col-lg-6">
                <!-- Header/Logo -->
                <div class="mb-4">
                    <h1 class="display-4 fw-bold text-white mb-2">
                        <span class="text-warning">CENTRA</span>VOLT
                    </h1>
                    <p class="lead text-light opacity-75 mb-0">
                        <strong>CEN</strong>tral Java <strong>TRA</strong>cking of <strong>VOLT</strong>age Sources
                    </p>
                </div>

                <!-- Hero Content -->
                <div class="hero-content">
                    <h2 class="display-5 fw-bold text-white mb-3">
                        Explore Power Plant Intelligence in Central Java
                    </h2>
                    <p class="lead text-light mb-4">
                        WebGIS platform for comprehensive mapping and intelligent management of regional energy sources across Central Java province.
                    </p>
                    <div class="d-flex gap-3 flex-wrap">
                        <a href="{{ route('map') }}" class="btn btn-warning btn-lg px-4 py-3 fw-semibold">
                            <i class="fas fa-map-marked-alt me-2"></i>Open Map
                        </a>
                        <a href="{{ route('table') }}" class="btn btn-outline-light btn-lg px-4 py-3">
                            <i class="fas fa-table me-2"></i>View Data
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 text-center">
                <div class="hero-illustration">
                    <div class="power-grid-animation">
                        <div class="grid-node active"></div>
                        <div class="grid-node"></div>
                        <div class="grid-node active"></div>
                        <div class="grid-line"></div>
                        <div class="grid-line vertical"></div>
                        <div class="energy-pulse"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Features Section -->
<div class="features-section py-5">
    <div class="container">
        <div class="row justify-content-center mb-5">
            <div class="col-lg-8 text-center">
                <h3 class="display-6 fw-bold mb-3">Powerful Geospatial Features</h3>
                <p class="lead text-muted">Comprehensive tools for energy infrastructure analysis and management</p>
            </div>
        </div>

        <div class="row g-4">
            <!-- Interactive Map Card -->
            <div class="col-lg-4 col-md-6">
                <div class="feature-card h-100">
                    <div class="card-icon mb-4">
                        <i class="fas fa-globe-asia"></i>
                    </div>
                    <h5 class="card-title fw-bold mb-3">Interactive Map</h5>
                    <p class="card-text text-muted mb-4">
                        Advanced geospatial visualization with dynamic mapping capabilities for real-time power infrastructure monitoring and analysis.
                    </p>
                    <a href="{{ route('map') }}" class="btn btn-primary btn-lg w-100">
                        <i class="fas fa-rocket me-2"></i>Launch Map
                    </a>
                </div>
            </div>

            <!-- Tabular Data Card -->
            <div class="col-lg-4 col-md-6">
                <div class="feature-card h-100">
                    <div class="card-icon mb-4">
                        <i class="fas fa-chart-bar"></i>
                    </div>
                    <h5 class="card-title fw-bold mb-3">Tabular Data</h5>
                    <p class="card-text text-muted mb-4">
                        Comprehensive data tables with advanced filtering and analysis tools for detailed power source information and statistics.
                    </p>
                    <a href="{{ route('table') }}" class="btn btn-success btn-lg w-100">
                        <i class="fas fa-table me-2"></i>View Table
                    </a>
                </div>
            </div>

            <!-- About Application Card -->
            <div class="col-lg-4 col-md-6">
                <div class="feature-card h-100">
                    <div class="card-icon mb-4">
                        <i class="fas fa-cogs"></i>
                    </div>
                    <h5 class="card-title fw-bold mb-3">About the App</h5>
                    <p class="card-text text-muted mb-4">
                        Built with Laravel framework and Leaflet.js mapping library, featuring advanced geospatial data processing and visualization capabilities.
                    </p>
                    <div class="tech-stack mb-3">
                        <span class="badge bg-danger me-2">Laravel</span>
                        <span class="badge bg-success me-2">Leaflet.js</span>
                        <span class="badge bg-info">Geospatial</span>
                    </div>
                    <button class="btn btn-outline-secondary btn-lg w-100" disabled>
                        <i class="fas fa-info-circle me-2"></i>Version 1.0
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Footer -->
<footer class="bg-dark text-light py-4">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-8">
                <p class="mb-1 fw-semibold">Created by Fildzah Hind Ihsamy — 23/522655/SV/23746</p>
                <p class="mb-0 text-muted">Advanced Geospatial Programming Practicum — Class B</p>
            </div>
            <div class="col-md-4 text-md-end">
                <div class="social-links">
                    <span class="text-warning fw-bold">CENTRAVOLT</span>
                    <small class="d-block text-muted">Energy Intelligence Platform</small>
                </div>
            </div>
        </div>
    </div>
</footer>

<style>
/* Hero Section Styles */
.hero-section {
    background: linear-gradient(135deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%);
    position: relative;
}

.hero-bg::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: radial-gradient(circle at 20% 80%, rgba(255, 193, 7, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 80% 20%, rgba(13, 202, 240, 0.1) 0%, transparent 50%);
}

/* Power Grid Animation */
.hero-illustration {
    position: relative;
    height: 400px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.power-grid-animation {
    position: relative;
    width: 300px;
    height: 300px;
}

.grid-node {
    position: absolute;
    width: 20px;
    height: 20px;
    background: #6c757d;
    border-radius: 50%;
    border: 3px solid #fff;
}

.grid-node.active {
    background: #ffc107;
    box-shadow: 0 0 20px rgba(255, 193, 7, 0.6);
    animation: pulse 2s infinite;
}

.grid-node:nth-child(1) { top: 50px; left: 50px; }
.grid-node:nth-child(2) { top: 50px; right: 50px; }
.grid-node:nth-child(3) { bottom: 50px; left: 140px; }

.grid-line {
    position: absolute;
    background: linear-gradient(90deg, #ffc107, #0dcaf0);
    height: 3px;
    width: 200px;
    top: 60px;
    left: 70px;
    opacity: 0.7;
}

.grid-line.vertical {
    width: 3px;
    height: 200px;
    top: 70px;
    left: 150px;
    background: linear-gradient(180deg, #ffc107, #0dcaf0);
}

.energy-pulse {
    position: absolute;
    width: 100px;
    height: 100px;
    border: 2px solid #ffc107;
    border-radius: 50%;
    top: 100px;
    left: 100px;
    animation: ripple 3s infinite;
}

@keyframes pulse {
    0%, 100% { transform: scale(1); opacity: 1; }
    50% { transform: scale(1.2); opacity: 0.8; }
}

@keyframes ripple {
    0% { transform: scale(0.5); opacity: 1; }
    100% { transform: scale(2); opacity: 0; }
}

/* Features Section */
.features-section {
    background: #f8f9fa;
}

.feature-card {
    background: white;
    border-radius: 15px;
    padding: 2rem;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    transition: all 0.3s ease;
    border: none;
}

.feature-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 20px 40px rgba(0,0,0,0.15);
}

.card-icon {
    width: 80px;
    height: 80px;
    background: linear-gradient(135deg, #ffc107, #fd7e14);
    border-radius: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto;
}

.card-icon i {
    font-size: 2rem;
    color: white;
}

.feature-card .btn {
    border-radius: 10px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.tech-stack .badge {
    font-size: 0.8rem;
    padding: 0.5rem 1rem;
    border-radius: 20px;
}

/* Responsive Design */
@media (max-width: 768px) {
    .hero-section .display-4 {
        font-size: 2.5rem;
    }

    .hero-section .display-5 {
        font-size: 2rem;
    }

    .hero-illustration {
        height: 250px;
        margin-top: 2rem;
    }

    .power-grid-animation {
        width: 200px;
        height: 200px;
    }
}

/* Button Hover Effects */
.btn {
    transition: all 0.3s ease;
}

.btn-warning:hover {
    background: #e0a800;
    border-color: #d39e00;
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(255, 193, 7, 0.4);
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(13, 110, 253, 0.4);
}

.btn-success:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(25, 135, 84, 0.4);
}
</style>

<!-- Font Awesome for Icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
@endsection
