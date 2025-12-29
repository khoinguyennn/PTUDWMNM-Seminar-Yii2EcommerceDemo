# Hướng Dẫn Chạy Dự Án Yii2 E-commerce

Hướng dẫn chi tiết cách cài đặt và chạy dự án Yii2 E-commerce từ đầu sau khi clone từ GitHub.

## 📋 Yêu Cầu Hệ Thống

- **PHP**: >= 8.0
- **MySQL**: >= 5.7
- **Composer**: Phiên bản mới nhất
- **Git**: Để clone dự án

## 🚀 Bước 1: Clone Dự Án

```bash
git clone https://github.com/khoinguyennn/PTUDWMNM-Seminar-Yii2EcommerceDemo.git
cd PTUDWMNM-Seminar-Yii2EcommerceDemo
```

## 📦 Bước 2: Cài Đặt Dependencies

```bash
composer install
```

## ⚙️ Bước 3: Cấu Hình Database

### 3.1. Tạo Database

Mở MySQL và tạo database:

```sql
CREATE DATABASE yii2advanced CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

### 3.2. Cấu Hình Kết Nối Database

Mở file `common/config/main-local.php` và cập nhật thông tin database:

```php
return [
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=yii2advanced',
            'username' => 'root',      // Thay đổi username của bạn
            'password' => '',          // Thay đổi password của bạn
            'charset' => 'utf8',
        ],
        // ...
    ],
];
```

**Lưu ý**: Nếu MySQL của bạn chạy trên port khác (ví dụ: 3307), thay đổi `dsn`:

```php
'dsn' => 'mysql:host=localhost;port=3307;dbname=yii2advanced',
```

## 🗄️ Bước 4: Chạy Migration

Chạy lệnh sau để tạo các bảng trong database:

```bash
php yii migrate
```

Nhập `yes` khi được hỏi để xác nhận.

## 👤 Bước 5: Tạo Tài Khoản Admin

Chạy lệnh sau để tạo tài khoản admin:

```bash
php yii app/create-admin-user admin 123456
```

Thông tin đăng nhập:
- **Username**: `admin`
- **Password**: `123456`

## 📁 Bước 6: Tạo Thư Mục Uploads

### 6.1. Tạo Thư Mục

```bash
# PowerShell
New-Item -ItemType Directory -Path "uploads" -Force
```

### 6.2. Tạo Symbolic Links

**Lưu ý**: Cần chạy PowerShell với quyền Administrator

```bash
# Tạo symlink cho Frontend
cd frontend/web
New-Item -ItemType SymbolicLink -Path "uploads" -Target "..\..\uploads"

# Quay lại thư mục gốc
cd ..\..

# Tạo symlink cho Backend
cd backend/web
New-Item -ItemType SymbolicLink -Path "uploads" -Target "..\..\uploads"

# Quay lại thư mục gốc
cd ..\..
```

### 6.3. Tạo Thư Mục Images và No-Image Placeholder

**Frontend:**

```bash
# Tạo thư mục images
New-Item -ItemType Directory -Path "frontend/web/images" -Force
```

Tạo file `frontend/web/images/no-image.svg`:

```xml
<svg xmlns="http://www.w3.org/2000/svg" width="300" height="300" viewBox="0 0 300 300">
  <rect width="300" height="300" fill="#e9ecef"/>
  <text x="50%" y="45%" font-family="Arial, sans-serif" font-size="18" fill="#6c757d" text-anchor="middle" dominant-baseline="middle">
    No Image
  </text>
  <text x="50%" y="55%" font-family="Arial, sans-serif" font-size="14" fill="#adb5bd" text-anchor="middle" dominant-baseline="middle">
    Available
  </text>
