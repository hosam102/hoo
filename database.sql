-- قاعدة بيانات مشروع نظام إدارة المهام الطلابية
-- أنشئ قاعدة بيانات باسم student_tasks ثم استورد هذا الملف داخلها.

CREATE TABLE IF NOT EXISTS tasks (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(150) NOT NULL,
    description TEXT NULL,
    status ENUM('pending', 'completed') NOT NULL DEFAULT 'pending',
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO tasks (title, description, status) VALUES
('إنشاء مستودع GitHub', 'إنشاء مستودع مشترك وإضافة عضو الفريق كمتعاون.', 'completed'),
('رفع ملفات الموقع', 'رفع ملفات PHP النهائية إلى مستودع GitHub.', 'pending'),
('ربط قاعدة البيانات', 'استيراد database.sql وربط الموقع بقاعدة MySQL.', 'pending');
