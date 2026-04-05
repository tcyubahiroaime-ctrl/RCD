<?php
require_once 'admin/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $vehicle_id    = $_POST['vehicle_id'] ?? '';
    $vehicle_name  = $_POST['vehicle_name'] ?? '';
    $vehicle_price = $_POST['vehicle_price'] ?? '';
    $full_name     = $_POST['full_name'] ?? '';
    $email         = $_POST['email'] ?? '';
    $phone         = $_POST['phone'] ?? '';
    $message       = $_POST['message'] ?? '';

    if (empty($full_name) || empty($email) || empty($phone) || empty($vehicle_id)) {
        die("Please fill in all required fields.");
    }

    $purchases = readJson(PURCHASES_FILE);
    $newRequest = [
        'id'            => getNextId($purchases),
        'vehicle_id'    => $vehicle_id,
        'vehicle_name'  => $vehicle_name,
        'vehicle_price' => $vehicle_price,
        'full_name'     => $full_name,
        'email'         => $email,
        'phone'         => $phone,
        'message'       => $message,
        'submitted_at'  => date('Y-m-d H:i:s'),
        'status'        => 'pending'
    ];
    $purchases[] = $newRequest;

    if (writeJson(PURCHASES_FILE, $purchases)) {
        header('Location: index.php?purchase_success=1');
        exit;
    } else {
        die("Error: Could not save your request. Please check file permissions.");
    }
} else {
    header('Location: index.php');
    exit;
}
?>