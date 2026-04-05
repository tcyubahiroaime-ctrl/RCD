<?php
require_once 'config.php';

function readChat() {
    return file_exists(CHAT_FILE) ? json_decode(file_get_contents(CHAT_FILE), true) : [];
}

function writeChat($data) {
    file_put_contents(CHAT_FILE, json_encode($data, JSON_PRETTY_PRINT));
}

$action = $_REQUEST['action'] ?? '';

// ---------- User actions ----------
if ($action === 'get') {
    $userId = $_GET['user_id'] ?? '';
    $since = (int)($_GET['since'] ?? 0);
    $messages = readChat();
    $result = array_filter($messages, function($msg) use ($userId, $since) {
        return $msg['user_id'] === $userId && $msg['timestamp'] > $since;
    });
    header('Content-Type: application/json');
    echo json_encode(['messages' => array_values($result)]);
    exit;
}

if ($action === 'send') {
    $userId = $_POST['user_id'] ?? '';
    $message = trim($_POST['message'] ?? '');
    if ($userId && $message) {
        $messages = readChat();
        $newMsg = [
            'id' => count($messages) + 1,
            'user_id' => $userId,
            'sender' => 'user',
            'message' => $message,
            'timestamp' => time(),
            'read' => 0
        ];
        $messages[] = $newMsg;
        writeChat($messages);
    }
    exit;
}

// ---------- Admin actions ----------
if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in']) {
    if ($action === 'get_users') {
        $messages = readChat();
        $users = [];
        foreach ($messages as $msg) {
            $uid = $msg['user_id'];
            if (!isset($users[$uid])) {
                $users[$uid] = [
                    'user_id' => $uid,
                    'last_message' => $msg['message'],
                    'last_time' => $msg['timestamp'],
                    'unread' => 0
                ];
            }
            if (!$msg['read'] && $msg['sender'] === 'user') {
                $users[$uid]['unread']++;
            }
            if ($msg['timestamp'] > $users[$uid]['last_time']) {
                $users[$uid]['last_message'] = $msg['message'];
                $users[$uid]['last_time'] = $msg['timestamp'];
            }
        }
        uasort($users, fn($a, $b) => $b['last_time'] <=> $a['last_time']);
        header('Content-Type: application/json');
        echo json_encode(array_values($users));
        exit;
    }

    if ($action === 'get_conversation') {
        $userId = $_GET['user_id'] ?? '';
        $messages = readChat();
        $conv = array_filter($messages, fn($m) => $m['user_id'] === $userId);
        // Mark user messages as read
        foreach ($messages as &$m) {
            if ($m['user_id'] === $userId && $m['sender'] === 'user' && !$m['read']) {
                $m['read'] = 1;
            }
        }
        writeChat($messages);
        header('Content-Type: application/json');
        echo json_encode(array_values($conv));
        exit;
    }

    if ($action === 'admin_send') {
        $userId = $_POST['user_id'] ?? '';
        $message = trim($_POST['message'] ?? '');
        if ($userId && $message) {
            $messages = readChat();
            $newMsg = [
                'id' => count($messages) + 1,
                'user_id' => $userId,
                'sender' => 'admin',
                'message' => $message,
                'timestamp' => time(),
                'read' => 1
            ];
            $messages[] = $newMsg;
            writeChat($messages);
        }
        exit;
    }
}
?>