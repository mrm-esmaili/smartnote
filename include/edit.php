<?php
require_once '../config.php';
require get_root_dir() . 'include/functions.php';

$id = $_POST['id'] ?? null;
$title = $_POST['title'] ?? '';
$content = $_POST['content'] ?? '';

if (!$id || !is_numeric($id) || !$title || !$content) {
    http_response_code(400);
    exit('اطلاعات ناقص است.');
}

$doc = new DOMDocument();
@$doc->loadHTML('<?xml encoding="utf-8" ?>' . $content);

// استخراج تصاویر فعلی از محتوای جدید
$newImages = [];
$newImagesRaw = [];
$images = $doc->getElementsByTagName('img');
foreach ($images as $img) {
    $src = $img->getAttribute('src');

    // اگر تصویر جدید (Base64) بود، ذخیره کن
    if (strpos($src, 'data:image') === 0) {
        preg_match('/^data:image\/(\w+);base64,/', $src, $type);
        $data = substr($src, strpos($src, ',') + 1);
        $data = base64_decode($data);

        $imageNameRaw = 'uploads/' . time() . '_' . rand(1000, 9999) . '.' . $type[1];

        $imageName = get_root_dir() . $imageNameRaw;
        $imageUrl = get_root_url() . $imageNameRaw;

        file_put_contents($imageName, $data);

        $img->setAttribute('src', $imageNameRaw);
        $newImages[] = $imageName;
        $newImagesRaw[] = $imageNameRaw;
    } else {
        // تصویر قبلی که هنوز باقی مونده
        $newImages[] = $src;
    }
}

// دریافت تصاویر قبلی از دیتابیس
$oldImages = get_select_query("SELECT file_path FROM uploads WHERE content_id = ?", [$id]);

// بررسی تصاویر حذف‌شده
foreach ($oldImages as $old) {
    if (!in_array($old['file_path'], $newImagesRaw)) {
        $file_path_old = get_root_dir() . $old['file_path'];
        if (file_exists($file_path_old)) {
            unlink($file_path_old);
        }
        ex_query("DELETE FROM uploads WHERE file_path = ?", [$old['file_path']]);
    }
}

// ذخیره محتوای جدید
$finalContent = $doc->saveHTML();
ex_query("UPDATE contents SET title = ?, content_text = ? WHERE id = ?", [$title, $finalContent, $id]);

// ثبت تصاویر جدید در جدول uploads
foreach ($newImagesRaw as $path) {
    $exists = get_select_query("SELECT id FROM uploads WHERE file_path = ? AND content_id = ?", [$path, $id]);
    if (empty($exists)) {
        ex_query("INSERT INTO uploads (file_path, content_id) VALUES (?, ?)", [$path, $id]);
    }
}

echo "✅ محتوا و تصاویر با موفقیت به‌روزرسانی شدند.";
