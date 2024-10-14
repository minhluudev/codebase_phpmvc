<?php

use Framework\View;

View::layout('layouts/main');
View::section('title', 'Home page');
?>

<?php View::sectionStart('content'); ?>
    <h1>Home page</h1>
<?= $title ?? '' ?>
<?php View::sectionEnd(); ?>

<?php View::layoutEnd(); ?>