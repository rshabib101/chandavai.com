<!DOCTYPE html>
<html lang="bn">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Wallet & Earnings - chanda vai</title>

    <!-- Fonts & Icons -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            -webkit-tap-highlight-color: transparent;
        }

        body {
            background-color: #f2f4f7;
            color: #1e293b;
            min-height: 100vh;
            padding-bottom: 90px;
        }

        .app-container {
            max-width: 480px;
            margin: 0 auto;
            min-height: 100vh;
            position: relative;
            background-color: #f2f4f7;
            padding: 16px 16px 80px 16px;
        }

        /* VIEW TOGGLE ANIMATION */
        .page-view {
            display: none;
            opacity: 0;
            transition: opacity 0.25s ease-in-out;
        }

        .page-view.active {
            display: block;
            opacity: 1;
        }

        /* TOP NAVIGATION HEADER */
        .top-nav-bar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
            padding: 6px 0;
        }

        .nav-back-btn {
            background: none;
            border: none;
            font-size: 20px;
            color: #0f172a;
            cursor: pointer;
            width: 36px;
            height: 36px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            transition: background 0.2s;
        }

        .nav-back-btn:hover {
            background: rgba(0, 0, 0, 0.05);
        }

        .nav-page-title {
            font-size: 20px;
            font-weight: 700;
            color: #0f172a;
        }

        .currency-dropdown-btn {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 20px;
            padding: 6px 14px;
            font-size: 13px;
            font-weight: 600;
            color: #0f172a;
            display: flex;
            align-items: center;
            gap: 6px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.04);
            cursor: pointer;
        }

        .balance-top-pill {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 20px;
            padding: 5px 12px;
            font-size: 13px;
            font-weight: 600;
            color: #64748b;
            display: flex;
            align-items: center;
            gap: 6px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.04);
        }

        .balance-top-pill strong {
            color: #0f172a;
            font-weight: 700;
        }

        /* CARD CONTAINERS */
        .white-card {
            background: #ffffff;
            border-radius: 24px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.03);
            border: 1px solid rgba(226, 232, 240, 0.7);
        }

        /* MAIN BALANCE HERO CARD (WALLETS) */
        .total-balance-label {
            font-size: 14px;
            font-weight: 500;
            color: #64748b;
            margin-bottom: 6px;
        }

        .total-balance-amount {
            font-size: 34px;
            font-weight: 800;
            color: #0f172a;
            line-height: 1.1;
            margin-bottom: 6px;
            letter-spacing: -0.5px;
        }

        .total-coins-sub {
            font-size: 14px;
            color: #64748b;
            display: flex;
            align-items: center;
            gap: 5px;
            margin-bottom: 20px;
        }

        .wallet-action-buttons {
            display: flex;
            gap: 12px;
        }

        .btn-cashout-main {
            flex: 1.2;
            background: linear-gradient(135deg, #ff0844 0%, #ff4e50 50%, #f97316 100%);
            color: #ffffff;
            border: none;
            border-radius: 25px;
            padding: 13px 18px;
            font-size: 15px;
            font-weight: 700;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            cursor: pointer;
            box-shadow: 0 4px 14px rgba(255, 78, 80, 0.35);
            transition: transform 0.2s, box-shadow 0.2s;
            text-decoration: none;
        }

        .btn-cashout-main:active {
            transform: scale(0.98);
        }

        .btn-payments-sub {
            flex: 1;
            background: #f1f5f9;
            color: #1e293b;
            border: 1px solid #e2e8f0;
            border-radius: 25px;
            padding: 13px 18px;
            font-size: 15px;
            font-weight: 600;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            cursor: pointer;
            transition: background 0.2s;
        }

        .btn-payments-sub:hover {
            background: #e2e8f0;
        }

        /* SECTION TITLES */
        .section-header-title {
            font-size: 17px;
            font-weight: 700;
            color: #0f172a;
            margin-bottom: 14px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        /* EARNINGS OVERVIEW 2x2 GRID */
        .earnings-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 14px;
            margin-bottom: 24px;
        }

        .earning-overview-card {
            background: #ffffff;
            border-radius: 20px;
            padding: 16px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.02);
            border: 1px solid #e2e8f0;
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .earning-card-top {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .icon-circle {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
        }

        .icon-circle.green {
            background: #e6f4ea;
            color: #16a34a;
        }

        .icon-circle.blue {
            background: #e8f0fe;
            color: #2563eb;
        }

        .icon-circle.purple {
            background: #f3e8ff;
            color: #9333ea;
        }

        .earning-card-meta {
            display: flex;
            flex-direction: column;
        }

        .earning-card-name {
            font-size: 14px;
            font-weight: 700;
            color: #0f172a;
        }

        .earning-card-date {
            font-size: 11px;
            color: #94a3b8;
            font-weight: 500;
        }

        .earning-card-val {
            font-size: 22px;
            font-weight: 800;
            color: #0f172a;
            display: flex;
            align-items: center;
            gap: 6px;
            margin-top: 4px;
        }

        .earning-card-sub {
            font-size: 13px;
            color: #64748b;
            font-weight: 500;
        }

        /* SUPPORT CARD */
        .support-card {
            background: #ffffff;
            border-radius: 20px;
            padding: 16px 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.02);
            border: 1px solid #e2e8f0;
            margin-bottom: 24px;
            cursor: pointer;
            transition: background 0.2s;
        }

        .support-card:hover {
            background: #f8fafc;
        }

        .support-left {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .support-icon-circle {
            width: 44px;
            height: 44px;
            background: #f1f5f9;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            color: #334155;
        }

        .support-info-title {
            font-size: 15px;
            font-weight: 700;
            color: #0f172a;
        }

        .support-info-sub {
            font-size: 12px;
            color: #64748b;
        }

        .support-status-online {
            font-size: 13px;
            font-weight: 600;
            color: #16a34a;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .online-dot {
            width: 8px;
            height: 8px;
            background: #22c55e;
            border-radius: 50%;
            display: inline-block;
        }

        /* CASH OUT SCREEN STYLES (SCREEN 1) */
        .select-amount-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 14px;
        }

        .select-amount-title {
            font-size: 16px;
            font-weight: 700;
            color: #0f172a;
        }

        .selected-coins-badge {
            background: #fff7ed;
            border: 1px solid #fdba74;
            border-radius: 16px;
            padding: 4px 12px;
            font-size: 13px;
            font-weight: 700;
            color: #ea580c;
        }

        .amount-options-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 12px;
            margin-bottom: 6px;
        }

        .amount-option-card {
            background: #f8fafc;
            border: 1.5px solid #e2e8f0;
            border-radius: 16px;
            padding: 14px 10px;
            text-align: center;
            cursor: pointer;
            transition: all 0.2s ease;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .amount-option-card:hover {
            border-color: #cbd5e1;
        }

        .amount-option-card.selected {
            background: #fff7ed;
            border-color: #f97316;
            box-shadow: 0 0 0 1px #f97316;
        }

        .option-coins-text {
            font-size: 15px;
            font-weight: 800;
            color: #0f172a;
            display: flex;
            align-items: center;
            gap: 4px;
            margin-bottom: 3px;
        }

        .amount-option-card.selected .option-coins-text {
            color: #ea580c;
        }

        .option-taka-text {
            font-size: 12px;
            color: #64748b;
            font-weight: 500;
        }

        .amount-option-card.selected .option-taka-text {
            color: #c2410c;
        }

        /* PAYMENT METHODS */
        .payment-methods-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 12px;
            margin-bottom: 12px;
        }

        .pm-card {
            background: #f8fafc;
            border: 1.5px solid #e2e8f0;
            border-radius: 16px;
            padding: 16px 10px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 8px;
            cursor: pointer;
            position: relative;
            transition: all 0.2s ease;
            height: 90px;
        }

        .pm-card.selected {
            background: #fff7ed;
            border-color: #f97316;
            box-shadow: 0 0 0 1px #f97316;
        }

        .pm-check-badge {
            position: absolute;
            top: 6px;
            right: 6px;
            width: 18px;
            height: 18px;
            background: #ea580c;
            color: #ffffff;
            border-radius: 50%;
            display: none;
            align-items: center;
            justify-content: center;
            font-size: 10px;
        }

        .pm-card.selected .pm-check-badge {
            display: flex;
        }

        .pm-logo {
            width: 32px;
            height: 32px;
            object-fit: contain;
        }

        .pm-label {
            font-size: 12px;
            font-weight: 600;
            color: #475569;
        }

        .pm-card.selected .pm-label {
            color: #ea580c;
            font-weight: 700;
        }

        .pm-card-full {
            grid-column: span 3;
            height: 60px;
            flex-direction: row;
            gap: 12px;
        }

        /* ACCOUNT INPUT FIELD */
        .account-input-group {
            margin-top: 16px;
        }

        .input-label-text {
            font-size: 14px;
            font-weight: 600;
            color: #334155;
            margin-bottom: 8px;
            display: block;
        }

        .account-input-capsule {
            background: #eeeff2;
            border: 1px solid #cbd5e1;
            border-radius: 30px;
            padding: 4px 16px;
            display: flex;
            align-items: center;
            gap: 10px;
            height: 48px;
        }

        .account-input-capsule img,
        .account-input-capsule i {
            width: 24px;
            height: 24px;
            object-fit: contain;
            color: #e11d48;
        }

        .account-input-capsule input {
            border: none;
            background: transparent;
            width: 100%;
            font-size: 15px;
            font-weight: 600;
            color: #0f172a;
            outline: none;
        }

        .account-input-capsule input::placeholder {
            color: #94a3b8;
            font-weight: 400;
        }

        /* WARNING / ERROR PILL */
        .insufficient-alert-pill {
            background: #fef2f2;
            border: 1px solid #fecaca;
            border-radius: 30px;
            padding: 12px 18px;
            display: flex;
            align-items: center;
            gap: 10px;
            color: #dc2626;
            font-size: 13px;
            font-weight: 600;
            margin-bottom: 16px;
        }

        .insufficient-alert-pill i {
            font-size: 16px;
        }

        /* CASHOUT SUBMIT BUTTON */
        .btn-cashout-submit {
            width: 100%;
            background: #fdba74;
            color: #ffffff;
            border: none;
            border-radius: 30px;
            padding: 15px;
            font-size: 17px;
            font-weight: 700;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            cursor: not-allowed;
            transition: all 0.25s ease;
            box-shadow: 0 4px 12px rgba(249, 115, 22, 0.15);
        }

        .btn-cashout-submit.active {
            background: linear-gradient(135deg, #f97316 0%, #ea580c 100%);
            cursor: pointer;
            box-shadow: 0 4px 14px rgba(249, 115, 22, 0.35);
        }

        .btn-cashout-submit.active:active {
            transform: scale(0.99);
        }

        .terms-disclaimer-text {
            text-align: center;
            font-size: 12px;
            color: #94a3b8;
            margin-top: 14px;
            line-height: 1.4;
        }

        .terms-disclaimer-text a {
            color: #ea580c;
            text-decoration: underline;
        }

        /* BOTTOM APP NAVIGATION BAR */
        .bottom-nav-bar {
            position: fixed;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 100%;
            max-width: 480px;
            background: #ffffff;
            border-top: 1px solid #e2e8f0;
            display: flex;
            justify-content: space-around;
            align-items: center;
            padding: 8px 0;
            z-index: 1000;
        }

        .nav-item-btn {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 4px;
            color: #64748b;
            text-decoration: none;
            font-size: 11px;
            font-weight: 600;
            transition: color 0.2s ease;
        }

        .nav-item-btn i {
            font-size: 18px;
        }

        .nav-item-btn.active {
            color: #0f172a;
        }

        .nav-item-btn.active i {
            color: #0f172a;
        }

        .nav-item-create-btn i {
            font-size: 18px;
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: #ff4757;
            color: #ffffff;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 2px 6px rgba(255, 71, 87, 0.4);
        }

        /* MODAL FOR PAYMENTS HISTORY */
        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(15, 23, 42, 0.5);
            backdrop-filter: blur(4px);
            z-index: 2000;
            display: none;
            align-items: flex-end;
            justify-content: center;
        }

        .modal-overlay.open {
            display: flex;
        }

        .modal-content-sheet {
            background: #ffffff;
            width: 100%;
            max-width: 480px;
            border-top-left-radius: 28px;
            border-top-right-radius: 28px;
            padding: 24px;
            max-height: 80vh;
            overflow-y: auto;
            animation: slideUp 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        }

        @keyframes slideUp {
            from { transform: translateY(100%); }
            to { transform: translateY(0); }
        }

        .modal-header-line {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .modal-title {
            font-size: 18px;
            font-weight: 700;
            color: #0f172a;
        }

        .modal-close-btn {
            background: #f1f5f9;
            border: none;
            width: 32px;
            height: 32px;
            border-radius: 50%;
            font-size: 16px;
            color: #64748b;
            cursor: pointer;
        }

        .history-list {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .history-item-card {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            padding: 14px 16px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .history-item-left {
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        .history-item-method {
            font-size: 14px;
            font-weight: 700;
            color: #0f172a;
        }

        .history-item-date {
            font-size: 12px;
            color: #94a3b8;
        }

        .history-item-right {
            display: flex;
            flex-direction: column;
            align-items: flex-end;
            gap: 4px;
        }

        .history-item-bdt {
            font-size: 15px;
            font-weight: 800;
            color: #ea580c;
        }

        .history-item-status {
            font-size: 11px;
            font-weight: 700;
            padding: 2px 8px;
            border-radius: 10px;
            text-transform: capitalize;
        }

        .status-pending { background: #fef3c7; color: #d97706; }
        .status-approved, .status-completed { background: #dcfce7; color: #16a34a; }
        .status-rejected { background: #fee2e2; color: #dc2626; }

        /* TOAST NOTIFICATION */
        .toast-msg {
            position: fixed;
            top: 20px;
            left: 50%;
            transform: translateX(-50%) translateY(-100px);
            background: #0f172a;
            color: #ffffff;
            padding: 12px 20px;
            border-radius: 30px;
            font-size: 14px;
            font-weight: 600;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
            z-index: 3000;
            transition: transform 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .toast-msg.show {
            transform: translateX(-50%) translateY(0);
        }
    </style>
</head>

<body>

    <div class="app-container">

        <!-- ========================================== -->
        <!-- VIEW 1: WALLET MAIN DASHBOARD (SCREENSHOT 2) -->
        <!-- ========================================== -->
        <div id="viewWallet" class="page-view active">

            <!-- TOP NAV BAR -->
            <div class="top-nav-bar">
                <a href="/user/profile" class="nav-back-btn" title="Back to Profile">
                    <i class="fa-solid fa-arrow-left"></i>
                </a>
                <h1 class="nav-page-title">Wallet</h1>
                <div class="currency-dropdown-btn">
                    <span>BDT</span>
                    <i class="fa-solid fa-chevron-down" style="font-size:10px;"></i>
                </div>
            </div>

            <!-- TOTAL BALANCE HERO CARD -->
            <div class="white-card">
                <div class="total-balance-label">Total balance</div>
                <div class="total-balance-amount" id="displayTotalBdt">৳ {{ number_format($totalBdt, 3) }}</div>
                <div class="total-coins-sub">
                    <span>≈</span>
                    <span>🪙 <span id="displayTotalCoins">{{ number_format($userPoints, 1) }}</span> coins</span>
                </div>
                <div class="wallet-action-buttons">
                    <button type="button" class="btn-cashout-main" onclick="switchView('viewCashout')">
                        <i class="fa-solid fa-wallet"></i>
                        <span>Cash Out</span>
                        <i class="fa-solid fa-chevron-right" style="font-size:12px; margin-left:2px;"></i>
                    </button>
                    <button type="button" class="btn-payments-sub" onclick="openModal('paymentsModal')">
                        <i class="fa-regular fa-clock"></i>
                        <span>Payments</span>
                        <i class="fa-solid fa-chevron-right" style="font-size:12px; margin-left:2px;"></i>
                    </button>
                </div>
            </div>

            <!-- EARNINGS OVERVIEW -->
            <div class="section-header-title">
                <span>Earnings Overview</span>
            </div>

            <div class="earnings-grid">
                <!-- CARD 1: TODAY -->
                <div class="earning-overview-card">
                    <div class="earning-card-top">
                        <div class="icon-circle green">
                            <i class="fa-solid fa-arrow-trend-up"></i>
                        </div>
                        <div class="earning-card-meta">
                            <span class="earning-card-name">Today</span>
                            <span class="earning-card-date">{{ now()->format('M j, Y') }}</span>
                        </div>
                    </div>
                    <div class="earning-card-val">
                        <span>🪙</span>
                        <span>{{ number_format($todayPoints, 1) }}</span>
                    </div>
                    <div class="earning-card-sub">≈ ৳ {{ number_format($todayBdt, 3) }}</div>
                </div>

                <!-- CARD 2: YESTERDAY -->
                <div class="earning-overview-card">
                    <div class="earning-card-top">
                        <div class="icon-circle blue">
                            <i class="fa-regular fa-clock"></i>
                        </div>
                        <div class="earning-card-meta">
                            <span class="earning-card-name">Yesterday</span>
                            <span class="earning-card-date">{{ now()->subDay()->format('M j, Y') }}</span>
                        </div>
                    </div>
                    <div class="earning-card-val">
                        <span>🪙</span>
                        <span>{{ number_format($yesterdayPoints, 1) }}</span>
                    </div>
                    <div class="earning-card-sub">≈ ৳ {{ number_format($yesterdayBdt, 3) }}</div>
                </div>

                <!-- CARD 3: THIS MONTH -->
                <div class="earning-overview-card">
                    <div class="earning-card-top">
                        <div class="icon-circle purple">
                            <i class="fa-regular fa-calendar-days"></i>
                        </div>
                        <div class="earning-card-meta">
                            <span class="earning-card-name">This Month</span>
                            <span class="earning-card-date">{{ now()->startOfMonth()->format('M j') }} - {{ now()->format('M j, Y') }}</span>
                        </div>
                    </div>
                    <div class="earning-card-val">
                        <span>🪙</span>
                        <span>{{ number_format($monthPoints, 1) }}</span>
                    </div>
                    <div class="earning-card-sub">≈ ৳ {{ number_format($monthBdt, 3) }}</div>
                </div>

                <!-- CARD 4: MIN. CASHOUT -->
                <div class="earning-overview-card">
                    <div class="earning-card-top">
                        <div class="icon-circle green">
                            <i class="fa-solid fa-wallet"></i>
                        </div>
                        <div class="earning-card-meta">
                            <span class="earning-card-name">Min. Cashout</span>
                            <span class="earning-card-date">{{ $needsMoreCoins > 0 ? 'Not yet' : 'Eligible' }}</span>
                        </div>
                    </div>
                    <div class="earning-card-val">
                        <span>🪙</span>
                        <span>600</span>
                    </div>
                    <div class="earning-card-sub">
                        {{ $needsMoreCoins > 0 ? number_format($needsMoreCoins, 1) . ' needs more' : 'Ready to withdraw!' }}
                    </div>
                </div>
            </div>

            <!-- SUPPORT SECTION -->
            <div class="section-header-title">
                <span>Support</span>
            </div>

            <div class="support-card" onclick="showToast('Support system active! Contact admin via WhatsApp.')">
                <div class="support-left">
                    <div class="support-icon-circle">
                        <i class="fa-solid fa-headset"></i>
                    </div>
                    <div>
                        <div class="support-info-title">Chat with support</div>
                        <div class="support-info-sub">Withdrawals · balance · account</div>
                    </div>
                </div>
                <div class="support-status-online">
                    <span class="online-dot"></span>
                    <span>Online</span>
                    <i class="fa-solid fa-chevron-right" style="font-size:11px; color:#94a3b8; margin-left:2px;"></i>
                </div>
            </div>

            <!-- COMMUNITIES SECTION -->
            <div class="section-header-title">
                <span>Communities</span>
            </div>
            <div class="white-card" style="padding:16px; margin-bottom:0;">
                <div style="display:flex; align-items:center; gap:12px;">
                    <div style="width:40px; height:40px; background:#eff6ff; border-radius:50%; display:flex; align-items:center; justify-content:center; color:#2563eb; font-size:18px;">
                        <i class="fa-brands fa-telegram"></i>
                    </div>
                    <div>
                        <div style="font-size:14px; font-weight:700; color:#0f172a;">Join Creator Community</div>
                        <div style="font-size:12px; color:#64748b;">Get updates & earning tips</div>
                    </div>
                </div>
            </div>

        </div>

        <!-- ========================================== -->
        <!-- VIEW 2: CASH OUT SCREEN (SCREENSHOT 1) -->
        <!-- ========================================== -->
        <div id="viewCashout" class="page-view">

            <!-- TOP NAV BAR -->
            <div class="top-nav-bar">
                <button type="button" class="nav-back-btn" onclick="switchView('viewWallet')">
                    <i class="fa-solid fa-arrow-left"></i>
                </button>
                <h1 class="nav-page-title">Cash Out</h1>
                <div class="balance-top-pill">
                    <span>Balance</span>
                    🪙 <strong id="cashoutHeaderCoins">{{ number_format($userPoints, 1) }}</strong>
                </div>
            </div>

            <!-- SELECT AMOUNT CARD -->
            <div class="white-card">
                <div class="select-amount-header">
                    <span class="select-amount-title">Select Amount</span>
                    <span class="selected-coins-badge">🪙 <span id="badgeSelectedCoins">600</span></span>
                </div>

                <div class="amount-options-grid">
                    <div class="amount-option-card selected" onclick="selectCoinsOption(600, 15.00, this)">
                        <div class="option-coins-text">🪙 600</div>
                        <div class="option-taka-text">≈ ৳15.00</div>
                    </div>
                    <div class="amount-option-card" onclick="selectCoinsOption(2500, 62.50, this)">
                        <div class="option-coins-text">🪙 2,500</div>
                        <div class="option-taka-text">≈ ৳62.50</div>
                    </div>
                    <div class="amount-option-card" onclick="selectCoinsOption(5000, 125.00, this)">
                        <div class="option-coins-text">🪙 5,000</div>
                        <div class="option-taka-text">≈ ৳125.00</div>
                    </div>
                    <div class="amount-option-card" onclick="selectCoinsOption(10000, 250.00, this)">
                        <div class="option-coins-text">🪙 10,000</div>
                        <div class="option-taka-text">≈ ৳250.00</div>
                    </div>
                    <div class="amount-option-card" onclick="selectCoinsOption(20000, 500.00, this)">
                        <div class="option-coins-text">🪙 20,000</div>
                        <div class="option-taka-text">≈ ৳500.00</div>
                    </div>
                    <div class="amount-option-card" onclick="selectCoinsOption(30000, 750.00, this)">
                        <div class="option-coins-text">🪙 30,000</div>
                        <div class="option-taka-text">≈ ৳750.00</div>
                    </div>
                </div>
            </div>

            <!-- PAYMENT METHOD CARD -->
            <div class="white-card">
                <div class="select-amount-title" style="margin-bottom:14px;">Payment Method</div>

                <div class="payment-methods-grid">
                    <!-- BKASH -->
                    <div class="pm-card selected" onclick="selectPaymentMethod('bKash', '01XXXXXXXXX', this)">
                        <div class="pm-check-badge"><i class="fa-solid fa-check"></i></div>
                        <svg class="pm-logo" viewBox="0 0 40 40" fill="none">
                            <rect width="40" height="40" rx="8" fill="#e2136e"/>
                            <path d="M12 28L28 12M28 12H16M28 12V24" stroke="white" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        <span class="pm-label">bKash</span>
                    </div>

                    <!-- NAGAD -->
                    <div class="pm-card" onclick="selectPaymentMethod('Nagad', '01XXXXXXXXX', this)">
                        <div class="pm-check-badge"><i class="fa-solid fa-check"></i></div>
                        <svg class="pm-logo" viewBox="0 0 40 40" fill="none">
                            <rect width="40" height="40" rx="8" fill="#f7921e"/>
                            <path d="M10 20C10 14.4772 14.4772 10 20 10C25.5228 10 30 14.4772 30 20" stroke="white" stroke-width="3" stroke-linecap="round"/>
                        </svg>
                        <span class="pm-label">Nagad</span>
                    </div>

                    <!-- BINANCE -->
                    <div class="pm-card" onclick="selectPaymentMethod('Binance', 'Pay ID / Email', this)">
                        <div class="pm-check-badge"><i class="fa-solid fa-check"></i></div>
                        <svg class="pm-logo" viewBox="0 0 40 40" fill="none">
                            <rect width="40" height="40" rx="8" fill="#f0b90b"/>
                            <path d="M20 12L24 16L20 20L16 16L20 12ZM20 20L24 24L20 28L16 24L20 20ZM12 16L16 20L12 24L8 20L12 16ZM28 16L32 20L28 24L24 20L28 16Z" fill="white"/>
                        </svg>
                        <span class="pm-label">Binance</span>
                    </div>

                    <!-- VISA / MASTERCARD -->
                    <div class="pm-card pm-card-full" onclick="selectPaymentMethod('Visa/Mastercard', 'Card Number', this)">
                        <div class="pm-check-badge"><i class="fa-solid fa-check"></i></div>
                        <div style="display:flex; align-items:center; gap:8px;">
                            <span style="font-weight:900; font-style:italic; font-size:18px; color:#1a1f71;">VISA</span>
                            <div style="display:flex; margin-left:4px;">
                                <div style="width:16px; height:16px; border-radius:50%; background:#eb001b; opacity:0.9;"></div>
                                <div style="width:16px; height:16px; border-radius:50%; background:#f79e1b; margin-left:-6px; opacity:0.9;"></div>
                            </div>
                        </div>
                        <span class="pm-label">Visa/Mastercard</span>
                    </div>
                </div>

                <!-- ACCOUNT NUMBER INPUT -->
                <div class="account-input-group">
                    <label class="input-label-text"><span id="inputMethodName">bKash</span> Number</label>
                    <div class="account-input-capsule">
                        <i class="fa-solid fa-mobile-screen-button"></i>
                        <input type="text" id="accountNumberInput" placeholder="e.g. 01XXXXXXXXX" autocomplete="off">
                    </div>
                </div>
            </div>

            <!-- INSUFFICIENT BALANCE ALERT (DYNAMIC) -->
            <div id="insufficientAlert" class="insufficient-alert-pill">
                <i class="fa-solid fa-circle-info"></i>
                <span>Your balance is insufficient for this amount</span>
            </div>

            <!-- CASHOUT BUTTON -->
            <button type="button" id="btnCashoutSubmit" class="btn-cashout-submit" onclick="submitCashout()">
                <i class="fa-solid fa-arrow-up-right-from-square"></i>
                <span>Cash Out ৳<span id="cashoutBtnTakaVal">15.00</span></span>
            </button>

            <!-- TERMS DISCLAIMER -->
            <div class="terms-disclaimer-text">
                By cashing out, you agree to bTrend's <a href="javascript:void(0)" onclick="showToast('Cash Out T&C: Minimum withdrawal 600 coins. Requests processed within 24 hours.')">Cash Out Terms & Conditions</a>.
            </div>

        </div>

    </div>

    <!-- FIXED BOTTOM APP NAVIGATION BAR -->
    <div class="bottom-nav-bar">
        <a href="/" class="nav-item-btn">
            <i class="fa-solid fa-house"></i>
            <span>Home</span>
        </a>
        <a href="/" class="nav-item-btn">
            <i class="fa-solid fa-clapperboard"></i>
            <span>Reels</span>
        </a>
        <a href="/report/create" class="nav-item-btn nav-item-create-btn">
            <i class="fa-solid fa-plus"></i>
            <span>Create</span>
        </a>
        <a href="/user/analytics" class="nav-item-btn active">
            <i class="fa-solid fa-chart-line"></i>
            <span>Analytics</span>
        </a>
        <a href="/user/profile" class="nav-item-btn">
            <i class="fa-solid fa-user"></i>
            <span>Profile</span>
        </a>
    </div>

    <!-- PAYMENTS HISTORY MODAL SHEET -->
    <div id="paymentsModal" class="modal-overlay" onclick="closeModalOnBackdrop(event, 'paymentsModal')">
        <div class="modal-content-sheet">
            <div class="modal-header-line">
                <h3 class="modal-title">Payment History</h3>
                <button type="button" class="modal-close-btn" onclick="closeModal('paymentsModal')">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>

            <div class="history-list" id="historyListContainer">
                @forelse($withdrawals as $w)
                    <div class="history-item-card">
                        <div class="history-item-left">
                            <span class="history-item-method">{{ $w->payment_method }} ({{ $w->account_number }})</span>
                            <span class="history-item-date">{{ $w->created_at->format('M j, Y - g:i A') }}</span>
                        </div>
                        <div class="history-item-right">
                            <span class="history-item-bdt">৳ {{ number_format($w->amount_bdt, 2) }}</span>
                            <span class="history-item-status status-{{ $w->status }}">{{ $w->status }}</span>
                        </div>
                    </div>
                @empty
                    <div style="text-align:center; padding:30px 10px; color:#94a3b8;">
                        <i class="fa-regular fa-receipt" style="font-size:36px; margin-bottom:8px;"></i>
                        <p style="font-size:14px; font-weight:500;">No payment history found</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- TOAST MSG NOTIFICATION -->
    <div id="toastMessage" class="toast-msg">
        <i class="fa-solid fa-circle-check" style="color:#22c55e;"></i>
        <span id="toastText">Message</span>
    </div>

    <script>
        // GLOBAL USER STATE
        let currentUserCoins = parseFloat("{{ $userPoints }}") || 0;
        let selectedCoins = 600;
        let selectedTaka = 15.00;
        let selectedPaymentMethod = 'bKash';

        // CSRF Token
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        // SWITCH BETWEEN WALLET & CASH OUT VIEWS
        function switchView(viewId) {
            document.querySelectorAll('.page-view').forEach(el => el.classList.remove('active'));
            const target = document.getElementById(viewId);
            if (target) {
                target.classList.add('active');
                window.scrollTo({ top: 0, behavior: 'smooth' });
            }
        }

        // SELECT COIN AMOUNT TIER
        function selectCoinsOption(coins, taka, element) {
            selectedCoins = coins;
            selectedTaka = taka;

            // UI Highlight
            document.querySelectorAll('.amount-option-card').forEach(card => card.classList.remove('selected'));
            element.classList.add('selected');

            // Update Badges & Texts
            document.getElementById('badgeSelectedCoins').innerText = coins.toLocaleString();
            document.getElementById('cashoutBtnTakaVal').innerText = taka.toFixed(2);

            // Re-evaluate Insufficient Balance Alert
            checkBalanceState();
        }

        // SELECT PAYMENT METHOD
        function selectPaymentMethod(methodName, placeholderText, element) {
            selectedPaymentMethod = methodName;

            // UI Highlight
            document.querySelectorAll('.pm-card').forEach(card => card.classList.remove('selected'));
            element.classList.add('selected');

            // Update Input
            document.getElementById('inputMethodName').innerText = methodName;
            const inputField = document.getElementById('accountNumberInput');
            inputField.placeholder = 'e.g. ' + placeholderText;
            inputField.value = '';
        }

        // EVALUATE INSUFFICIENT BALANCE
        function checkBalanceState() {
            const alertEl = document.getElementById('insufficientAlert');
            const submitBtn = document.getElementById('btnCashoutSubmit');

            if (currentUserCoins < selectedCoins) {
                alertEl.style.display = 'flex';
                submitBtn.classList.remove('active');
            } else {
                alertEl.style.display = 'none';
                submitBtn.classList.add('active');
            }
        }

        // SUBMIT CASHOUT VIA AJAX
        function submitCashout() {
            if (currentUserCoins < selectedCoins) {
                showToast("Your balance is insufficient for this amount.");
                return;
            }

            const accountNumber = document.getElementById('accountNumberInput').value.trim();
            if (!accountNumber) {
                showToast("Please enter your " + selectedPaymentMethod + " account number.");
                document.getElementById('accountNumberInput').focus();
                return;
            }

            const submitBtn = document.getElementById('btnCashoutSubmit');
            submitBtn.disabled = true;
            submitBtn.style.opacity = '0.7';

            fetch('/user/cashout', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    coins: selectedCoins,
                    payment_method: selectedPaymentMethod,
                    account_number: accountNumber
                })
            })
            .then(res => res.json())
            .then(data => {
                submitBtn.disabled = false;
                submitBtn.style.opacity = '1';

                if (data.status === 'success') {
                    // Update Local State
                    currentUserCoins = parseFloat(data.new_points);
                    
                    // Update DOM Elements
                    document.getElementById('displayTotalCoins').innerText = currentUserCoins.toFixed(1);
                    document.getElementById('displayTotalBdt').innerText = '৳ ' + data.new_bdt;
                    document.getElementById('cashoutHeaderCoins').innerText = currentUserCoins.toFixed(1);

                    // Clear Input
                    document.getElementById('accountNumberInput').value = '';

                    // Toast Feedback & Switch back to Wallet
                    showToast(data.message);
                    checkBalanceState();

                    // Prepend new withdrawal to history list
                    if (data.withdrawal) {
                        const historyContainer = document.getElementById('historyListContainer');
                        const newCard = document.createElement('div');
                        newCard.className = 'history-item-card';
                        newCard.innerHTML = `
                            <div class="history-item-left">
                                <span class="history-item-method">${data.withdrawal.payment_method} (${data.withdrawal.account_number})</span>
                                <span class="history-item-date">Just now</span>
                            </div>
                            <div class="history-item-right">
                                <span class="history-item-bdt">৳ ${parseFloat(data.withdrawal.amount_bdt).toFixed(2)}</span>
                                <span class="history-item-status status-pending">pending</span>
                            </div>
                        `;
                        if (historyContainer.querySelector('p')) {
                            historyContainer.innerHTML = '';
                        }
                        historyContainer.prepend(newCard);
                    }

                    setTimeout(() => switchView('viewWallet'), 1200);

                } else {
                    showToast(data.message || 'Withdrawal failed. Please try again.');
                }
            })
            .catch(err => {
                submitBtn.disabled = false;
                submitBtn.style.opacity = '1';
                showToast('An error occurred. Please try again.');
            });
        }

        // MODAL HELPERS
        function openModal(modalId) {
            document.getElementById(modalId).classList.add('open');
        }

        function closeModal(modalId) {
            document.getElementById(modalId).classList.remove('open');
        }

        function closeModalOnBackdrop(e, modalId) {
            if (e.target.id === modalId) {
                closeModal(modalId);
            }
        }

        // TOAST NOTIFICATION HELPER
        function showToast(msg) {
            const toast = document.getElementById('toastMessage');
            document.getElementById('toastText').innerText = msg;
            toast.classList.add('show');
            setTimeout(() => {
                toast.classList.remove('show');
            }, 3500);
        }

        // INITIAL CHECK ON LOAD
        document.addEventListener('DOMContentLoaded', () => {
            checkBalanceState();
        });
    </script>
</body>

</html>
