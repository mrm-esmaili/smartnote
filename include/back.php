<?php
require_once '../config.php';
require get_root_dir() . 'include/functions.php';

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

    $imageName = get_root_dir() . 'uploads/' . time() . '_' . rand(1000, 9999) . '.' . $type[1];
    file_put_contents($imageName, $data);

    $img->setAttribute('src', $imageName);
    ex_query("INSERT INTO uploads (file_path) VALUES (?)", [$imageName]);
  }
}

$finalContent = $doc->saveHTML();

$content_id = ex_query("INSERT INTO contents (title, content_text) VALUES (?, ?)", [$title, $finalContent]);

echo "محتوا و تصاویر با موفقیت ذخیره شدند.";
