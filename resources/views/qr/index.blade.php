@extends('layouts.app')

@section('content')
<div class="generator-container">
    <!-- Page Header -->
    <div class="text-center mb-5">
        <h1 class="hero-title">QR Code Generator</h1>
        <p class="hero-subtitle">Create custom QR codes for URLs, contact info, Wi-Fi, and more. Customize colors, add logos, and download instantly.</p>
    </div>

    <!-- Type Selection Tabs -->
    <div class="card-modern mb-4">
        <div class="card-header-modern">
            <i class="fas fa-cog me-2"></i>
            Select QR Code Type
        </div>
        <div class="card-body-modern pt-0">
            <div class="row">
                <div class="col-12">
                    <div class="scrollable-tabs">
                        <nav class="nav nav-pills nav-fill" id="qrTypeTabs" role="tablist">
                            <a class="nav-link active" id="url-tab" data-bs-toggle="tab" data-bs-target="#url" role="tab">
                                <i class="fas fa-link fa-fw me-2"></i>URL
                            </a>
                            <a class="nav-link" id="text-tab" data-bs-toggle="tab" data-bs-target="#text" role="tab">
                                <i class="fas fa-font fa-fw me-2"></i>Text
                            </a>
                            <a class="nav-link" id="email-tab" data-bs-toggle="tab" data-bs-target="#email" role="tab">
                                <i class="fas fa-envelope fa-fw me-2"></i>Email
                            </a>
                            <a class="nav-link" id="phone-tab" data-bs-toggle="tab" data-bs-target="#phone" role="tab">
                                <i class="fas fa-phone fa-fw me-2"></i>Phone
                            </a>
                            <a class="nav-link" id="sms-tab" data-bs-toggle="tab" data-bs-target="#sms" role="tab">
                                <i class="fas fa-sms fa-fw me-2"></i>SMS
                            </a>
                            <a class="nav-link" id="whatsapp-tab" data-bs-toggle="tab" data-bs-target="#whatsapp" role="tab">
                                <i class="fab fa-whatsapp fa-fw me-2"></i>WhatsApp
                            </a>
                            <a class="nav-link" id="wifi-tab" data-bs-toggle="tab" data-bs-target="#wifi" role="tab">
                                <i class="fas fa-wifi fa-fw me-2"></i>WiFi
                            </a>
                            <a class="nav-link" id="location-tab" data-bs-toggle="tab" data-bs-target="#location" role="tab">
                                <i class="fas fa-map-marker-alt fa-fw me-2"></i>Location
                            </a>
                            <a class="nav-link" id="social-tab" data-bs-toggle="tab" data-bs-target="#social" role="tab">
                                <i class="fas fa-share-alt fa-fw me-2"></i>Social
                            </a>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Form -->
    <form id="qrForm" enctype="multipart/form-data" onsubmit="event.preventDefault();">
        @csrf
        <input type="hidden" name="type" id="qrType" value="url">

        <!-- Content Tab Panels -->
        <div class="card-modern mb-4">
            <div class="card-header-modern">
                <i class="fas fa-edit me-2"></i>
                Content
            </div>
            <div class="card-body-modern">
                <div class="tab-content">
                    <!-- URL -->
                    <div class="tab-pane fade show active" id="url" role="tabpanel">
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Website URL</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-link"></i></span>
                                <input type="url" class="form-control form-control-modern" name="data[url]" placeholder="https://example.com" required>
                            </div>
                            <div class="form-text">Enter the full website address including https://</div>
                        </div>
                    </div>

                    <!-- Text -->
                    <div class="tab-pane fade" id="text" role="tabpanel">
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Text Content</label>
                            <textarea class="form-control form-control-modern" name="data[text]" rows="4" placeholder="Enter any text you want to encode..." required></textarea>
                            <div class="form-text">Any plain text, up to 2,000 characters</div>
                        </div>
                    </div>

                    <!-- Email -->
                    <div class="tab-pane fade" id="email" role="tabpanel">
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Email Address</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                <input type="email" class="form-control form-control-modern" name="data[email]" placeholder="user@example.com" required>
                            </div>
                            <div class="form-text">Scanning will open default email client</div>
                        </div>
                    </div>

                    <!-- Phone -->
                    <div class="tab-pane fade" id="phone" role="tabpanel">
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Phone Number</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                <input type="tel" class="form-control form-control-modern" name="data[phone]" placeholder="+1 234 567 8900" required>
                            </div>
                            <div class="form-text">Include country code (e.g., +1 for US)</div>
                        </div>
                    </div>

                    <!-- SMS -->
                    <div class="tab-pane fade" id="sms" role="tabpanel">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Phone Number</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                    <input type="tel" class="form-control form-control-modern" name="data[phone]" placeholder="+1 234 567 8900" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Message (optional)</label>
                                <input type="text" class="form-control form-control-modern" name="data[message]" placeholder="Your message here">
                            </div>
                        </div>
                    </div>

                    <!-- WhatsApp -->
                    <div class="tab-pane fade" id="whatsapp" role="tabpanel">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Phone Number</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fab fa-whatsapp"></i></span>
                                    <input type="tel" class="form-control form-control-modern" name="data[phone]" placeholder="+1 234 567 8900" required>
                                </div>
                                <div class="form-text">Include country code</div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Message (optional)</label>
                                <input type="text" class="form-control form-control-modern" name="data[message]" placeholder="Your message here">
                            </div>
                        </div>
                    </div>

                    <!-- WiFi -->
                    <div class="tab-pane fade" id="wifi" role="tabpanel">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Network Name (SSID)</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-wifi"></i></span>
                                    <input type="text" class="form-control form-control-modern" name="data[ssid]" placeholder="Your WiFi network name" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Password</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-key"></i></span>
                                    <input type="password" class="form-control form-control-modern" name="data[password]" placeholder="WiFi password">
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Encryption Type</label>
                                <select class="form-select form-control-modern" name="data[encryption]">
                                    <option value="WPA">WPA/WPA2 (Recommended)</option>
                                    <option value="WEP">WEP</option>
                                    <option value="nopass">No Password</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Location -->
                    <div class="tab-pane fade" id="location" role="tabpanel">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Latitude</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-map-pin"></i></span>
                                    <input type="text" class="form-control form-control-modern" name="data[lat]" placeholder="40.7128" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Longitude</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-map-pin"></i></span>
                                    <input type="text" class="form-control form-control-modern" name="data[lng]" placeholder="-74.0060" required>
                                </div>
                            </div>
                        </div>
                        <div class="mt-3">
                            <button type="button" class="btn btn-modern-outline btn-sm" id="getLocationBtn">
                                <i class="fas fa-location-crosshairs me-2"></i>Use My Current Location
                            </button>
                        </div>
                    </div>

                    <!-- Social/App -->
                    <div class="tab-pane fade" id="social" role="tabpanel">
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Social Media or App Link</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-share-alt"></i></span>
                                <input type="url" class="form-control form-control-modern" name="data[social_url]" placeholder="https://instagram.com/username" required>
                            </div>
                            <div class="form-text">Works with Instagram, Facebook, Twitter, TikTok, and app store links</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Customization Options -->
        <div class="card-modern mb-4">
            <div class="card-header-modern">
                <i class="fas fa-palette me-2"></i>
                Customization
            </div>
            <div class="card-body-modern">
                <div class="row g-4">
                    <!-- Size -->
                    <div class="col-lg-3 col-md-6">
                        <label class="form-label fw-semibold d-flex justify-content-between">
                            <span>Size</span>
                            <span class="badge bg-primary" id="sizeValue">400px</span>
                        </label>
                        <input type="range" class="form-range" name="size" min="200" max="800" value="400" step="50" id="sizeSlider">
                        <div class="d-flex justify-content-between mt-1">
                            <small class="text-muted">Small</small>
                            <small class="text-muted">Large</small>
                        </div>
                    </div>

                    <!-- Color -->
                    <div class="col-lg-3 col-md-6">
                        <label class="form-label fw-semibold">QR Color</label>
                        <div class="d-flex align-items-center">
                            <input type="color" class="form-control form-control-color" name="color" value="#000000" id="colorPicker">
                            <span class="ms-3" id="colorHex">#000000</span>
                        </div>
                    </div>

                    <!-- Background -->
                    <div class="col-lg-3 col-md-6">
                        <label class="form-label fw-semibold">Background Color</label>
                        <div class="d-flex align-items-center">
                            <input type="color" class="form-control form-control-color" name="bg_color" value="#ffffff" id="bgColorPicker">
                            <span class="ms-3" id="bgColorHex">#FFFFFF</span>
                        </div>
                    </div>

                    <!-- Error Correction -->
                    <div class="col-lg-3 col-md-6">
                        <label class="form-label fw-semibold">Error Correction</label>
                        <select class="form-select form-control-modern" name="error_correction">
                            <option value="L">Low (7%)</option>
                            <option value="M" selected>Medium (15%)</option>
                            <option value="Q">High (25%)</option>
                            <option value="H">Highest (30%)</option>
                        </select>
                        <div class="form-text">Higher = More durable</div>
                    </div>

                    <!-- Style -->
                    <div class="col-lg-4 col-md-6">
                        <label class="form-label fw-semibold">Module Style</label>
                        <select class="form-select form-control-modern" name="style" id="moduleStyle">
                            <option value="square">Square (Standard)</option>
                            <option value="dot">Dots</option>
                            <option value="round">Rounded</option>
                        </select>
                    </div>

                    <!-- Eye Style -->
                    <div class="col-lg-4 col-md-6">
                        <label class="form-label fw-semibold">Eye Style</label>
                        <select class="form-select form-control-modern" name="eye_style">
                            <option value="square">Square</option>
                            <option value="circle">Circle</option>
                            <option value="rounded">Rounded</option>
                        </select>
                    </div>

                    <!-- Logo -->
                    <div class="col-lg-4 col-md-12">
                        <label class="form-label fw-semibold">Logo (Optional)</label>
                        <div class="input-group">
                            <input type="file" class="form-control form-control-modern" name="logo" accept="image/*" id="logoUpload">
                            <button class="btn btn-outline-secondary" type="button" id="clearLogoBtn" style="display: none;">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                        <div class="form-text">Recommended: 70×70px PNG with transparent background</div>
                        <div id="logoPreview" class="mt-2" style="display: none;"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Preview & Download -->
        <div class="card-modern mb-4">
            <div class="card-header-modern">
                <i class="fas fa-eye me-2"></i>
                Preview & Download
            </div>
            <div class="card-body-modern text-center">
                <!-- Preview Area -->
                <div class="preview-area mb-4 p-4 rounded-3 position-relative" style="background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%); min-height: 450px; display: flex; align-items: center; justify-content: center;">
                    <div id="previewContainer">
                        <img id="qrPreview"
                            src="data:image/svg+xml;base64,{{ base64_encode(QrCode::size(400)->generate('https://example.com')) }}"
                            class="img-fluid"
                            style="max-height: 400px; transition: all 0.3s ease;">

                        <div class="placeholder-message" id="placeholderText" style="display:none; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); text-align: center; color: #64748b;">
                            <i class="fas fa-qrcode display-1 mb-3" style="color: #cbd5e1;"></i>
                            <p class="lead">Fill in details to see live preview</p>
                        </div>
                    </div>
                    <div class="loading-overlay" id="loadingOverlay" style="display: none; position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: rgba(255,255,255,0.9); display: flex; align-items: center; justify-content: center; z-index: 10;">
                        <div class="text-center">
                            <div class="spinner-border text-primary mb-3" role="status"></div>
                            <p>Generating QR Code...</p>
                        </div>
                    </div>
                </div>

                <!-- Download Buttons -->
                <div class="action-buttons">
                    <button type="button" class="btn btn-modern btn-lg px-5" id="downloadPng">
                        <i class="fas fa-download me-2"></i>
                        Download PNG
                    </button>
                    <button type="button" class="btn btn-modern-outline btn-lg px-5" id="downloadSvg">
                        <i class="fas fa-download me-2"></i>
                        Download SVG
                    </button>
                    <button type="button" class="btn btn-modern-outline btn-lg px-5" id="downloadJpg">
                        <i class="fas fa-download me-2"></i>
                        Download JPG
                    </button>
                </div>

                <!-- Preview Note -->
                <div class="mt-4">
                    <p class="text-muted">
                        <i class="fas fa-info-circle me-2"></i>
                        Preview updates live as you change settings. Click any download button to save.
                    </p>
                </div>
            </div>
        </div>
    </form>
