<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="<?= ASSETS ?>css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title><?= $data['page_title'] . " - " . WEBSITE_NAME ?></title>
</head>
<body>
<script>
    function myFunction() {
        var x = document.getElementById("myTopnav");
        if (x.className === "topnav") {
            x.className += " responsive";
        } else {
            x.className = "topnav";
        }
    }
</script>
    <div class="topnav" id="myTopnav">
        <a href="<?= ROOT ?>index" class="<?php active('index');?> nav-link" >Forum</a>
        <a href="<?= ROOT ?>posts" class="<?php active('posts');?> nav-link">Příspěvky</a>
        <div class="left-nav">
            <?php if(isset($_SESSION['username'])): ?>
                <a href="<?= ROOT ?>posts/profile/<?= $_SESSION['username'] ?>"
                   class="<?php active($_SESSION['username']);?> nav-link" ><?= $_SESSION['username'] ?></a>
                <a href="<?= ROOT ?>posts/create"
                   class="<?php active('create');?> nav-link" >Vytvořit příspěvek</a>
                <a href="<?= ROOT ?>authentication/logout"
                   class="nav-link">Odhlásit se</a>
            <?php else: ?>
                <a href="<?= ROOT ?>authentication/login"
                   class="<?php active('login'); ?> nav-link">Příhlásit se</a>
                <a href="<?= ROOT ?>authentication/register"
                   class="<?php active('register'); ?> nav-link">Registrovat</a>
            <?php endif; ?>
        </div>
        <a href="javascript:void(0);" class="icon" onclick="myFunction()">
            <i class="fa fa-bars"></i>
        </a>
        <?php if(isset($_SESSION['message'])): ?>
            <p class="message"><?php echo $_SESSION['message']; unset( $_SESSION['message'] );?></p>
        <?php endif; ?>
    </div>

    <section class="main smoke">
