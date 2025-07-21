<?php
require_once 'config.php';
require get_root_dir() . 'include/functions.php';

$id = $_GET['id'] ?? null;
if (!$id || !is_numeric($id)) {
    die('شناسه نامعتبر است.');
}

// دریافت یک مطلب بر اساس شناسه
$rows = get_select_query("SELECT title, content_text, created_at FROM contents WHERE id = ?", [$id]);
if (empty($rows)) {
    die('مطلبی با این شناسه پیدا نشد.');
}

$row = $rows[0];

$content = $row['content_text'];
$title = $row['title'];
$created_at = $row['created_at'];

$baseUrl = get_root_url();
$content = str_replace('src="uploads/', 'src="' . $baseUrl . 'uploads/', $content);
?>
<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8" />
    <title>تست summernote</title>
    <link rel="stylesheet" href="<?= get_root_url(); ?>dist/library/bootstrap/bootstrap.min.css" />
    <link rel="stylesheet" href="<?= get_root_url(); ?>dist/library/summernote/summernote-bs4.min.css" />
    <link rel="stylesheet" href="<?= get_root_url(); ?>dist/library/sweetalert/sweetalert2.min.css" />
    <link rel="stylesheet" href="<?= get_root_url(); ?>dist/style.css?v1.8" />
</head>

<body>
    <input type="hidden" value="<?= get_root_url(); ?>" id="home_url">
    <div class="container text-right p-5">
        <a class="btn btn-info btn-sm" href="<?= get_root_url() ?>list.php">نمایش محتواها</a>
    </div>

    <div class="container">
        <div class="content-box text-right">
            <h3><?= htmlspecialchars($title) ?></h3>
            <div class="content-meta">🗓 ثبت شده در: <?= $created_at ?></div>
            <div class="content-body">
                <?= $content ?>
            </div>
        </div>
    </div>

    <!-- JS Libraries -->
    <script src="<?= get_root_url(); ?>dist/library/jquery/jquery-3.5.1.min.js"></script>
    <script src="<?= get_root_url(); ?>dist/library/bootstrap/bootstrap.bundle.min.js"></script>
    <script src="<?= get_root_url(); ?>dist/library/summernote/summernote-bs4.min.js"></script>
    <script src="<?= get_root_url(); ?>dist/library/summernote/lang/summernote-fa-IR.js?v1.2"></script>
    <script src="<?= get_root_url(); ?>dist/library/sweetalert/sweetalert2.min.js"></script>
    <script src="<?= get_root_url(); ?>dist/script.js?v1.8"></script>
</body>

</html>