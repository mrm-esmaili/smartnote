<?php
require_once '../config.php';
require get_root_dir() . 'include/functions.php';

$id = $_POST['id'] ?? null;
if (!$id || !is_numeric($id)) {
  http_response_code(400);
  exit;
}

$rows = get_select_query("SELECT id, title, content_text FROM contents WHERE id = ?", [$id]);
echo json_encode($rows[0] ?? []);