</div>

<!-- Quick Tips -->
<div class="row mt-5">
    <div class="col-12">
        <div class="card-modern">
            <div class="card-body-modern">
                <h5 class="mb-3" style="color: var(--primary-color);">
                    <i class="fas fa-lightbulb me-2"></i>
                    Quick Tips
                </h5>
                <div class="row">
                    <div class="col-md-4">
                        <div class="d-flex align-items-start mb-3">
                            <div class="me-3 text-primary">
                                <i class="fas fa-check-circle"></i>
                            </div>
                            <div>
                                <h6 class="fw-semibold">High Error Correction</h6>
                                <p class="text-muted small">Use "High" or "Highest" for QR codes with logos or when printing small.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="d-flex align-items-start mb-3">
                            <div class="me-3 text-primary">
                                <i class="fas fa-check-circle"></i>
                            </div>
                            <div>
                                <h6 class="fw-semibold">Contrast is Key</h6>
                                <p class="text-muted small">Ensure good contrast between QR color and background for better scanning.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="d-flex align-items-start mb-3">
                            <div class="me-3 text-primary">
                                <i class="fas fa-check-circle"></i>
                            </div>
                            <div>
                                <h6 class="fw-semibold">Test Before Use</h6>
                                <p class="text-muted small">Always scan your QR code with multiple devices before distributing.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* Custom styles for QR generator */
    .scrollable-tabs {
        overflow-x: auto;
        padding-bottom: 5px;
    }

    .scrollable-tabs .nav {
        flex-wrap: nowrap;
        min-width: max-content;
    }

    .scrollable-tabs .nav-link {
        white-space: nowrap;
        border-radius: 50px;
        padding: 10px 20px;
        margin: 0 3px;
        color: #64748b;
        border: 1px solid #e2e8f0;
        background: white;
    }

    .scrollable-tabs .nav-link.active {
        background: linear-gradient(90deg, var(--primary-color), var(--secondary-color));
        color: white;
        border-color: transparent;
        box-shadow: 0 4px 12px rgba(67, 97, 238, 0.2);
    }

    .form-control-color {
        height: 50px;
        width: 50px;
        padding: 5px;
        border-radius: 12px;
        border: 2px solid #e2e8f0;
        cursor: pointer;
    }

    .form-control-color:hover {
        border-color: var(--primary-color);
    }

    #colorHex, #bgColorHex {
        font-family: monospace;
        font-weight: 600;
        color: #334155;
        min-width: 80px;
    }

    #sizeSlider {
        height: 8px;
        border-radius: 4px;
    }

    #sizeSlider::-webkit-slider-thumb {
        background: linear-gradient(90deg, var(--primary-color), var(--secondary-color));
    }

    #sizeSlider::-moz-range-thumb {
        background: linear-gradient(90deg, var(--primary-color), var(--secondary-color));
    }

    .loading-overlay {
        border-radius: 16px;
    }

    .placeholder-message {
        pointer-events: none;
    }

    @media (max-width: 768px) {
        .scrollable-tabs .nav-link {
            padding: 8px 15px;
            font-size: 0.9rem;
        }

        .action-buttons {
            flex-direction: column;
        }

        .action-buttons .btn {
            width: 100%;
            margin-bottom: 10px;
        }
    }
