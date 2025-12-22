<?php
session_start();

// مسح كل بيانات الجلسة
session_unset();
session_destroy();

// إعادة التوجيه إلى صفحة تسجيل الدخول
header("Location: index.php");
exit;
?>
