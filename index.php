<?php
require_once __DIR__ . '/config.php';

$result = $conn->query("SELECT id, title, description, status, created_at FROM tasks ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>نظام إدارة المهام الطلابية</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header class="site-header">
    <div class="container header-content">
        <div>
            <p class="eyebrow">مشروع الحوسبة السحابية</p>
            <h1>نظام إدارة المهام الطلابية</h1>
        </div>
        <a class="button primary" href="add.php">+ إضافة مهمة</a>
    </div>
</header>

<main class="container">
    <section class="intro-card">
        <h2>مهامي</h2>
        <p>تطبيق PHP بسيط لإضافة المهام وتعديلها وحذفها مع تخزين البيانات في MySQL.</p>
    </section>

    <?php if (isset($_GET['message'])): ?>
        <div class="alert success"><?= htmlspecialchars($_GET['message']) ?></div>
    <?php endif; ?>

    <section class="task-grid">
        <?php if ($result && $result->num_rows > 0): ?>
            <?php while ($task = $result->fetch_assoc()): ?>
                <article class="task-card <?= $task['status'] === 'completed' ? 'done' : '' ?>">
                    <div class="task-topline">
                        <span class="badge <?= $task['status'] === 'completed' ? 'badge-success' : 'badge-warning' ?>">
                            <?= $task['status'] === 'completed' ? 'مكتملة' : 'قيد التنفيذ' ?>
                        </span>
                        <small>#<?= (int)$task['id'] ?></small>
                    </div>
                    <h3><?= htmlspecialchars($task['title']) ?></h3>
                    <p><?= nl2br(htmlspecialchars($task['description'] ?? '')) ?></p>
                    <small class="date">أضيفت في: <?= htmlspecialchars($task['created_at']) ?></small>
                    <div class="actions">
                        <a class="button secondary" href="edit.php?id=<?= (int)$task['id'] ?>">تعديل</a>
                        <a class="button danger" href="delete.php?id=<?= (int)$task['id'] ?>" onclick="return confirm('هل تريد حذف هذه المهمة؟');">حذف</a>
                    </div>
                </article>
            <?php endwhile; ?>
        <?php else: ?>
            <div class="empty-state">
                <h3>لا توجد مهام بعد</h3>
                <p>ابدأ بإضافة أول مهمة إلى النظام.</p>
                <a class="button primary" href="add.php">إضافة أول مهمة</a>
            </div>
        <?php endif; ?>
    </section>
</main>

<footer class="footer">مشروع تدريبي باستخدام PHP وMySQL وGitHub</footer>
</body>
</html>
<?php $conn->close(); ?>
