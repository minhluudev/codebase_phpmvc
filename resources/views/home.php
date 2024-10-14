<?php layout('layouts/main'); ?>
<?php section('title', 'Home page'); ?>
<?php sectionStart('content'); ?>
    <h1>Home page</h1>
<?= $title ?? '' ?>
<?php sectionEnd(); ?>

<?php layoutEnd(); ?>