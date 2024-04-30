<?php
include_once("partials/header.php");
$pizza_object = new Pizza();
unset($_SESSION['order']);
if (!isset($_SESSION['logged']) || $_SESSION['logged'] !== true) {
    header('Location: login.php');  // Redirect to login page
    exit;  // Stop further execution of the script
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
<!-- <form action="">
    <div class="d-flex align-items-center justify-items-center gap-3">
    <input value='Margarita' name="pizza_name" class="form-control"/>
    <input value='Vegan' name="type" class="form-control"/>
    <input value='3.9' type="number" name="price" class="form-control"/>
    <input type="file" name="image_data" class="form_control"/>
    <button type="submit" value="UPDATE" name="_method" class="btn btn-primary">update</button>
    <button type="submit" value="DELETE" name="_method" class="btn-close"></button>
    </div>
</form> -->
</main>
<?php
include_once("partials/footer.php");
?>