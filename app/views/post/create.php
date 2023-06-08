<?php $this->view("header", $data); ?>
<div class="form post-form">
    <form method="post" enctype="multipart/form-data">
        <h2 class="text-center title-form">Vytvořte příspěvek</h2>
        <div class="justify-between">
            <div class="input-container">
                <label for="title">Titulek:</label>
                <input name="title" class="row-input-lg input" type="text" placeholder="Titulek" autofocus required/>
            </div>
            <div class="input-container">
                <label for="image">Vložte Obraz:</label>
                <input name="image" class="row-input-lg input file-input" type="file" placeholder="Titulek" accept="image/*"/>
            </div>
        </div>
        <div class="input-container">
            <label for="description">Obsah:</label>
            <textarea name="description" rows="10" class="input textarea" required></textarea>
        </div>
        <p class="form-message-error"><?php check_message() ?></p>
        <button class="submit" type="submit">Vytvořit</button>
    </form>
</div>
<?php $this->view("footer", $data); ?>
