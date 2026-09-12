# نظام إدارة المهام الطلابية

مشروع ويب صغير باستخدام **PHP + MySQL** مناسب لمشروع الحوسبة السحابية والتدريب على Git وGitHub وInfinityFree.

## وظائف الموقع

- عرض المهام من قاعدة البيانات.
- إضافة مهمة.
- تعديل مهمة.
- حذف مهمة.
- تغيير حالة المهمة إلى مكتملة أو قيد التنفيذ.
- واجهة عربية متجاوبة.

## ملفات المشروع

| الملف | الوظيفة |
|---|---|
| `index.php` | عرض جميع المهام |
| `add.php` | إضافة مهمة |
| `edit.php` | تعديل مهمة |
| `delete.php` | حذف مهمة |
| `config.example.php` | نموذج إعداد الاتصال بقاعدة البيانات |
| `database.sql` | إنشاء جدول المهام وإضافة بيانات تجريبية |
| `style.css` | تنسيق الواجهة |

## التشغيل محليًا باستخدام XAMPP

1. انسخ المجلد إلى:

   ```text
   C:\xampp\htdocs\student-task-manager
   ```

2. شغّل Apache وMySQL من XAMPP.
3. افتح phpMyAdmin على:

   ```text
   http://localhost/phpmyadmin
   ```

4. أنشئ قاعدة بيانات باسم:

   ```text
   student_tasks
   ```

5. اختر قاعدة البيانات ثم Import، وارفع الملف `database.sql`.
6. انسخ `config.example.php` وسمّ النسخة الجديدة `config.php`.
7. إذا كنت تستخدم XAMPP الافتراضي اترك بيانات الاتصال كما هي.
8. افتح الموقع:

   ```text
   http://localhost/student-task-manager
   ```

## رفع المشروع إلى GitHub

```bash
git init
git add .
git commit -m "Add student task manager website"
git branch -M main
git remote add origin https://github.com/USERNAME/student-task-manager.git
git push -u origin main
```

استبدل `USERNAME` باسم حساب GitHub الخاص بك.

## رفع المشروع إلى InfinityFree

1. أنشئ حساب استضافة مستقلًا.
2. افتح File Manager ثم مجلد `htdocs`.
3. ارفع ملفات المشروع إلى `htdocs`.
4. من لوحة التحكم أنشئ قاعدة MySQL جديدة.
5. افتح phpMyAdmin الخاص بالاستضافة.
6. اختر قاعدة البيانات ثم Import وارفع `database.sql`.
7. أنشئ ملفًا باسم `config.php` اعتمادًا على `config.example.php` وأدخل بيانات InfinityFree:

```php
$host = 'sqlXXX.infinityfree.com';
$username = 'if0_12345678';
$password = 'كلمة مرور قاعدة البيانات';
$database = 'if0_12345678_tasks';
```

8. افتح رابط الموقع واختبر الإضافة والتعديل والحذف.

## ملاحظة أمنية

لا ترفع `config.php` إلى مستودع GitHub العام؛ لأنه يحتوي على كلمة مرور قاعدة البيانات. الملف موجود في `.gitignore`، بينما يتم رفع `config.example.php` فقط.

## أوامر المزامنة بين الطالبين

```bash
git pull origin main
git add .
git commit -m "Describe your change"
git push origin main
```
