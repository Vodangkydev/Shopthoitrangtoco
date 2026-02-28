## 🛍️ Website Bán Đồ Thời Trang – PHP thuần
user>
<img width="1903" height="1080" alt="image" src="https://github.com/user-attachments/assets/052227a2-cc3e-4eac-86a4-9f6799ba6407" />
<img width="1910" height="1072" alt="image" src="https://github.com/user-attachments/assets/0d1d74e9-74b2-40fe-8f15-f8172197366a" />
<img width="1900" height="872" alt="image" src="https://github.com/user-attachments/assets/5e097aba-dc1e-42b9-adba-3bf2183085c7" />
<img width="1887" height="783" alt="image" src="https://github.com/user-attachments/assets/5220f4f5-e581-4db1-9146-4789f63540ed" />
<img width="1875" height="878" alt="image" src="https://github.com/user-attachments/assets/e9dc461f-368a-4b12-aca7-b19a574b1ff9" />
<img width="1682" height="810" alt="image" src="https://github.com/user-attachments/assets/953642d3-fbfb-4fa1-8f49-4cbc0a60f85f" />
<<img width="1694" height="851" alt="image" src="https://github.com/user-attachments/assets/a494768f-c2a5-49e6-9290-48b28ef5c41f" />

admin>
<img width="1721" height="868" alt="image" src="https://github.com/user-attachments/assets/c8563a32-139b-407c-97ac-8fa869e52113" />


Website bán đồ thời trang (Toco Menswear) được xây dựng bằng **PHP thuần + MySQL**, chạy trên XAMPP, có đầy đủ luồng **mua hàng – giỏ hàng – đặt hàng – quản trị sản phẩm/đơn hàng** và tích hợp **chatbot Dialogflow**.

### 1. Tính năng chính

- **Trang chủ & hiển thị sản phẩm**
  - Liệt kê **sản phẩm mới nhất**, **sản phẩm khuyến mãi** và **toàn bộ sản phẩm** với phân trang.
  - Bộ lọc/sắp xếp sản phẩm theo: **mới nhất**, **giá thấp/cao**, **giá sau giảm thấp/cao**.
  - Hỗ trợ **wishlist (yêu thích)** lưu trong session.
- **Giỏ hàng & mua hàng**
  - Thêm sản phẩm vào giỏ, **tăng/giảm số lượng**, chọn **size (M/L/XL)**, xoá từng dòng hoặc xoá toàn bộ.
  - Tính **tổng tiền** theo số lượng và giá.
  - Luồng đặt hàng: Giỏ hàng → Vận chuyển → Hình thức thanh toán → Cảm ơn / Lịch sử đơn hàng.
- **Tài khoản khách hàng**
  - Đăng ký/đăng nhập, lưu thông tin vào bảng `khachhang`.
  - Đăng nhập dùng **prepared statement** để chống SQL injection, có tùy chọn **ghi nhớ tài khoản bằng cookie**.
  - Sau khi đăng nhập, khách hàng có thể đặt hàng và xem **lịch sử đơn hàng**.
- **Đặt hàng & thanh toán**
  - Lưu đơn hàng vào bảng `cart` và chi tiết vào `cart_details` (sản phẩm, số lượng, size).
  - Hỗ trợ hình thức thanh toán: **tiền mặt**, **chuyển khoản** (VNPay đang để placeholder “chưa cập nhật”).
  - Sử dụng **Carbon** để lưu thời gian tạo đơn (`cart_date`) theo múi giờ `Asia/Ho_Chi_Minh`.
- **Chatbot Dialogflow**
  - Tích hợp **Dialogflow Messenger** trực tiếp trên `index.php` (thẻ `<df-messenger>`), hỗ trợ khách hàng tự động.

### 2. Hệ thống quản trị (Admin)

Admin nằm trong thư mục `admin/`, đăng nhập bằng bảng `user`:

- **Quản lý sản phẩm (`product`)**
  - Xem danh sách sản phẩm với phân trang, ảnh, tên, ngày tạo/cập nhật.
  - Thêm, sửa, xoá, **copy sản phẩm** (tạo nhanh từ sản phẩm có sẵn).
  - Quản lý **thư viện ảnh** theo sản phẩm (bảng `image_library`, thư mục `admin/uploads/`).
- **Quản lý đơn hàng (`cart`, `cart_details`)**
  - Danh sách đơn hàng: mã đơn, khách hàng, hình thức thanh toán, **trạng thái đơn**:
    - 1: Đơn hàng mới  
    - 2: Đang chuẩn bị  
    - 3: Đang giao  
    - 4: Hoàn thành
  - Xem chi tiết đơn hàng, cập nhật trạng thái.
