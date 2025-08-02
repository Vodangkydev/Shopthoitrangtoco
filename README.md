# 🛍️ Website Bán Đồ Thời Trang

## 📝 Mô tả dự án

Website bán đồ thời trang được phát triển bằng PHP thuần với giao diện người dùng thân thiện và hệ thống quản trị admin hoàn chỉnh. Dự án bao gồm đầy đủ các chức năng cần thiết cho một website thương mại điện tử.

## ✨ Tính năng chính

### 🛒 Phía người dùng
- **Trang chủ**: Hiển thị sản phẩm nổi bật, banner quảng cáo
- **Danh mục sản phẩm**: Phân loại sản phẩm theo danh mục
- **Tìm kiếm**: Tìm kiếm sản phẩm theo tên
- **Giỏ hàng**: Thêm, xóa, cập nhật số lượng sản phẩm
- **Đăng ký/Đăng nhập**: Hệ thống tài khoản người dùng
- **Thanh toán**: Hỗ trợ nhiều hình thức thanh toán
- **Lịch sử đơn hàng**: Theo dõi trạng thái đơn hàng
- **Tin tức**: Cập nhật thông tin mới nhất
- **Liên hệ**: Thông tin liên hệ và hỗ trợ

### 🔧 Phía quản trị (Admin)
- **Quản lý sản phẩm**: Thêm, sửa, xóa sản phẩm
- **Quản lý danh mục**: Phân loại sản phẩm
- **Quản lý đơn hàng**: Xem và cập nhật trạng thái đơn hàng
- **Quản lý người dùng**: Hệ thống tài khoản admin
- **Upload hình ảnh**: Tích hợp CKEditor và CKFinder
- **Thống kê**: Báo cáo doanh thu và đơn hàng

## 🛠️ Công nghệ sử dụng

- **Backend**: PHP thuần
- **Database**: MySQL
- **Frontend**: HTML, CSS, JavaScript
- **Editor**: CKEditor + CKFinder
- **Chatbot**: Dialogflow Messenger
- **Thư viện**: Carbon (PHP DateTime)

## 📁 Cấu trúc thư mục

```
Shopthoitrangtoco/
├── admin/                 # Hệ thống quản trị
│   ├── admin/            # Giao diện admin
│   ├── css/              # Style cho admin
│   ├── images/           # Hình ảnh admin
│   ├── resources/        # CKEditor, CKFinder
│   └── uploads/          # Thư mục upload file
├── carbon/               # Thư viện Carbon
├── css/                  # Style cho frontend
├── images/               # Hình ảnh sản phẩm
├── pages/                # Các trang chức năng
│   ├── main/            # Trang chính
│   └── sidebar/         # Sidebar
├── connect_db.php        # Kết nối database
├── demo_db.sql          # Database schema
└── index.php            # Trang chủ
```
## Video demo: https://drive.google.com/file/d/1fSLTQLYOZnjU5KCxOsEM0xoPe0SJSEp2/view?usp=drive_link

## 🚀 Cài đặt và chạy dự án

### Yêu cầu hệ thống
- PHP 7.0 trở lên
- MySQL 5.7 trở lên
- Web server (Apache/Nginx)

### Các bước cài đặt

1. **Clone dự án**
   ```bash
   git clone [URL_REPOSITORY]
   cd Shopthoitrangtoco
   ```

2. **Cài đặt database**
   - Tạo database mới trong MySQL
   - Import file `demo_db.sql` vào database

3. **Cấu hình kết nối database**
   - Mở file `connect_db.php`
   - Cập nhật thông tin kết nối:
     ```php
     $host = "localhost";
     $user = "root";
     $password = "";
     $database = "demo_db";
     ```

4. **Cấu hình web server**
   - Đặt thư mục dự án vào thư mục web server
   - Đảm bảo PHP có quyền đọc/ghi file

5. **Truy cập website**
   - Frontend: `http://localhost/Shopthoitrangtoco/`
   - Admin: `http://localhost/Shopthoitrangtoco/admin/`

## 👤 Tài khoản mặc định

### Admin
- **Username**: admin
- **Password**: admin

### Database
- **Database name**: demo_db
- **Host**: localhost
- **User**: root
- **Password**: (để trống)

## 📱 Tính năng nổi bật

- **Responsive Design**: Tương thích với mọi thiết bị
- **Chatbot tích hợp**: Hỗ trợ khách hàng 24/7
- **Quản lý hình ảnh**: Upload và quản lý hình ảnh dễ dàng
- **Hệ thống thanh toán**: Đa dạng phương thức thanh toán
- **Bảo mật**: Session management và validation
- **SEO friendly**: Tối ưu cho công cụ tìm kiếm

## 🔒 Bảo mật

- Sử dụng session để quản lý đăng nhập
- Validation dữ liệu đầu vào
- Prepared statements cho truy vấn database
- Bảo vệ chống SQL injection

**Lưu ý**: Đây là dự án học tập, vui lòng không sử dụng cho mục đích thương mại mà không có sự cho phép. 