</svg>
```

**Backend:**

```bash
# Tạo thư mục images
New-Item -ItemType Directory -Path "backend/web/images" -Force
```

Tạo file `backend/web/images/no-image.svg` (nội dung giống như trên)

## 🌐 Bước 7: Chạy Server

Mở **2 terminal/PowerShell riêng biệt**:

### Terminal 1 - Frontend (Trang khách hàng):

```bash
php -S localhost:8080 -t frontend/web frontend/web/router.php
```

Truy cập: **http://localhost:8080**

### Terminal 2 - Backend (Trang quản trị):

```bash
php -S localhost:8081 -t backend/web backend/web/router.php
```

Truy cập: **http://localhost:8081**

## 🎯 Bước 8: Sử Dụng

### Frontend (http://localhost:8080)

1. **Đăng ký tài khoản**: Click "Sign up" để tạo tài khoản khách hàng
2. **Đăng nhập**: Sử dụng tài khoản vừa tạo
3. **Xem sản phẩm**: Duyệt danh sách sản phẩm
4. **Thêm vào giỏ hàng**: Click nút "Add to Cart"
5. **Thanh toán**: Vào giỏ hàng và hoàn tất đơn hàng

### Backend (http://localhost:8081)

1. **Đăng nhập** với tài khoản admin:
   - Username: `admin`
   - Password: `123456`

2. **Quản lý sản phẩm**:
   - Click "Products" → "Create Product"
   - Điền thông tin sản phẩm
   - Upload ảnh sản phẩm
   - Click "Save"

3. **Quản lý đơn hàng**:
   - Click "Orders" để xem danh sách đơn hàng
   - Cập nhật trạng thái đơn hàng

## 🔧 Troubleshooting

### Lỗi: MySQL Connection Refused

**Giải pháp**: Kiểm tra MySQL service có đang chạy không:

```bash
# Kiểm tra MySQL service
Get-Service -Name "MySQL*"

# Khởi động MySQL nếu cần
Start-Service -Name "MySQL80"  # Thay đổi tên service phù hợp
```

### Lỗi: Cannot create symlink

**Giải pháp**: Chạy PowerShell với quyền Administrator:
1. Click phải vào PowerShell
2. Chọn "Run as Administrator"
3. Chạy lại lệnh tạo symlink

Hoặc sử dụng cách thay thế: **Copy thay vì symlink**

```bash
# Copy thư mục uploads vào frontend/web
Copy-Item -Path "uploads" -Destination "frontend/web/uploads" -Recurse

# Copy thư mục uploads vào backend/web  
Copy-Item -Path "uploads" -Destination "backend/web/uploads" -Recurse
```

**Lưu ý**: Nếu dùng copy, mỗi khi upload ảnh mới cần copy lại.

### Lỗi: Ảnh không hiển thị

**Giải pháp**:

1. Kiểm tra symlink đã được tạo chưa:
   ```bash
   Get-Item frontend/web/uploads
   Get-Item backend/web/uploads
   ```

2. Kiểm tra file no-image.svg đã được tạo chưa:
   ```bash
   Test-Path frontend/web/images/no-image.svg
   Test-Path backend/web/images/no-image.svg
   ```

3. Upload lại ảnh sản phẩm qua backend

### Lỗi: Not Found khi truy cập URL

**Giải pháp**: Đảm bảo bạn đang chạy server với file `router.php`:

```bash
# ĐÚNG
php -S localhost:8080 -t frontend/web frontend/web/router.php