- **Quản lý danh mục (`danhmuc`) & nội dung khác**
  - Danh mục sản phẩm (Áo, Quần, Nón, …).
  - Nội dung liên hệ (`lienhe`) được lưu HTML (nhập từ CKEditor trong admin).
- **Công cụ trong admin**
  - Đăng nhập admin, header/footer riêng, phân trang chung (`admin/pagination.php`).
  - Upload hình ảnh với CKEditor + CKFinder.

### 3. Công nghệ & thư viện

- **Backend**: PHP thuần (`mysqli`)
- **Database**: MySQL / MariaDB
- **Frontend**: HTML, CSS, JavaScript (custom)
- **Editor**: CKEditor + CKFinder (trong `admin/resources/`)
- **Chatbot**: Dialogflow Messenger (thẻ `<df-messenger>` trong `index.php`)
- **Thư viện PHP**: Carbon (thư mục `carbon/`) dùng cho xử lý ngày giờ đặt hàng

### 4. Cấu trúc thư mục chính

```text
Shopthoitrangtoco/
├── admin/                 # Hệ thống quản trị
│   ├── admin/             # Trang CRUD sản phẩm, đơn hàng, danh mục, liên hệ,...
│   ├── css/               # CSS cho admin
│   ├── images/            # Ảnh cho giao diện admin
│   ├── resources/         # CKEditor, CKFinder (đã ignore trong Git)
│   └── uploads/           # Ảnh sản phẩm upload (đã ignore trong Git)
├── carbon/                # Thư viện Carbon PHP
├── css/                   # CSS cho frontend
├── images/                # Ảnh banner, logo, v.v.
├── js/                    # JS cho frontend (ví dụ: main.js)
├── pages/
│   ├── main/              # Các trang chức năng: giỏ hàng, đăng nhập, thanh toán,...
│   └── sidebar/           # Sidebar, khối phụ
├── connect_db.php         # Cấu hình kết nối database (frontend)
├── admin/connect_db.php   # Cấu hình kết nối database (admin)
├── demo_db.sql            # File SQL tạo bảng + dữ liệu mẫu
├── database_deploy.sql    # Script triển khai DB (nếu cần)
├── index.php              # Entry chính frontend (gộp header/menu/main/footer + chatbot)
└── .gitignore             # Bỏ qua resources nặng & uploads
```

### 5. Cài đặt & chạy dự án (XAMPP)

#### Yêu cầu

- PHP 7.0+  
- MySQL 5.7+ / MariaDB  
- XAMPP (Apache + MySQL) hoặc server tương đương

#### Các bước

1. **Clone dự án**

```bash
git clone [URL_REPOSITORY]
cd Shopthoitrangtoco
```

2. **Tạo database & import dữ liệu**

- Mở `phpMyAdmin` (`http://localhost/phpmyadmin`)
- Tạo database mới, ví dụ: `demo_db`
- Import file `demo_db.sql` vào database này.

3. **Cấu hình kết nối database**

- Mở `connect_db.php` và `admin/connect_db.php`, đảm bảo thông tin giống database vừa tạo:

```php
$host = "localhost";
$user = "root";
$password = "";
$database = "demo_db";
```

4. **Đặt thư mục dự án vào XAMPP**

- Đảm bảo cả project nằm tại: `C:\xampp\htdocs\Shopthoitrangtoco`
- Start **Apache** và **MySQL** trong XAMPP.

5. **Truy cập website**

- Frontend: `http://localhost/Shopthoitrangtoco/`
- Admin: `http://localhost/Shopthoitrangtoco/admin/`

### 6. Tài khoản mẫu

- **Admin** (bảng `user` trong `demo_db.sql`)
  - Username: `admin`
  - Password: `123`
- **Khách hàng**: Có sẵn một số dòng trong bảng `khachhang`, bạn có thể đăng ký thêm từ giao diện người dùng.

### 7. Ghi chú Git & dung lượng

- `.gitignore` đã cấu hình KHÔNG commit:
  - `admin/resources/ckeditor/`
  - `admin/resources/ckfinder/`
  - `admin/uploads/`
- Khi clone từ GitHub:
  - Có thể **tải lại CKEditor/CKFinder** và đặt đúng thư mục nếu cần chỉnh sửa nội dung rich text.

### 8. Lưu ý

- Dự án mang tính **học tập/đồ án**, chưa hoàn thiện toàn bộ về bảo mật (mật khẩu đang lưu plain-text trong DB demo).
- Không nên dùng trực tiếp cho môi trường production nếu chưa:
  - Hash mật khẩu (bcrypt, password_hash, …).
  - Rà soát toàn bộ input, CSRF, XSS, quyền truy cập admin, v.v.




