<?php

use Framework\View;

View::layout('layouts/main');
View::section('title', 'About page');
?>

<?php View::sectionStart('content'); ?>
    <h1>About page</h1>
<?= $title ?? '' ?>
<?php View::sectionEnd(); ?>

<?php View::layoutEnd(); ?>