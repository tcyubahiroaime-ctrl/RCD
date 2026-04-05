<?php
// Get car ID from URL
$car_id = isset($_GET['id']) ? $_GET['id'] : null;

// Load vehicle data
$file = "vehicles.json";
$car = null;

if (file_exists($file)) {
    $vehicles = json_decode(file_get_contents($file), true);
    if (!empty($vehicles)) {
        foreach ($vehicles as $vehicle) {
            if ($vehicle['id'] == $car_id) {
                $car = $vehicle;
                break;
            }
        }
    }
}

// If car not found, redirect
if (!$car) {
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($car['name']); ?> - RWANDA CAR DEALER</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Montserrat:wght@700;800;900&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #1e40af;
            --primary-dark: #1e3a8a;
            --secondary: #0f172a;
            --accent: #3b82f6;
            --light: #f8fafc;
            --gray: #64748b;
            --dark-gray: #334155;
            --light-gray: #e2e8f0;
            --success: #10b981;
            --warning: #f59e0b;
            --white: #ffffff;
            --shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            line-height: 1.6;
            color: #1e293b;
            background-color: #f1f5f9;
        }

        h1, h2, h3, h4, h5, h6 {
            font-family: 'Montserrat', sans-serif;
            font-weight: 700;
        }

        .container {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .btn {
            display: inline-block;
            padding: 12px 28px;
            border-radius: 8px;
            font-weight: 600;
            text-decoration: none;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
            border: none;
            font-size: 16px;
        }

        .btn-primary {
            background-color: var(--primary);
            color: var(--white);
        }

        .btn-primary:hover {
            background-color: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: var(--shadow-lg);
        }

        .btn-secondary {
            background-color: var(--success);
            color: var(--white);
        }

        .btn-secondary:hover {
            background-color: #059669;
        }

        /* Header */
        header {
            background-color: var(--white);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .header-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 16px 0;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
        }

        .logo-icon {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, var(--primary), var(--accent));
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
        }

        .logo-text {
            font-size: 24px;
            font-weight: 800;
            color: var(--secondary);
        }

        .back-link {
            text-decoration: none;
            color: var(--primary);
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        /* Breadcrumb */
        .breadcrumb {
            background-color: var(--light);
            padding: 15px 0;
            margin-bottom: 40px;
        }

        .breadcrumb-content {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .breadcrumb-item {
            color: var(--gray);
        }

        .breadcrumb-item a {
            color: var(--primary);
            text-decoration: none;
        }

        .breadcrumb-item.active {
            color: var(--secondary);
            font-weight: 600;
        }

        /* Main Content */
        .car-details-section {
            background-color: var(--white);
            border-radius: 16px;
            overflow: hidden;
            box-shadow: var(--shadow);
            margin-bottom: 40px;
        }

        .car-gallery {
            position: relative;
            height: 500px;
            background: #f0f0f0;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        .car-gallery img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .car-gallery:hover img {
            transform: scale(1.05);
        }

        .car-badge-large {
            position: absolute;
            top: 20px;
            right: 20px;
            background: linear-gradient(135deg, var(--primary), var(--accent));
            color: white;
            padding: 12px 24px;
            border-radius: 24px;
            font-weight: 700;
            font-size: 16px;
            box-shadow: var(--shadow-lg);
        }

        .car-rating-large {
            position: absolute;
            bottom: 20px;
            left: 20px;
            background: rgba(0, 0, 0, 0.7);
            color: white;
            padding: 12px 18px;
            border-radius: 8px;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 18px;
        }

        .car-rating-large i {
            color: #f59e0b;
        }

        /* Car Info Header */
        .car-info-header {
            padding: 40px;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: white;
        }

        .car-title-price {
            display: flex;
            justify-content: space-between;
            align-items: start;
            margin-bottom: 30px;
            flex-wrap: wrap;
            gap: 20px;
        }

        .car-title-section h1 {
            font-size: 40px;
            margin-bottom: 10px;
        }

        .car-title-section p {
            font-size: 18px;
            opacity: 0.9;
        }

        .car-price-large {
            font-size: 48px;
            font-weight: 700;
            text-align: right;
        }

        .price-note {
            font-size: 14px;
            opacity: 0.8;
            margin-top: 5px;
        }

        /* Quick Specs Grid */
        .quick-specs {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .spec-card {
            background: rgba(255, 255, 255, 0.1);
            padding: 20px;
            border-radius: 12px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            text-align: center;
        }

        .spec-label {
            font-size: 14px;
            opacity: 0.9;
            margin-bottom: 8px;
        }

        .spec-value {
            font-size: 20px;
            font-weight: 700;
        }

        /* Content Tabs */
        .tabs-container {
            padding: 40px;
        }

        .tabs-header {
            display: flex;
            gap: 20px;
            border-bottom: 2px solid var(--light-gray);
            margin-bottom: 30px;
            flex-wrap: wrap;
        }

        .tab-button {
            background: none;
            border: none;
            padding: 12px 20px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            color: var(--gray);
            border-bottom: 3px solid transparent;
            transition: all 0.3s ease;
            font-family: 'Poppins', sans-serif;
        }

        .tab-button.active {
            color: var(--primary);
            border-bottom-color: var(--primary);
        }

        .tab-button:hover {
            color: var(--primary);
        }

        .tab-content {
            display: none;
        }

        .tab-content.active {
            display: block;
            animation: fadeIn 0.3s ease;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        /* Features Section */
        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 25px;
        }

        .feature-item {
            background: linear-gradient(135deg, #dbeafe, #bfdbfe);
            padding: 25px;
            border-radius: 12px;
            border-left: 4px solid var(--primary);
        }

        .feature-icon {
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, var(--primary), var(--accent));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 24px;
            margin-bottom: 15px;
        }

        .feature-title {
            font-size: 18px;
            font-weight: 600;
            color: var(--secondary);
            margin-bottom: 10px;
        }

        .feature-desc {
            color: var(--gray);
            font-size: 14px;
        }

        /* Specifications Table */
        .specs-table {
            width: 100%;
            border-collapse: collapse;
        }

        .specs-table tr {
            border-bottom: 1px solid var(--light-gray);
        }

        .specs-table tr:hover {
            background-color: #f8fafc;
        }

        .specs-table td {
            padding: 15px;
        }

        .specs-table td:first-child {
            font-weight: 600;
            color: var(--secondary);
            width: 40%;
        }

        .specs-table td:last-child {
            color: var(--gray);
        }

        /* Deals Section */
        .deals-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 25px;
        }

        .deal-card {
            background: linear-gradient(135deg, #f0fdf4, #dcfce7);
            border: 2px solid var(--success);
            padding: 30px;
            border-radius: 12px;
            position: relative;
            overflow: hidden;
        }

        .deal-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: linear-gradient(90deg, var(--success), #84cc16);
        }

        .deal-icon {
            width: 50px;
            height: 50px;
            background: var(--success);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 24px;
            margin-bottom: 15px;
        }

        .deal-title {
            font-size: 20px;
            font-weight: 700;
            color: var(--secondary);
            margin-bottom: 10px;
        }

        .deal-description {
            color: var(--gray);
            margin-bottom: 15px;
            font-size: 14px;
            line-height: 1.6;
        }

        .deal-value {
            background: var(--success);
            color: white;
            padding: 8px 16px;
            border-radius: 20px;
            display: inline-block;
            font-weight: 600;
            font-size: 14px;
        }

        /* Action Buttons */
        .action-buttons {
            padding: 40px;
            background-color: var(--light);
            border-top: 2px solid var(--light-gray);
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
        }

        .action-buttons .btn {
            flex: 1;
            min-width: 200px;
            padding: 16px 28px;
            font-size: 16px;
        }

        /* Similar Cars */
        .similar-cars-section {
            margin-top: 60px;
        }

        .section-title {
            text-align: center;
            margin-bottom: 40px;
        }

        .section-title h2 {
            font-size: 36px;
            color: var(--secondary);
            margin-bottom: 10px;
        }

        .section-title p {
            color: var(--gray);
            font-size: 16px;
        }

        /* Cars Grid */
        .cars-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 25px;
        }

        .car-card {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: var(--shadow);
            transition: all 0.3s ease;
        }

        .car-card:hover {
            transform: translateY(-10px);
            box-shadow: var(--shadow-lg);
        }

        .car-card-image {
            width: 100%;
            height: 200px;
            background: #f0f0f0;
            overflow: hidden;
        }

        .car-card-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .car-card-content {
            padding: 20px;
        }

        .car-card-name {
            font-size: 18px;
            font-weight: 700;
            color: var(--secondary);
            margin-bottom: 10px;
        }

        .car-card-price {
            font-size: 20px;
            font-weight: 700;
            color: var(--primary);
            margin-bottom: 15px;
        }

        .car-card-specs {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
            margin-bottom: 15px;
            font-size: 13px;
            color: var(--gray);
        }

        /* Footer */
        footer {
            background-color: var(--secondary);
            color: #94a3b8;
            padding: 60px 0 30px;
            margin-top: 80px;
        }

        .footer-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 40px;
            margin-bottom: 40px;
        }

        .footer-col h4 {
            color: var(--white);
            font-size: 18px;
            margin-bottom: 20px;
        }

        .footer-links {
            list-style: none;
        }

        .footer-links li {
            margin-bottom: 12px;
        }

        .footer-links a {
            color: #94a3b8;
            text-decoration: none;
            transition: color 0.3s;
        }

        .footer-links a:hover {
            color: var(--white);
        }

        .copyright {
            text-align: center;
            padding-top: 30px;
            border-top: 1px solid #334155;
            font-size: 14px;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .car-gallery {
                height: 300px;
            }

            .car-info-header {
                padding: 30px;
            }

            .car-title-price {
                flex-direction: column;
            }

            .car-price-large {
                text-align: left;
            }

            .tabs-header {
                gap: 10px;
            }

            .tab-button {
                padding: 10px 15px;
                font-size: 14px;
            }

            .features-grid,
            .deals-grid,
            .cars-grid {
                grid-template-columns: 1fr;
            }

            .action-buttons {
                flex-direction: column;
            }

            .action-buttons .btn {
                min-width: auto;
            }

            .footer-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .car-title-section h1 {
                font-size: 28px;
            }

            .car-price-large {
                font-size: 36px;
            }
        }

        @media (max-width: 480px) {
            .car-info-header {
                padding: 20px;
            }

            .tabs-container {
                padding: 20px;
            }

            .action-buttons {
                padding: 20px;
            }

            .footer-grid {
                grid-template-columns: 1fr;
            }

            .car-title-section h1 {
                font-size: 24px;
            }

            .car-price-large {
                font-size: 28px;
            }

            .section-title h2 {
                font-size: 24px;
            }
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header>
        <div class="container header-container">
            <a href="index.php" class="logo">
                <div class="logo-icon">RCD</div>
                <div class="logo-text">Rwanda Car Dealer</div>
            </a>
            <a href="index.php" class="back-link">
                <i class="fas fa-arrow-left"></i> Back to Inventory
            </a>
        </div>
    </header>

    <!-- Breadcrumb -->
    <div class="breadcrumb">
        <div class="container breadcrumb-content">
            <span class="breadcrumb-item"><a href="index.php">Home</a></span>
            <span>/</span>
            <span class="breadcrumb-item"><a href="index.php#inventory">Inventory</a></span>
            <span>/</span>
            <span class="breadcrumb-item active"><?php echo htmlspecialchars($car['name']); ?></span>
        </div>
    </div>

    <div class="container">
        <!-- Main Car Details -->
        <div class="car-details-section">
            <!-- Gallery -->
            <div class="car-gallery">
                <img src="<?php echo htmlspecialchars($car['image']); ?>" alt="<?php echo htmlspecialchars($car['name']); ?>">
                <div class="car-badge-large"><?php echo htmlspecialchars($car['badge']); ?></div>
                <div class="car-rating-large">
                    <i class="fas fa-star"></i>
                    <span><?php echo htmlspecialchars($car['rating']); ?></span>
                </div>
            </div>

            <!-- Car Info Header -->
            <div class="car-info-header">
                <div class="car-title-price">
                    <div class="car-title-section">
                        <h1><?php echo htmlspecialchars($car['name']); ?></h1>
                        <p><?php echo htmlspecialchars($car['status']); ?> • <?php echo htmlspecialchars($car['badge']); ?></p>
                    </div>
                    <div>
                        <div class="car-price-large"><?php echo htmlspecialchars($car['price']); ?></div>
                        <div class="price-note">Best Market Price Guaranteed</div>
                    </div>
                </div>

                <!-- Quick Specs -->
                <div class="quick-specs">
                    <div class="spec-card">
                        <div class="spec-label"><i class="fas fa-calendar"></i> Year</div>
                        <div class="spec-value"><?php echo htmlspecialchars($car['year']); ?></div>
                    </div>
                    <div class="spec-card">
                        <div class="spec-label"><i class="fas fa-gas-pump"></i> Fuel Type</div>
                        <div class="spec-value"><?php echo htmlspecialchars($car['fuel']); ?></div>
                    </div>
                    <div class="spec-card">
                        <div class="spec-label"><i class="fas fa-users"></i> Seats</div>
                        <div class="spec-value"><?php echo htmlspecialchars($car['seats']); ?></div>
                    </div>
                    <div class="spec-card">
                        <div class="spec-label"><i class="fas fa-check-circle"></i> Status</div>
                        <div class="spec-value">Ready</div>
                    </div>
                </div>
            </div>

            <!-- Tabs Content -->
            <div class="tabs-container">
                <div class="tabs-header">
                    <button class="tab-button active" onclick="switchTab('features')">
                        <i class="fas fa-star"></i> Key Features
                    </button>
                    <button class="tab-button" onclick="switchTab('specs')">
                        <i class="fas fa-sliders-h"></i> Specifications
                    </button>
                    <button class="tab-button" onclick="switchTab('deals')">
                        <i class="fas fa-tag"></i> Special Deals
                    </button>
                </div>

                <!-- Features Tab -->
                <div id="features" class="tab-content active">
                    <div class="features-grid">
                        <?php
                        $features = explode(",", $car['features']);
                        $featureIcons = [
                            'Leather Seats' => 'fa-chair',
                            'Sunroof' => 'fa-sun',
                            'Backup Camera' => 'fa-camera',
                            'Touchscreen' => 'fa-mobile',
                            'Bluetooth' => 'fa-podcast',
                            'USB Charging' => 'fa-plug',
                            'ABS Brakes' => 'fa-brake',
                            'Airbags' => 'fa-shield',
                            'Cruise Control' => 'fa-gauge',
                            'Hill Assist' => 'fa-arrow-up',
                            'Smart Key' => 'fa-key',
                            'Climate Control' => 'fa-snowflake',
                            'Navigation System' => 'fa-map',
                            'Power Windows' => 'fa-window-maximize'
                        ];
                        
                        foreach ($features as $feature) {
                            $feature = trim($feature);
                            $icon = isset($featureIcons[$feature]) ? $featureIcons[$feature] : 'fa-check';
                        ?>
                            <div class="feature-item">
                                <div class="feature-icon">
                                    <i class="fas <?php echo $icon; ?>"></i>
                                </div>
                                <div class="feature-title"><?php echo htmlspecialchars($feature); ?></div>
                                <div class="feature-desc">Premium feature included with this vehicle</div>
                            </div>
                        <?php } ?>
                    </div>
                </div>

                <!-- Specifications Tab -->
                <div id="specs" class="tab-content">
                    <table class="specs-table">
                        <tr>
                            <td>Make & Model</td>
                            <td><?php echo htmlspecialchars($car['name']); ?></td>
                        </tr>
                        <tr>
                            <td>Year</td>
                            <td><?php echo htmlspecialchars($car['year']); ?></td>
                        </tr>
                        <tr>
                            <td>Fuel Type</td>
                            <td><?php echo htmlspecialchars($car['fuel']); ?></td>
                        </tr>
                        <tr>
                            <td>Number of Seats</td>
                            <td><?php echo htmlspecialchars($car['seats']); ?></td>
                        </tr>
                        <tr>
                            <td>Condition</td>
                            <td><?php echo htmlspecialchars($car['status']); ?></td>
                        </tr>
                        <tr>
                            <td>Price</td>
                            <td><?php echo htmlspecialchars($car['price']); ?></td>
                        </tr>
                        <tr>
                            <td>Category</td>
                            <td><?php echo htmlspecialchars($car['badge']); ?></td>
                        </tr>
                        <tr>
                            <td>Rating</td>
                            <td>
                                <i class="fas fa-star" style="color: #f59e0b;"></i>
                                <i class="fas fa-star" style="color: #f59e0b;"></i>
                                <i class="fas fa-star" style="color: #f59e0b;"></i>
                                <i class="fas fa-star" style="color: #f59e0b;"></i>
                                <i class="fas fa-star" style="color: #f59e0b;"></i>
                                (<?php echo htmlspecialchars($car['rating']); ?>/5.0)
                            </td>
                        </tr>
                        <tr>
                            <td>Transmission</td>
                            <td>Automatic</td>
                        </tr>
                        <tr>
                            <td>Drive Type</td>
                            <td>All-Wheel Drive</td>
                        </tr>
                        <tr>
                            <td>Mileage</td>
                            <td>Low - Perfect Condition</td>
                        </tr>
                        <tr>
                            <td>Engine Type</td>
                            <td>Turbocharged Gasoline</td>
                        </tr>
                    </table>
                </div>

                <!-- Deals Tab -->
                <div id="deals" class="tab-content">
                    <div class="deals-grid">
                        <div class="deal-card">
                            <div class="deal-icon">
                                <i class="fas fa-percent"></i>
                            </div>
                            <div class="deal-title">Special Financing Offer</div>
                            <div class="deal-description">Get 0% APR financing for up to 60 months on this premium vehicle with approved credit</div>
                            <div class="deal-value">0% APR Financing</div>
                        </div>

                        <div class="deal-card">
                            <div class="deal-icon">
                                <i class="fas fa-shield-alt"></i>
                            </div>
                            <div class="deal-title">Free Extended Warranty</div>
                            <div class="deal-description">Complimentary 7-year/100,000-mile extended warranty coverage for complete peace of mind</div>
                            <div class="deal-value">$2,500+ Value</div>
                        </div>

                        <div class="deal-card">
                            <div class="deal-icon">
                                <i class="fas fa-exchange-alt"></i>
                            </div>
                            <div class="deal-title">Trade-In Bonus</div>
                            <div class="deal-description">Get an extra $1,500 credit when you trade in your current vehicle today</div>
                            <div class="deal-value">+$1,500 Credit</div>
                        </div>

                        <div class="deal-card">
                            <div class="deal-icon">
                                <i class="fas fa-wrench"></i>
                            </div>
                            <div class="deal-title">Free Premium Maintenance</div>
                            <div class="deal-description">First 3 years of free scheduled maintenance, oil changes, and inspections included</div>
                            <div class="deal-value">$1,200+ Savings</div>
                        </div>

                        <div class="deal-card">
                            <div class="deal-icon">
                                <i class="fas fa-truck"></i>
                            </div>
                            <div class="deal-title">Complimentary Delivery</div>
                            <div class="deal-description">Free nationwide delivery service directly to your preferred location or home</div>
                            <div class="deal-value">Free Delivery</div>
                        </div>

                        <div class="deal-card">
                            <div class="deal-icon">
                                <i class="fas fa-handshake"></i>
                            </div>
                            <div class="deal-title">Loyalty Rewards Program</div>
                            <div class="deal-description">Join our exclusive loyalty program and earn rewards on future purchases and services</div>
                            <div class="deal-value">Exclusive Benefits</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="action-buttons">
                <a href="buy.php?id=<?php echo htmlspecialchars($car['id']); ?>" class="btn btn-primary">
                    <i class="fas fa-shopping-cart"></i> Buy This Car
                </a>
                <button class="btn btn-secondary" onclick="testDrive()">
                    <i class="fas fa-road"></i> Schedule Test Drive
                </button>
                <a href="#contact" class="btn btn-primary" style="background-color: #f59e0b;">
                    <i class="fas fa-phone"></i> Contact Sales Team
                </a>
            </div>
        </div>

        <!-- Similar Cars Section -->
        <div class="similar-cars-section">
            <div class="section-title">
                <h2>Similar Vehicles</h2>
                <p>You might also be interested in these premium vehicles</p>
            </div>
            <div class="cars-grid">
                <?php
                $count = 0;
                if (file_exists($file)) {
                    $allVehicles = json_decode(file_get_contents($file), true);
                    if (!empty($allVehicles)) {
                        foreach ($allVehicles as $vehicle) {
                            if ($vehicle['id'] != $car_id && $count < 3) {
                                $count++;
                ?>
                                <div class="car-card">
                                    <div class="car-card-image">
                                        <img src="<?php echo htmlspecialchars($vehicle['image']); ?>" alt="<?php echo htmlspecialchars($vehicle['name']); ?>">
                                    </div>
                                    <div class="car-card-content">
                                        <div class="car-card-name"><?php echo htmlspecialchars($vehicle['name']); ?></div>
                                        <div class="car-card-price"><?php echo htmlspecialchars($vehicle['price']); ?></div>
                                        <div class="car-card-specs">
                                            <div><i class="fas fa-calendar"></i> <?php echo htmlspecialchars($vehicle['year']); ?></div>
                                            <div><i class="fas fa-gas-pump"></i> <?php echo htmlspecialchars($vehicle['fuel']); ?></div>
                                            <div><i class="fas fa-users"></i> <?php echo htmlspecialchars($vehicle['seats']); ?></div>
                                            <div><i class="fas fa-star"></i> <?php echo htmlspecialchars($vehicle['rating']); ?></div>
                                        </div>
                                        <a href="car_details.php?id=<?php echo htmlspecialchars($vehicle['id']); ?>" class="btn btn-primary" style="width: 100%; text-align: center;">View Details</a>
                                    </div>
                                </div>
                <?php
                            }
                        }
                    }
                }
                ?>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="footer-grid">
                <div class="footer-col">
                    <h4>About Us</h4>
                    <p style="color: #94a3b8; line-height: 1.6;">
                        Premium automotive excellence since 2010. Your trusted partner for luxury vehicles.
                    </p>
                </div>
                
                <div class="footer-col">
                    <h4>Quick Links</h4>
                    <ul class="footer-links">
                        <li><a href="index.php">Home</a></li>
                        <li><a href="index.php#inventory">Inventory</a></li>
                        <li><a href="index.php#services">Services</a></li>
                        <li><a href="index.php#about">About</a></li>
                    </ul>
                </div>
                
                <div class="footer-col">
                    <h4>Contact</h4>
                    <ul class="footer-links">
                        <li><a href="tel:+250791636887">+(250) 791636887</a></li>
                        <li><a href="mailto:sales@rwandacardealer.com">sales@rwandacardealer.com</a></li>
                        <li>1856 DOWNTOWN, KIGALI</li>
                    </ul>
                </div>
                
                <div class="footer-col">
                    <h4>Follow Us</h4>
                    <ul class="footer-links">
                        <li><a href="#">Facebook</a></li>
                        <li><a href="#">Twitter</a></li>
                        <li><a href="#">Instagram</a></li>
                    </ul>
                </div>
            </div>
            
            <div class="copyright">
                <p>&copy; 2026 RWANDA CAR DEALER. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script>
        function switchTab(tabName) {
            // Hide all tabs
            const tabs = document.querySelectorAll('.tab-content');
            tabs.forEach(tab => tab.classList.remove('active'));
            
            // Remove active class from all buttons
            const buttons = document.querySelectorAll('.tab-button');
            buttons.forEach(button => button.classList.remove('active'));
            
            // Show selected tab
            document.getElementById(tabName).classList.add('active');
            
            // Add active class to clicked button
            event.target.classList.add('active');
        }

        function testDrive() {
            alert('Thank you for your interest! Our sales team will contact you shortly to schedule your test drive.');
        }

        // Smooth scroll for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({ behavior: 'smooth' });
                }
            });
        });
    </script>
</body>
</html>