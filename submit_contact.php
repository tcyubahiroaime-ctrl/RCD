<?php
// Include config – this defines MESSAGES_FILE
require_once 'admin/config.php';

// --- DEBUG: Write a timestamp to debug.txt to confirm the script runs ---
file_put_contents(__DIR__ . '/debug.txt', "Script ran at " . date('Y-m-d H:i:s') . "\n", FILE_APPEND);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name    = $_POST['full_name'] ?? '';
    $email   = $_POST['email']      ?? '';
    $phone   = $_POST['phone']      ?? '';
    $subject = $_POST['subject']    ?? '';
    $message = $_POST['message']    ?? '';

    if (empty($name) || empty($email) || empty($message)) {
        die("Please fill in all required fields.");
    }

    // --- DEBUG: Write the received data to debug.txt ---
    file_put_contents(__DIR__ . '/debug.txt', "Received: $name, $email\n", FILE_APPEND);

    // Get the absolute path of messages.json for debugging
    $abs_path = realpath(MESSAGES_FILE);
    if ($abs_path === false) {
        $abs_path = "File does not exist yet – will be created at: " . realpath(dirname(MESSAGES_FILE)) . DIRECTORY_SEPARATOR . basename(MESSAGES_FILE);
    } else {
        $abs_path = "File exists at: " . $abs_path;
    }
    file_put_contents(__DIR__ . '/debug.txt', "Messages file: $abs_path\n", FILE_APPEND);

    // Read existing messages
    $messages = readJson(MESSAGES_FILE);
    file_put_contents(__DIR__ . '/debug.txt', "Existing messages count: " . count($messages) . "\n", FILE_APPEND);

    $newMessage = [
        'id'            => getNextId($messages),
        'name'          => $name,
        'email'         => $email,
        'phone'         => $phone,
        'subject'       => $subject,
        'message'       => $message,
        'submitted_at'  => date('Y-m-d H:i:s'),
        'read'          => 0
    ];

    $messages[] = $newMessage;

    // Attempt to write
    if (writeJson(MESSAGES_FILE, $messages)) {
        file_put_contents(__DIR__ . '/debug.txt', "SUCCESS: Wrote " . count($messages) . " messages to file.\n", FILE_APPEND);
        header('Location: index.php?contact_success=1#contact');
        exit;
    } else {
        file_put_contents(__DIR__ . '/debug.txt', "ERROR: Failed to write to file.\n", FILE_APPEND);
        die("Error: Could not save your message. Please check file permissions.");
    }
} else {
    header('Location: index.php');
    exit;
}
?>