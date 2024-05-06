document.addEventListener("DOMContentLoaded", function () {
  const switchChecked = document.getElementById("switchChecked");
  switchChecked.addEventListener("change", function () {
    if (!this.checked) {
      // Hỏi khi tắt switch
      if (!confirm("Bạn có chắc muốn khóa người dùng này không?")) {
        // Nếu hủy, giữ switch ở trạng thái đã bật
        this.checked = true;
      }
    } else {
      // Hỏi khi bật switch
      if (!confirm("Bạn có chắc muốn mở khóa người dùng này không?")) {
        // Nếu hủy, đặt lại switch ở trạng thái đã tắt
        this.checked = false;
      }
    }
  });
});
