# SmartNote
ویرایشگر WYSIWYG تحت jQuery با قابلیت ارسال محتوا و آپلود هوشمند تصاویر در زمان ذخیره.

## ✨ ویژگی‌ها
- ویرایش متن با استفاده از Summernote
- پشتیبانی از تگ‌های H1-H3
- درج تصاویر داخل محتوا و ذخیره‌سازی پس از تأیید
- ذخیره محتوا در پایگاه‌داده MySQL
- ذخیره تصاویر در پوشه `uploads` و ثبت مسیر در دیتابیس
- نمایش پیغام‌های تعاملی با SweetAlert

## 🧱 ساختار پروژه
# SmartNote
ویرایشگر WYSIWYG تحت jQuery با قابلیت ارسال محتوا و آپلود هوشمند تصاویر در زمان ذخیره.


## ✨ ویژگی‌ها
- ویرایش متن با استفاده از Summernote
- پشتیبانی از تگ‌های H1-H3
- درج تصاویر داخل محتوا و ذخیره‌سازی پس از تأیید
- ذخیره محتوا در پایگاه‌داده MySQL
- ذخیره تصاویر در پوشه `uploads` و ثبت مسیر در دیتابیس
- نمایش پیغام‌های تعاملی با SweetAlert


## 🧱 ساختار پروژه
SmartNote/

├── index.html ← رابط کاربری اصلی

├── script.js ← کد ارسال محتوا به سرور با AJAX

├── back.php ← پردازش محتوا و ذخیره در دیتابیس

├── connection.php ← اتصال و اجرای کوئری‌ها

├── uploads/ ← ذخیره تصاویر

├── summernote/ ← فایل‌های CSS/JS مربوط به ویرایشگر

├── sweetalert2/ ← فایل‌های SweetAlert

└── README.md ← راهنمای پروژه


## 🧪 پایگاه‌داده

```sql
### جدول `contents`
CREATE TABLE contents (
  id INT AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(255) NOT NULL,
  content_text TEXT NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

### جدول `upload`
CREATE TABLE uploads (
  id INT AUTO_INCREMENT PRIMARY KEY,
  content_id INT DEFAULT NULL,
  file_path VARCHAR(255) NOT NULL,
  uploaded_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (content_id) REFERENCES contents(id) ON DELETE SET NULL
);

⚙️ نحوه راه‌اندازی
- فایل‌های summernote, bootstrap, sweetalert2 رو در پوشه مربوطه قرار دهید.
- دیتابیس MySQL ساخته و جداول را اجرا کنید.
- فایل config.ini را با اطلاعات اتصال تنظیم کنید.
- پروژه را در محیط لوکال (XAMPP/WAMP) اجرا نمایید.

📮 تماس
در صورت وجود هرگونه سوال، خوشحال می‌شیم در گیت یا تلگرام پاسخ‌گو باشیم!