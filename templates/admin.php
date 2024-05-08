<?php
include_once("partials/header.php");
$pizza_object = new Pizza();
unset($_SESSION['order']);
if (!isset($_SESSION['logged']) || $_SESSION['logged'] !== true) {
    header('Location: login.php');
    exit;
}
?>
<main class="container-fluid d-flex flex-column background justify-content-center align-items-center mt-3 gap-4">
<h1 class='text-white'>Admin panel</h1>
<h3 class='text-white'>Pizza sizes</h3>

<?php
echo($pizza_object->displayAdminSizes());
?>
<h3 class='text-white'>Pizza items</h3>
<?php
echo($pizza_object->displayAdminPizzas());
?>
</main>
<?php
include_once("partials/footer.php");
?>