# SAI (thiếu router.php)
php -S localhost:8080 -t frontend/web
```

## 📂 Cấu Trúc Thư Mục Chi Tiết

### 📁 Thư Mục Gốc

```
yii2-ecommerce-website/
├── frontend/              # Application Frontend (Trang khách hàng)
├── backend/               # Application Backend (Trang quản trị)
├── common/                # Code dùng chung giữa frontend và backend
├── console/               # Console application (CLI commands)
├── environments/          # Environment configurations (dev/prod)
├── uploads/               # Thư mục lưu trữ file upload
├── vendor/                # Thư viện PHP từ Composer
├── vagrant/               # Vagrant configuration (nếu dùng)
├── composer.json          # Composer dependencies
├── composer.lock          # Composer lock file
├── init                   # Script khởi tạo môi trường (Linux/Mac)
├── init.bat               # Script khởi tạo môi trường (Windows)
├── yii                    # Yii console command (Linux/Mac)
├── yii.bat                # Yii console command (Windows)
├── README.md              # Thông tin dự án
└── README_SETUP.md        # Hướng dẫn setup dự án
```

---

### 🎨 Frontend (Trang Khách Hàng)

**Đường dẫn**: `frontend/`

Đây là phần giao diện dành cho khách hàng truy cập.

```
frontend/
├── assets/               # Asset bundles (CSS, JS)
│   └── AppAsset.php     # Đăng ký CSS/JS cho frontend
├── config/              # Cấu hình frontend
│   ├── main.php         # Cấu hình chính
│   ├── main-local.php   # Cấu hình local (database, etc.)
│   ├── params.php       # Parameters
│   └── bootstrap.php    # Bootstrap configuration
├── controllers/         # Controllers xử lý request
│   ├── SiteController.php      # Trang chủ, login, signup
│   ├── CartController.php      # Giỏ hàng
│   ├── OrderController.php     # Đơn hàng
│   └── ProductController.php   # Chi tiết sản phẩm
├── models/              # Models cho frontend
│   ├── LoginForm.php           # Form đăng nhập
│   ├── SignupForm.php          # Form đăng ký
│   ├── ContactForm.php         # Form liên hệ
│   └── search/                 # Search models
├── views/               # Views (HTML templates)
│   ├── layouts/                # Layout chung
│   │   └── main.php           # Layout chính (navbar, footer)
│   ├── site/                   # Views cho SiteController
│   │   ├── index.php          # Trang chủ
│   │   ├── login.php          # Trang đăng nhập
│   │   ├── signup.php         # Trang đăng ký
│   │   └── _product_item.php  # Template card sản phẩm
│   ├── cart/                   # Views cho CartController
│   ├── order/                  # Views cho OrderController
│   └── product/                # Views cho ProductController
├── web/                 # Web root (public folder)
│   ├── index.php               # Entry point
│   ├── router.php              # Router cho PHP built-in server
│   ├── uploads/                # Symlink → ../../uploads
│   ├── images/                 # Ảnh static
│   │   └── no-image.svg       # Placeholder khi không có ảnh
│   ├── css/                    # CSS files
│   │   └── custom.css         # Custom CSS (360+ dòng)
│   ├── js/                     # JavaScript files
│   │   └── custom.js          # Custom JS (AJAX cart)
│   └── assets/                 # Generated assets
├── runtime/             # Runtime files (cache, logs)
│   ├── cache/                  # Cache files
│   └── logs/                   # Log files
└── tests/               # Tests cho frontend
```

**Chức năng chính**:
- Hiển thị danh sách sản phẩm
- Xem chi tiết sản phẩm
- Thêm sản phẩm vào giỏ hàng (AJAX)
- Quản lý giỏ hàng
- Đặt hàng và thanh toán
- Đăng ký/Đăng nhập khách hàng

---

### 🔧 Backend (Trang Quản Trị)

**Đường dẫn**: `backend/`

Đây là phần giao diện dành cho admin quản lý hệ thống.

```
backend/
├── assets/              # Asset bundles
│   └── AppAsset.php    # Đăng ký CSS/JS cho backend
├── config/              # Cấu hình backend
│   ├── main.php        # Cấu hình chính
│   ├── main-local.php  # Cấu hình local
│   ├── params.php      # Parameters
│   └── bootstrap.php   # Bootstrap configuration
├── controllers/         # Controllers xử lý request
│   ├── SiteController.php      # Dashboard, login
│   ├── ProductController.php   # CRUD sản phẩm
│   ├── OrderController.php     # Quản lý đơn hàng
│   └── UserController.php      # Quản lý user (nếu có)
├── models/              # Models cho backend
│   ├── LoginForm.php           # Form đăng nhập admin
│   └── search/                 # Search models
│       ├── ProductSearch.php   # Search sản phẩm
│       └── OrderSearch.php     # Search đơn hàng
├── views/               # Views (HTML templates)
│   ├── layouts/                # Layout chung
│   │   └── main.php           # Layout chính
│   ├── site/                   # Views cho SiteController
│   │   ├── index.php          # Dashboard
│   │   └── login.php          # Trang đăng nhập admin
│   ├── product/                # Views cho ProductController
│   │   ├── index.php          # Danh sách sản phẩm
│   │   ├── create.php         # Tạo sản phẩm
│   │   ├── update.php         # Sửa sản phẩm
│   │   ├── view.php           # Xem chi tiết
│   │   └── _form.php          # Form tạo/sửa
│   └── order/                  # Views cho OrderController
│       ├── index.php          # Danh sách đơn hàng
│       ├── view.php           # Xem chi tiết đơn
│       └── update.php         # Cập nhật trạng thái
├── web/                 # Web root (public folder)
│   ├── index.php               # Entry point
│   ├── router.php              # Router cho PHP built-in server
│   ├── uploads/                # Symlink → ../../uploads
│   ├── images/                 # Ảnh static
│   │   └── no-image.svg       # Placeholder
│   ├── css/                    # CSS files
│   └── assets/                 # Generated assets
├── runtime/             # Runtime files
│   ├── cache/                  # Cache files
│   └── logs/                   # Log files
└── tests/               # Tests cho backend
```

**Chức năng chính**:
- Đăng nhập admin
- Quản lý sản phẩm (CRUD - Create, Read, Update, Delete)
- Upload ảnh sản phẩm
- Quản lý đơn hàng
- Cập nhật trạng thái đơn hàng
- Xem báo cáo, thống kê

---

### 🔗 Common (Code Dùng Chung)

**Đường dẫn**: `common/`

Chứa code được chia sẻ giữa frontend và backend.

```
common/
├── config/              # Cấu hình chung
│   ├── main.php                # Cấu hình chính (components, modules)
│   ├── main-local.php          # Cấu hình local (database)
│   ├── params.php              # Parameters chung
│   └── bootstrap.php           # Bootstrap configuration
├── models/              # Models chung
│   ├── User.php                # Model User (admin, customer)
│   ├── Product.php             # Model Product
│   ├── Order.php               # Model Order
│   ├── OrderItem.php           # Model Order Item (chi tiết đơn)
│   ├── CartItem.php            # Model Cart Item (giỏ hàng)
│   └── query/                  # Active Query classes
│       ├── UserQuery.php
│       ├── ProductQuery.php
│       └── OrderQuery.php
├── components/          # Components tùy chỉnh
│   └── Formatter.php           # Custom formatter (currency)
├── i18n/                # Internationalization
│   └── Formatter.php           # I18n formatter
├── grid/                # Grid widgets
│   └── ActionColumn.php        # Custom action column
├── widgets/             # Widgets tùy chỉnh
├── mail/                # Email templates
│   ├── emailVerify-html.php    # Email xác thực HTML
│   ├── emailVerify-text.php    # Email xác thực Text
│   ├── order_completed_customer-html.php
│   └── order_completed_customer-text.php
├── fixtures/            # Data fixtures cho testing
│   └── UserFixture.php
└── tests/               # Tests chung
```

**Mục đích**:
- Tránh duplicate code
- Models được dùng bởi cả frontend và backend
- Components, widgets dùng chung
- Email templates
- Cấu hình database chung

---

### 💻 Console (CLI Application)

**Đường dẫn**: `console/`

Chứa các console commands để chạy từ terminal.

```
console/
├── config/              # Cấu hình console
│   ├── main.php                # Cấu hình chính
│   ├── main-local.php          # Cấu hình local
│   ├── params.php              # Parameters
│   └── bootstrap.php           # Bootstrap configuration
├── controllers/         # Console controllers
│   ├── AppController.php       # Custom app commands
│   │                           # (tạo admin user, etc.)
│   └── MigrateController.php   # Migration commands (nếu override)
├── migrations/          # Database migrations
│   ├── m130524_201442_init.php                    # Tạo bảng user
│   ├── m190124_110200_add_verification_token_column_to_user_table.php
│   ├── m241229_025726_create_products_table.php   # Tạo bảng products
│   ├── m241229_025738_create_cart_items_table.php # Tạo bảng cart_items
│   ├── m241229_025800_create_orders_table.php     # Tạo bảng orders
│   └── m241229_025811_create_order_items_table.php# Tạo bảng order_items
├── models/              # Models cho console
└── runtime/             # Runtime files
    ├── cache/
    └── logs/
