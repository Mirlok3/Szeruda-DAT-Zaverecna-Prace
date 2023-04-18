<?php $this->view("header", $data); ?>
<div class="form login">
    <form method="post">
        <h2 class="text-center title-form">Příhlásit se</h2>
        <div class="input-container">
            <label for="username">Jméno:</label>
            <input name="username" class="input" type="text" placeholder="Jméno" required autofocus/>
        </div>
        <div class="input-container">
            <label for="password">Heslo:</label>
            <input name="password" class="input" type="password" placeholder="Heslo" required />
        </div>
        <button class="submit">Příhlásit se</button>
        <p class="form-message">Nejste registrováni? <a href="<?= ROOT ?>authentication/register">Zaregistrujte se zde...</a></p>
        <p class="form-message-error"><?php check_message(); ?></p>
    </form>
</div>
<?php $this->view("footer", $data); ?>
