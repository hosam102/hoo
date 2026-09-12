<?php
require_once __DIR__ . '/config.php';

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if ($id) {
    $stmt = $conn->prepare('DELETE FROM tasks WHERE id = ?');
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $stmt->close();
}

header('Location: index.php?message=' . urlencode('تم حذف المهمة بنجاح'));
exit;
