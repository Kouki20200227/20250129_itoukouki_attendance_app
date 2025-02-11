document.addEventListener('DOMContentLoaded', function () {
    function updateDate() {
        const now = new Date();
        const weekdays = ["日", "月", "火", "水", "木", "金", "土"];
        const formattedDate =
            now.getFullYear() + "年" +
            (now.getMonth() + 1) + "月" +
            now.getDate() + "日(" +
            weekdays[now.getDay()] + ")";
        document.getElementById("current-date").textContent = formattedDate;
        document.getElementById("current-time").textContent =
            String(now.getHours()).padStart(2, "0") +
            ":" +
            String(now.getMinutes()).padStart(2, "0");
    }

    setInterval(updateDate, 1000); //1秒毎に更新
    updateDate(); //初回実行用
})

