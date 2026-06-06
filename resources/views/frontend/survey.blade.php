<!DOCTYPE html>
<html lang="bn">

<head>
    @include('partials.gtm')
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Envele Apparels – Reseller Program</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        *,
        *::before,
        *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: #f0f2f5;
            min-height: 100vh;
            padding: 30px 16px 60px;
        }

        .container {
            max-width: 620px;
            margin: 0 auto;
        }

        /* ── Hero ── */
        .hero {
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%);
            border-radius: 18px;
            padding: 2rem 1.5rem 1.75rem;
            margin-bottom: 1.5rem;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .hero::before {
            content: '';
            position: absolute;
            top: -50px;
            right: -50px;
            width: 150px;
            height: 150px;
            border-radius: 50%;
            background: rgba(255, 200, 50, 0.07);
        }

        .hero::after {
            content: '';
            position: absolute;
            bottom: -40px;
            left: -40px;
            width: 110px;
            height: 110px;
            border-radius: 50%;
            background: rgba(255, 200, 50, 0.05);
        }

        .brand-label {
            font-size: 11px;
            letter-spacing: 3px;
            color: #ffc832;
            font-weight: 600;
            text-transform: uppercase;
            margin-bottom: 10px;
        }

        .hero h1 {
            font-size: 22px;
            font-weight: 700;
            color: #fff;
            line-height: 1.35;
            margin-bottom: 8px;
        }

        .hero p {
            font-size: 13px;
            color: rgba(255, 255, 255, 0.55);
        }

        .badge-row {
            display: flex;
            gap: 8px;
            justify-content: center;
            flex-wrap: wrap;
            margin-top: 16px;
        }

        .badge {
            background: rgba(255, 200, 50, 0.12);
            border: 0.5px solid rgba(255, 200, 50, 0.3);
            color: #ffc832;
            font-size: 11px;
            padding: 5px 12px;
            border-radius: 20px;
            font-weight: 500;
        }

        /* ── Step Indicator ── */
        .step-wrapper {
            margin-bottom: 1.25rem;
        }

        .step-indicator {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0;
            margin-bottom: 10px;
        }

        .step-dot {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            font-weight: 600;
            border: 1.5px solid #d0d0d0;
            color: #aaa;
            background: #fff;
            cursor: pointer;
            transition: all 0.25s;
            flex-shrink: 0;
        }

        .step-dot.active {
            background: #1a1a2e;
            color: #ffc832;
            border-color: #1a1a2e;
        }

        .step-dot.done {
            background: #ffc832;
            color: #1a1a2e;
            border-color: #ffc832;
        }

        .step-line {
            height: 2px;
            width: 50px;
            background: #e0e0e0;
            flex-shrink: 0;
            transition: background 0.3s;
        }

        .step-line.done {
            background: #ffc832;
        }

        /* Progress bar */
        .progress-bar {
            height: 4px;
            background: #e5e7eb;
            border-radius: 4px;
            overflow: hidden;
        }

        .progress-fill {
            height: 100%;
            background: linear-gradient(90deg, #ffc832, #ffb300);
            border-radius: 4px;
            transition: width 0.35s ease;
        }

        /* ── Section Card ── */
        .section-card {
            background: #fff;
            border-radius: 16px;
            padding: 1.5rem;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
            display: none;
        }

        .section-card.active {
            display: block;
        }

        .section-title {
            font-size: 11px;
            font-weight: 700;
            color: #888;
            letter-spacing: 2px;
            text-transform: uppercase;
            margin-bottom: 1.25rem;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .section-title span.icon {
            background: rgba(255, 200, 50, 0.15);
            color: #b8860b;
            width: 30px;
            height: 30px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 15px;
        }

        /* ── Fields ── */
        .field {
            margin-bottom: 1rem;
        }

        .field label {
            display: block;
            font-size: 13px;
            font-weight: 500;
            color: #444;
            margin-bottom: 7px;
        }

        .field input[type="text"],
        .field input[type="tel"],
        .field input[type="url"],
        .field select,
        .field textarea {
            width: 100%;
            padding: 11px 14px;
            border: 1.5px solid #e5e7eb;
            border-radius: 10px;
            font-size: 14px;
            font-family: 'Poppins', sans-serif;
            color: #222;
            background: #fafafa;
            outline: none;
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        .field input:focus,
        .field select:focus,
        .field textarea:focus {
            border-color: #ffc832;
            box-shadow: 0 0 0 3px rgba(255, 200, 50, 0.15);
            background: #fff;
        }

        .field textarea {
            resize: none;
            height: 90px;
            line-height: 1.6;
        }

        .field select {
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='14' height='14' viewBox='0 0 24 24' fill='none' stroke='%23888' stroke-width='2'%3E%3Cpath d='M6 9l6 6 6-6'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 14px center;
            padding-right: 36px;
        }

        /* ── Chip Select ── */
        .chip-group {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
        }

        .chip {
            padding: 8px 14px;
            border: 1.5px solid #e5e7eb;
            border-radius: 22px;
            font-size: 13px;
            cursor: pointer;
            color: #555;
            background: #fafafa;
            transition: all 0.15s;
            font-family: 'Poppins', sans-serif;
            user-select: none;
        }

        .chip:hover {
            border-color: #ffc832;
            color: #b8860b;
            background: #fffbeb;
        }

        .chip.selected {
            background: #ffc832;
            color: #1a1a2e;
            border-color: #ffc832;
            font-weight: 600;
        }

        /* ── Package Cards ── */
        .pkg-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 10px;
        }

        .pkg-card {
            border: 1.5px solid #e5e7eb;
            border-radius: 12px;
            padding: 16px 12px;
            cursor: pointer;
            transition: all 0.2s;
            text-align: center;
            background: #fafafa;
        }

        .pkg-card:hover {
            border-color: #ffc832;
            background: #fffbeb;
        }

        .pkg-card.selected {
            border-color: #ffc832;
            background: #fffbeb;
            box-shadow: 0 0 0 2px rgba(255, 200, 50, 0.25);
        }

        .pkg-icon {
            font-size: 22px;
            margin-bottom: 6px;
        }

        .pkg-name {
            font-size: 13px;
            font-weight: 600;
            color: #222;
        }

        .pkg-qty {
            font-size: 12px;
            color: #888;
            margin-top: 3px;
        }

        .pkg-card.selected .pkg-name {
            color: #b8860b;
        }

        /* ── Navigation Buttons ── */
        .nav-row {
            display: flex;
            gap: 10px;
            margin-top: 1.25rem;
        }

        .btn-back {
            flex: 1;
            padding: 12px;
            border: 1.5px solid #e5e7eb;
            border-radius: 10px;
            background: #fff;
            color: #666;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            font-family: 'Poppins', sans-serif;
            transition: all 0.15s;
        }

        .btn-back:hover {
            background: #f5f5f5;
            border-color: #ccc;
        }

        .btn-next {
            flex: 2;
            padding: 12px;
            border: none;
            border-radius: 10px;
            background: #1a1a2e;
            color: #ffc832;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            font-family: 'Poppins', sans-serif;
            transition: all 0.2s;
        }

        .btn-next:hover {
            background: #0f3460;
        }

        /* ── Agreement ── */
        .agreement-box {
            background: #f9f9f9;
            border: 1px solid #eee;
            border-radius: 10px;
            padding: 13px;
            margin-top: 1rem;
            display: flex;
            align-items: flex-start;
            gap: 10px;
        }

        .agreement-box input[type="checkbox"] {
            margin-top: 2px;
            accent-color: #ffc832;
            width: 17px;
            height: 17px;
            flex-shrink: 0;
            cursor: pointer;
        }

        .agreement-box span {
            font-size: 13px;
            color: #555;
            line-height: 1.6;
        }

        /* ── Benefits ── */
        .benefits-list {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 6px;
            margin-top: 1rem;
        }

        .benefit-item {
            display: flex;
            align-items: center;
            gap: 7px;
            font-size: 12px;
            color: #555;
        }

        .benefit-item::before {
            content: '✓';
            background: #ffc832;
            color: #1a1a2e;
            width: 18px;
            height: 18px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 10px;
            font-weight: 700;
            flex-shrink: 0;
        }

        /* ── Submit ── */
        .submit-btn {
            width: 100%;
            padding: 15px;
            border: none;
            border-radius: 12px;
            background: linear-gradient(135deg, #1a1a2e 0%, #0f3460 100%);
            color: #ffc832;
            font-size: 15px;
            font-weight: 700;
            cursor: pointer;
            font-family: 'Poppins', sans-serif;
            letter-spacing: 0.5px;
            margin-top: 1.25rem;
            transition: opacity 0.2s, transform 0.15s;
        }

        .submit-btn:hover {
            opacity: 0.92;
            transform: translateY(-1px);
        }

        .submit-btn:active {
            transform: translateY(0);
        }

        /* ── Success Message ── */
        .alert-success {
            background: #d1fae5;
            border: 1px solid #6ee7b7;
            color: #065f46;
            padding: 12px 16px;
            border-radius: 10px;
            font-size: 13px;
            font-weight: 500;
            margin-bottom: 1rem;
            text-align: center;
        }

        /* ── Validation Error ── */
        .field-error {
            font-size: 11px;
            color: #dc2626;
            margin-top: 4px;
        }

        @media (max-width: 480px) {
            .benefits-list {
                grid-template-columns: 1fr;
            }

            .step-line {
                width: 32px;
            }
        }
    </style>
</head>

<body>

    <div class="container">

        {{-- ── Hero Banner ── --}}
        <div class="hero">
            <div class="brand-label">✦ Envele Apparels ✦</div>
            <h1>Reseller Program<br>আবেদন ফর্ম</h1>
            <p>আমাদের রিসেলার পরিবারে যোগ দিন</p>
            <div class="badge-row">
                <span class="badge">🏷 Wholesale Price</span>
                <span class="badge">🚚 Nationwide Delivery</span>
                <span class="badge">🎯 Full Support</span>
            </div>
        </div>

        {{-- ── Success Message ── --}}
        @if(session('success'))
        <div class="alert-success">
            ✅ {{ session('success') }}
        </div>
        @endif

        {{-- ── Step Indicator ── --}}
        <div class="step-wrapper">
            <div class="step-indicator">
                <div class="step-dot active" id="dot-0">1</div>
                <div class="step-line" id="line-01"></div>
                <div class="step-dot" id="dot-1">2</div>
                <div class="step-line" id="line-12"></div>
                <div class="step-dot" id="dot-2">3</div>
                <div class="step-line" id="line-23"></div>
                <div class="step-dot" id="dot-3">4</div>
            </div>
            <div class="progress-bar">
                <div class="progress-fill" id="progressFill" style="width: 25%;"></div>
            </div>
        </div>

        {{-- ── FORM ── --}}
        <form method="POST" action="{{ route('reseller.store') }}" id="resellerForm">
            @csrf

            {{-- Hidden fields for chip selections --}}
            <input type="hidden" name="profession" id="h_profession">
            <input type="hidden" name="business_before" id="h_business_before">
            <input type="hidden" name="platform" id="h_platform">
            <input type="hidden" name="product" id="h_product">
            <input type="hidden" name="monthly_target" id="h_monthly_target">
            <input type="hidden" name="stock_type" id="h_stock_type">
            <input type="hidden" name="package" id="h_package">

            {{-- ════════ Step 1: Personal Info ════════ --}}
            <div class="section-card active" id="step-0">
                <div class="section-title">
                    <span class="icon">👤</span> ব্যক্তিগত তথ্য
                </div>

                <div class="field">
                    <label>পূর্ণ নাম *</label>
                    <input type="text" name="full_name" value="{{ old('full_name') }}"
                        placeholder="আপনার পূর্ণ নাম লিখুন" required>
                    @error('full_name')
                    <div class="field-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="field">
                    <label>মোবাইল নম্বর (WhatsApp) *</label>
                    <input type="tel" name="mobile" value="{{ old('mobile') }}"
                        placeholder="01XXXXXXXXX" required>
                    @error('mobile')
                    <div class="field-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="field">
                    <label>Facebook Profile Link *</label>
                    <input type="url" name="facebook" value="{{ old('facebook') }}"
                        placeholder="https://facebook.com/yourprofile" required>
                    @error('facebook')
                    <div class="field-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="field">
                    <label>জেলা / এলাকা *</label>
                    <input type="text" name="district" value="{{ old('district') }}"
                        placeholder="আপনার জেলা বা এলাকার নাম" required>
                    @error('district')
                    <div class="field-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="field">
                    <label>বর্তমান পেশা *</label>
                    <div class="chip-group" data-id="profession" data-multi="false">
                        <div class="chip" data-val="Student">Student</div>
                        <div class="chip" data-val="Job Holder">Job Holder</div>
                        <div class="chip" data-val="Business Owner">Business Owner</div>
                        <div class="chip" data-val="Freelancer">Freelancer</div>
                        <div class="chip" data-val="Housewife">Housewife</div>
                        <div class="chip" data-val="Other">Other</div>
                    </div>
                    @error('profession')
                    <div class="field-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="nav-row">
                    <button type="button" class="btn-next" onclick="goStep(1)">
                        পরবর্তী →
                    </button>
                </div>
            </div>

            {{-- ════════ Step 2: Business Info ════════ --}}
            <div class="section-card" id="step-1">
                <div class="section-title">
                    <span class="icon">🏪</span> ব্যবসায়িক তথ্য
                </div>

                <div class="field">
                    <label>আগে কি Online Business করেছেন?</label>
                    <div class="chip-group" data-id="business_before" data-multi="false">
                        <div class="chip" data-val="Yes">হ্যাঁ, করেছি</div>
                        <div class="chip" data-val="No">না, নতুন শুরু করব</div>
                    </div>
                    @error('business_before')
                    <div class="field-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="field">
                    <label>কোন Platform এ কাজ করবেন? (একাধিক বেছে নিন)</label>
                    <div class="chip-group" data-id="platform" data-multi="true">
                        <div class="chip" data-val="Facebook">Facebook</div>
                        <div class="chip" data-val="TikTok">TikTok</div>
                        <div class="chip" data-val="Instagram">Instagram</div>
                        <div class="chip" data-val="Physical Shop">Physical Shop</div>
                        <div class="chip" data-val="Live Selling">Live Selling</div>
                    </div>
                    @error('platform')
                    <div class="field-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="field">
                    <label>কোন Product নিয়ে কাজ করতে চান? (একাধিক বেছে নিন)</label>
                    <div class="chip-group" data-id="product" data-multi="true">
                        <div class="chip" data-val="Old Money Polo">Old Money Polo</div>
                        <div class="chip" data-val="Oversized T-shirt">Oversized T-shirt</div>
                        <div class="chip" data-val="Jersey">Jersey</div>
                        <div class="chip" data-val="Punjabi">Punjabi</div>
                        <div class="chip" data-val="Kids Wear">Kids Wear</div>
                        <div class="chip" data-val="All Products">All Products ✦</div>
                    </div>
                    @error('product')
                    <div class="field-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="nav-row">
                    <button type="button" class="btn-back" onclick="goStep(0)">← আগে</button>
                    <button type="button" class="btn-next" onclick="goStep(2)">পরবর্তী →</button>
                </div>
            </div>

            {{-- ════════ Step 3: Target & Package ════════ --}}
            <div class="section-card" id="step-2">
                <div class="section-title">
                    <span class="icon">🎯</span> লক্ষ্যমাত্রা ও প্যাকেজ
                </div>

                <div class="field">
                    <label>Monthly কত পিস Sell করার Target আছে?</label>
                    <div class="chip-group" data-id="monthly_target" data-multi="false">
                        <div class="chip" data-val="10-20 pcs">10–20 পিস</div>
                        <div class="chip" data-val="20-50 pcs">20–50 পিস</div>
                        <div class="chip" data-val="100-200 pcs">100–200 পিস</div>
                        <div class="chip" data-val="500-1000+ pcs">500–1000+ পিস</div>
                    </div>
                    @error('monthly_target')
                    <div class="field-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="field">
                    <label>আপনি কি Stock নিয়ে কাজ করবেন?</label>
                    <div class="chip-group" data-id="stock_type" data-multi="false">
                        <div class="chip" data-val="Yes">হ্যাঁ, Stock নেব</div>
                        <div class="chip" data-val="No">না</div>
                        <div class="chip" data-val="Pre-Order">Pre-Order ভিত্তিক</div>
                    </div>
                    @error('stock_type')
                    <div class="field-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="field">
                    <label>কোন Package নিতে চান?</label>
                    <div class="pkg-grid">
                        <div class="pkg-card" data-pkg="Starter" onclick="selectPkg(this)">
                            <div class="pkg-icon">🌱</div>
                            <div class="pkg-name">Starter</div>
                            <div class="pkg-qty">10 পিস</div>
                        </div>
                        <div class="pkg-card" data-pkg="Silver" onclick="selectPkg(this)">
                            <div class="pkg-icon">🥈</div>
                            <div class="pkg-name">Silver</div>
                            <div class="pkg-qty">50 পিস</div>
                        </div>
                        <div class="pkg-card" data-pkg="Gold" onclick="selectPkg(this)">
                            <div class="pkg-icon">🥇</div>
                            <div class="pkg-name">Gold</div>
                            <div class="pkg-qty">500 পিস</div>
                        </div>
                        <div class="pkg-card" data-pkg="Dealer" onclick="selectPkg(this)">
                            <div class="pkg-icon">💎</div>
                            <div class="pkg-name">Dealer</div>
                            <div class="pkg-qty">1000+ পিস</div>
                        </div>
                    </div>
                    @error('package')
                    <div class="field-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="nav-row">
                    <button type="button" class="btn-back" onclick="goStep(1)">← আগে</button>
                    <button type="button" class="btn-next" onclick="goStep(3)">পরবর্তী →</button>
                </div>
            </div>

            {{-- ════════ Step 4: Final & Submit ════════ --}}
            <div class="section-card" id="step-3">
                <div class="section-title">
                    <span class="icon">📋</span> চূড়ান্ত তথ্য
                </div>

                <div class="field">
                    <label>কেন Envele Apparels-এর সাথে কাজ করতে চান? *</label>
                    <textarea name="reason" placeholder="আপনার কারণ সংক্ষেপে লিখুন..." required>{{ old('reason') }}</textarea>
                    @error('reason')
                    <div class="field-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="agreement-box">
                    <input type="checkbox" name="agreement" id="agreement" value="1" required>
                    <span>আমি Envele Apparels-এর সকল Rules & Policies পড়েছি এবং মেনে চলতে সম্মত আছি।</span>
                </div>
                @error('agreement')
                <div class="field-error" style="margin-top:6px;">{{ $message }}</div>
                @enderror

                <div class="benefits-list" style="margin-top:1.25rem;">
                    <div class="benefit-item">Wholesale Price পাবেন</div>
                    <div class="benefit-item">Product Photo & Video</div>
                    <div class="benefit-item">Marketing Support</div>
                    <div class="benefit-item">Courier Support</div>
                    <div class="benefit-item">New Arrival Update</div>
                    <div class="benefit-item">Business Guidance</div>
                </div>

                <div class="nav-row">
                    <button type="button" class="btn-back" onclick="goStep(2)">← আগে</button>
                </div>

                <button type="submit" class="submit-btn" onclick="syncHidden()">
                    🚀 আবেদন সম্পন্ন করুন
                </button>
            </div>

        </form>
    </div>

    <script>
        let currentStep = 0;
        const totalSteps = 4;

        // ── Chip selection logic ──
        document.querySelectorAll('.chip-group').forEach(function(group) {
            var isMulti = group.dataset.multi === 'true';
            group.querySelectorAll('.chip').forEach(function(chip) {
                chip.addEventListener('click', function() {
                    if (isMulti) {
                        chip.classList.toggle('selected');
                    } else {
                        group.querySelectorAll('.chip').forEach(function(c) {
                            c.classList.remove('selected');
                        });
                        chip.classList.add('selected');
                    }
                });
            });
        });

        // ── Package card selection ──
        function selectPkg(el) {
            document.querySelectorAll('.pkg-card').forEach(function(c) {
                c.classList.remove('selected');
            });
            el.classList.add('selected');
        }

        // ── Sync chip values to hidden inputs before submit ──
        function syncHidden() {
            document.querySelectorAll('.chip-group').forEach(function(group) {
                var id = group.dataset.id;
                var isMulti = group.dataset.multi === 'true';
                var selected = [];
                group.querySelectorAll('.chip.selected').forEach(function(c) {
                    selected.push(c.dataset.val);
                });
                var hiddenEl = document.getElementById('h_' + id);
                if (hiddenEl) hiddenEl.value = selected.join(', ');
            });

            // Package
            var selectedPkg = document.querySelector('.pkg-card.selected');
            if (selectedPkg) {
                document.getElementById('h_package').value = selectedPkg.dataset.pkg;
            }
        }

        // ── Step navigation ──
        function goStep(n) {
            currentStep = n;
            updateUI();
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        }

        function updateUI() {
            // Cards
            for (var i = 0; i < totalSteps; i++) {
                var card = document.getElementById('step-' + i);
                if (card) {
                    card.classList.toggle('active', i === currentStep);
                }
            }
            // Dots
            for (var i = 0; i < totalSteps; i++) {
                var dot = document.getElementById('dot-' + i);
                if (!dot) continue;
                dot.classList.remove('active', 'done');
                if (i === currentStep) dot.classList.add('active');
                else if (i < currentStep) dot.classList.add('done');
            }
            // Lines
            var lines = [{
                    id: 'line-01',
                    done: currentStep > 0
                },
                {
                    id: 'line-12',
                    done: currentStep > 1
                },
                {
                    id: 'line-23',
                    done: currentStep > 2
                },
            ];
            lines.forEach(function(l) {
                var el = document.getElementById(l.id);
                if (el) el.classList.toggle('done', l.done);
            });
            // Progress
            var pct = ((currentStep + 1) / totalSteps * 100).toFixed(0) + '%';
            document.getElementById('progressFill').style.width = pct;
        }
    </script>

</body>

</html>