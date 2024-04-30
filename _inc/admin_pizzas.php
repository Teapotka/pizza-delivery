<?php
include('config.php');
$pizzaObject = new Pizza();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $method = $_POST['_method'];
    $pizzaName = $_POST['pizza_name'];
    $type = $_POST['type'];
    $price = $_POST['price'];
    $pizzaId = $_POST['pizza_id'] ?? null; // This will only be set for UPDATE and DELETE operations
    echo($method);
    echo($pizzaName);
    echo($type);
    echo($price);
    echo($pizzaId);
    // Process image data if a file is uploaded
    if (!empty($_FILES['image_data']['name'])) {
        $imageData = file_get_contents($_FILES['image_data']['tmp_name']);
        $imageData = base64_encode($imageData); // Optionally encode to base64 if storing in this format
    } else {
        $imageData = null;
    }

    switch ($method) {
        case 'CREATE':
            if (!is_null($imageData)) {
                $pizzaObject->createPizza($pizzaName, $type, $price, $imageData);
            }
            break;
        case 'UPDATE':
            if ($pizzaId) {
                $pizzaObject->updatePizza($pizzaId, $pizzaName, $type, $price, $imageData);
            }
            break;
        case 'DELETE':
            if ($pizzaId) {
                $pizzaObject->deletePizza($pizzaId);
            }
            break;
    }

    // Redirect to avoid form resubmission issues
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit;
}
?>

<!-- HTML and form setup should ideally be in a separate view file or integrated within your MVC structure -->
