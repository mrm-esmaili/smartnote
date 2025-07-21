<?php
require_once '../config.php';
require get_root_dir() . 'include/functions.php';

$id = $_POST['id'] ?? null;
if (!$id || !is_numeric($id)) {
  http_response_code(400);
  exit('شناسه نامعتبر است.');
}

// دریافت مسیر تصاویر مرتبط
$images = get_select_query("SELECT file_path FROM uploads WHERE content_id = ?", [$id]);

// حذف فایل‌ها از پوشه uploads
foreach ($images as $img) {
  $path = $img['file_path'];
  if (file_exists($path)) {
    unlink($path);
  }
}

// حذف رکوردها از جدول uploads و contents
ex_query("DELETE FROM uploads WHERE content_id = ?", [$id]);
ex_query("DELETE FROM contents WHERE id = ?", [$id]);

echo "مطلب و تصاویر مرتبط با موفقیت حذف شدند.";