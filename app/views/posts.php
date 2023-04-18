<?php $this->view("header", $data); ?>
<?php foreach ( $data['posts'] as $post ): ?>
    <div class="post">
        <div class="justify-between">
            <h2 class="post-title"><?= $post->title ?>
                <span>
                       <?= date("d/m/Y h:i", strtotime($post->date)) ?>
                       od <?= $post->username ?>
                </span>
            </h2>
            <?php if(isset($_SESSION['username']) && $post->username == $_SESSION['username'] ): ?>
                <a href="<?= ROOT ?>posts/delete/<?= $post->id ?>" class="post-delete"><span>Vymazat</span></a>
            <?php endif; ?>
        </div>
        <p class="post-description">
            <?= $post->description ?>
        </p>
        <?php if($post->image !== "NULL"): ?>
            <img src="<?= ROOT . $post->image ?>" class="post-image"/>
        <?php endif; ?>
    </div>
<?php endforeach; ?>
<?php $this->view("footer", $data); ?>
