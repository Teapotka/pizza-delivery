<?php
class Order extends Database {
    private $db;

    public function __construct(){
        $this->db = $this->db_connection(); // Establish database connection
    }

    public function selectOrders(){
        try {
            
            // $sql = "SELECT o.id, o.pizza_id, p.pizza_name, p.image_data, o.size, o.pieces, (o.pieces*o.price) as price FROM `order` o JOIN pizza p ON o.pizza_id = p.pizza_id;"; // SQL query to select all pizzas
            $sql = "SELECT o.id, p.pizza_name, p.image_data, s.size, o.pieces, ((s.surcharge + p.price)*o.pieces) as total FROM `order` o JOIN `pizza` p ON p.pizza_id = o.pizza_id JOIN `pizza_sizes` s ON s.id = o.size_id;";
            $stmt = $this->db->query($sql); // Execute the query
            $orders = $stmt->fetchAll(); // Fetch all pizzas as objects
            return $orders; // Return the result
        } catch(PDOException $e) {
            echo "Error: " . $e->getMessage(); // Handle any errors
        }
    }
    public function selectOrderIds(){
        try {
            
            $sql = "SELECT * FROM `order`";
            $stmt = $this->db->query($sql); // Execute the query
            $orders = $stmt->fetchAll(); // Fetch all pizzas as objects
            return $orders; // Return the result
        } catch(PDOException $e) {
            echo "Error: " . $e->getMessage(); // Handle any errors
        }
    }
    public function selectTotal(){
        try {
            
            $sql = "SELECT SUM((s.surcharge + p.price)*o.pieces) as total FROM `order` o JOIN `pizza` p ON p.pizza_id = o.pizza_id JOIN `pizza_sizes` s ON s.id = o.size_id;"; // SQL query to select all pizzas
            $stmt = $this->db->query($sql); // Execute the query
            $total = $stmt->fetchColumn(); // Fetch all pizzas as objects
            return $total; // Return the result
        } catch(PDOException $e) {
            echo "Error: " . $e->getMessage(); // Handle any errors
        }
    }
    public function selectCount(){
        try {
            $sql = "SELECT COUNT( * ) as total FROM `order`;"; // SQL query to select all pizzas
            $stmt = $this->db->query($sql); // Execute the query
            $count = $stmt->fetchColumn(); // Fetch all pizzas as objects
            return $count; // Return the result
        } catch(PDOException $e) {
            echo "Error: " . $e->getMessage(); // Handle any errors
        }
    }

    public function createOrder($pizza_id, $size_id, $pieces){
        try{
            $sql = "INSERT INTO `order` (pizza_id, size_id, pieces) VALUES (:pizza_id, :size_id, :pieces)";
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(':pizza_id', $pizza_id);
            $stmt->bindValue(':size_id', $size_id);
            $stmt->bindValue(':pieces', $pieces);
            $stmt->execute();
        } catch(PDOException $e){
            echo "Error: " . $e->getMessage();
        }
    }
    public function updateOrderPieces($pizza_id, $size_id ,$pieces){
        try{
            $sql = "UPDATE `order` SET `pieces`= :pieces WHERE pizza_id = :pizza_id AND size_id = :size_id";
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(':pizza_id', $pizza_id);
            $stmt->bindValue(':size_id', $size_id);
            $stmt->bindValue(':pieces', $pieces);
            $stmt->execute();
        } catch(PDOException $e){
            echo "Error: " . $e->getMessage();
        }
    }

    public function deleteOrder($order_id,){
        try{
            $sql = "DELETE FROM `order` WHERE id = :order_id";
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(':order_id', $order_id);
            $stmt->execute();
        } catch(PDOException $e){
            echo "Error: " . $e->getMessage();
        }
    }

    public function displayOrders(){
        $orders = $this->selectOrders();
        $output = "";
        foreach ($orders as $order) {
            $output .= '<div class="item bg-white d-flex w-100 rounded align-items-center justify-content-between p-3">';
            $output .= '<div class="d-flex flex-sm-row flex-column align-items-center justify-content-center w-100 gap-4">';
            $output .= '<div class="d-flex align-items-center justify-content-center gap-3">';
            $image_data = $order->image_data;
            $base64_image = base64_encode($image_data);
            $output .= '<img src="data:image/jpeg;base64,' . $base64_image . '" class="rounded-circle" width="50">';
            $output .= '<h4>'.$order->pizza_name.' - '.$order->size.'</h4>';
            $output .= '</div>';
            $output .= '<div class="d-flex align-items-center justify-content-center gap-3">';
            $output .= '<div class="d-flex">';
            $output .= '<button type="button" class="btn d-flex align-items-center justify-content-center"><i class="bi bi-dash-circle d-flex"></i></button>';
            $output .= '<h3>'.$order->pieces.' pc.</h3>';
            $output .= '<button type="button" class="btn d-flex align-items-center justify-content-center"><i class="bi bi-plus-circle d-flex"></i></button>';
            $output .= '</div>';
            $output .= '<h3>'.$order->total.' €</h3>';
            $output .= '</div>';
            $output .= '</div>';
            $output .= '<form action="../_inc/add_to_cart.php" method="POST">';
            $output .= '<input type="hidden" name="_method" value="DELETE">';
            $output .= '<input type="hidden" name="order_id" value="' . $order->id . '">';
            $output .= '<button type="submit" class="btn-close"></button>';
            $output .= '</form>';
            $output .= '</div>';        
        }
        return $output;
    }

    public function displayTotal(){
        $total = $this->selectTotal();
        $output = '<div class="d-flex align-items-center justify-content-center gap-3">';
        $output .= '<h1 class="text-white">'.$total.' €</h1>';
        $output .= '<button class="btn bg-white rounded fw-bold">Order</button>';
        $output .= '</div>';

        return $output;
    }
    

}
?>