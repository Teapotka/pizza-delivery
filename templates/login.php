<?php
include_once("partials/header.php");
unset($_SESSION['order']);
?>
<main class="container mt-4">
    <h2>Login</h2>
    <form action="../_inc/login.php" method="POST">
        <div class="mb-3">
            <label for="login" class="form-label">Username:</label>
            <input type="text" name="login" id="login" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password:</label>
            <input type="password" name="password" id="password" class="form-control" required>
        </div>
        <button type="submit" name="REGISTER" class="btn btn-primary">Register</button>
        <button type="submit" name="LOGIN" class="btn btn-primary">Login</button>
    </form>
</main>
<?php
include_once("partials/footer.php");
?>