@extends('layouts.app')

@section('content')
<div class="hero-section">
    <div class="container">
        <h1 class="hero-title">Free QR Code & Barcode Generator</h1>
        <p class="hero-subtitle">No signup • No watermark • Unlimited • Forever free</p>

        <!-- Features Grid -->
        <div class="row mt-5 mb-5">
            <div class="col-md-3 col-sm-6 mb-4">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-bolt"></i>
                    </div>
                    <h4>Instant Generation</h4>
                    <p class="text-muted">Generate codes in seconds with our fast processor</p>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 mb-4">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-download"></i>
                    </div>
                    <h4>Free Download</h4>
                    <p class="text-muted">Download high-resolution images without watermarks</p>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 mb-4">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-palette"></i>
                    </div>
                    <h4>Customizable</h4>
                    <p class="text-muted">Adjust colors, size, and format to match your needs</p>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 mb-4">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <h4>Secure & Private</h4>
                    <p class="text-muted">Your data never leaves your browser. No tracking.</p>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="action-buttons mt-4">
            <a href="{{ route('qr.index') }}" class="btn btn-modern btn-lg">
                <i class="fas fa-qrcode me-2"></i>
                Generate QR Code
            </a>
            <a href="{{ route('barcode.index') }}" class="btn btn-modern btn-lg" style="background: linear-gradient(90deg, #10b981, #059669);">
                <i class="fas fa-barcode me-2"></i>
                Generate Barcode
            </a>
        </div>

        <!-- Demo Preview -->
        <div class="row mt-5 pt-5">
            <div class="col-md-6 mb-4">
                <div class="card-modern">
                    <div class="card-header-modern">
                        <i class="fas fa-qrcode"></i>
                        QR Code Demo
                    </div>
                    <div class="card-body-modern text-center">
                        <div class="code-preview mb-3">
                            <!-- Demo QR Code (SVG) -->
                            <svg width="200" height="200" viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
                                <rect width="200" height="200" fill="#f8fafc"/>
                                <rect x="20" y="20" width="160" height="160" fill="white" stroke="#cbd5e1" stroke-width="2"/>
                                <!-- QR Pattern -->
                                <rect x="40" y="40" width="20" height="20" fill="#4361ee"/>
                                <rect x="70" y="40" width="10" height="10" fill="#4361ee"/>
                                <rect x="90" y="40" width="20" height="20" fill="#4361ee"/>
                                <rect x="40" y="70" width="10" height="10" fill="#4361ee"/>
                                <rect x="70" y="70" width="20" height="20" fill="#4361ee"/>
                                <rect x="100" y="70" width="10" height="10" fill="#4361ee"/>
                                <rect x="40" y="100" width="20" height="20" fill="#4361ee"/>
                                <rect x="70" y="100" width="10" height="10" fill="#4361ee"/>
                                <rect x="90" y="100" width="20" height="20" fill="#4361ee"/>
                                <!-- Finder patterns -->
                                <rect x="50" y="50" width="40" height="40" fill="white" stroke="#4361ee" stroke-width="3"/>
                                <rect x="52" y="52" width="36" height="36" fill="#4361ee"/>
                                <rect x="58" y="58" width="24" height="24" fill="white"/>
                                <rect x="64" y="64" width="12" height="12" fill="#4361ee"/>
                            </svg>
                        </div>
                        <p class="text-muted">Generate QR codes for URLs, contact info, Wi-Fi, and more</p>
                        <a href="{{ route('qr.index') }}" class="btn btn-modern btn-sm mt-2">
                            <i class="fas fa-play me-1"></i>
                            Try QR Generator
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-4">
                <div class="card-modern">
                    <div class="card-header-modern" style="background: linear-gradient(90deg, #10b981, #059669);">
                        <i class="fas fa-barcode"></i>
                        Barcode Demo
                    </div>
                    <div class="card-body-modern text-center">
                        <div class="code-preview mb-3">
                            <!-- Demo Barcode -->
                            <svg width="300" height="120" viewBox="0 0 300 120" xmlns="http://www.w3.org/2000/svg">
                                <rect width="300" height="120" fill="#f8fafc"/>
                                <rect x="20" y="20" width="260" height="80" fill="white" stroke="#cbd5e1" stroke-width="2"/>
                                <!-- Barcode pattern -->
                                <rect x="30" y="25" width="4" height="70" fill="#059669"/>
                                <rect x="38" y="25" width="2" height="70" fill="#059669"/>
                                <rect x="44" y="25" width="6" height="70" fill="#059669"/>
                                <rect x="54" y="25" width="2" height="70" fill="#059669"/>
                                <rect x="60" y="25" width="4" height="70" fill="#059669"/>
                                <rect x="68" y="25" width="6" height="70" fill="#059669"/>
                                <rect x="78" y="25" width="2" height="70" fill="#059669"/>
                                <rect x="84" y="25" width="4" height="70" fill="#059669"/>
                                <rect x="92" y="25" width="2" height="70" fill="#059669"/>
                                <rect x="98" y="25" width="6" height="70" fill="#059669"/>
                                <rect x="108" y="25" width="4" height="70" fill="#059669"/>
                                <rect x="116" y="25" width="2" height="70" fill="#059669"/>
                                <rect x="122" y="25" width="6" height="70" fill="#059669"/>
                                <rect x="132" y="25" width="2" height="70" fill="#059669"/>
                                <rect x="138" y="25" width="4" height="70" fill="#059669"/>
                                <!-- Barcode text -->
                                <text x="150" y="110" text-anchor="middle" font-family="monospace" font-size="14" fill="#64748b">123456789012</text>
                            </svg>
                        </div>
                        <p class="text-muted">Create barcodes for products, inventory, tickets, and labels</p>
                        <a href="{{ route('barcode.index') }}" class="btn btn-modern btn-sm mt-2" style="background: linear-gradient(90deg, #10b981, #059669);">
                            <i class="fas fa-play me-1"></i>
                            Try Barcode Generator
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- How It Works -->
        <div class="row mt-5 pt-4">
            <div class="col-12">
                <h2 class="text-center mb-5" style="color: var(--primary-color);">How It Works</h2>

                <div class="step-indicator">
                    <div class="step-line"></div>
                    <div class="step active">
                        <div class="step-number">1</div>
                        <div class="step-title">Enter Content</div>
                    </div>
                    <div class="step">
                        <div class="step-number">2</div>
                        <div class="step-title">Customize</div>
                    </div>
                    <div class="step">
                        <div class="step-number">3</div>
                        <div class="step-title">Preview</div>
                    </div>
                    <div class="step">
                        <div class="step-number">4</div>
                        <div class="step-title">Download</div>
                    </div>
                </div>

                <div class="text-center mt-4">
                    <p class="text-muted">Get started in less than a minute. No account required.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Additional Info Section -->