```

**Các lệnh console**:
```bash
# Chạy migrations
php yii migrate

# Reset database (xóa tất cả và chạy lại migrations)
php yii migrate/fresh

# Tạo admin user
php yii app/create-admin-user <username> <password>

# Clear cache
php yii cache/flush-all
```

---

### 🌍 Environments (Môi Trường)

**Đường dẫn**: `environments/`

Chứa cấu hình cho các môi trường khác nhau.

```
environments/
├── index.php            # Danh sách environments
├── dev/                 # Development environment
│   ├── common/
│   │   └── config/
│   │       └── main-local.php      # DB config cho dev
│   ├── frontend/
│   │   └── config/
│   │       └── main-local.php      # Frontend config cho dev
│   └── backend/
│       └── config/
│           └── main-local.php      # Backend config cho dev
└── prod/                # Production environment
    ├── common/
    ├── frontend/
    └── backend/
```

**Cách sử dụng**:
```bash
# Khởi tạo môi trường development
php init

# Chọn [0] Development
```

---

### 📤 Uploads (Thư Mục Upload)

**Đường dẫn**: `uploads/`

Thư mục lưu trữ tất cả file upload (ảnh sản phẩm, v.v.)

```
uploads/
└── products/            # Ảnh sản phẩm
    └── [random-string]/ # Thư mục ngẫu nhiên cho mỗi ảnh
        └── product.jpg  # File ảnh
