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

## 📂 Cấu Trúc Thư Mục Quan Trọng

```
yii2-ecommerce-website/
├── frontend/           # Frontend (Khách hàng)
│   ├── web/
│   │   ├── uploads/   # Symlink → ../../uploads
│   │   ├── images/    # Chứa no-image.svg
│   │   └── router.php # Router cho PHP built-in server
│   └── ...
├── backend/            # Backend (Quản trị)
│   ├── web/
│   │   ├── uploads/   # Symlink → ../../uploads
│   │   ├── images/    # Chứa no-image.svg
│   │   └── router.php # Router cho PHP built-in server
│   └── ...
├── common/             # Code dùng chung
│   ├── models/        # Models
│   └── config/        # Config files
├── uploads/            # Thư mục lưu ảnh upload (gốc)
│   └── products/      # Ảnh sản phẩm
└── console/            # Console commands
    └── migrations/    # Database migrations
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
