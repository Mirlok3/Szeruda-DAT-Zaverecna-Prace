<?php $this->view("header", $data); ?>
<div class="home flex-column">
    <div class="home-title ">
        <h1>Vítejte v mém Fóru!</h1>
        <?php if(isset($_SESSION['username'])): ?>
            <a href="<?= ROOT ?>posts/create" class="home-button">Vytvořte příspěvek</a>
        <?php else: ?>
            <a href="<?= ROOT ?>authentication/login" class="home-button">Přihlašte se</a>
            <a href="<?= ROOT ?>authentication/register" class="home-button">Registrujte se</a>
        <?php endif; ?>
    </div>
    <div class="custom-shape-divider-bottom-1686146486">
        <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
            <path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z" class="shape-fill"></path>
        </svg>
    </div>
    <div class="home-content">
        <h2 class="home-content-title">Nejpopulárnější Příspěvky</h2>
        <div class="home-posts">
            <?php foreach ( $data['posts'] as $post ): ?>
                <div class="post">
                    <div class="justify-start">
                        <div class="flex-column post-vote">
                            <a href="<?= ROOT ?>vote/upVote/<?= $post->id ?>" class="<?php vote_color($post->id, 'blue');?>">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="like">
                                    <path d="M1 8.25a1.25 1.25 0 112.5 0v7.5a1.25 1.25 0 11-2.5 0v-7.5zM11 3V1.7c0-.268.14-.526.395-.607A2 2 0 0114 3c0 .995-.182 1.948-.514 2.826-.204.54.166 1.174.744 1.174h2.52c1.243 0 2.261 1.01 2.146 2.247a23.864 23.864 0 01-1.341 5.974C17.153 16.323 16.072 17 14.9 17h-3.192a3 3 0 01-1.341-.317l-2.734-1.366A3 3 0 006.292 15H5V8h.963c.685 0 1.258-.483 1.612-1.068a4.011 4.011 0 012.166-1.73c.432-.143.853-.386 1.011-.814.16-.432.248-.9.248-1.388z" />
                                </svg>
                            </a>
                            <p class="text-center"><?= $post->votes ?><p>
                            <a href="<?= ROOT ?>vote/downVote/<?= $post->id ?>" class="<?php vote_color($post->id, 'red');?>">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="like">
                                    <path d="M18.905 12.75a1.25 1.25 0 01-2.5 0v-7.5a1.25 1.25 0 112.5 0v7.5zM8.905 17v1.3c0 .268-.14.526-.395.607A2 2 0 015.905 17c0-.995.182-1.948.514-2.826.204-.54-.166-1.174-.744-1.174h-2.52c-1.242 0-2.26-1.01-2.146-2.247.193-2.08.652-4.082 1.341-5.974C2.752 3.678 3.833 3 5.005 3h3.192a3 3 0 011.342.317l2.733 1.366A3 3 0 0013.613 5h1.292v7h-.963c-.684 0-1.258.482-1.612 1.068a4.012 4.012 0 01-2.165 1.73c-.433.143-.854.386-1.012.814-.16.432-.248.9-.248 1.388z" />
                                </svg>
                            </a>
                        </div>
                        <div class="flex-column">
                            <h2 class="post-title">
                        <span>
                           <?= date("d/m/Y h:i", strtotime($post->date)) ?>
                           od <a class="post-link" href="<?= ROOT ?>posts/profile/<?= $post->username ?>"> <?= $post->username ?></a>
                        </span>
                                <a class="post-link" href="<?= ROOT ?>posts/show/<?= $post->id ?>"><?= $post->title ?></a>
                            </h2>
                            <div class="justify-between">
                                <p class="post-description">
                                    <?= $post->description ?>
                                </p>
                            </div>
                        </div>
                        <?php if($post->image !== NULL): ?>
                            <img src="<?= ROOT . $post->image ?>" class="post-image"/>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<?php $this->view("footer", $data); ?>
