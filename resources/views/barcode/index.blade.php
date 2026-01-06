@extends('layouts.app')

@section('content')
<div class="generator-container">
    <!-- Page Header -->
    <div class="text-center mb-5">
        <h1 class="hero-title">Barcode Generator</h1>
        <p class="hero-subtitle">Create professional barcodes instantly. No signup required, no watermarks, unlimited use.</p>
    </div>

    <!-- Barcode Details Card -->
    <div class="card-modern mb-4">
        <div class="card-header-modern">
            <i class="fas fa-barcode me-2"></i>
            Barcode Details
        </div>
        <div class="card-body-modern">
            <form id="barcodeForm" enctype="multipart/form-data">
                @csrf

                <div class="row g-4">
                    <!-- Barcode Type Selection -->
                    <div class="col-lg-6">
                        <label class="form-label fw-semibold">Barcode Type</label>
                        <select class="form-select form-control-modern" name="type" id="type" required>
                            <optgroup label="Most Common">
                                <option value="code128" selected>Code 128 (Alphanumeric)</option>
                                <option value="code39">Code 39 (Alphanumeric)</option>
                                <option value="ean13">EAN-13 (Product Numbers)</option>
                            </optgroup>
                            <optgroup label="Retail & Products">
                                <option value="upca">UPC-A (US Products)</option>
                                <option value="upce">UPC-E (Compressed UPC)</option>
                                <option value="ean8">EAN-8 (Small Products)</option>
                            </optgroup>
                            <optgroup label="Specialized">
                                <option value="itf">ITF (Shipping/Logistics)</option>
                                <option value="isbn">ISBN (Books)</option>
                                <option value="codabar">Codabar (Libraries)</option>
                            </optgroup>
                        </select>

                        <!-- Type Description -->
                        <div class="type-description mt-3 p-3 rounded-3" style="background: #f8fafc; border-left: 4px solid var(--primary-color);">
                            <h6 class="fw-semibold mb-2" id="typeName">Code 128</h6>
                            <p class="text-muted small mb-2" id="typeDesc">Supports all 128 ASCII characters. Most widely used barcode format.</p>
                            <p class="mb-1"><small><strong>Format:</strong> <span id="typeFormat">Alphanumeric</span></small></p>
                            <p class="mb-0"><small><strong>Common Use:</strong> <span id="typeUse">Logistics, packaging, inventory</span></small></p>
                        </div>
                    </div>

                    <!-- Data Input -->
                    <div class="col-lg-6">
                        <label class="form-label fw-semibold">Barcode Data / Number</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-keyboard"></i></span>
                            <input type="text" class="form-control form-control-modern" name="data" id="data" placeholder="Enter text or number" required>
                        </div>

                        <!-- Format Validation -->
                        <div class="format-validation mt-3">
                            <div class="d-flex align-items-center mb-2">
                                <span class="badge bg-primary me-2" id="formatBadge">ALPHANUMERIC</span>
                                <span class="text-muted small" id="charCount">Enter data to see character count</span>
                            </div>
                            <div class="progress" style="height: 6px;">
                                <div class="progress-bar bg-success" id="validationProgress" role="progressbar" style="width: 0%"></div>
                            </div>
                            <div class="form-text mt-2">
                                <i class="fas fa-info-circle me-1"></i>
                                <span id="formatHint">Enter letters, numbers, and basic symbols</span>
                            </div>
                        </div>

                        <!-- Example Data -->
                        <div class="mt-4">
                            <p class="text-muted small mb-2">Try example data:</p>
                            <div class="d-flex flex-wrap gap-2">
                                <button type="button" class="btn btn-sm btn-modern-outline" onclick="setExample('123456789012')">EAN-13 Number</button>
                                <button type="button" class="btn btn-sm btn-modern-outline" onclick="setExample('PROD-2024-001')">Product Code</button>
                                <button type="button" class="btn btn-sm btn-modern-outline" onclick="setExample('978-3-16-148410-0')">ISBN</button>
                                <button type="button" class="btn btn-sm btn-modern-outline" onclick="setExample('ABC123XYZ')">Alphanumeric</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Customization Options -->
    <div class="card-modern mb-4">
        <div class="card-header-modern">
            <i class="fas fa-sliders-h me-2"></i>
            Customization
        </div>
        <div class="card-body-modern">
            <div class="row g-4">
                <!-- Dimensions -->
                <div class="col-lg-4 col-md-6">
                    <label class="form-label fw-semibold d-flex justify-content-between">
                        <span>Width Factor</span>
                        <span class="badge bg-primary" id="widthValue">2x</span>
                    </label>
                    <input type="range" class="form-range custom-slider" name="width" id="width" min="1" max="5" value="2" step="0.5">
                    <div class="d-flex justify-content-between mt-1">
                        <small class="text-muted">Thin</small>
                        <small class="text-muted">Thick</small>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <label class="form-label fw-semibold d-flex justify-content-between">
                        <span>Height</span>
                        <span class="badge bg-primary" id="heightValue">100px</span>
                    </label>
                    <input type="range" class="form-range custom-slider" name="height" id="height" min="30" max="200" value="100">
                    <div class="d-flex justify-content-between mt-1">
                        <small class="text-muted">Short</small>
                        <small class="text-muted">Tall</small>
                    </div>
                </div>

                <!-- Colors -->
                <div class="col-lg-4 col-md-6">
                    <label class="form-label fw-semibold">Bar Color</label>
                    <div class="color-picker-wrapper">
                        <div class="d-flex align-items-center">
                            <input type="color" class="form-control form-control-color" name="color" id="color" value="#000000">
                            <div class="ms-3">
                                <div class="fw-semibold" id="colorHex">#000000</div>
                                <div class="color-presets mt-2">
                                    <div class="d-flex gap-2">
                                        <button type="button" class="color-preset" style="background: #000000;" onclick="setColor('#000000')"></button>
                                        <button type="button" class="color-preset" style="background: #1e40af;" onclick="setColor('#1e40af')"></button>
                                        <button type="button" class="color-preset" style="background: #059669;" onclick="setColor('#059669')"></button>
                                        <button type="button" class="color-preset" style="background: #7c3aed;" onclick="setColor('#7c3aed')"></button>
                                        <button type="button" class="color-preset" style="background: #dc2626;" onclick="setColor('#dc2626')"></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Display Options -->
                <div class="col-lg-4 col-md-6">
                    <label class="form-label fw-semibold">Show Text Below</label>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" name="show_text" id="show_text" checked style="width: 3em; height: 1.5em;">
                        <label class="form-check-label ms-3" for="show_text">
                            <span class="fw-medium">Display human-readable text</span>
                            <small class="d-block text-muted">Recommended for product labels</small>
                        </label>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <label class="form-label fw-semibold">Text Size</label>
                    <select class="form-select form-control-modern" name="text_size" id="text_size">
                        <option value="small">Small</option>
                        <option value="medium" selected>Medium</option>
                        <option value="large">Large</option>
                        <option value="xlarge">Extra Large</option>
                    </select>
                </div>

                <div class="col-lg-4 col-md-6">
                    <label class="form-label fw-semibold">Background</label>
                    <div class="d-flex align-items-center">
                        <input type="color" class="form-control form-control-color" name="bg_color" id="bg_color" value="#ffffff">
                        <div class="ms-3">
                            <div class="fw-semibold" id="bgColorHex">#FFFFFF</div>
                            <div class="form-check mt-2">
                                <input class="form-check-input" type="checkbox" name="transparent_bg" id="transparent_bg">
                                <label class="form-check-label" for="transparent_bg">Transparent background</label>
                            </div>
                        </div>
                    </div>
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
            <div class="preview-area mb-4 p-4 rounded-3 position-relative" style="background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%); min-height: 300px; display: flex; align-items: center; justify-content: center;">
                <div id="previewContainer">
                    <img id="barcodePreview" src="" alt="Barcode Preview" class="img-fluid" style="max-height: 250px; display: none; transition: all 0.3s ease;">
                    <div class="placeholder-message" id="placeholderText" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); text-align: center; color: #64748b;">
                        <i class="fas fa-barcode display-1 mb-3" style="color: #cbd5e1;"></i>
                        <p class="lead">Enter data to see your barcode preview</p>
                        <p class="text-muted small">Select a barcode type and enter valid data</p>
                    </div>
                </div>
                <div class="loading-overlay" id="loadingOverlay" style="display: none; position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: rgba(255,255,255,0.9); display: flex; align-items: center; justify-content: center; z-index: 10;">
                    <div class="text-center">
                        <div class="spinner-border text-success mb-3" role="status"></div>
                        <p>Generating Barcode...</p>
                    </div>
                </div>
            </div>

            <!-- Download Buttons -->
            <div class="action-buttons">
                <button type="button" class="btn btn-modern btn-lg px-5" id="downloadPng" style="background: linear-gradient(90deg, #10b981, #059669);">
                    <i class="fas fa-download me-2"></i>
                    Download PNG
                </button>
                <button type="button" class="btn btn-modern-outline btn-lg px-5" id="downloadSvg">
                    <i class="fas fa-download me-2"></i>
                    Download SVG
                </button>
                <button type="button" class="btn btn-modern-outline btn-lg px-5" id="downloadPdf">
                    <i class="fas fa-file-pdf me-2"></i>
                    Download PDF
                </button>
            </div>

            <!-- Format Info -->
            <div class="mt-4">
                <div class="d-flex justify-content-center gap-4">
                    <div class="text-center">
                        <div class="badge bg-success-subtle text-success mb-2">PNG</div>
                        <p class="text-muted small mb-0">For web & printing</p>
                    </div>
                    <div class="text-center">
                        <div class="badge bg-primary-subtle text-primary mb-2">SVG</div>
                        <p class="text-muted small mb-0">Scalable vector</p>
                    </div>
                    <div class="text-center">
                        <div class="badge bg-danger-subtle text-danger mb-2">PDF</div>
                        <p class="text-muted small mb-0">Document ready</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Barcode Types Reference -->
    <div class="row mt-5">
        <div class="col-12">
            <div class="card-modern">
                <div class="card-body-modern">
                    <h5 class="mb-4" style="color: var(--primary-color);">
                        <i class="fas fa-book me-2"></i>
                        Barcode Types Reference
                    </h5>
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <div class="type-card p-3 rounded-3" style="background: #f0f9ff; border: 1px solid #bae6fd;">
                                <h6 class="fw-semibold text-primary mb-2">Code 128</h6>
                                <p class="text-muted small mb-2">High-density alphanumeric barcode for logistics and inventory.</p>
                                <span class="badge bg-primary-subtle text-primary">Alphanumeric</span>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="type-card p-3 rounded-3" style="background: #f0fdf4; border: 1px solid #bbf7d0;">
                                <h6 class="fw-semibold text-success mb-2">EAN-13</h6>
                                <p class="text-muted small mb-2">13-digit product numbering system used worldwide.</p>
                                <span class="badge bg-success-subtle text-success">Numbers Only</span>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="type-card p-3 rounded-3" style="background: #fef2f2; border: 1px solid #fecaca;">
                                <h6 class="fw-semibold text-danger mb-2">UPC-A</h6>
                                <p class="text-muted small mb-2">12-digit barcode for retail products in North America.</p>
                                <span class="badge bg-danger-subtle text-danger">12 Digits</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* Custom styles for Barcode generator */
    .custom-slider {
        height: 8px;
        border-radius: 4px;
        background: #e2e8f0;
    }

    .custom-slider::-webkit-slider-thumb {
        background: linear-gradient(90deg, #10b981, #059669);
        width: 24px;
        height: 24px;
        border-radius: 50%;
        border: 3px solid white;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
    }

    .custom-slider::-moz-range-thumb {
        background: linear-gradient(90deg, #10b981, #059669);
        width: 24px;
        height: 24px;
        border-radius: 50%;
        border: 3px solid white;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
    }

    .type-description {
        transition: all 0.3s ease;
    }

    .color-preset {
        width: 24px;
        height: 24px;
        border-radius: 50%;
        border: 2px solid white;
        cursor: pointer;
        transition: transform 0.2s ease;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .color-preset:hover {
        transform: scale(1.1);
    }

    .type-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        cursor: pointer;
    }

    .type-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
    }

    .form-check-input:checked {
        background-color: #10b981;
        border-color: #10b981;
    }

    .form-switch .form-check-input {
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='-4 -4 8 8'%3e%3ccircle r='3' fill='%23fff'/%3e%3c/svg%3e");
    }

    .format-validation {
        background: #f8fafc;
        border-radius: 12px;
        padding: 15px;
    }

    @media (max-width: 768px) {
        .color-picker-wrapper .d-flex {
            flex-direction: column;
            align-items: flex-start;
        }

        .color-picker-wrapper .ms-3 {
            margin-left: 0 !important;
            margin-top: 15px;
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
document.addEventListener('DOMContentLoaded', function () {
    // DOM Elements
    const form = document.getElementById('barcodeForm');
    const preview = document.getElementById('barcodePreview');
    const placeholder = document.getElementById('placeholderText');
    const loadingOverlay = document.getElementById('loadingOverlay');
    const typeSelect = document.getElementById('type');
    const dataInput = document.getElementById('data');
    const widthSlider = document.getElementById('width');
    const heightSlider = document.getElementById('height');
    const widthValue = document.getElementById('widthValue');
    const heightValue = document.getElementById('heightValue');
    const colorPicker = document.getElementById('color');
    const colorHex = document.getElementById('colorHex');
    const bgColorPicker = document.getElementById('bg_color');
    const bgColorHex = document.getElementById('bgColorHex');

    // Barcode type information
    const typeInfo = {
        code128: {
            name: 'Code 128',
            desc: 'Supports all 128 ASCII characters. Most widely used barcode format.',
            format: 'Alphanumeric',
            use: 'Logistics, packaging, inventory',
            hint: 'Enter letters, numbers, and basic symbols',
            pattern: /^[\x00-\x7F]+$/
        },
        code39: {
            name: 'Code 39',
            desc: 'Alphanumeric barcode with start/stop characters.',
            format: 'Alphanumeric + symbols',
            use: 'Industrial, automotive, government',
            hint: 'Letters, numbers, space, -, ., $, /, +, %',
            pattern: /^[A-Z0-9\s\-\$\/\+\.\%]+$/i
        },
        ean13: {
            name: 'EAN-13',
            desc: '13-digit product numbering system used worldwide.',
            format: 'Numbers only (12 or 13)',
            use: 'Retail products globally',
            hint: '12 or 13 digits (last digit is check digit)',
            pattern: /^\d{12,13}$/
        },
        ean8: {
            name: 'EAN-8',
            desc: 'Compressed version of EAN-13 for small products.',
            format: 'Numbers only (7 or 8)',
            use: 'Small retail products',
            hint: '7 or 8 digits (last digit is check digit)',
            pattern: /^\d{7,8}$/
        },
        upca: {
            name: 'UPC-A',
            desc: '12-digit barcode for retail products in North America.',
            format: 'Numbers only (11 or 12)',
            use: 'US/Canada retail',
            hint: '11 or 12 digits (last digit is check digit)',
            pattern: /^\d{11,12}$/
        },
        upce: {
            name: 'UPC-E',
            desc: 'Compressed version of UPC-A for small packages.',
            format: 'Numbers only (6, 7, or 8)',
            use: 'Small retail products',
            hint: '6, 7, or 8 digits',
            pattern: /^\d{6,8}$/
        },
        itf: {
            name: 'ITF-14',
            desc: 'Interleaved 2 of 5, used for shipping containers.',
            format: 'Numbers only (even digits)',
            use: 'Shipping, logistics',
            hint: 'Even number of digits',
            pattern: /^\d{2,}$/
        },
        isbn: {
            name: 'ISBN',
            desc: 'International Standard Book Number.',
            format: 'Numbers with hyphens',
            use: 'Books',
            hint: 'ISBN-10 or ISBN-13 format',
            pattern: /^(?:\d{9}[\dX]|\d{13})$/
        },
        codabar: {
            name: 'Codabar',
            desc: 'Used in libraries, blood banks, and photo labs.',
            format: 'Numbers, -, $, :, /, ., +',
            use: 'Libraries, healthcare',
            hint: 'Numbers and limited symbols',
            pattern: /^[0-9\-\$\:\.\/\+]+$/
        }
    };

    // Initialize
    updateTypeInfo();
    updateSliderValues();
    validateInput();

    // Update slider values display
    function updateSliderValues() {
        widthValue.textContent = `${widthSlider.value}x`;
        heightValue.textContent = `${heightSlider.value}px`;
        colorHex.textContent = colorPicker.value.toUpperCase();
        bgColorHex.textContent = bgColorPicker.value.toUpperCase();
    }

    // Update type information
    function updateTypeInfo() {
        const type = typeSelect.value;
        const info = typeInfo[type];

        document.getElementById('typeName').textContent = info.name;
        document.getElementById('typeDesc').textContent = info.desc;
        document.getElementById('typeFormat').textContent = info.format;
        document.getElementById('typeUse').textContent = info.use;
        document.getElementById('formatHint').textContent = info.hint;
        document.getElementById('formatBadge').textContent = info.format.toUpperCase();

        validateInput();
    }

    // Validate input based on type
    function validateInput() {
        const type = typeSelect.value;
        const data = dataInput.value;
        const info = typeInfo[type];
        const charCount = document.getElementById('charCount');
        const progressBar = document.getElementById('validationProgress');

        // Update character count
        charCount.textContent = `${data.length} characters`;

        // Validate pattern
        if (!data.trim()) {
            progressBar.style.width = '0%';
            progressBar.classList.remove('bg-success', 'bg-warning', 'bg-danger');
            return false;
        }

        const isValid = info.pattern.test(data);
        const strength = Math.min((data.length / 20) * 100, 100);

        if (isValid) {
            progressBar.style.width = `${strength}%`;
            progressBar.className = 'progress-bar bg-success';
        } else {
            progressBar.style.width = '100%';
            progressBar.className = 'progress-bar bg-danger';
        }

        return isValid;
    }

    // Set example data
    window.setExample = function(example) {
        dataInput.value = example;
        validateInput();
        generatePreview();
    }

    // Set color from preset
    window.setColor = function(color) {
        colorPicker.value = color;
        colorHex.textContent = color.toUpperCase();
        generatePreview();
    }

    // Event Listeners
    typeSelect.addEventListener('change', function() {
        updateTypeInfo();
        generatePreview();
    });

    dataInput.addEventListener('input', function() {
        validateInput();
        generatePreview();
    });

    [widthSlider, heightSlider, colorPicker, bgColorPicker].forEach(el => {
        el.addEventListener('input', function() {
            updateSliderValues();
            generatePreview();
        });
    });

    form.querySelectorAll('select, input[type="checkbox"]').forEach(el => {
        el.addEventListener('change', generatePreview);
    });

    // Generate preview with debouncing
    let generateTimeout;
    async function generatePreview() {
        clearTimeout(generateTimeout);

        generateTimeout = setTimeout(async () => {
            const formData = new FormData(form);

            // Basic validation
            if (!formData.get('data').trim()) {
                preview.style.display = 'none';
                placeholder.style.display = 'block';
                return;
            }

            // Validate format
            if (!validateInput()) {
                preview.style.display = 'none';
                placeholder.style.display = 'block';
                return;
            }

            try {
                loadingOverlay.style.display = 'flex';

                const response = await fetch('{{ route("barcode.generate") }}', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                });

              if (response.ok) {
                    const svgText = await response.text();

                    // Convert the SVG string to a Blob
                    const blob = new Blob([svgText], { type: 'image/svg+xml' });
                    const url = URL.createObjectURL(blob);

                    preview.src = url;
                    preview.style.display = 'block';
                    placeholder.style.display = 'none';
                } else {
                    const error = await response.text();
                    console.error('Generation error:', error);
                    alert('Invalid data for selected barcode type.');
                }
            } catch (err) {
                console.error('Preview error:', err);
                alert('Network error. Please try again.');
            } finally {
                loadingOverlay.style.display = 'none';
            }
        }, 300); // 300ms debounce
    }

    // Download functions
    document.getElementById('downloadPng').addEventListener('click', () => download('png'));
    document.getElementById('downloadSvg').addEventListener('click', () => download('svg'));
    document.getElementById('downloadPdf').addEventListener('click', () => download('pdf'));

    async function download(format) {
        const formData = new FormData(form);
        formData.append('format', format);

        // Validate before download
        if (!formData.get('data').trim()) {
            alert('Please enter barcode data first');
            return;
        }

        if (!validateInput()) {
            alert('Invalid data format for selected barcode type');
            return;
        }

        const button = event.target;
        const originalText = button.innerHTML;
        button.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Preparing...';
        button.disabled = true;

        try {
            const response = await fetch('{{ route("barcode.download") }}', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            });

            if (response.ok) {
                const blob = await response.blob();
                const url = URL.createObjectURL(blob);
                const a = document.createElement('a');
                a.href = url;
                a.download = `barcode-${Date.now()}.${format}`;
                document.body.appendChild(a);
                a.click();
                document.body.removeChild(a);
                URL.revokeObjectURL(url);
            } else {
                const error = await response.text();
                alert('Error generating barcode: ' + error);
            }
        } catch (err) {
            console.error('Download error:', err);
            alert('Download failed. Please try again.');
        } finally {
            button.innerHTML = originalText;
            button.disabled = false;
        }
    }

    // Initial preview
    generatePreview();
});
</script>
@endsection
