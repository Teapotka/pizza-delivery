<?php
class Order extends Database {
    private $db;

    public function __construct(){
        $this->db = $this->db_connection(); // Establish database connection
    }

    // Method to map order from session with database
    public function selectOrders(){
        try {
            $session_object = new Session();
            $pizza_ids_array = $session_object->getColumn('order', 'pizza_id', true);
            $size_ids_array = $session_object->getColumn('order', 'size_id', true);
            $pizza_ids = implode(',', $pizza_ids_array);
            $size_ids = implode(',', $size_ids_array);
            if(empty($pizza_ids) || empty($size_ids)){
                return [];
            }
            $sql = "SELECT * FROM pizza WHERE pizza_id IN ($pizza_ids)";
            $stmt = $this->db->query($sql); // Execute the query
            $pizzaResults = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $pizzas = [];
            foreach ($pizzaResults as $pizza) {
                $pizzas[$pizza['pizza_id']] = $pizza;
            }

            $sql = "SELECT * FROM pizza_sizes WHERE id IN ($size_ids)";
            $stmt = $this->db->query($sql);
            $sizeResults = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $sizes = [];
            foreach ($sizeResults as $size) {
                $sizes[$size['id']] = $size;
            }

            $combinedList = [];
            foreach ($session_object->getValue('order') as $sessionOrder) {
                $pizzaId = $sessionOrder['pizza_id'];
                $sizeId = $sessionOrder['size_id'];

                if (isset($pizzas[$pizzaId]) && isset($sizes[$sizeId])) {
                    $pizza = $pizzas[$pizzaId];
                    $size = $sizes[$sizeId];
                    $combinedList[] = [
                        'pizza_name' => $pizza['pizza_name'],
                        'pizza_id' => $pizza['pizza_id'],
                        'price' => $pizza['price'],
                        'image_data' => $pizza['image_data'],
                        'size' => $size['size'],
                        'size_id' => $size['id'],
                        'surcharge' => $size['surcharge'],
                        'pieces' => $sessionOrder['pieces']
                    ];
                }
            }
            return $combinedList; // Return the result
        } catch(PDOException $e) {
            echo "Error: " . $e->getMessage(); // Handle any errors
        }
    }

    // Method to get total amount of order
    public function selectTotal(){
        $orders = $this->selectOrders();
        $total = 0;
        foreach($orders as $order){
            $total += ($order['price'] + $order['surcharge']) * $order['pieces'];
        }
        return $total;
    }

    // Method to get total pieces of order
    public function selectCount(){
        $session_object = new Session();
        if ($session_object->getValue('order') ) {
            return count($_SESSION['order']); // Return the count of items in the session array
        }
        return 0;
    }


    // Method to create order in session
    function createOrder($pizza_id, $size_id, $status) {
        // Start the session if not already started
        if ($status == PHP_SESSION_NONE) {
            echo('restart');
            session_start();
        }
        // Initialize the orders array in the session if not already set
        if (!isset($_SESSION['order'])) {
            $_SESSION['order'] = [];
        }
    
        $found = false;
        
        foreach ($_SESSION['order'] as &$order) {
            if ($order['pizza_id'] == $pizza_id && $order['size_id'] == $size_id) {
                $order['pieces'] += 1;  // Increment pieces by 1;
                $found = true;
                break;
            }
        }
    
        // If not found, append new order to the session array
        if (!$found) {
            $_SESSION['order'][] = [
                'pizza_id' => $pizza_id,
                'size_id' => $size_id,
                'pieces' => 1,  // Start with 1 piece
            ];
        }
    }

    // Method to update order in session
    public function updateOrderPieces($order_id,$delta){
        if (isset($_SESSION['order'][$order_id])) {
            if(($delta == -1) && $_SESSION['order'][$order_id]['pieces'] == 1){
                return;
            }
            $_SESSION['order'][$order_id]['pieces'] += $delta;
        }
    }

    // Method to delete order in session
    public function deleteOrder($index) {
        // Start the session if not already started
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    
        // Remove the order if the index exists
        if (isset($_SESSION['order'][$index])) {
            array_splice($_SESSION['order'], $index, 1);
        }
    }


    // Method to display orders
    public function displayOrders(){
        $orders = $this->selectOrders();
        $output = "";
        $i = 0;
        if(empty($orders)){
            return '<h1 class="text-white">Cart is empty</h1>';
        }
        foreach ($orders as $order) {
            $total = ($order['price'] + $order['surcharge']) * $order['pieces'];
            $output .= '<div class="item bg-white d-flex w-100 rounded align-items-center justify-content-between p-3">';
            $output .= '<div class="d-flex flex-sm-row flex-column align-items-center justify-content-center w-100 gap-4">';
            $output .= '<div class="d-flex align-items-center justify-content-center gap-3">';
            $image_data = $order['image_data'];
            $base64_image = base64_encode($image_data);
            $output .= '<img src="data:image/jpeg;base64,' . $base64_image . '" class="rounded-circle" width="50">';
            $output .= '<h4>'.$order['pizza_name'].' - '.$order['size'].'</h4>';
            $output .= '</div>';
            $output .= '<div class="d-flex align-items-center justify-content-center gap-3">';
            $output .= '<form action="../_inc/order.php" method="POST">';
            $output .= '<div class="d-flex">';
            $output .= '<input type="hidden" name="_method" value="PATCH">';
            $output .= '<input type="hidden" name="order_id" value="'.$i.'">';
            $output .= '<button type="submit" name="delta" value="-1" class="btn d-flex align-items-center justify-content-center"><i class="bi bi-dash-circle d-flex"></i></button>';
            $output .= '<h3>'.$order['pieces'].' pc.</h3>';
            $output .= '<button type="submit" name="delta" value="1" class="btn d-flex align-items-center justify-content-center"><i class="bi bi-plus-circle d-flex"></i></button>';
            $output .= '</div>';
            $output .= '</form>';
            $output .= '<h3>'.$total.' €</h3>';
            $output .= '</div>';
            $output .= '</div>';
            $output .= '<form action="../_inc/order.php" method="POST">';
            $output .= '<input type="hidden" name="_method" value="DELETE">';
            $output .= '<input type="hidden" name="order_id" value="' . $i . '">';
            $output .= '<button type="submit" class="btn-close"></button>';
            $output .= '</form>';
            $output .= '</div>'; 
            $i += 1;       
        }
        return $output; // Returns HTML output
    }

    // Method to display total of order
    public function displayTotal(){
        $total = $this->selectTotal();

        $output = '<div class="d-flex align-items-center justify-content-center gap-3">';
        $output .= '<h1 class="text-white">'.$total.' €</h1>';
        $output .= '<form action="thankyou.php" method="POST">';
        $output .= '<input type="hidden" name="order" value="completed">';
        $output .= '<button type="submit" class="btn bg-white rounded fw-bold">Order</button>';
        $output .= '</input>';
        $output .= '</div>';

        return $output; // Returns HTML output
    }
    

}
?>