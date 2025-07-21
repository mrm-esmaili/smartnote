<?php
require_once 'config.php';
require get_root_dir() . 'include/functions.php';
?>
<!DOCTYPE html>
<html lang="fa">
    <head>
        <meta charset="UTF-8" />
        <title>تست summernote</title>
        <link rel="stylesheet" href="<?= get_root_url(); ?>dist/library/bootstrap/bootstrap.min.css" />
        <link rel="stylesheet" href="<?= get_root_url(); ?>dist/library/summernote/summernote-bs4.min.css" />
        <link rel="stylesheet" href="<?= get_root_url(); ?>dist/library/sweetalert/sweetalert2.min.css" />
        <link rel="stylesheet" href="<?= get_root_url(); ?>dist/style.css?v1.4" />
    </head>
    <body>
        <input type="hidden" value="<?= get_root_url(); ?>" id="home_url">
        <div class="container text-right p-5">
            <a class="btn btn-info btn-sm" href="<?= get_root_url() ?>list.php">نمایش محتواها</a>
        </div>
        <div class="container">
            <h3 class="mb-4 text-center">محتوای شما</h3>
            <form id="contentForm" enctype="multipart/form-data">
                <input type="text" name="title" class="form-control mb-3" placeholder="عنوان محتوا" required />
                <textarea id="summernote" name="content"></textarea>
                <button type="submit" class="btn btn-success mt-3">
                    ارسال
                </button>
            </form>
        </div>

        <!-- JS Libraries -->
        <script src="<?= get_root_url(); ?>dist/library/jquery/jquery-3.5.1.min.js"></script>
        <script src="<?= get_root_url(); ?>dist/library/bootstrap/bootstrap.bundle.min.js"></script>
        <script src="<?= get_root_url(); ?>dist/library/summernote/summernote-bs4.min.js"></script>
        <script src="<?= get_root_url(); ?>dist/library/summernote/lang/summernote-fa-IR.js?v1.2"></script>
        <script src="<?= get_root_url(); ?>dist/library/sweetalert/sweetalert2.min.js"></script>
        <script src="<?= get_root_url(); ?>dist/script.js?v1.5"></script>
    </body>
</html>
