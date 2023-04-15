<?php include("header.php"); ?>
<div class="form login">
    <form action="" method="post">
        <h2 class="text-center title-form">Registrace</h2>
        <div class="input-container">
            <label for="name">Jméno:</label>
            <input name="name" class="input" type="text" placeholder="Jméno" required autofocus/>
        </div>
        <div class="input-container">
            <label for="email">Email:</label>
            <input name="email" class="input" type="email" placeholder="Email" required />
        </div>
        <div class="input-container">
            <label for="password">Heslo:</label>
            <input name="password" class="input" type="password" placeholder="Heslo" required />
        </div>
        <button class="submit">~</button>
        <p class="form-message">Už jste registrováni? <a href="<?= ROOT ?>authentication/login">Přihlašte se zde...</a></p>
    </form>
</div>
<?php include("footer.php"); ?>
