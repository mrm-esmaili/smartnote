<?php
require_once '../config.php';
require get_root_dir() . 'include/functions.php';

$savedImages = [];

$title = $_POST['title'];
$content = $_POST['content'];

$doc = new DOMDocument();
@$doc->loadHTML('<?xml encoding="utf-8" ?>' . $content);

$images = $doc->getElementsByTagName('img');
foreach ($images as $img) {
    $src = $img->getAttribute('src');

    if (strpos($src, 'data:image') === 0) {
        preg_match('/^data:image\/(\w+);base64,/', $src, $type);
        $data = substr($src, strpos($src, ',') + 1);
        $data = base64_decode($data);

        $imageNameRaw = 'uploads/' . time() . '_' . rand(1000, 9999) . '.' . $type[1];

        $imageName = get_root_dir() . $imageNameRaw;
        $imageUrl = get_root_url() . $imageNameRaw;

        file_put_contents($imageName, $data);

        $img->setAttribute('src', $imageNameRaw);

        $savedImages[] = $imageNameRaw;
    }
}

$finalContent = $doc->saveHTML();

$content_id = ex_query("INSERT INTO contents (title, content_text) VALUES (?, ?)", [$title, $finalContent]);

if (!empty($savedImages)) {
    foreach ($savedImages as $path) {
        ex_query("INSERT INTO uploads (file_path, content_id) VALUES (?, ?)", [$path, $content_id]);
    }
}

echo "محتوا و تصاویر با موفقیت ذخیره شدند.";
