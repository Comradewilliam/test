<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Product Rating & Hospital Management API Dashboard">
    <title>Product Rating & Hospital Dashboard</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg-primary: #0b0f19;
            --bg-secondary: #111827;
            --bg-card: rgba(17, 24, 39, 0.75);
            --bg-glass: rgba(31, 41, 55, 0.6);
            --border-color: rgba(255, 255, 255, 0.08);
            --border-hover: rgba(99, 102, 241, 0.4);
            --primary: #6366f1;
            --primary-hover: #4f46e5;
            --primary-glow: rgba(99, 102, 241, 0.25);
            --accent: #ec4899;
            --accent-glow: rgba(236, 72, 153, 0.2);
            --success: #10b981;
            --success-glow: rgba(16, 185, 129, 0.2);
            --warning: #f59e0b;
            --danger: #ef4444;
            --text-main: #f9fafb;
            --text-muted: #9ca3af;
            --text-dim: #6b7280;
            --gold: #fbbf24;
            --radius-lg: 16px;
            --radius-md: 12px;
            --radius-sm: 8px;
            --font-display: 'Outfit', sans-serif;
            --font-body: 'Plus Jakarta Sans', sans-serif;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            transition: background-color 0.2s, border-color 0.2s, color 0.2s, transform 0.15s;
        }

        body {
            font-family: var(--font-body);
            background-color: var(--bg-primary);
            color: var(--text-main);
            min-height: 100vh;
            background-image: 
                radial-gradient(circle at 15% 15%, rgba(99, 102, 241, 0.12) 0%, transparent 40%),
                radial-gradient(circle at 85% 85%, rgba(236, 72, 153, 0.08) 0%, transparent 40%),
                radial-gradient(circle at 50% 50%, rgba(16, 185, 129, 0.05) 0%, transparent 50%);
            background-attachment: fixed;
            overflow-x: hidden;
        }

        /* Ambient Glow & Grid */
        .ambient-grid {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-size: 40px 40px;
            background-image: 
                linear-gradient(to right, rgba(255, 255, 255, 0.015) 1px, transparent 1px),
                linear-gradient(to bottom, rgba(255, 255, 255, 0.015) 1px, transparent 1px);
            pointer-events: none;
            z-index: 0;
        }

        /* Container */
        .container {
            max-width: 1280px;
            margin: 0 auto;
            padding: 24px 20px;
            position: relative;
            z-index: 1;
        }

        /* Header / Navbar */
        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 16px 24px;
            background: var(--bg-card);
            backdrop-filter: blur(16px);
            border: 1px solid var(--border-color);
            border-radius: var(--radius-lg);
            margin-bottom: 28px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.25);
        }

        .logo-area {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .logo-icon {
            width: 44px;
            height: 44px;
            background: linear-gradient(135deg, var(--primary), var(--accent));
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            box-shadow: 0 4px 15px var(--primary-glow);
        }

        .logo-text h1 {
            font-family: var(--font-display);
            font-size: 1.35rem;
            font-weight: 700;
            letter-spacing: -0.02em;
            background: linear-gradient(to right, #ffffff, #c7d2fe);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .logo-text p {
            font-size: 0.8rem;
            color: var(--text-muted);
        }

        .nav-actions {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .user-pill {
            display: flex;
            align-items: center;
            gap: 10px;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid var(--border-color);
            padding: 6px 14px;
            border-radius: 40px;
            font-size: 0.85rem;
        }

        .user-avatar {
            width: 28px;
            height: 28px;
            background: linear-gradient(135deg, #4f46e5, #06b6d4);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 0.75rem;
        }

        /* Buttons */
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 10px 18px;
            border-radius: var(--radius-sm);
            font-family: var(--font-body);
            font-size: 0.9rem;
            font-weight: 600;
            cursor: pointer;
            border: none;
            outline: none;
            text-decoration: none;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary), var(--primary-hover));
            color: #fff;
            box-shadow: 0 4px 14px var(--primary-glow);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(99, 102, 241, 0.4);
        }

        .btn-secondary {
            background: rgba(255, 255, 255, 0.08);
            border: 1px solid var(--border-color);
            color: var(--text-main);
        }

        .btn-secondary:hover {
            background: rgba(255, 255, 255, 0.12);
            border-color: rgba(255, 255, 255, 0.2);
            transform: translateY(-1px);
        }

        .btn-danger {
            background: rgba(239, 68, 68, 0.15);
            border: 1px solid rgba(239, 68, 68, 0.3);
            color: #fca5a5;
        }

        .btn-danger:hover {
            background: rgba(239, 68, 68, 0.3);
            color: #fff;
        }

        .btn-sm {
            padding: 6px 12px;
            font-size: 0.8rem;
            border-radius: 6px;
        }

        /* Auth View Card */
        #auth-view {
            max-width: 480px;
            margin: 60px auto;
            background: var(--bg-card);
            backdrop-filter: blur(20px);
            border: 1px solid var(--border-color);
            border-radius: var(--radius-lg);
            padding: 36px 32px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.4);
            animation: fadeIn 0.4s ease;
        }

        .auth-header {
            text-align: center;
            margin-bottom: 28px;
        }

        .auth-header h2 {
            font-family: var(--font-display);
            font-size: 1.75rem;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .auth-header p {
            color: var(--text-muted);
            font-size: 0.9rem;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            font-size: 0.85rem;
            font-weight: 600;
            color: var(--text-muted);
            margin-bottom: 8px;
        }

        .form-control {
            width: 100%;
            background: rgba(17, 24, 39, 0.9);
            border: 1px solid var(--border-color);
            border-radius: var(--radius-sm);
            padding: 12px 14px;
            color: var(--text-main);
            font-family: var(--font-body);
            font-size: 0.95rem;
        }

        .form-control:focus {
            border-color: var(--primary);
            outline: none;
            box-shadow: 0 0 0 3px var(--primary-glow);
        }

        .quick-accounts {
            margin-top: 24px;
            padding-top: 20px;
            border-top: 1px solid var(--border-color);
        }

        .quick-accounts span {
            display: block;
            font-size: 0.78rem;
            color: var(--text-dim);
            text-transform: uppercase;
            letter-spacing: 0.05em;
            margin-bottom: 10px;
            font-weight: 600;
        }

        .account-chips {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
        }

        .chip {
            background: rgba(255, 255, 255, 0.04);
            border: 1px solid var(--border-color);
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.8rem;
            color: #c7d2fe;
            cursor: pointer;
        }

        .chip:hover {
            background: var(--primary-glow);
            border-color: var(--primary);
            color: #fff;
        }

        /* Navigation Tabs */
        .tabs {
            display: flex;
            gap: 12px;
            margin-bottom: 24px;
            border-bottom: 1px solid var(--border-color);
            padding-bottom: 12px;
        }

        .tab-btn {
            background: transparent;
            border: none;
            color: var(--text-muted);
            font-family: var(--font-display);
            font-size: 1.05rem;
            font-weight: 600;
            padding: 8px 18px;
            border-radius: var(--radius-sm);
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .tab-btn.active {
            background: var(--primary-glow);
            color: #fff;
            border: 1px solid rgba(99, 102, 241, 0.4);
        }

        .badge-tab {
            font-size: 0.7rem;
            background: var(--accent);
            color: #fff;
            padding: 2px 7px;
            border-radius: 10px;
            font-weight: 700;
        }

        /* Stats Grid */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 18px;
            margin-bottom: 28px;
        }

        .stat-card {
            background: var(--bg-card);
            backdrop-filter: blur(12px);
            border: 1px solid var(--border-color);
            border-radius: var(--radius-md);
            padding: 20px 24px;
            display: flex;
            align-items: center;
            gap: 18px;
        }

        .stat-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
        }

        .stat-val {
            font-family: var(--font-display);
            font-size: 1.65rem;
            font-weight: 700;
            line-height: 1.2;
        }

        .stat-label {
            font-size: 0.8rem;
            color: var(--text-muted);
            font-weight: 500;
        }

        /* Product Section Controls */
        .controls-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            gap: 16px;
            flex-wrap: wrap;
        }

        .search-box {
            position: relative;
            flex: 1;
            max-width: 380px;
        }

        .search-box input {
            padding-left: 38px;
        }

        .search-icon {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-dim);
            font-size: 16px;
        }

        /* Product Cards Grid */
        .products-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: 22px;
        }

        .product-card {
            background: var(--bg-card);
            backdrop-filter: blur(14px);
            border: 1px solid var(--border-color);
            border-radius: var(--radius-lg);
            padding: 24px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            position: relative;
            overflow: hidden;
        }

        .product-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, var(--primary), var(--accent));
            opacity: 0;
            transition: opacity 0.3s;
        }

        .product-card:hover {
            border-color: var(--border-hover);
            transform: translateY(-4px);
            box-shadow: 0 14px 28px rgba(0, 0, 0, 0.3);
        }

        .product-card:hover::before {
            opacity: 1;
        }

        .card-top {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 12px;
        }

        .product-title {
            font-family: var(--font-display);
            font-size: 1.15rem;
            font-weight: 700;
            color: #fff;
            margin-bottom: 4px;
        }

        .product-price {
            font-family: var(--font-display);
            font-size: 1.25rem;
            font-weight: 700;
            color: #a5b4fc;
        }

        .product-desc {
            font-size: 0.85rem;
            color: var(--text-muted);
            line-height: 1.5;
            margin-bottom: 18px;
            min-height: 40px;
        }

        /* Rating Metrics Section */
        .metrics-panel {
            background: rgba(0, 0, 0, 0.25);
            border: 1px solid rgba(255, 255, 255, 0.05);
            border-radius: var(--radius-sm);
            padding: 12px 14px;
            margin-bottom: 16px;
        }

        .metric-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 0.82rem;
            margin-bottom: 6px;
        }

        .metric-row:last-child {
            margin-bottom: 0;
        }

        .metric-title {
            color: var(--text-muted);
        }

        .status-badge {
            font-size: 0.72rem;
            font-weight: 700;
            text-transform: uppercase;
            padding: 2px 8px;
            border-radius: 12px;
            letter-spacing: 0.03em;
        }

        .status-active {
            background: rgba(16, 185, 129, 0.15);
            border: 1px solid rgba(16, 185, 129, 0.4);
            color: #6ee7b7;
        }

        .status-inactive {
            background: rgba(245, 158, 11, 0.15);
            border: 1px solid rgba(245, 158, 11, 0.4);
            color: #fcd34d;
        }

        .status-unrated {
            background: rgba(255, 255, 255, 0.06);
            color: var(--text-dim);
        }

        /* Star Selector */
        .stars-container {
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .star-interactive {
            font-size: 22px;
            color: rgba(255, 255, 255, 0.15);
            cursor: pointer;
            transition: transform 0.15s, color 0.15s;
        }

        .star-interactive:hover,
        .star-interactive.active {
            color: var(--gold);
            transform: scale(1.15);
        }

        .stars-readonly {
            color: var(--gold);
            font-size: 16px;
            display: flex;
            gap: 2px;
        }

        .rating-actions {
            display: flex;
            gap: 8px;
            margin-top: 14px;
        }

        /* Hospital Registration Form (Bonus Task) */
        .hospital-card {
            background: var(--bg-card);
            backdrop-filter: blur(16px);
            border: 1px solid var(--border-color);
            border-radius: var(--radius-lg);
            padding: 32px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
        }

        .hospital-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 20px;
        }

        .hospital-result {
            margin-top: 28px;
            padding: 20px;
            border-radius: var(--radius-md);
            background: rgba(16, 185, 129, 0.1);
            border: 1px solid rgba(16, 185, 129, 0.3);
            display: none;
            animation: fadeIn 0.3s ease;
        }

        .result-header {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 12px;
            color: #6ee7b7;
            font-weight: 700;
        }

        .check-in-tag {
            font-family: var(--font-display);
            font-size: 1.2rem;
            color: #fff;
            background: rgba(0, 0, 0, 0.4);
            padding: 8px 16px;
            border-radius: var(--radius-sm);
            display: inline-block;
            margin-top: 6px;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        /* Toast Notifications */
        #toast-container {
            position: fixed;
            bottom: 24px;
            right: 24px;
            z-index: 9999;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .toast {
            background: #1f2937;
            border: 1px solid var(--border-color);
            padding: 14px 20px;
            border-radius: var(--radius-sm);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.5);
            display: flex;
            align-items: center;
            gap: 12px;
            min-width: 280px;
            max-width: 420px;
            animation: slideIn 0.3s ease;
        }

        .toast-success { border-left: 4px solid var(--success); }
        .toast-error { border-left: 4px solid var(--danger); }
        .toast-info { border-left: 4px solid var(--primary); }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(8px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes slideIn {
            from { opacity: 0; transform: translateX(50px); }
            to { opacity: 1; transform: translateX(0); }
        }

        .hidden { display: none !important; }
    </style>
</head>
<body>
    <div class="ambient-grid"></div>

    <div class="container">
        <!-- Main Top Bar -->
        <header id="main-header">
            <div class="logo-area">
                <div class="logo-icon">⭐</div>
                <div class="logo-text">
                    <h1>Rating API & Hospital Dashboard</h1>
                    <p>Laravel 11 + Sanctum REST Services</p>
                </div>
            </div>

            <div class="nav-actions">
                <div id="user-info" class="user-pill hidden">
                    <div class="user-avatar" id="avatar-letter">Y</div>
                    <span id="user-email-display">user@test.com</span>
                </div>
                <button id="btn-logout" class="btn btn-secondary btn-sm hidden" onclick="handleLogout()">
                    Logout
                </button>
            </div>
        </header>

        <!-- Authentication View -->
        <section id="auth-view">
            <div class="auth-header">
                <h2>Account Login</h2>
                <p>Authenticate with Sanctum to access products & hospital registration</p>
            </div>

            <form id="login-form" onsubmit="handleLogin(event)">
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" class="form-control" placeholder="you@example.com" value="young@test.com" required>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" class="form-control" placeholder="Enter password" value="QAZzaq123" required>
                </div>

                <button type="submit" id="btn-login-submit" class="btn btn-primary" style="width: 100%; padding: 12px;">
                    Sign In & Open Dashboard
                </button>
            </form>

            <div class="quick-accounts">
                <span>Quick Test Logins (Click to autofill):</span>
                <div class="account-chips">
                    <div class="chip" onclick="fillLogin('young@test.com', 'QAZzaq123')">young@test.com</div>
                    <div class="chip" onclick="fillLogin('willy@test.com', 'QAZzaq123')">willy@test.com</div>
                    <div class="chip" onclick="fillLogin('sadiki@test.com', 'QAZzaq123')">sadiki@test.com</div>
                </div>
            </div>
        </section>

        <!-- Dashboard View (Shown after authentication) -->
        <section id="dashboard-view" class="hidden">
            <!-- Navigation Tabs -->
            <div class="tabs">
                <button class="tab-btn active" onclick="switchTab('products')" id="tab-products">
                    📦 Product Ratings
                </button>
                <button class="tab-btn" onclick="switchTab('hospital')" id="tab-hospital">
                    🏥 Hospital Registration <span class="badge-tab">BONUS TASK</span>
                </button>
            </div>

            <!-- Tab 1: Products & Ratings -->
            <div id="content-products">
                <!-- Stats Overview -->
                <div class="stats-grid">
                    <div class="stat-card">
                        <div class="stat-icon" style="background: rgba(99, 102, 241, 0.15); color: #818cf8;">📊</div>
                        <div>
                            <div class="stat-val" id="stat-total-products">10</div>
                            <div class="stat-label">Total Catalog Products</div>
                        </div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-icon" style="background: rgba(236, 72, 153, 0.15); color: #f472b6;">⭐</div>
                        <div>
                            <div class="stat-val" id="stat-my-ratings">0</div>
                            <div class="stat-label">Your Rated Products</div>
                        </div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-icon" style="background: rgba(16, 185, 129, 0.15); color: #34d399;">⚡</div>
                        <div>
                            <div class="stat-val" id="stat-active-count">0</div>
                            <div class="stat-label">Active Fresh Ratings (>30m)</div>
                        </div>
                    </div>
                </div>

                <!-- Products Controls Bar -->
                <div class="controls-bar">
                    <div class="search-box">
                        <span class="search-icon">🔍</span>
                        <input type="text" id="search-input" class="form-control" placeholder="Filter products..." oninput="filterProducts()">
                    </div>

                    <div style="display: flex; gap: 8px;">
                        <button class="btn btn-secondary btn-sm" onclick="fetchProducts()">
                            🔄 Refresh Catalog
                        </button>
                    </div>
                </div>

                <!-- Products Cards Grid -->
                <div id="products-container" class="products-grid">
                    <!-- Dynamic Product Cards will be inserted here -->
                </div>
            </div>

            <!-- Tab 2: Hospital Patient Registration (Bonus Task) -->
            <div id="content-hospital" class="hidden">
                <div class="hospital-card">
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; flex-wrap: wrap; gap: 12px;">
                        <div>
                            <h2 style="font-family: var(--font-display); font-size: 1.45rem;">Gpitg Hospital Registration</h2>
                            <p style="color: var(--text-muted); font-size: 0.88rem;">Forwards patient data to http://41.188.172.204:3033/patient-registration</p>
                        </div>
                        <button class="btn btn-secondary btn-sm" type="button" onclick="fillHospitalSample()">
                            ⚡ Auto-Fill Sample Patient
                        </button>
                    </div>

                    <form id="hospital-form" onsubmit="handleHospitalSubmit(event)">
                        <div class="hospital-grid">
                            <div class="form-group">
                                <label for="Patient_Name">Patient Name</label>
                                <input type="text" id="Patient_Name" class="form-control" value="ngenzi ngenzi" required>
                            </div>

                            <div class="form-group">
                                <label for="Date_Of_Birth">Date Of Birth</label>
                                <input type="date" id="Date_Of_Birth" class="form-control" value="2022-07-02" required>
                            </div>

                            <div class="form-group">
                                <label for="Gender">Gender</label>
                                <select id="Gender" class="form-control" required>
                                    <option value="Male" selected>Male</option>
                                    <option value="Female">Female</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="Sponsor_ID">Sponsor ID</label>
                                <input type="text" id="Sponsor_ID" class="form-control" value="1" required>
                            </div>

                            <div class="form-group">
                                <label for="Visit_Type_ID">Visit Type ID</label>
                                <input type="text" id="Visit_Type_ID" class="form-control" value="1" required>
                            </div>

                            <div class="form-group">
                                <label for="Type_Of_Check_In">Type Of Check In</label>
                                <input type="text" id="Type_Of_Check_In" class="form-control" value="1" required>
                            </div>

                            <div class="form-group">
                                <label for="branchId">Branch ID</label>
                                <input type="text" id="branchId" class="form-control" value="1" required>
                            </div>

                            <div class="form-group">
                                <label for="Employee_ID">Employee ID</label>
                                <input type="text" id="Employee_ID" class="form-control" value="46" required>
                            </div>

                            <div class="form-group">
                                <label for="Diceased">Deceased</label>
                                <select id="Diceased" class="form-control">
                                    <option value="no" selected>No</option>
                                    <option value="yes">Yes</option>
                                </select>
                            </div>
                        </div>

                        <button type="submit" id="btn-hospital-submit" class="btn btn-primary" style="margin-top: 20px; padding: 12px 24px;">
                            🏥 Submit Patient Registration
                        </button>
                    </form>

                    <div id="hospital-response" class="hospital-result">
                        <div class="result-header">
                            <span style="font-size: 20px;">✅</span>
                            <span id="hospital-res-msg">Patient registered successfully!</span>
                        </div>
                        <div style="font-size: 0.9rem; color: var(--text-muted); margin-bottom: 4px;">Returned Check-in Timestamp:</div>
                        <div class="check-in-tag" id="hospital-checkin-time">--</div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- Toast Notifications Container -->
    <div id="toast-container"></div>

    <script>
        let authToken = localStorage.getItem('api_token') || null;
        let currentUser = JSON.parse(localStorage.getItem('user_data') || 'null');
        let productsData = [];

        // App Initialization
        document.addEventListener('DOMContentLoaded', () => {
            if (authToken && currentUser) {
                showDashboard(currentUser);
                fetchProducts();
            } else {
                showLogin();
            }
        });

        function showLogin() {
            document.getElementById('auth-view').classList.remove('hidden');
            document.getElementById('dashboard-view').classList.add('hidden');
            document.getElementById('user-info').classList.add('hidden');
            document.getElementById('btn-logout').classList.add('hidden');
        }

        function showDashboard(user) {
            document.getElementById('auth-view').classList.add('hidden');
            document.getElementById('dashboard-view').classList.remove('hidden');
            document.getElementById('user-info').classList.remove('hidden');
            document.getElementById('btn-logout').classList.remove('hidden');
            document.getElementById('user-email-display').textContent = user.email || 'Authenticated User';
            document.getElementById('avatar-letter').textContent = (user.name || user.email || 'U')[0].toUpperCase();
        }

        function fillLogin(email, pass) {
            document.getElementById('email').value = email;
            document.getElementById('password').value = pass;
        }

        // Login Handler
        async function handleLogin(e) {
            e.preventDefault();
            const btn = document.getElementById('btn-login-submit');
            btn.disabled = true;
            btn.textContent = 'Signing in...';

            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;

            try {
                const res = await fetch('/api/login', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json', 'Accept': 'application/json' },
                    body: JSON.stringify({ email, password })
                });

                const data = await res.json();

                if (res.ok && data.token) {
                    authToken = data.token;
                    currentUser = data.user;
                    localStorage.setItem('api_token', authToken);
                    localStorage.setItem('user_data', JSON.stringify(currentUser));
                    showToast('Logged in successfully', 'success');
                    showDashboard(currentUser);
                    fetchProducts();
                } else {
                    showToast(data.message || 'Invalid email or password', 'error');
                }
            } catch (err) {
                showToast('Network error during login: ' + err.message, 'error');
            } finally {
                btn.disabled = false;
                btn.textContent = 'Sign In & Open Dashboard';
            }
        }

        // Logout Handler
        async function handleLogout() {
            if (authToken) {
                try {
                    await fetch('/api/logout', {
                        method: 'POST',
                        headers: {
                            'Authorization': 'Bearer ' + authToken,
                            'Accept': 'application/json'
                        }
                    });
                } catch (e) {}
            }
            authToken = null;
            currentUser = null;
            localStorage.removeItem('api_token');
            localStorage.removeItem('user_data');
            showToast('Logged out', 'info');
            showLogin();
        }

        // Tab Switcher
        function switchTab(tab) {
            const tabProds = document.getElementById('tab-products');
            const tabHosp = document.getElementById('tab-hospital');
            const contentProds = document.getElementById('content-products');
            const contentHosp = document.getElementById('content-hospital');

            if (tab === 'products') {
                tabProds.classList.add('active');
                tabHosp.classList.remove('active');
                contentProds.classList.remove('hidden');
                contentHosp.classList.add('hidden');
            } else {
                tabProds.classList.remove('active');
                tabHosp.classList.add('active');
                contentProds.classList.add('hidden');
                contentHosp.classList.remove('hidden');
            }
        }

        // Fetch Products Catalog
        async function fetchProducts() {
            if (!authToken) return;
            try {
                const res = await fetch('/api/products', {
                    headers: {
                        'Authorization': 'Bearer ' + authToken,
                        'Accept': 'application/json'
                    }
                });

                if (res.status === 401) {
                    handleLogout();
                    return;
                }

                productsData = await res.json();
                renderProducts(productsData);
                updateStats(productsData);
            } catch (err) {
                showToast('Error loading products: ' + err.message, 'error');
            }
        }

        // Update Stats Counters
        function updateStats(products) {
            document.getElementById('stat-total-products').textContent = products.length;
            const rated = products.filter(p => p.user_rating !== null).length;
            const active = products.filter(p => p.active_time === 'active').length;
            document.getElementById('stat-my-ratings').textContent = rated;
            document.getElementById('stat-active-count').textContent = active;
        }

        // Render Products List
        function renderProducts(products) {
            const container = document.getElementById('products-container');
            container.innerHTML = '';

            if (products.length === 0) {
                container.innerHTML = '<div style="grid-column: 1/-1; text-align: center; color: var(--text-muted); padding: 40px;">No products found matching your search.</div>';
                return;
            }

            products.forEach(p => {
                const card = document.createElement('div');
                card.className = 'product-card';

                // Format Average Stars
                const avgRating = p.ratings !== null ? p.ratings : 'No ratings yet';
                const userRating = p.user_rating;
                
                // Status Badge
                let statusBadge = '<span class="status-badge status-unrated">Unrated</span>';
                if (p.active_time === 'active') {
                    statusBadge = `<span class="status-badge status-active">Active (${p.time_passed}m ago)</span>`;
                } else if (p.active_time === 'inactive') {
                    statusBadge = `<span class="status-badge status-inactive">Inactive (${p.time_passed}m ago)</span>`;
                }

                card.innerHTML = `
                    <div>
                        <div class="card-top">
                            <div>
                                <div class="product-title">${escapeHtml(p.name)}</div>
                            </div>
                            <div class="product-price">$${parseFloat(p.price).toFixed(2)}</div>
                        </div>

                        <div class="product-desc">${escapeHtml(p.description || '')}</div>

                        <div class="metrics-panel">
                            <div class="metric-row">
                                <span class="metric-title">Average Rating:</span>
                                <span style="font-weight: 700; color: var(--gold);">⭐ ${avgRating}</span>
                            </div>
                            <div class="metric-row">
                                <span class="metric-title">Freshness Status:</span>
                                <span>${statusBadge}</span>
                            </div>
                        </div>
                    </div>

                    <div>
                        <div style="font-size: 0.8rem; font-weight: 600; color: var(--text-muted); margin-bottom: 8px; display: flex; justify-content: space-between;">
                            <span>${userRating ? 'Your Rating: ' + userRating + ' / 5' : 'Rate this product:'}</span>
                            ${userRating ? '<span style="color: #818cf8;">(Click to change)</span>' : ''}
                        </div>

                        <div class="stars-container" id="stars-prod-${p.id}">
                            ${[1, 2, 3, 4, 5].map(star => `
                                <span class="star-interactive ${userRating && star <= userRating ? 'active' : ''}" 
                                      onclick="submitRating(${p.id}, ${star}, ${userRating !== null})">★</span>
                            `).join('')}
                        </div>

                        ${userRating !== null ? `
                            <div class="rating-actions">
                                <button class="btn btn-danger btn-sm" onclick="deleteRating(${p.id})">
                                    🗑️ Remove Rating
                                </button>
                            </div>
                        ` : ''}
                    </div>
                `;

                container.appendChild(card);
            });
        }

        // Rate or Change Rating
        async function submitRating(productId, ratingValue, isUpdate) {
            if (!authToken) return;
            const method = isUpdate ? 'PUT' : 'POST';
            const endpoint = `/api/products/${productId}/rate`;

            try {
                const res = await fetch(endpoint, {
                    method: method,
                    headers: {
                        'Authorization': 'Bearer ' + authToken,
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({ rating: ratingValue })
                });

                const data = await res.json();

                if (res.ok) {
                    showToast(`Rating set to ${ratingValue} ⭐ successfully`, 'success');
                    fetchProducts();
                } else if (res.status === 409) {
                    // If conflict, try update
                    submitRating(productId, ratingValue, true);
                } else {
                    showToast(data.message || 'Failed to submit rating', 'error');
                }
            } catch (err) {
                showToast('Error: ' + err.message, 'error');
            }
        }

        // Delete Rating
        async function deleteRating(productId) {
            if (!authToken) return;
            try {
                const res = await fetch(`/api/products/${productId}/rate`, {
                    method: 'DELETE',
                    headers: {
                        'Authorization': 'Bearer ' + authToken,
                        'Accept': 'application/json'
                    }
                });

                const data = await res.json();
                if (res.ok) {
                    showToast('Rating removed successfully', 'info');
                    fetchProducts();
                } else {
                    showToast(data.message || 'Failed to remove rating', 'error');
                }
            } catch (err) {
                showToast('Error: ' + err.message, 'error');
            }
        }

        // Filter Products Search
        function filterProducts() {
            const query = document.getElementById('search-input').value.toLowerCase();
            const filtered = productsData.filter(p => 
                p.name.toLowerCase().includes(query) || 
                (p.description && p.description.toLowerCase().includes(query))
            );
            renderProducts(filtered);
        }

        // Auto-fill Sample Hospital Form Data
        function fillHospitalSample() {
            document.getElementById('Patient_Name').value = 'ngenzi ngenzi';
            document.getElementById('Date_Of_Birth').value = '2022-07-02';
            document.getElementById('Gender').value = 'Male';
            document.getElementById('Sponsor_ID').value = '1';
            document.getElementById('Visit_Type_ID').value = '1';
            document.getElementById('Type_Of_Check_In').value = '1';
            document.getElementById('branchId').value = '1';
            document.getElementById('Employee_ID').value = '46';
            document.getElementById('Diceased').value = 'no';
            showToast('Sample patient data loaded', 'info');
        }

        // Handle Hospital Registration Submission
        async function handleHospitalSubmit(e) {
            e.preventDefault();
            const btn = document.getElementById('btn-hospital-submit');
            btn.disabled = true;
            btn.textContent = 'Registering with Hospital...';

            const payload = {
                Sponsor_ID: document.getElementById('Sponsor_ID').value,
                Patient_Name: document.getElementById('Patient_Name').value,
                Date_Of_Birth: document.getElementById('Date_Of_Birth').value,
                Gender: document.getElementById('Gender').value,
                Visit_Type_ID: document.getElementById('Visit_Type_ID').value,
                Type_Of_Check_In: document.getElementById('Type_Of_Check_In').value,
                branchId: document.getElementById('branchId').value,
                Employee_ID: document.getElementById('Employee_ID').value,
                pf3: null,
                Diceased: document.getElementById('Diceased').value,
                Referral_Status: null
            };

            try {
                const res = await fetch('/api/patient-registration', {
                    method: 'POST',
                    headers: {
                        'Authorization': 'Bearer ' + authToken,
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify(payload)
                });

                const data = await res.json();

                if (res.ok) {
                    const resultBox = document.getElementById('hospital-response');
                    document.getElementById('hospital-res-msg').textContent = data.message || 'Patient registered successfully!';
                    document.getElementById('hospital-checkin-time').textContent = data.Check_In_Date_And_Time || new Date().toISOString();
                    resultBox.style.display = 'block';
                    showToast('Check_In_Date_And_Time returned with message successfully', 'success');
                } else {
                    showToast(data.message || 'Registration failed', 'error');
                }
            } catch (err) {
                showToast('Error communicating with server: ' + err.message, 'error');
            } finally {
                btn.disabled = false;
                btn.textContent = '🏥 Submit Patient Registration';
            }
        }

        // Toast Helper
        function showToast(message, type = 'info') {
            const container = document.getElementById('toast-container');
            const toast = document.createElement('div');
            toast.className = `toast toast-${type}`;
            const icon = type === 'success' ? '✅' : type === 'error' ? '❌' : 'ℹ️';
            toast.innerHTML = `<span>${icon}</span><span style="font-size: 0.9rem;">${escapeHtml(message)}</span>`;
            container.appendChild(toast);
            setTimeout(() => {
                toast.style.opacity = '0';
                toast.style.transform = 'translateY(10px)';
                setTimeout(() => toast.remove(), 300);
            }, 4000);
        }

        function escapeHtml(str) {
            return String(str).replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;');
        }
    </script>
</body>
</html>
