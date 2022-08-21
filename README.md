# Bài tập lớn môn Công nghệ phần mềm - Trường đại học Công nghệ - Đại học Quốc gia Hà Nội (UET)
# Website Bán quần áo

### Các thành viên
- Nguyễn Đăng Hoàng Đạo : Trưởng nhóm, Lập trình Backend, Triển khai CSDL, Chỉnh sửa và bổ sung Frontend
- Trần Thị Kim Bắc : Thành viên, Xây dựng và thu thập CSDL, Viết báo cáo
- Trần Đình Cường : Thành viên, Lập trình Frontend

### Công nghệ sử dụng
* PHP
* HTML, CSS, Javascript
* MySQL

### Kiến trúc
* Kiến trúc Client - Server
* Mô hình MVC

### Các chức năng chính
* Đối với người dùng
  - Đăng nhập, đăng kí
  - Xem và tìm kiếm sản phẩm, xem chi tiết sản phẩm
  - Quản lý giỏ hàng (Thêm, xóa, sửa)
  - Quản lý đơn hàng (đặt hàng, hủy đơn hàng, xem danh sách đơn hàng)
  - Quản lý thông tin cá nhân (Thêm, xóa, sửa)
  - Quản lý địa chỉ giao hàng (Thêm, xóa, sửa)
* Đối với Quản trị viên
  - Quản lý người dùng (Thêm, xóa, sửa)
  - Quản lý danh mục sản phẩm, loại sản phẩm, sản phẩm (Thêm, xóa, sửa)
  - Quản lý người dùng (Xem danh sách người dùng, xóa, sửa)
  - Quản lý đơn hàng (Xem danh sách đơn hàng)
  - Xem báo cáo thống kê doanh thu (Theo tháng hoặc theo năm)
  
### Hướng dẫn sử dụng
- Cần cài đặt XAMPP và MySQL(8.0 trở lên). Nên thay thế bản MySQL có sẵn của XAMPP bằng bản MySQL 8.0 trở lên), tham khảo đường link
  https://odan.github.io/2019/11/17/xampp-replacing-mariadb-with-mysql-8.html
  
- Tạo CSDL mới trong MySQL và import dữ liệu từ file saleweb.sql
- Mọi đường dẫn khả dụng (url) của web đều được định nghĩa trong file Core/Middleware.php