<div class="container mt-5 pt-5">
    <div class="row">
        <div class="col-lg-8 offset-lg-2">
            <div class="card-modern">
                <div class="card-body-modern">
                    <h3 class="text-center mb-4" style="color: var(--primary-color);">Why Choose Our Generator?</h3>
                    <div class="row">
                        <div class="col-md-6">
                            <ul class="list-unstyled">
                                <li class="mb-3">
                                    <i class="fas fa-check-circle text-primary me-2"></i>
                                    <strong>Completely Free</strong> - No hidden costs or premium tiers
                                </li>
                                <li class="mb-3">
                                    <i class="fas fa-check-circle text-primary me-2"></i>
                                    <strong>High Quality</strong> - Vector SVG & high-resolution PNG output
                                </li>
                                <li class="mb-3">
                                    <i class="fas fa-check-circle text-primary me-2"></i>
                                    <strong>Multiple Formats</strong> - PNG, JPG, SVG, and PDF
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <ul class="list-unstyled">
                                <li class="mb-3">
                                    <i class="fas fa-check-circle text-primary me-2"></i>
                                    <strong>Privacy Focused</strong> - All processing happens in your browser
                                </li>
                                <li class="mb-3">
                                    <i class="fas fa-check-circle text-primary me-2"></i>
                                    <strong>No Limits</strong> - Generate as many codes as you need
                                </li>
                                <li class="mb-3">
                                    <i class="fas fa-check-circle text-primary me-2"></i>
                                    <strong>Commercial Use</strong> - Use generated codes for any purpose
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="text-center mt-4">
                        <a href="{{ route('qr.index') }}" class="btn btn-modern px-5">
                            <i class="fas fa-rocket me-2"></i>
                            Start Generating Now
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* Additional styles for the home page */
    .feature-card h4 {
        font-weight: 600;
        color: #334155;
        margin-bottom: 0.5rem;
    }

    .feature-card p {
        font-size: 0.95rem;
    }
</style>
@endsection
