<?php require_once 'header.php'; ?>
<h1><?=$title;?></h1>
<h2><?=$desc;?></h2>
<p class="message"><?=$_SESSION['message'];?></p>
<?php require_once $content; ?>
<?php require_once 'footer.php'; ?>
