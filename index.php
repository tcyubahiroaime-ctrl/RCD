<?php
// Show success messages
$contact_success = isset($_GET['contact_success']);
$purchase_success = isset($_GET['purchase_success']);
$payment_success = isset($_GET['payment_success']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rwanda Car Dealer | Buy & Sell New & Used Cars in Rwanda</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;14..32,400;14..32,500;14..32,600;14..32,700;14..32,800&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --primary: #0066cc;
            --primary-dark: #0052a3;
            --primary-light: #e6f0ff;
            --secondary: #ff8c00;
            --text-dark: #1a1a1a;
            --text-light: #666666;
            --text-muted: #999999;
            --border: #e5e7eb;
            --bg-white: #ffffff;
            --bg-gray: #f9fafb;
            --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
            --radius: 12px;
            --radius-sm: 8px;
            --transition: all 0.3s ease;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--bg-gray);
            color: var(--text-dark);
            line-height: 1.5;
        }

        .container {
            max-width: 1280px;
            margin: 0 auto;
            padding: 0 24px;
        }

        /* Header */
        .header {
            background: var(--bg-white);
            box-shadow: var(--shadow-sm);
            position: sticky;
            top: 0;
            z-index: 100;
            border-bottom: 1px solid var(--border);
        }

        .header-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 16px 0;
        }

        /* Professional Logo */
        .logo {
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            padding: 8px 20px;
            border-radius: 40px;
            box-shadow: var(--shadow-sm);
            transition: var(--transition);
        }

        .logo:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
        }

        .logo-icon {
            font-size: 28px;
            color: white;
        }

        .logo-text {
            font-size: 20px;
            font-weight: 800;
            color: white;
            letter-spacing: -0.5px;
        }

        .logo-badge {
            background: rgba(255,255,255,0.2);
            padding: 4px 8px;
            border-radius: 20px;
            font-size: 10px;
            font-weight: 600;
            color: white;
            margin-left: 6px;
        }

        .nav-menu {
            display: flex;
            list-style: none;
            gap: 32px;
        }

        .nav-link {
            text-decoration: none;
            color: var(--text-light);
            font-weight: 500;
            transition: var(--transition);
        }

        .nav-link:hover {
            color: var(--primary);
        }

        .nav-link.active {
            color: var(--primary);
            font-weight: 600;
        }

        .mobile-menu-btn {
            display: none;
            background: none;
            border: none;
            font-size: 24px;
            cursor: pointer;
            color: var(--text-dark);
        }

        /* Hero Section with Background Image */
        .hero {
            background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('https://images.unsplash.com/photo-1494976388531-d1058494cdd8?w=1600&h=600&fit=crop');
            background-size: cover;
            background-position: center 30%;
            padding: 100px 0 80px;
            color: white;
            position: relative;
        }

        .hero-content {
            text-align: center;
            max-width: 700px;
            margin: 0 auto;
        }

        .hero h1 {
            font-size: 48px;
            font-weight: 800;
            margin-bottom: 16px;
            text-shadow: 0 2px 4px rgba(0,0,0,0.3);
        }

        .hero p {
            font-size: 18px;
            margin-bottom: 32px;
            opacity: 0.95;
            text-shadow: 0 1px 2px rgba(0,0,0,0.2);
        }

        /* Search Bar */
        .search-container {
            background: var(--bg-white);
            border-radius: var(--radius);
            box-shadow: var(--shadow-lg);
            padding: 24px;
            margin-top: 20px;
        }

        .search-form {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            align-items: flex-end;
        }

        .search-group {
            flex: 1;
            min-width: 180px;
        }

        .search-group label {
            display: block;
            font-size: 12px;
            font-weight: 600;
            color: var(--text-light);
            margin-bottom: 6px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .search-input, .search-select {
            width: 100%;
            padding: 12px 16px;
            border: 1px solid var(--border);
            border-radius: var(--radius-sm);
            font-size: 14px;
            transition: var(--transition);
            background: var(--bg-white);
        }

        .search-input:focus, .search-select:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(0, 102, 204, 0.1);
        }

        .search-btn {
            background: var(--primary);
            color: white;
            border: none;
            padding: 12px 32px;
            border-radius: var(--radius-sm);
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
            height: 48px;
        }

        .search-btn:hover {
            background: var(--primary-dark);
        }

        /* Section Header */
        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 32px;
            flex-wrap: wrap;
            gap: 16px;
        }

        .section-header h2 {
            font-size: 28px;
            font-weight: 700;
            color: var(--text-dark);
        }

        .section-header p {
            color: var(--text-light);
        }

        /* Cars Section - Horizontal Scroll with Buttons */
        .cars-section {
            position: relative;
            padding: 60px 0;
        }

        .cars-wrapper {
            position: relative;
            overflow: visible;
        }

        .cars-grid {
            display: flex;
            gap: 24px;
            overflow-x: auto;
            scroll-behavior: smooth;
            padding: 10px 0 20px;
            scrollbar-width: thin;
            -webkit-overflow-scrolling: touch;
        }

        .cars-grid::-webkit-scrollbar {
            height: 6px;
        }

        .cars-grid::-webkit-scrollbar-track {
            background: var(--border);
            border-radius: 10px;
        }

        .cars-grid::-webkit-scrollbar-thumb {
            background: var(--primary);
            border-radius: 10px;
        }

        /* Medium size car card */
        .car-card {
            background: var(--bg-white);
            border-radius: var(--radius);
            overflow: hidden;
            transition: var(--transition);
            border: 1px solid var(--border);
            flex: 0 0 320px;   /* fixed medium width */
            position: relative;
        }

        .car-card:hover {
            transform: translateY(-6px);
            box-shadow: var(--shadow-lg);
            border-color: var(--primary-light);
        }

        .car-image {
            position: relative;
            height: 200px;      /* medium height */
            overflow: hidden;
            background: var(--bg-gray);
        }

        .car-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.4s;
        }

        .car-card:hover .car-image img {
            transform: scale(1.05);
        }

        .car-badge {
            position: absolute;
            top: 12px;
            left: 12px;
            background: var(--secondary);
            color: white;
            padding: 4px 10px;
            border-radius: 4px;
            font-size: 11px;
            font-weight: 600;
        }

        .car-badge.new {
            background: var(--primary);
        }

        .car-rating {
            position: absolute;
            bottom: 12px;
            right: 12px;
            background: rgba(0,0,0,0.7);
            color: white;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 12px;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .car-rating i {
            color: #ffc107;
        }

        .car-content {
            padding: 20px;
        }

        .car-title {
            font-size: 18px;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 8px;
        }

        .car-price {
            font-size: 20px;
            font-weight: 800;
            color: var(--primary);
            margin-bottom: 12px;
        }

        .car-specs {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            margin-bottom: 16px;
            padding-bottom: 16px;
            border-bottom: 1px solid var(--border);
        }

        .spec-item {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 13px;
            color: var(--text-light);
        }

        .spec-item i {
            color: var(--primary);
            width: 16px;
        }

        .car-features {
            margin-bottom: 16px;
        }

        .features-list {
            list-style: none;
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
        }

        .features-list li {
            font-size: 12px;
            color: var(--text-light);
            background: var(--bg-gray);
            padding: 4px 10px;
            border-radius: 20px;
        }

        .car-actions {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
            margin-top: 8px;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 10px 16px;
            border-radius: var(--radius-sm);
            font-weight: 600;
            font-size: 14px;
            text-decoration: none;
            transition: var(--transition);
            cursor: pointer;
            border: none;
        }

        .btn-primary {
            background: var(--primary);
            color: white;
        }

        .btn-primary:hover {
            background: var(--primary-dark);
        }

        .btn-outline {
            background: transparent;
            border: 1px solid var(--border);
            color: var(--text-dark);
        }

        .btn-outline:hover {
            border-color: var(--primary);
            color: var(--primary);
        }

        /* Scroll Buttons */
        .scroll-btn {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            width: 44px;
            height: 44px;
            background: var(--bg-white);
            border: 1px solid var(--border);
            border-radius: 50%;
            box-shadow: var(--shadow-md);
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: var(--transition);
            z-index: 10;
            color: var(--primary);
            font-size: 20px;
        }

        .scroll-btn:hover {
            background: var(--primary);
            color: white;
            border-color: var(--primary);
        }

        .scroll-left {
            left: -20px;
        }

        .scroll-right {
            right: -20px;
        }

        @media (max-width: 1024px) {
            .scroll-left {
                left: 0;
            }
            .scroll-right {
                right: 0;
            }
        }

        /* Services Section */
        .services-section {
            background: var(--bg-gray);
            padding: 60px 0;
        }

        .services-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 32px;
            margin-top: 40px;
        }

        .service-card {
            text-align: center;
            padding: 32px 20px;
            border-radius: var(--radius);
            transition: var(--transition);
            background: var(--bg-white);
        }

        .service-card:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-md);
        }

        .service-icon {
            width: 70px;
            height: 70px;
            background: var(--primary-light);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            color: var(--primary);
            font-size: 28px;
        }

        .service-card h3 {
            font-size: 18px;
            font-weight: 700;
            margin-bottom: 10px;
        }

        .service-card p {
            color: var(--text-light);
            font-size: 14px;
        }

        /* Contact Section */
        .contact-section {
            padding: 60px 0;
            background: var(--bg-white);
        }

        .contact-grid {
            display: grid;
            grid-template-columns: 1fr 1.5fr;
            gap: 48px;
        }

        .contact-info {
            background: var(--primary);
            padding: 32px;
            border-radius: var(--radius);
            color: white;
        }

        .contact-info h3 {
            font-size: 24px;
            margin-bottom: 24px;
        }

        .contact-item {
            display: flex;
            gap: 16px;
            margin-bottom: 24px;
            align-items: flex-start;
        }

        .contact-icon {
            width: 44px;
            height: 44px;
            background: rgba(255,255,255,0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
        }

        .contact-text h4 {
            font-size: 16px;
            margin-bottom: 4px;
        }

        .contact-text p, .contact-text a {
            color: rgba(255,255,255,0.9);
            text-decoration: none;
            font-size: 14px;
        }

        .social-links {
            display: flex;
            gap: 12px;
            margin-top: 24px;
        }

        .social-link {
            width: 40px;
            height: 40px;
            background: rgba(255,255,255,0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            transition: var(--transition);
        }

        .social-link:hover {
            background: white;
            color: var(--primary);
        }

        .contact-form {
            background: var(--bg-gray);
            padding: 32px;
            border-radius: var(--radius);
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            font-size: 14px;
            font-weight: 500;
            margin-bottom: 8px;
            color: var(--text-dark);
        }

        input, select, textarea {
            width: 100%;
            padding: 12px 16px;
            border: 1px solid var(--border);
            border-radius: var(--radius-sm);
            font-size: 14px;
            transition: var(--transition);
        }

        input:focus, select:focus, textarea:focus {
            outline: none;
            border-color: var(--primary);
        }

        textarea {
            resize: vertical;
            min-height: 100px;
        }

        /* Footer */
        .footer {
            background: var(--text-dark);
            color: var(--text-muted);
            padding: 48px 0 24px;
        }

        .footer-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 40px;
            margin-bottom: 40px;
        }

        .footer-col h4 {
            color: white;
            font-size: 16px;
            margin-bottom: 20px;
            font-weight: 600;
        }

        .footer-links {
            list-style: none;
        }

        .footer-links li {
            margin-bottom: 12px;
        }

        .footer-links a {
            color: var(--text-muted);
            text-decoration: none;
            font-size: 14px;
            transition: var(--transition);
        }

        .footer-links a:hover {
            color: white;
        }

        .copyright {
            text-align: center;
            padding-top: 24px;
            border-top: 1px solid rgba(255,255,255,0.1);
            font-size: 13px;
        }

        /* Alert */
        .alert-success {
            background: #d1fae5;
            color: #065f46;
            padding: 16px;
            border-radius: var(--radius);
            margin-bottom: 24px;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        /* Modal */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.7);
            overflow: auto;
        }

        .modal-content {
            background: var(--bg-white);
            margin: 40px auto;
            width: 90%;
            max-width: 900px;
            border-radius: var(--radius);
            animation: slideDown 0.3s;
        }

        @keyframes slideDown {
            from { transform: translateY(-50px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }

        .modal-header {
            padding: 20px 24px;
            border-bottom: 1px solid var(--border);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .modal-header h2 {
            font-size: 24px;
        }

        .close-modal {
            font-size: 28px;
            cursor: pointer;
            transition: var(--transition);
        }

        .close-modal:hover {
            color: var(--primary);
        }

        .modal-body {
            padding: 24px;
            max-height: 70vh;
            overflow-y: auto;
        }

        .modal-gallery {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 24px;
        }

        .main-image {
            height: 300px;
            border-radius: var(--radius);
            overflow: hidden;
        }

        .main-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .thumbnails {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 10px;
        }

        .thumbnail {
            height: 90px;
            border-radius: var(--radius-sm);
            overflow: hidden;
            cursor: pointer;
            border: 2px solid transparent;
        }

        .thumbnail:hover {
            border-color: var(--primary);
        }

        .thumbnail img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .modal-details {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 24px;
        }

        .detail-card {
            background: var(--bg-gray);
            padding: 20px;
            border-radius: var(--radius);
        }

        .detail-card h3 {
            font-size: 16px;
            margin-bottom: 16px;
            color: var(--primary);
        }

        .spec-row {
            display: flex;
            justify-content: space-between;
            padding: 8px 0;
            border-bottom: 1px solid var(--border);
        }

        .modal-actions {
            display: flex;
            gap: 16px;
            margin-top: 24px;
            padding-top: 20px;
            border-top: 1px solid var(--border);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .container {
                padding: 0 16px;
            }
            .nav-menu {
                display: none;
            }
            .mobile-menu-btn {
                display: block;
            }
            .hero h1 {
                font-size: 32px;
            }
            .search-form {
                flex-direction: column;
            }
            .search-btn {
                width: 100%;
            }
            .contact-grid, .footer-grid, .modal-gallery, .modal-details {
                grid-template-columns: 1fr;
            }
            .form-row {
                grid-template-columns: 1fr;
            }
            .scroll-btn {
                display: none;
            }
            .car-card {
                flex: 0 0 280px;
            }
        }
    </style>
</head>
<body>
    <header class="header">
        <div class="container header-container">
            <a href="#" class="logo">
                <i class="fas fa-car logo-icon"></i>
                <span class="logo-text">Rwanda Car Dealer</span>
                <span class="logo-badge">Since 2015</span>
            </a>
            <ul class="nav-menu">
                <li><a href="#home" class="nav-link active">Home</a></li>
                <li><a href="#inventory" class="nav-link">Inventory</a></li>
                <li><a href="#services" class="nav-link">Services</a></li>
                <li><a href="#contact" class="nav-link">Contact</a></li>
                <li><a href="admin/admin.php" class="nav-link">Admin</a></li>
            </ul>
            <button class="mobile-menu-btn"><i class="fas fa-bars"></i></button>
        </div>
    </header>

    <section id="home" class="hero">
        <div class="container">
            <div class="hero-content">
                <h1>Find Your Perfect Car in Rwanda</h1>
                <p>Explore thousands of new and used cars from trusted dealers. Best prices, easy financing, and free delivery.</p>
            </div>
            <div class="search-container">
                <form class="search-form" id="searchForm">
                    <div class="search-group">
                        <label>Search by name</label>
                        <input type="text" id="searchInput" class="search-input" placeholder="e.g., Toyota, BMW, Mercedes">
                    </div>
                    <div class="search-group">
                        <label>Category</label>
                        <select id="categoryFilter" class="search-select">
                            <option value="all">All Categories</option>
                            <option value="sedan">Sedan</option>
                            <option value="suv">SUV</option>
                            <option value="truck">Truck</option>
                            <option value="electric">Electric</option>
                        </select>
                    </div>
                    <button type="button" class="search-btn" onclick="filterCars()">
                        <i class="fas fa-search"></i> Search
                    </button>
                </form>
            </div>
        </div>
    </section>

    <?php if ($contact_success || $purchase_success || $payment_success): ?>
    <div class="container" style="margin-top: 24px;">
        <div class="alert-success">
            <i class="fas fa-check-circle"></i>
            <?php if ($contact_success): ?>Thank you! Your message has been sent. We'll get back to you soon.
            <?php elseif ($purchase_success): ?>Thank you! Your purchase request has been sent. We'll contact you soon.
            <?php elseif ($payment_success): ?>Thank you! Your payment request has been submitted. We will contact you shortly.
            <?php endif; ?>
        </div>
    </div>
    <?php endif; ?>

    <section id="inventory" class="cars-section">
        <div class="container">
            <div class="section-header">
                <div>
                    <h2>Featured Vehicles</h2>
                    <p>Hand-picked selection of premium automobiles</p>
                </div>
            </div>
            <div class="cars-wrapper">
                <button class="scroll-btn scroll-left" id="scrollLeftBtn" onclick="scrollCarsLeft()">
                    <i class="fas fa-chevron-left"></i>
                </button>
                <button class="scroll-btn scroll-right" id="scrollRightBtn" onclick="scrollCarsRight()">
                    <i class="fas fa-chevron-right"></i>
                </button>
                <div class="cars-grid" id="carsGrid">
                <?php
                $file = "vehicles.json";
                $allVehicles = [];
                if (file_exists($file)) {
                    $allVehicles = json_decode(file_get_contents($file), true);
                    if (!empty($allVehicles)) {
                        foreach ($allVehicles as $car) {
                ?>
                <div class="car-card" data-name="<?= strtolower(htmlspecialchars($car['name'])) ?>" data-category="<?= strtolower(htmlspecialchars($car['badge'])) ?>">
                    <div class="car-image">
                        <img src="<?= htmlspecialchars($car['image']) ?>" alt="<?= htmlspecialchars($car['name']) ?>">
                        <div class="car-badge <?= $car['badge'] === 'New' ? 'new' : '' ?>"><?= htmlspecialchars($car['badge']) ?></div>
                        <div class="car-rating">
                            <i class="fas fa-star"></i> <?= htmlspecialchars($car['rating']) ?>
                        </div>
                    </div>
                    <div class="car-content">
                        <h3 class="car-title"><?= htmlspecialchars($car['name']) ?></h3>
                        <div class="car-price"><?= htmlspecialchars($car['price']) ?></div>
                        <div class="car-specs">
                            <div class="spec-item"><i class="fas fa-calendar"></i> <?= htmlspecialchars($car['year']) ?></div>
                            <div class="spec-item"><i class="fas fa-gas-pump"></i> <?= htmlspecialchars($car['fuel']) ?></div>
                            <div class="spec-item"><i class="fas fa-user-friends"></i> <?= htmlspecialchars($car['seats']) ?> seats</div>
                            <div class="spec-item"><i class="fas fa-check-circle"></i> <?= htmlspecialchars($car['status']) ?></div>
                        </div>
                        <div class="car-features">
                            <ul class="features-list">
                                <?php
                                $features = explode(",", $car['features']);
                                $displayFeatures = array_slice($features, 0, 3);
                                foreach ($displayFeatures as $feature) {
                                    echo "<li>" . htmlspecialchars(trim($feature)) . "</li>";
                                }
                                ?>
                            </ul>
                        </div>
                        <div class="car-actions">
                            <button class="btn btn-primary" onclick='showCarDetails(<?= json_encode($car) ?>)'>
                                <i class="fas fa-info-circle"></i> Details
                            </button>
                            <a href="buy.php?id=<?= $car['id'] ?>" class="btn btn-outline">
                                <i class="fas fa-shopping-cart"></i> Buy Now
                            </a>
                        </div>
                    </div>
                </div>
                <?php
                        }
                    } else {
                        echo "<p style='grid-column:1/-1; text-align:center;'>No vehicles available.</p>";
                    }
                } else {
                    echo "<p style='grid-column:1/-1; text-align:center;'>Vehicle data not found.</p>";
                }
                ?>
                </div>
            </div>
        </div>
    </section>

    <section id="services" class="services-section">
        <div class="container">
            <div class="section-header">
                <div>
                    <h2>Our Premium Services</h2>
                    <p>Exceptional service at every stage of your journey</p>
                </div>
            </div>
            <div class="services-grid">
                <div class="service-card">
                    <div class="service-icon"><i class="fas fa-credit-card"></i></div>
                    <h3>Flexible Financing</h3>
                    <p>Easy payment plans and competitive rates tailored to your budget</p>
                </div>
                <div class="service-card">
                    <div class="service-icon"><i class="fas fa-truck"></i></div>
                    <h3>Free Delivery</h3>
                    <p>Fast and secure door-to-door delivery across Rwanda</p>
                </div>
                <div class="service-card">
                    <div class="service-icon"><i class="fas fa-shield-alt"></i></div>
                    <h3>Warranty Protection</h3>
                    <p>Comprehensive coverage and peace of mind for your investment</p>
                </div>
                <div class="service-card">
                    <div class="service-icon"><i class="fas fa-wrench"></i></div>
                    <h3>Maintenance Support</h3>
                    <p>Professional servicing and spare parts availability</p>
                </div>
            </div>
        </div>
    </section>

    <section id="contact" class="contact-section">
        <div class="container">
            <div class="section-header">
                <div>
                    <h2>Get In Touch</h2>
                    <p>Have questions? We'd love to hear from you.</p>
                </div>
            </div>
            <div class="contact-grid">
                <div class="contact-info">
                    <h3>Contact Details</h3>
                    <div class="contact-item">
                        <div class="contact-icon"><i class="fas fa-map-marker-alt"></i></div>
                        <div class="contact-text">
                            <h4>Location</h4>
                            <p>Kigali, Rwanda</p>
                        </div>
                    </div>
                    <div class="contact-item">
                        <div class="contact-icon"><i class="fas fa-phone"></i></div>
                        <div class="contact-text">
                            <h4>Phone</h4>
                            <a href="tel:+250123456789">+250 (0) 123 456 789</a>
                        </div>
                    </div>
                    <div class="contact-item">
                        <div class="contact-icon"><i class="fas fa-envelope"></i></div>
                        <div class="contact-text">
                            <h4>Email</h4>
                            <a href="mailto:info@rwandacardealer.com">info@rwandacardealer.com</a>
                        </div>
                    </div>
                    <div class="contact-item">
                        <div class="contact-icon"><i class="fas fa-clock"></i></div>
                        <div class="contact-text">
                            <h4>Working Hours</h4>
                            <p>Mon - Fri: 8:00 - 18:00<br>Sat: 9:00 - 16:00</p>
                        </div>
                    </div>
                    <div class="social-links">
                        <a href="#" class="social-link"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="social-link"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="social-link"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="social-link"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
                <form class="contact-form" action="submit_contact.php" method="POST">
                    <div class="form-row">
                        <div class="form-group">
                            <label>Full Name</label>
                            <input type="text" name="full_name" required>
                        </div>
                        <div class="form-group">
                            <label>Email Address</label>
                            <input type="email" name="email" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Phone Number</label>
                        <input type="tel" name="phone" required>
                    </div>
                    <div class="form-group">
                        <label>Subject</label>
                        <input type="text" name="subject" required>
                    </div>
                    <div class="form-group">
                        <label>Message</label>
                        <textarea name="message" rows="4" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary" style="width:100%;">
                        <i class="fas fa-paper-plane"></i> Send Message
                    </button>
                </form>
            </div>
        </div>
    </section>

    <footer class="footer">
        <div class="container">
            <div class="footer-grid">
                <div class="footer-col">
                    <h4>About Us</h4>
                    <ul class="footer-links">
                        <li><a href="#inventory">Our Fleet</a></li>
                        <li><a href="#services">Our Services</a></li>
                        <li><a href="#contact">Contact</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h4>Quick Links</h4>
                    <ul class="footer-links">
                        <li><a href="#inventory">Browse Cars</a></li>
                        <li><a href="#services">Services</a></li>
                        <li><a href="admin/admin.php">Admin Panel</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h4>Support</h4>
                    <ul class="footer-links">
                        <li><a href="#contact">Contact Us</a></li>
                        <li><a href="#">FAQs</a></li>
                        <li><a href="#">Financing</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h4>Legal</h4>
                    <ul class="footer-links">
                        <li><a href="#">Privacy Policy</a></li>
                        <li><a href="#">Terms & Conditions</a></li>
                    </ul>
                </div>
            </div>
            <div class="copyright">
                <p>&copy; 2025 Rwanda Car Dealer. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Car Modal -->
    <div id="carModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 id="modalTitle">Car Details</h2>
                <span class="close-modal" onclick="closeCarModal()">&times;</span>
            </div>
            <div class="modal-body">
                <div class="modal-gallery">
                    <div class="main-image">
                        <img id="modalMainImage" src="" alt="Car">
                    </div>
                    <div class="thumbnails" id="modalThumbnails"></div>
                </div>
                <div class="modal-details">
                    <div class="detail-card">
                        <h3>Specifications</h3>
                        <div class="spec-row"><span>Year</span><span id="modalYear">-</span></div>
                        <div class="spec-row"><span>Fuel</span><span id="modalFuel">-</span></div>
                        <div class="spec-row"><span>Seats</span><span id="modalSeats">-</span></div>
                        <div class="spec-row"><span>Status</span><span id="modalStatus">-</span></div>
                        <div class="spec-row"><span>Price</span><span id="modalPrice">-</span></div>
                    </div>
                    <div class="detail-card">
                        <h3>Features</h3>
                        <ul class="features-list" id="modalFeatures"></ul>
                    </div>
                </div>
                <div class="modal-actions">
                    <a href="#" id="modalBuyLink" class="btn btn-primary"><i class="fas fa-shopping-cart"></i> Buy Now</a>
                    <button class="btn btn-outline" onclick="closeCarModal()">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Scroll functions for horizontal car grid
        function scrollCarsLeft() {
            const grid = document.getElementById('carsGrid');
            grid.scrollBy({ left: -350, behavior: 'smooth' });
        }
        function scrollCarsRight() {
            const grid = document.getElementById('carsGrid');
            grid.scrollBy({ left: 350, behavior: 'smooth' });
        }

        // Filter cars
        function filterCars() {
            const searchTerm = document.getElementById('searchInput').value.toLowerCase();
            const category = document.getElementById('categoryFilter').value;
            const cards = document.querySelectorAll('.car-card');
            let visible = 0;

            cards.forEach(card => {
                const name = card.dataset.name;
                const cat = card.dataset.category;
                const matchesSearch = name.includes(searchTerm);
                const matchesCategory = category === 'all' || cat === category;

                if (matchesSearch && matchesCategory) {
                    card.style.display = 'block';
                    visible++;
                } else {
                    card.style.display = 'none';
                }
            });

            const grid = document.getElementById('carsGrid');
            let noResult = document.getElementById('noResults');
            if (visible === 0) {
                if (!noResult) {
                    noResult = document.createElement('div');
                    noResult.id = 'noResults';
                    noResult.style.cssText = 'grid-column:1/-1; text-align:center; padding:40px; color: #999; width:100%;';
                    noResult.innerHTML = '<i class="fas fa-search" style="font-size:48px; margin-bottom:16px; display:block;"></i><p>No vehicles found. Try different keywords.</p>';
                    grid.appendChild(noResult);
                }
            } else if (noResult) {
                noResult.remove();
            }
        }

        // Modal functions
        function showCarDetails(car) {
            document.getElementById('modalTitle').innerText = car.name;
            document.getElementById('modalMainImage').src = car.image;
            document.getElementById('modalYear').innerText = car.year;
            document.getElementById('modalFuel').innerText = car.fuel;
            document.getElementById('modalSeats').innerText = car.seats + ' seats';
            document.getElementById('modalStatus').innerText = car.status;
            document.getElementById('modalPrice').innerText = car.price;
            document.getElementById('modalBuyLink').href = 'buy.php?id=' + car.id;

            const featuresList = document.getElementById('modalFeatures');
            featuresList.innerHTML = '';
            const features = car.features.split(',').map(f => f.trim());
            features.forEach(f => {
                const li = document.createElement('li');
                li.innerHTML = '<i class="fas fa-check"></i> ' + f;
                featuresList.appendChild(li);
            });

            const thumbContainer = document.getElementById('modalThumbnails');
            thumbContainer.innerHTML = '';
            const thumb = document.createElement('div');
            thumb.className = 'thumbnail';
            thumb.innerHTML = `<img src="${car.image}" alt="thumb" onclick="document.getElementById('modalMainImage').src='${car.image}'">`;
            thumbContainer.appendChild(thumb);

            document.getElementById('carModal').style.display = 'block';
        }

        function closeCarModal() {
            document.getElementById('carModal').style.display = 'none';
        }

        window.onclick = function(event) {
            if (event.target === document.getElementById('carModal')) closeCarModal();
        }

        // Mobile menu toggle
        document.querySelector('.mobile-menu-btn').addEventListener('click', function() {
            const nav = document.querySelector('.nav-menu');
            nav.style.display = nav.style.display === 'flex' ? 'none' : 'flex';
        });
    </script>
</body>
</html>