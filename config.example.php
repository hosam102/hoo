<?php
// انسخ هذا الملف باسم config.php ثم أدخل بيانات MySQL الخاصة بك.

$host = 'localhost';
$username = 'root';
$password = '';
$database = 'student_tasks';

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die('فشل الاتصال بقاعدة البيانات. تحقق من بيانات config.php.');
}

$conn->set_charset('utf8mb4');
