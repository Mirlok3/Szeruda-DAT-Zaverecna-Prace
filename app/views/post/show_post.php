<?php $this->view("header", $data); $post = $data['posts'][0]; ?>
    <div class="post-show">
        <div class="justify-between">
            <h2 class="post-title"><a class="post-link" href="<?= ROOT ?>posts/show/<?= $post->id ?>"> <?= $post->title ?></a>
                <span>
                   <?= date("d/m/Y h:i", strtotime($post->date)) ?>
                   od <a class="post-link" href="<?= ROOT ?>posts/profile/<?= $post->username ?>"> <?= $post->username ?></a>
                </span>
            </h2>
            <?php if(isset($_SESSION['username']) && $post->username == $_SESSION['username'] ): ?>
                <div class="flex-column text-center">
                    <a href="<?= ROOT ?>posts/delete/<?= $post->id ?>"
                       class="post-button red"><span>Vymazat</span></a>
                    <a href="<?= ROOT ?>posts/edit/<?= $post->id ?>" class="post-button blue"><span>Změnit</span></a>
                </div>
            <?php endif; ?>
        </div>
        <p class="post-show-description">
            <?= $post->description ?>
        </p>
        <?php if($post->image !== NULL): ?>
            <img src="<?= ROOT . $post->image ?>" class="post-show-image"/>
        <?php endif; ?>
        <div class="justify-start ">
            <a href="<?= ROOT ?>vote/upVote/<?= $post->id ?>/show" class="<?php vote_color($post->id, 'blue');?>">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="show-like">
                    <path d="M1 8.25a1.25 1.25 0 112.5 0v7.5a1.25 1.25 0 11-2.5 0v-7.5zM11 3V1.7c0-.268.14-.526.395-.607A2 2 0 0114 3c0 .995-.182 1.948-.514 2.826-.204.54.166 1.174.744 1.174h2.52c1.243 0 2.261 1.01 2.146 2.247a23.864 23.864 0 01-1.341 5.974C17.153 16.323 16.072 17 14.9 17h-3.192a3 3 0 01-1.341-.317l-2.734-1.366A3 3 0 006.292 15H5V8h.963c.685 0 1.258-.483 1.612-1.068a4.011 4.011 0 012.166-1.73c.432-.143.853-.386 1.011-.814.16-.432.248-.9.248-1.388z" />
                </svg>
            </a>
            <a href="<?= ROOT ?>vote/downVote/<?= $post->id ?>/show" class="<?php vote_color($post->id, 'red');?>">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="show-like">
                    <path d="M18.905 12.75a1.25 1.25 0 01-2.5 0v-7.5a1.25 1.25 0 112.5 0v7.5zM8.905 17v1.3c0 .268-.14.526-.395.607A2 2 0 015.905 17c0-.995.182-1.948.514-2.826.204-.54-.166-1.174-.744-1.174h-2.52c-1.242 0-2.26-1.01-2.146-2.247.193-2.08.652-4.082 1.341-5.974C2.752 3.678 3.833 3 5.005 3h3.192a3 3 0 011.342.317l2.733 1.366A3 3 0 0013.613 5h1.292v7h-.963c-.684 0-1.258.482-1.612 1.068a4.012 4.012 0 01-2.165 1.73c-.433.143-.854.386-1.012.814-.16.432-.248.9-.248 1.388z" />
                </svg>
            </a>
            <p class="text-center"><?= $post->votes ?> Hlasů<p>
        </div>
    </div>
    <div class="post-comment">
        <h2>Komentáře</h2> 
        <form method="post">
            <div class="input-container">
                <label for="content">Vytvořte komentář:</label>
                <textarea name="content" rows="2" class="input textarea" required></textarea>
                <input name="post_id" value="<?= $data['posts'][0]->id ?>" type="hidden">
                <p class="form-message-error"><?php check_message() ?></p>
                <button class="submit" type="submit">Vytvořit</button>
            </div>
        </form>
        <?php foreach ($data['comments'] as $comment): ?>
            <div class="post-comments">
                <h2 class="post-title">
                    <span>
                        <a class="post-link" href="<?= ROOT ?>posts/profile/<?= $comment->username ?>"> <?= $comment->username ?></a>
                        <?= date("d/m/Y h:i", strtotime($comment->date)) ?>
                    </span>
                </h2>
                <p><?= $comment->content ?></p>
            </div>
        <?php endforeach; ?>
    </div>
<?php $this->view("footer", $data); ?>
