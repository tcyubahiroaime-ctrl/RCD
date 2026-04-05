<?php
require_once 'admin/config.php';

// Hide warnings (optional safety)
error_reporting(E_ALL & ~E_NOTICE);

// Check if ID exists
if (!isset($_GET['id'])) {
    die("Vehicle not found.");
}

$vehicle_id = (int) $_GET['id'];
$vehicles = readJson(VEHICLES_FILE);

$selected_vehicle = null;

foreach ($vehicles as $v) {
    if ($v['id'] == $vehicle_id) {
        $selected_vehicle = $v;
        break;
    }
}

if (!$selected_vehicle) {
    die("Vehicle not found.");
}

// Prevent buying if out of stock
if ($selected_vehicle['status'] === 'Out of Stock') {
    die("Sorry, this vehicle is currently out of stock.");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Complete Your Purchase | RWANDA CAR DEALER</title>
<link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;14..32,400;14..32,500;14..32,600;14..32,700&display=swap" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

:root {
    --primary: #3b82f6;
    --primary-dark: #2563eb;
    --primary-light: #60a5fa;
    --secondary: #8b5cf6;
    --success: #10b981;
    --warning: #f59e0b;
    --danger: #ef4444;
    --dark: #0f172a;
    --dark-light: #1e293b;
    --gray: #64748b;
    --gray-light: #94a3b8;
    --white: #ffffff;
    --border-radius: 16px;
    --shadow-sm: 0 1px 2px 0 rgb(0 0 0 / 0.05);
    --shadow-md: 0 4px 6px -1px rgb(0 0 0 / 0.1);
    --shadow-lg: 0 10px 15px -3px rgb(0 0 0 / 0.1);
    --shadow-xl: 0 20px 25px -5px rgb(0 0 0 / 0.1);
}

body {
    font-family: 'Inter', sans-serif;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    min-height: 100vh;
    padding: 40px 20px;
    color: var(--dark);
}

/* Container */
.purchase-container {
    max-width: 1200px;
    margin: 0 auto;
    animation: fadeInUp 0.5s ease-out;
}

@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Header */
.purchase-header {
    text-align: center;
    margin-bottom: 40px;
}

.purchase-header h1 {
    font-size: 42px;
    font-weight: 700;
    background: linear-gradient(135deg, #fff, #e0e7ff);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    margin-bottom: 10px;
}

.purchase-header p {
    color: rgba(255, 255, 255, 0.8);
    font-size: 18px;
}

/* Main Grid */
.purchase-grid {
    display: grid;
    grid-template-columns: 1fr 1.5fr;
    gap: 30px;
}

/* Vehicle Summary Card */
.vehicle-summary {
    background: white;
    border-radius: var(--border-radius);
    overflow: hidden;
    box-shadow: var(--shadow-xl);
    position: sticky;
    top: 20px;
    height: fit-content;
}

.vehicle-image {
    position: relative;
    height: 250px;
    overflow: hidden;
}

.vehicle-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.vehicle-badge {
    position: absolute;
    top: 20px;
    right: 20px;
    background: linear-gradient(135deg, var(--primary), var(--secondary));
    color: white;
    padding: 8px 16px;
    border-radius: 20px;
    font-weight: 600;
    font-size: 14px;
}

.vehicle-info {
    padding: 25px;
}

.vehicle-info h2 {
    font-size: 28px;
    font-weight: 700;
    color: var(--dark);
    margin-bottom: 15px;
}

.price-tag {
    font-size: 32px;
    font-weight: 700;
    color: var(--primary);
    margin-bottom: 20px;
    padding-bottom: 20px;
    border-bottom: 2px solid #e2e8f0;
}

.specs-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 15px;
    margin-bottom: 20px;
}

.spec-item {
    display: flex;
    align-items: center;
    gap: 10px;
    color: var(--gray);
    font-size: 14px;
}

.spec-item i {
    color: var(--primary);
    font-size: 16px;
}

.features-list {
    list-style: none;
    margin-top: 20px;
    padding-top: 20px;
    border-top: 2px solid #e2e8f0;
}

.features-list li {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 8px 0;
    color: var(--gray);
    font-size: 14px;
}

.features-list li i {
    color: var(--success);
    font-size: 14px;
}

/* Payment Section */
.payment-section {
    background: white;
    border-radius: var(--border-radius);
    padding: 30px;
    box-shadow: var(--shadow-xl);
}

.payment-section h3 {
    font-size: 24px;
    font-weight: 600;
    color: var(--dark);
    margin-bottom: 10px;
}

.payment-subtitle {
    color: var(--gray);
    margin-bottom: 30px;
    font-size: 14px;
}

/* Payment Methods */
.payment-methods {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 15px;
    margin-bottom: 30px;
}

.method-card {
    background: #f8fafc;
    border: 2px solid #e2e8f0;
    border-radius: 12px;
    padding: 20px;
    text-align: center;
    cursor: pointer;
    transition: all 0.3s ease;
}

.method-card:hover {
    transform: translateY(-4px);
    box-shadow: var(--shadow-md);
}

.method-card.selected {
    border-color: var(--primary);
    background: linear-gradient(135deg, #eff6ff, #e0e7ff);
}

.method-icon {
    width: 60px;
    height: 60px;
    background: linear-gradient(135deg, var(--primary), var(--secondary));
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 15px;
    color: white;
    font-size: 28px;
}

.method-card h4 {
    font-size: 18px;
    font-weight: 600;
    color: var(--dark);
    margin-bottom: 5px;
}

.method-card p {
    font-size: 12px;
    color: var(--gray);
}

/* Forms */
.payment-form {
    display: none;
    animation: fadeIn 0.4s ease-out;
}

.payment-form.active {
    display: block;
}

@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.form-group {
    margin-bottom: 20px;
}

.form-group label {
    display: block;
    margin-bottom: 8px;
    font-weight: 500;
    color: var(--dark);
    font-size: 14px;
}

.form-group label i {
    color: var(--primary);
    margin-right: 8px;
}

.form-group input,
.form-group select,
.form-group textarea {
    width: 100%;
    padding: 12px 16px;
    border: 2px solid #e2e8f0;
    border-radius: 12px;
    font-size: 14px;
    transition: all 0.3s ease;
    font-family: 'Inter', sans-serif;
}

.form-group input:focus,
.form-group select:focus,
.form-group textarea:focus {
    outline: none;
    border-color: var(--primary);
    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
}

.form-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 20px;
}

textarea {
    resize: vertical;
    min-height: 100px;
}

/* Submit Button */
.submit-btn {
    width: 100%;
    padding: 16px;
    background: linear-gradient(135deg, var(--primary), var(--secondary));
    color: white;
    border: none;
    border-radius: 12px;
    font-size: 16px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    margin-top: 10px;
}

.submit-btn:hover {
    transform: translateY(-2px);
    box-shadow: var(--shadow-lg);
}

.submit-btn i {
    margin-right: 8px;
}

/* Back Button */
.back-button {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    color: white;
    text-decoration: none;
    margin-bottom: 20px;
    padding: 10px 20px;
    background: rgba(255, 255, 255, 0.1);
    border-radius: 10px;
    transition: all 0.3s ease;
}

.back-button:hover {
    background: rgba(255, 255, 255, 0.2);
    transform: translateX(-4px);
}

/* Info Box */
.info-box {
    background: #fef3c7;
    border-left: 4px solid var(--warning);
    padding: 15px;
    border-radius: 12px;
    margin-bottom: 25px;
}

.info-box p {
    color: #92400e;
    font-size: 13px;
    display: flex;
    align-items: center;
    gap: 10px;
}

.info-box i {
    font-size: 18px;
}

/* Responsive */
@media (max-width: 992px) {
    .purchase-grid {
        grid-template-columns: 1fr;
    }
    
    .vehicle-summary {
        position: relative;
        top: 0;
    }
}

@media (max-width: 768px) {
    .payment-methods {
        grid-template-columns: 1fr;
    }
    
    .form-row {
        grid-template-columns: 1fr;
        gap: 0;
    }
    
    .purchase-header h1 {
        font-size: 32px;
    }
    
    .purchase-container {
        padding: 0;
    }
}

/* Loading State */
.loading {
    position: relative;
    opacity: 0.7;
    pointer-events: none;
}

.loading::after {
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    width: 30px;
    height: 30px;
    border: 3px solid #f3f3f3;
    border-top: 3px solid var(--primary);
    border-radius: 50%;
    animation: spin 1s linear infinite;
}

@keyframes spin {
    0% { transform: translate(-50%, -50%) rotate(0deg); }
    100% { transform: translate(-50%, -50%) rotate(360deg); }
}
</style>
</head>
<body>

<div class="purchase-container">
    <a href="index.php" class="back-button">
        <i class="fas fa-arrow-left"></i> Back to Vehicles
    </a>
    
    <div class="purchase-header">
        <h1>Complete Your Purchase</h1>
        <p>Secure checkout for your dream vehicle</p>
    </div>
    
    <div class="purchase-grid">
        <!-- Vehicle Summary -->
        <div class="vehicle-summary">
            <div class="vehicle-image">
                <img src="<?php echo htmlspecialchars($selected_vehicle['image']); ?>" alt="<?php echo htmlspecialchars($selected_vehicle['name']); ?>">
                <div class="vehicle-badge">Featured</div>
            </div>
            <div class="vehicle-info">
                <h2><?php echo htmlspecialchars($selected_vehicle['name']); ?></h2>
                <div class="price-tag"><?php echo htmlspecialchars($selected_vehicle['price']); ?></div>
                
                <div class="specs-grid">
                    <div class="spec-item">
                        <i class="fas fa-calendar"></i>
                        <span><?php echo htmlspecialchars($selected_vehicle['year']); ?></span>
                    </div>
                    <div class="spec-item">
                        <i class="fas fa-gas-pump"></i>
                        <span><?php echo htmlspecialchars($selected_vehicle['fuel']); ?></span>
                    </div>
                    <div class="spec-item">
                        <i class="fas fa-user-friends"></i>
                        <span><?php echo htmlspecialchars($selected_vehicle['seats']); ?> Seats</span>
                    </div>
                    <div class="spec-item">
                        <i class="fas fa-check-circle"></i>
                        <span><?php echo htmlspecialchars($selected_vehicle['status']); ?></span>
                    </div>
                </div>
                
                <ul class="features-list">
                    <?php
                    $features = explode(",", $selected_vehicle['features']);
                    $displayFeatures = array_slice($features, 0, 4);
                    foreach ($displayFeatures as $feature) {
                        echo "<li><i class='fas fa-check-circle'></i> " . htmlspecialchars(trim($feature)) . "</li>";
                    }
                    ?>
                </ul>
            </div>
        </div>
        
        <!-- Payment Section -->
        <div class="payment-section">
            <h3>Payment Details</h3>
            <p class="payment-subtitle">Choose your preferred payment method</p>
            
            <div class="payment-methods">
                <div class="method-card" data-method="bank">
                    <div class="method-icon">
                        <i class="fas fa-university"></i>
                    </div>
                    <h4>Bank Transfer</h4>
                    <p>Direct bank payment</p>
                </div>
                
                <div class="method-card" data-method="mtn">
                    <div class="method-icon">
                        <i class="fas fa-mobile-alt"></i>
                    </div>
                    <h4>MTN Mobile Money</h4>
                    <p>Pay with MTN</p>
                </div>
                
                <div class="method-card" data-method="airtel">
                    <div class="method-icon">
                        <i class="fas fa-mobile-alt"></i>
                    </div>
                    <h4>Airtel Money</h4>
                    <p>Pay with Airtel</p>
                </div>
            </div>
            
            <div class="info-box">
                <p>
                    <i class="fas fa-shield-alt"></i>
                    Your payment information is secure and encrypted
                </p>
            </div>
            
            <!-- Bank Form -->
            <form id="bank-form" class="payment-form" action="submit_payment.php" method="POST">
                <input type="hidden" name="payment_method" value="Bank Transfer">
                <input type="hidden" name="vehicle_id" value="<?php echo $selected_vehicle['id']; ?>">
                <input type="hidden" name="vehicle_name" value="<?php echo htmlspecialchars($selected_vehicle['name']); ?>">
                <input type="hidden" name="vehicle_price" value="<?php echo htmlspecialchars($selected_vehicle['price']); ?>">
                
                <div class="form-row">
                    <div class="form-group">
                        <label><i class="fas fa-user"></i> Full Name</label>
                        <input type="text" name="full_name" placeholder="Enter your full name" required>
                    </div>
                    <div class="form-group">
                        <label><i class="fas fa-envelope"></i> Email Address</label>
                        <input type="email" name="email" placeholder="your@email.com" required>
                    </div>
                </div>
                
                <div class="form-group">
                    <label><i class="fas fa-phone"></i> Phone Number</label>
                    <input type="text" name="phone" placeholder="+250 7XX XXX XXX" required>
                </div>
                
                <div class="form-group">
                    <label><i class="fas fa-building"></i> Select Bank</label>
                    <select name="bank_name" required>
                        <option value="">Choose your bank</option>
                        <option>Bank of Kigali</option>
                        <option>Equity Bank</option>
                        <option>Cogebanque</option>
                        <option>Access Bank</option>
                        <option>I&M Bank</option>
                        <option>Bank Populaire</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label><i class="fas fa-hashtag"></i> Transaction Reference</label>
                    <input type="text" name="reference" placeholder="Enter transaction reference number" required>
                </div>
                
                <div class="form-group">
                    <label><i class="fas fa-comment"></i> Additional Message</label>
                    <textarea name="message" placeholder="Any special requests or notes?"></textarea>
                </div>
                
                <button type="submit" class="submit-btn">
                    <i class="fas fa-lock"></i> Complete Bank Transfer
                </button>
            </form>
            
            <!-- MTN Form -->
            <form id="mtn-form" class="payment-form" action="submit_payment.php" method="POST">
                <input type="hidden" name="payment_method" value="MTN Mobile Money">
                <input type="hidden" name="vehicle_id" value="<?php echo $selected_vehicle['id']; ?>">
                <input type="hidden" name="vehicle_name" value="<?php echo htmlspecialchars($selected_vehicle['name']); ?>">
                <input type="hidden" name="vehicle_price" value="<?php echo htmlspecialchars($selected_vehicle['price']); ?>">
                
                <div class="form-row">
                    <div class="form-group">
                        <label><i class="fas fa-user"></i> Full Name</label>
                        <input type="text" name="full_name" placeholder="Enter your full name" required>
                    </div>
                    <div class="form-group">
                        <label><i class="fas fa-envelope"></i> Email Address</label>
                        <input type="email" name="email" placeholder="your@email.com" required>
                    </div>
                </div>
                
                <div class="form-group">
                    <label><i class="fas fa-phone"></i> Phone Number</label>
                    <input type="text" name="phone" placeholder="+250 7XX XXX XXX" required>
                </div>
                
                <div class="form-group">
                    <label><i class="fas fa-mobile-alt"></i> MTN Mobile Number</label>
                    <input type="text" name="mobile_number" placeholder="07XX XXX XXX" required>
                </div>
                
                <div class="form-group">
                    <label><i class="fas fa-hashtag"></i> Transaction Reference</label>
                    <input type="text" name="reference" placeholder="Enter transaction reference number" required>
                </div>
                
                <div class="form-group">
                    <label><i class="fas fa-comment"></i> Additional Message</label>
                    <textarea name="message" placeholder="Any special requests or notes?"></textarea>
                </div>
                
                <button type="submit" class="submit-btn">
                    <i class="fas fa-lock"></i> Pay with MTN Mobile Money
                </button>
            </form>
            
            <!-- Airtel Form -->
            <form id="airtel-form" class="payment-form" action="submit_payment.php" method="POST">
                <input type="hidden" name="payment_method" value="Airtel Money">
                <input type="hidden" name="vehicle_id" value="<?php echo $selected_vehicle['id']; ?>">
                <input type="hidden" name="vehicle_name" value="<?php echo htmlspecialchars($selected_vehicle['name']); ?>">
                <input type="hidden" name="vehicle_price" value="<?php echo htmlspecialchars($selected_vehicle['price']); ?>">
                
                <div class="form-row">
                    <div class="form-group">
                        <label><i class="fas fa-user"></i> Full Name</label>
                        <input type="text" name="full_name" placeholder="Enter your full name" required>
                    </div>
                    <div class="form-group">
                        <label><i class="fas fa-envelope"></i> Email Address</label>
                        <input type="email" name="email" placeholder="your@email.com" required>
                    </div>
                </div>
                
                <div class="form-group">
                    <label><i class="fas fa-phone"></i> Phone Number</label>
                    <input type="text" name="phone" placeholder="+250 7XX XXX XXX" required>
                </div>
                
                <div class="form-group">
                    <label><i class="fas fa-mobile-alt"></i> Airtel Number</label>
                    <input type="text" name="mobile_number" placeholder="07XX XXX XXX" required>
                </div>
                
                <div class="form-group">
                    <label><i class="fas fa-hashtag"></i> Transaction Reference</label>
                    <input type="text" name="reference" placeholder="Enter transaction reference number" required>
                </div>
                
                <div class="form-group">
                    <label><i class="fas fa-comment"></i> Additional Message</label>
                    <textarea name="message" placeholder="Any special requests or notes?"></textarea>
                </div>
                
                <button type="submit" class="submit-btn">
                    <i class="fas fa-lock"></i> Pay with Airtel Money
                </button>
            </form>
        </div>
    </div>
</div>

<script>
// Payment method selection
const methodCards = document.querySelectorAll('.method-card');
const forms = {
    bank: document.getElementById('bank-form'),
    mtn: document.getElementById('mtn-form'),
    airtel: document.getElementById('airtel-form')
};

// Set default selected method
let currentMethod = 'bank';
forms.bank.classList.add('active');
document.querySelector('[data-method="bank"]').classList.add('selected');

methodCards.forEach(card => {
    card.addEventListener('click', () => {
        const method = card.dataset.method;
        
        // Update active class on cards
        methodCards.forEach(c => c.classList.remove('selected'));
        card.classList.add('selected');
        
        // Hide all forms
        Object.values(forms).forEach(form => {
            form.classList.remove('active');
        });
        
        // Show selected form
        if (forms[method]) {
            forms[method].classList.add('active');
            currentMethod = method;
        }
    });
});

// Add loading state on form submit
const formsList = document.querySelectorAll('.payment-form');
formsList.forEach(form => {
    form.addEventListener('submit', function(e) {
        const submitBtn = this.querySelector('.submit-btn');
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-pulse"></i> Processing...';
        submitBtn.disabled = true;
        this.classList.add('loading');
    });
});
</script>
</body>
</html>