<?php
require_once __DIR__ . '/config.php';

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
        $stmt = $conn->prepare('INSERT INTO tasks (title, description, status) VALUES (?, ?, ?)');
        $stmt->bind_param('sss', $title, $description, $status);
        $stmt->execute();
        $stmt->close();
        header('Location: index.php?message=' . urlencode('تمت إضافة المهمة بنجاح'));
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إضافة مهمة</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<main class="container narrow">
    <a class="back-link" href="index.php">← العودة إلى المهام</a>
    <section class="form-card">
        <h1>إضافة مهمة جديدة</h1>
        <p>أدخل بيانات المهمة ثم احفظها في قاعدة البيانات.</p>
        <?php if ($error): ?><div class="alert error"><?= htmlspecialchars($error) ?></div><?php endif; ?>
        <form method="post">
            <label for="title">عنوان المهمة</label>
            <input id="title" name="title" type="text" maxlength="150" required value="<?= htmlspecialchars($_POST['title'] ?? '') ?>">

            <label for="description">الوصف</label>
            <textarea id="description" name="description" rows="5"><?= htmlspecialchars($_POST['description'] ?? '') ?></textarea>

            <label for="status">الحالة</label>
            <select id="status" name="status">
                <option value="pending">قيد التنفيذ</option>
                <option value="completed">مكتملة</option>
            </select>

            <button class="button primary" type="submit">حفظ المهمة</button>
        </form>
    </section>
</main>
</body>
</html>
<?php $conn->close(); ?>
