<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Free QR & Barcode Generator</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #4361ee;
            --primary-dark: #3a56d4;
            --secondary-color: #7209b7;
            --light-bg: #f8f9fa;
            --dark-bg: #121826;
            --card-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            --hover-shadow: 0 15px 40px rgba(0, 0, 0, 0.12);
            --border-radius: 16px;
            --transition: all 0.3s ease;
        }

        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
            color: #333;
            line-height: 1.6;
            min-height: 100vh;
            background: linear-gradient(135deg, #f5f7fa 0%, #e4e8f0 100%);
        }

        .navbar {
            background: linear-gradient(90deg, var(--dark-bg) 0%, #1e293b 100%);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            padding: 1rem 0;
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .navbar-brand {
            font-weight: 700;
            font-size: 1.5rem;
            background: linear-gradient(90deg, #4361ee, #7209b7);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .navbar-brand i {
            font-size: 1.8rem;
        }

        .nav-link {
            color: #e2e8f0 !important;
            font-weight: 500;
            margin: 0 5px;
            padding: 8px 16px !important;
            border-radius: 50px;
            transition: var(--transition);
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .nav-link:hover, .nav-link.active {
            background-color: rgba(67, 97, 238, 0.15);
            color: white !important;
            transform: translateY(-2px);
        }

        .nav-link i {
            font-size: 1.1rem;
        }

        .hero-section {
            padding: 4rem 0 3rem;
            text-align: center;
            background: transparent;
        }

        .hero-title {
            font-size: 3rem;
            font-weight: 800;
            background: linear-gradient(90deg, var(--primary-color), var(--secondary-color));
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            margin-bottom: 1rem;
            line-height: 1.2;
        }

        .hero-subtitle {
            font-size: 1.2rem;
            color: #64748b;
            max-width: 700px;
            margin: 0 auto 2.5rem;
        }

        .card-modern {
            background: white;
            border-radius: var(--border-radius);
            box-shadow: var(--card-shadow);
            border: none;
            overflow: hidden;
            transition: var(--transition);
            height: 100%;
        }

        .card-modern:hover {
            transform: translateY(-8px);
            box-shadow: var(--hover-shadow);
        }

        .card-header-modern {
            background: linear-gradient(90deg, var(--primary-color), var(--secondary-color));
            color: white;
            padding: 1.5rem;
            border-bottom: none;
            font-weight: 600;
            font-size: 1.3rem;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .card-body-modern {
            padding: 2rem;
        }

        .btn-modern {
            background: linear-gradient(90deg, var(--primary-color), var(--secondary-color));
            border: none;
            color: white;
            padding: 12px 28px;
            border-radius: 50px;
            font-weight: 600;
            transition: var(--transition);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .btn-modern:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(67, 97, 238, 0.3);
            color: white;
        }

        .btn-modern-outline {
            background: transparent;
            border: 2px solid var(--primary-color);
            color: var(--primary-color);
        }

        .btn-modern-outline:hover {
            background: var(--primary-color);
            color: white;
        }

        .form-control-modern {
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            padding: 14px 18px;
            font-size: 1rem;
            transition: var(--transition);
        }

        .form-control-modern:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.15);
        }

        .generator-container {
            max-width: 900px;
            margin: 0 auto;
        }

        .preview-card {
            background: white;
            border-radius: var(--border-radius);
            box-shadow: var(--card-shadow);
            padding: 2.5rem;
            text-align: center;
            margin-bottom: 2rem;
            border-top: 5px solid var(--primary-color);
        }

        .code-preview {
            background: #f8fafc;
            border-radius: 12px;
            padding: 2rem;
            display: inline-block;
            margin: 1.5rem auto;
            border: 2px dashed #cbd5e1;
            max-width: 100%;
        }

        .code-preview img {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
        }

        .footer {
            background: var(--dark-bg);
            color: #cbd5e1;
            padding: 3rem 0 2rem;
            margin-top: 4rem;
        }

        .feature-icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, rgba(67, 97, 238, 0.1), rgba(114, 9, 183, 0.1));
            border-radius: 16px;
            margin-bottom: 1.5rem;
            color: var(--primary-color);
            font-size: 1.8rem;
        }

        .feature-card {
            text-align: center;
            padding: 2rem;
        }

        .step-indicator {
            display: flex;
            justify-content: center;
            margin-bottom: 2.5rem;
            position: relative;
        }

        .step {
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 120px;
            position: relative;
            z-index: 1;
        }

        .step-number {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: #e2e8f0;
            color: #64748b;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 1.2rem;
            margin-bottom: 10px;
            transition: var(--transition);
        }

        .step.active .step-number {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            box-shadow: 0 5px 15px rgba(67, 97, 238, 0.3);
        }

        .step-title {
            font-weight: 600;
            color: #334155;
            font-size: 0.95rem;
            text-align: center;
        }

        .step-line {
            position: absolute;
            top: 25px;
            left: 15%;
            right: 15%;
            height: 3px;
            background: #e2e8f0;
            z-index: 0;
        }

        .action-buttons {
            display: flex;
            gap: 15px;
            justify-content: center;
            flex-wrap: wrap;
            margin-top: 2rem;
        }

        @media (max-width: 768px) {
            .hero-title {
                font-size: 2.2rem;
            }

            .step-indicator {
                flex-direction: column;
                align-items: center;
                gap: 30px;
            }

            .step-line {
                display: none;
            }

            .action-buttons {
                flex-direction: column;
                align-items: center;
            }

            .action-buttons .btn {
                width: 100%;
                max-width: 300px;
            }
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">
                <i class="fas fa-qrcode"></i>
                QR/Barcode Pro
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <div class="navbar-nav ms-auto">
                    <a class="nav-link {{ Request::routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">
                        <i class="fas fa-home"></i>
                        Home
                    </a>
                    <a class="nav-link {{ Request::routeIs('qr.*') ? 'active' : '' }}" href="{{ route('qr.index') }}">
                        <i class="fas fa-qrcode"></i>
                        QR Code
                    </a>
                    <a class="nav-link {{ Request::routeIs('barcode.*') ? 'active' : '' }}" href="{{ route('barcode.index') }}">
                        <i class="fas fa-barcode"></i>
                        Barcode
                    </a>
                </div>
            </div>
        </div>
    </nav>



    <div class="container">
        @yield('content')
    </div>

    <!-- Footer -->
    <div class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-4">
                    <h5 class="mb-3 text-white">QR/Barcode Pro</h5>
                    <p>Free online tool for generating QR codes and barcodes. Fast, secure, and no registration required.</p>
                </div>
                <div class="col-md-4 mb-4">
                    <h5 class="mb-3 text-white">Quick Links</h5>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('qr.index') }}" class="text-light text-decoration-none">QR Code Generator</a></li>
                        <li><a href="{{ route('barcode.index') }}" class="text-light text-decoration-none">Barcode Generator</a></li>
                    </ul>
                </div>
                <div class="col-md-4 mb-4">
                    <h5 class="mb-3 text-white">Features</h5>
                    <ul class="list-unstyled">
                        <li class="mb-1"><i class="fas fa-check-circle text-primary me-2"></i> No watermarks</li>
                        <li class="mb-1"><i class="fas fa-check-circle text-primary me-2"></i> High-resolution downloads</li>
                        <li class="mb-1"><i class="fas fa-check-circle text-primary me-2"></i> Multiple formats</li>
                    </ul>
                </div>
            </div>
            <hr class="my-4 bg-light">
            <div class="text-center">
                <p class="mb-0">&copy; 2023 QR/Barcode Pro. All rights reserved.</p>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
</body>
</html>
