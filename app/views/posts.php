<?php include("header.php"); ?>
<?php foreach ( $data['posts'] as $post ): ?>
    <div class="post">
        <h2 class="post-title"><?= $post['title'] ?></h2>
        <p class="post-description">
            <?= $post['description'] ?>
        </p>
    </div>
<?php endforeach; ?>
<?php include("footer.php"); ?>
