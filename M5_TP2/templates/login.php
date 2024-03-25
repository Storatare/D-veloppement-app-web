<!-- login.php -->
<?php 
include_once 'parts/header.php'; ?>
<main>
    <section>
        <div class="acc">
            <h1>Connexion</h1>
        </div>
        <form action="index.php?action=login" method="post">
            <?php if (isset($_SESSION['csrf_token'])) : ?>
            <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
            <?php endif; ?>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Mot de passe:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="form-group">
                <button type="submit">Se connecter</button>
            </div>
        </form>
    </section>
</main>

<?php include_once 'parts/footer.php'; ?>