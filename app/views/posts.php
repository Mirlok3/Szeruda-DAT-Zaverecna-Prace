<?php $this->view("header", $data); ?>
    <h2><?= $data['page_title'] ?></h2>
    <?php foreach ( $data['posts'] as $post ): ?>
        <div class="post">
            <div class="justify-between">
                <h2 class="post-title"><a class="post-link" href="<?= ROOT ?>posts/show/<?= $post->id ?>"> <?= $post->title ?></a>
                    <span>
                           <?= date("d/m/Y h:i", strtotime($post->date)) ?>
                           od <a class="post-link" href="<?= ROOT ?>posts/profile/<?= $post->username ?>"> <?= $post->username ?></a>
                    </span>
                </h2>
                <?php if(isset($_SESSION['username']) && $post->username == $_SESSION['username'] ): ?>
                    <div>
                        <a href="<?= ROOT ?>posts/delete/<?= $post->id ?>"
                              class="post-button red"><span>Vymazat</span></a>
                        <a href="<?= ROOT ?>posts/edit/<?= $post->id ?>" class="post-button blue"><span>Změnit</span></a>
                    </div>
                <?php endif; ?>
            </div>
            <p class="post-description">
                <?= $post->description ?>
            </p>
            <?php if($post->image !== NULL): ?>
                <img src="<?= ROOT . $post->image ?>" class="post-image"/>
            <?php endif; ?>
        </div>
    <?php endforeach; ?>
<?php $this->view("footer", $data); ?>
