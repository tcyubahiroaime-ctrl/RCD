<?php
require_once 'admin/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $purchases = readJson(PURCHASES_FILE);

    // Generate new ID
    $newId = getNextId($purchases);

    // Basic fields
    $purchase = [
        'id' => $newId,
        'vehicle_id' => $_POST['vehicle_id'] ?? '',
        'vehicle_name' => $_POST['vehicle_name'] ?? '',
        'vehicle_price' => $_POST['vehicle_price'] ?? '',
        'full_name' => $_POST['full_name'] ?? '',
        'email' => $_POST['email'] ?? '',
        'phone' => $_POST['phone'] ?? '',
        'payment_method' => $_POST['payment_method'] ?? '',
        'bank_name' => $_POST['bank_name'] ?? '',
        'mobile_number' => $_POST['mobile_number'] ?? '',
        'reference' => $_POST['reference'] ?? '',
        'message' => $_POST['message'] ?? '',
        'status' => 'pending',
        'submitted_at' => date('Y-m-d H:i:s')
    ];

    $purchases[] = $purchase;

    if (writeJson(PURCHASES_FILE, $purchases)) {
        header("Location: buy_success.php");
        exit;
    } else {
        echo "Error saving payment.";
    }
}
?>