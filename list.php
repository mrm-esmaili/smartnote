<?php
require_once 'config.php';
require get_root_dir() . 'include/functions.php';

$results = get_select_query("SELECT id, title, content_text, created_at FROM contents ORDER BY created_at DESC");
?>

<!DOCTYPE html>
<html lang="fa">

<head>
    <meta charset="UTF-8" />
    <title>لیست مطالب ثبت‌شده</title>
    <link rel="stylesheet" href="<?= get_root_url(); ?>dist/library/bootstrap/bootstrap.min.css" />
    <link rel="stylesheet" href="<?= get_root_url(); ?>dist/library/summernote/summernote-bs4.min.css" />
    <link rel="stylesheet" href="<?= get_root_url(); ?>dist/library/sweetalert/sweetalert2.min.css" />
    <link rel="stylesheet" href="<?= get_root_url(); ?>dist/style.css?v1.4" />
</head>

<body>
    <input type="hidden" value="<?= get_root_url(); ?>" id="home_url">

    <div class="container text-right p-5">
        <a class="btn btn-info btn-sm" href="<?= get_root_url() ?>index.php">محتوای جدید</a>
    </div>
    <div class="container">
        <h2 class="mb-4 text-center">📋 لیست مطالب ثبت‌شده</h2>

        <?php if (!empty($results)): ?>
            <?php foreach ($results as $row): ?>
                <div class="content-box text-right">
                    <h4><?= htmlspecialchars($row['title']) ?></h4>
                    <div class="content-meta">🕓 <?= $row['created_at'] ?> | شناسه: <?= $row['id'] ?></div>
                    <div class="content-preview">
                        <?= mb_substr(strip_tags($row['content_text']), 0, 200) ?>...
                    </div>
                    <button class="btn btn-danger btn-sm mt-3 delete-btn" data-id="<?= $row['id'] ?>">🗑 حذف مطلب</button>
                    <a href="<?= get_root_url() ?>view.php?id=<?= $row['id'] ?>" class="btn btn-info btn-sm mt-3">👁 مشاهده کامل</a>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="text-center text-muted">هیچ محتوایی ثبت نشده است.</p>
        <?php endif; ?>
    </div>

    <!-- JS Libraries -->
    <script src="<?= get_root_url(); ?>dist/library/jquery/jquery-3.5.1.min.js"></script>
    <script src="<?= get_root_url(); ?>dist/library/bootstrap/bootstrap.bundle.min.js"></script>
    <script src="<?= get_root_url(); ?>dist/library/summernote/summernote-bs4.min.js"></script>
    <script src="<?= get_root_url(); ?>dist/library/summernote/lang/summernote-fa-IR.js?v1.2"></script>
    <script src="<?= get_root_url(); ?>dist/library/sweetalert/sweetalert2.min.js"></script>
    <script src="<?= get_root_url(); ?>dist/script.js?v1.6"></script>

</body>

</html>