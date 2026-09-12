<?php
require_once __DIR__ . '/config.php';

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if (!$id) {
    header('Location: index.php');
    exit;
}

$stmt = $conn->prepare('SELECT title, description, status FROM tasks WHERE id = ?');
$stmt->bind_param('i', $id);
$stmt->execute();
$task = $stmt->get_result()->fetch_assoc();
$stmt->close();

if (!$task) {
    header('Location: index.php?message=' . urlencode('المهمة غير موجودة'));
    exit;
}

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title'] ?? '');
    $description = trim($_POST['description'] ?? '');
    $status = $_POST['status'] ?? 'pending';

    if ($title === '') {
        $error = 'يرجى إدخال عنوان المهمة.';
    } elseif (!in_array($status, ['pending', 'completed'], true)) {
        $error = 'حالة المهمة غير صحيحة.';
    } else {
        $stmt = $conn->prepare('UPDATE tasks SET title = ?, description = ?, status = ? WHERE id = ?');
        $stmt->bind_param('sssi', $title, $description, $status, $id);
        $stmt->execute();
        $stmt->close();
        header('Location: index.php?message=' . urlencode('تم تعديل المهمة بنجاح'));
        exit;
    }
    $task = ['title' => $title, 'description' => $description, 'status' => $status];
}
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تعديل المهمة</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<main class="container narrow">
    <a class="back-link" href="index.php">← العودة إلى المهام</a>
    <section class="form-card">
        <h1>تعديل المهمة</h1>
        <?php if ($error): ?><div class="alert error"><?= htmlspecialchars($error) ?></div><?php endif; ?>
        <form method="post">
            <label for="title">عنوان المهمة</label>
            <input id="title" name="title" type="text" maxlength="150" required value="<?= htmlspecialchars($task['title']) ?>">

            <label for="description">الوصف</label>
            <textarea id="description" name="description" rows="5"><?= htmlspecialchars($task['description'] ?? '') ?></textarea>

            <label for="status">الحالة</label>
            <select id="status" name="status">
                <option value="pending" <?= $task['status'] === 'pending' ? 'selected' : '' ?>>قيد التنفيذ</option>
                <option value="completed" <?= $task['status'] === 'completed' ? 'selected' : '' ?>>مكتملة</option>
            </select>

            <button class="button primary" type="submit">حفظ التعديل</button>
        </form>
    </section>
</main>
</body>
</html>
<?php $conn->close(); ?>