</style>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    // 1. Get Elements
    const form = document.getElementById('qrForm');
    const preview = document.getElementById('qrPreview');
    const loadingOverlay = document.getElementById('loadingOverlay');
    const qrTypeInput = document.getElementById('qrType');

    // 2. Setup CSRF for all AJAX requests
    const csrfToken = document.querySelector('meta[name="csrf-token"]')
        ? document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        : document.querySelector('input[name="_token"]').value;

    // 3. Tab Switching Logic
    document.querySelectorAll('#qrTypeTabs .nav-link').forEach(tab => {
        tab.addEventListener('shown.bs.tab', (e) => {
            const targetId = e.target.getAttribute('data-bs-target').replace('#', '');
            qrTypeInput.value = targetId;
            generate();
        });
    });

    // 4. Live Updates (Debounced)
    let debounceTimer;
    form.querySelectorAll('input, select, textarea').forEach(input => {
        input.addEventListener('input', () => {
            clearTimeout(debounceTimer);
            debounceTimer = setTimeout(generate, 500);
        });
        input.addEventListener('change', generate);
    });

    // 5. GENERATE FUNCTION
    async function generate() {
        // Don't generate if specific inputs are empty (optional check)
        // Show loading
        if(loadingOverlay) loadingOverlay.style.display = 'flex';

        const fd = new FormData(form);

        try {
            const res = await fetch('{{ route("qr.generate") }}', {
                method: 'POST',
                body: fd,
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                }
            });

            if (res.ok) {
                const svgText = await res.text();
                // Fix for special characters in SVG
                const base64Svg = btoa(unescape(encodeURIComponent(svgText)));
                preview.src = 'data:image/svg+xml;base64,' + base64Svg;
                preview.style.opacity = '1';
            } else {
                console.error('Server Status:', res.status);
            }
        } catch (e) {
            console.error('Generation Error:', e);
        } finally {
            if(loadingOverlay) loadingOverlay.style.display = 'none';
        }
    }

    // 6. DOWNLOAD FUNCTION
    // Attach to buttons
    document.getElementById('downloadPng').onclick = () => download('png');
    document.getElementById('downloadSvg').onclick = () => download('svg');
    document.getElementById('downloadJpg').onclick = () => download('png'); // Fallback to png if jpg not supported

    async function download(format) {
        const fd = new FormData(form);
        fd.append('format', format);

        const btn = document.getElementById('download' + format.charAt(0).toUpperCase() + format.slice(1));
        const originalText = btn.innerHTML;
        btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Processing...';
        btn.disabled = true;

        try {
            const res = await fetch('{{ route("qr.download") }}', {
                method: 'POST',
                body: fd,
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                }
            });

            if (res.ok) {
                const blob = await res.blob();
                const url = window.URL.createObjectURL(blob);
                const a = document.createElement('a');
                a.href = url;
                a.download = `qrcode.${format}`;
                document.body.appendChild(a);
                a.click();
                document.body.removeChild(a);
                window.URL.revokeObjectURL(url);
            } else {
                alert('Download failed. Server returned: ' + res.status);
            }
        } catch (e) {
            console.error(e);
            alert('An error occurred');
        } finally {
            btn.innerHTML = originalText;
            btn.disabled = false;
        }
    }
});
</script>
@endsection