```

**Lưu ý**:
- Thư mục này được symlink vào `frontend/web/uploads` và `backend/web/uploads`
- Ảnh được tổ chức theo cấu trúc `/products/[random-string]/[filename]`
- Random string để tránh trùng lặp tên file

---

### 📦 Vendor (Thư Viện PHP)

**Đường dẫn**: `vendor/`

Chứa tất cả thư viện PHP được cài qua Composer.

```
vendor/
├── autoload.php         # Composer autoloader
├── yiisoft/             # Yii2 framework
│   ├── yii2/           # Yii2 core
│   └── yii2-bootstrap4/# Bootstrap 4 extension
├── swiftmailer/         # Email library
├── phpunit/             # Testing framework
├── codeception/         # Testing framework
└── ...                  # Các thư viện khác
```

**Không commit thư mục này** vào Git (đã có trong `.gitignore`)

---

### 📋 Files Quan Trọng Ở Thư Mục Gốc

```
├── composer.json        # Danh sách dependencies
├── composer.lock        # Lock file (version cụ thể)
├── init                 # Script khởi tạo env (Linux/Mac)
├── init.bat             # Script khởi tạo env (Windows)
├── yii                  # Yii console (Linux/Mac)
├── yii.bat              # Yii console (Windows)
├── requirements.php     # Kiểm tra requirements
├── LICENSE.md           # License
├── README.md            # Thông tin dự án
└── README_SETUP.md      # Hướng dẫn setup (file này)
```

---

## 🔄 Luồng Hoạt Động

### Frontend (Customer):
1. User truy cập `http://localhost:8080`
2. Request đi qua `frontend/web/index.php`
3. Router xử lý URL → Controller → Action
4. Controller lấy data từ Model (trong `common/models/`)
5. Controller render View (trong `frontend/views/`)
6. Response trả về HTML cho user

### Backend (Admin):
1. Admin truy cập `http://localhost:8081`
2. Request đi qua `backend/web/index.php`
3. Router xử lý URL → Controller → Action
4. Controller lấy/lưu data từ Model (trong `common/models/`)
5. Controller render View (trong `backend/views/`)
6. Response trả về HTML cho admin

### Upload Ảnh:
1. Admin upload ảnh qua backend form
2. `ProductController` xử lý upload
3. `Product` model lưu file vào `uploads/products/[random]/[file]`
4. Đường dẫn lưu vào database: `/products/[random]/[file]`
5. Frontend/Backend truy cập ảnh qua symlink `web/uploads/`

---

## 🗄️ Database Schema

### Tables:
- **user** - Lưu thông tin user (admin, customer)
- **products** - Lưu thông tin sản phẩm
- **cart_items** - Lưu giỏ hàng (cho user đã login)
- **orders** - Lưu thông tin đơn hàng
- **order_items** - Lưu chi tiết đơn hàng (sản phẩm trong đơn)

### Relationships:
```
User (1) -----> (N) Orders
Product (1) --> (N) CartItems
Product (1) --> (N) OrderItems  
Order (1) ----> (N) OrderItems
User (1) -----> (N) CartItems
```

## 🔐 Thông Tin Tài Khoản Mẫu

### Admin (Backend)
- **URL**: http://localhost:8081
- **Username**: `admin`
- **Password**: `123456`

### Customer (Frontend)
- Tự đăng ký tại: http://localhost:8080/site/signup
- Không cần xác thực email (tự động active)

## 📚 Tài Liệu Tham Khảo

- [Yii2 Documentation](https://www.yiiframework.com/doc/guide/2.0/en)
- [Yii2 Advanced Template](https://github.com/yiisoft/yii2-app-advanced)
- [Bootstrap 4 Documentation](https://getbootstrap.com/docs/4.6/)

## 💡 Tips

1. **Để dừng server**: Nhấn `Ctrl + C` trong terminal
2. **Để clear cache**: `php yii cache/flush-all`
3. **Để reset database**: `php yii migrate/fresh --interactive=0` (⚠️ Xóa tất cả dữ liệu)
4. **Xem log lỗi**: Kiểm tra file trong `frontend/runtime/logs/` và `backend/runtime/logs/`

## 🎨 Tính Năng Đã Được Cải Thiện

- ✅ Giao diện hiện đại với Bootstrap 4
- ✅ Hero section với gradient đẹp
- ✅ Product cards với hover effects
- ✅ AJAX add to cart (không reload trang)
- ✅ Responsive design
- ✅ Custom currency formatter (hiển thị "số tiền VND")
- ✅ Session cart cho guest users
- ✅ Auto-activate user (không cần verify email)

## 📝 License

MIT License

---

**Chúc bạn code vui vẻ! 🚀**
