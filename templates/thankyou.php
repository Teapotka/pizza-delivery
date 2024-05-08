<?php
include_once("partials/header.php");
$title = 'question';
if(isset($_POST["order"]) && $_POST["order"] == "completed"){
    unset($_SESSION['order']);
    $title = 'order';
}
?>
<main class="container-fluid d-flex justify-content-center align-items-center">
    <h1 class='text-white my-5'>Thank you for Your <?php echo($title); ?>!</h1>
</main>
<?php
include_once("partials/footer.php");
?>