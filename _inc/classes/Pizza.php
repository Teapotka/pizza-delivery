<?php
class Pizza extends Database {
    
    private $db;

    public function __construct(){
        $this->db = $this->db_connection(); // Establish database connection
    }

    public function displayTypeTags(){
        $types = ['All', 'Vegan', 'Vegetarian', 'Pork', 'Chicken', 'Spicy'];
        $current_type = isset($_GET['type']) ? $_GET['type'] : null;
        $output = '';
        foreach($types as $type){
            $class = ($type == $current_type || ($type == 'All' && $current_type === null)) ? 'is-chosen' : '';
            $output .= '<a href="?type='. $type. '" class="tag ' . $class . ' px-3 py-1">' . $type . '</a>';
        }
        return $output;
    }

    // Method to select pizza data from the database
    public function selectPizzas(){
        try {
            $selected_type = isset($_GET['type']) ? $_GET['type'] : null;
            // $sql = "SELECT * FROM pizza"; // SQL query to select all pizzas
            $sql = ($selected_type !== null) ? "SELECT * FROM pizza WHERE type = \"". $selected_type ."\";" : "SELECT * FROM pizza";
            if ($selected_type == "All"){
                $sql = "SELECT * FROM pizza";
            }
            $stmt = $this->db->query($sql); // Execute the query
            $pizzas = $stmt->fetchAll(); // Fetch all pizzas as objects
            return $pizzas; // Return the result
        } catch(PDOException $e) {
            echo "Error: " . $e->getMessage(); // Handle any errors
        }
    }
    // Method to select sizes data from the database
    public function selectSizes(){
        try {
            $sql = "SELECT * FROM pizza_sizes"; // SQL query to select all pizzas
            $stmt = $this->db->query($sql); // Execute the query
            $sizes = $stmt->fetchAll(); // Fetch all pizzas as objects
            return $sizes; // Return the result
        } catch(PDOException $e) {
            echo "Error: " . $e->getMessage(); // Handle any errors
        }
    }

    // Method to display pizzas
    public function displayPizzas(){
        $pizzas = $this->selectPizzas(); // Get pizzas from the database
        $sizes = $this->selectSizes(); // Get sizes from the database
        $current_size_id = isset($_GET['size_id']) ? $_GET['size_id'] : null;
        $current_pizza_id = isset($_GET['pizza_id']) ? $_GET['pizza_id'] : null;
        $current_type = isset($_GET['type']) ? $_GET['type'] : null;
        $output = ''; // Initialize output variable
        foreach ($pizzas as $pizza) {
            // Build HTML output for each pizza
            $output .= '<div class="card h-100 pizza-card rounded">';
            $output .= '<div class="d-flex justify-content-end align-items-center">';
            $output .= '<div class="text-tag fw-bold py-1">' . $pizza->type . '</div>';
            $output .= '</div>';
            // $output .= '<img src="../assets/img/' . $pizza->image_name . '" alt="" class="card-img-top">';
            $image_data = $pizza->image_data;
            $base64_image = base64_encode($image_data);
            $output .= '<img src="data:image/jpeg;base64,' . $base64_image . '" alt="" class="card-img-top">';
            $output .= '<div class="card-body">';
            $output .= '<h5 class="card-title">' . $pizza->pizza_name . '</h5>';
            $output .= '</div>';
            $output .= '<div class="d-flex gap-2">';
            foreach ($sizes as $size){
                $class = '';
                if(($current_pizza_id != $pizza->pizza_id) && ($size->size == "26cm")){
                    $class = 'is-chosen';
                }
                if(($current_pizza_id == $pizza->pizza_id) && ($size->id == $current_size_id)){
                    $class = 'is-chosen';
                }
                $output .= '<a href="?type='. (($current_type == null) ? 'All' : $current_type) . '&size_id='.$size->id.'&pizza_id='.$pizza->pizza_id.'" class="tag '.$class.' size-tag px-1 py-1">'.$size->size.'</a>';
            }
            
            $output .= '</div>';
            $output .= '<div class="d-flex py-4 justify-content-between align-items-center">';
            $surcharge = 0;
            if(($current_pizza_id == $pizza->pizza_id)){
                foreach($sizes as $size){
                    if($size->id == $current_size_id){
                        $surcharge = $size->surcharge;
                    }
                }
            }
            $output .= '<h4>' . $pizza->price + $surcharge . ' €</h4>';
            $output .= '<form action="../_inc/add_to_cart.php" method="POST">';
            $output .= '<input type="hidden" name="size_id" value="' . (($current_pizza_id == $pizza->pizza_id) ? $current_size_id : 1) . '">';
            $output .= '<input type="hidden" name="pizza_id" value="' . $pizza->pizza_id . '">';
            $output .= '<button type="submit" class="tag size-tag is-chosen px-3 py-1">+ Add</button>';
            $output .= '</form>';
            $output .= '</div>';
            $output .= '</div>';
        }
        return $output; // Return the HTML output
    }
}

?>