<?php
class Pizza extends Database {
    
    private $db;

    public function __construct(){
        $this->db = $this->db_connection(); // Establish database connection
    }

    public function displayTypeTags(){
        $results = $this->selectAllTags();
        $types = [];
        foreach ($results as $row) {
            $types[] = $row->type; // Extracting type from each object
        }
        array_unshift($types, 'All');
        $current_type = isset($_GET['type']) ? $_GET['type'] : null;
        $output = '';
        foreach($types as $type){
            $class = ($type == $current_type || ($type == 'All' && $current_type === null)) ? 'is-chosen' : '';
            $output .= '<a href="?type='. $type. '" class="tag ' . $class . ' px-3 py-1">' . $type . '</a>';
        }
        return $output; // Return the HTML output
    }

    // Method to select tags data from the database
    public function selectAllTags() {
        try {
            $sql = "SELECT DISTINCT type FROM pizza"; // SQL query to select all pizzas
            $stmt = $this->db->query($sql); // Execute the query
            $sizes = $stmt->fetchAll(); // Fetch all pizzas as objects
            return $sizes; 
        } catch(PDOException $e) {
            echo "Error: " . $e->getMessage(); // Handle any errors
        }
        
    }

    // Method to select pizza data from the database
    public function selectPizzas(){
        try {
            $selected_type = isset($_GET['type']) ? $_GET['type'] : null;
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

    //Create request to sizes table
    public function createSize($size, $surcharge){
        $sql = "INSERT INTO pizza_sizes (size, surcharge) VALUES (?, ?)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$size, $surcharge]);
    }
    
    //Update request to sizes table
    public function updateSize($sizeId, $size, $surcharge){
        $sql = "UPDATE pizza_sizes SET size = ?, surcharge = ? WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$size, $surcharge, $sizeId]);
    }

    //Delete request to sizes table
    public function deleteSize($sizeId){
        $sql = "DELETE FROM pizza_sizes WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$sizeId]);
    }

    //Create request to pizza table
    public function createPizza($pizzaName, $type, $price, $imageData) {
        $sql = "INSERT INTO pizza (pizza_name, type, price, image_data) VALUES (?, ?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$pizzaName, $type, $price, base64_decode($imageData)]);
    }
    
    //Update request to pizza table
    public function updatePizza($pizzaId, $pizzaName, $type, $price, $imageData) {
        if (is_null($imageData)) {
            $sql = "UPDATE pizza SET pizza_name = ?, type = ?, price = ? WHERE pizza_id = ?";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([$pizzaName, $type, $price, $pizzaId]);
        } else {
            $sql = "UPDATE pizza SET pizza_name = ?, type = ?, price = ?, image_data = ? WHERE pizza_id = ?";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([$pizzaName, $type, $price, base64_decode($imageData), $pizzaId]);
        }
    }
    
    //Delete request to pizza table
    public function deletePizza($pizzaId) {
        $sql = "DELETE FROM pizza WHERE pizza_id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$pizzaId]);
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
            $output .= '<form action="../_inc/order.php" method="POST">';
            $output .= '<input type="hidden" name="size_id" value="' . (($current_pizza_id == $pizza->pizza_id) ? $current_size_id : 1) . '">';
            $output .= '<input type="hidden" name="pizza_id" value="' . $pizza->pizza_id . '">';
            $output .= '<input type="hidden" name="_method" value="CREATE">';
            $output .= '<button type="submit" class="tag size-tag is-chosen px-3 py-1">+ Add</button>';
            $output .= '</form>';
            $output .= '</div>';
            $output .= '</div>';
        }
        return $output; // Return the HTML output
    }

    public function displayAdminSizes(){
        $sizes = $this->selectSizes();
        $output = '';
        $output .= '<form action="../_inc/admin_sizes.php" method="POST" class="d-flex align-items-center justify-content-center gap-3">';
        $output .= '<input type="text" name="size" placeholder="Size" class="form-control" required>';
        $output .= '<input type="number" name="surcharge" placeholder="Surcharge" class="form-control" required>';
        $output .= '<button type="submit" name="_method" value="CREATE" class="btn btn-success">Add</button>';
        $output .= '</form>';
        foreach ($sizes as $size) {
            $output .= '<form action="../_inc/admin_sizes.php" method="POST" class="d-flex align-items-center justify-content-center gap-3">';
            $output .= '<input type="hidden" name="size_id" value="' . $size->id . '" />';
            $output .= '<input type="text" name="size" value="' . $size->size . '" class="form-control" />';
            $output .= '<input type="text" name="surcharge" value="' . $size->surcharge . '" class="form-control" />';
            $output .= '<button type="submit" name="_method" value="UPDATE" class="btn btn-primary">Update</button>';
            $output .= '<button type="submit" name="_method" value="DELETE" class="btn btn-danger" aria-label="Delete size">Delete</button>';
            $output .= '</form>';
        }

        return $output;
    }

    public function displayAdminPizzas(){
        $pizzas = $this->selectPizzas();
        $output = '';
        $output .= '<form action="../_inc/admin_pizzas.php" method="POST" enctype="multipart/form-data" class="mb-3">';
        $output .= '<div class="d-flex align-items-center justify-content-between bg-white p-3 rounded">';
        $output .= '<input placeholder="Name" name="pizza_name" class="form-control me-2" required>';
        $output .= '<input placeholder="Type" name="type" class="form-control me-2" required>';
        $output .= '<input placeholder="Price" type="number" step="0.01" name="price" class="form-control me-2" required>';
        $output .= '<input type="file" name="image_data" class="form-control-file me-2">';
        $output .= '<button type="submit" name="_method" value="CREATE" class="btn btn-success">Add</button>';
        $output .= '</div>';
        $output .= '</form>';
        foreach ($pizzas as $pizza) {
            $base64Image = base64_encode($pizza->image_data);
            $output .= '<form action="../_inc/admin_pizzas.php" method="POST" enctype="multipart/form-data" class="mb-3">';
            $output .= '<div class="d-flex align-items-center justify-content-between bg-white p-3 rounded">';
    
            $output .= '<input type="hidden" name="pizza_id" value="' . $pizza->pizza_id . '">';
    
            $output .= '<input value="' . $pizza->pizza_name . '" name="pizza_name" class="form-control me-2" required>';
            $output .= '<input value="' . $pizza->type . '" name="type" class="form-control me-2" required>';
            $output .= '<input value="' . $pizza->price . '" type="number" step="0.01" name="price" class="form-control me-2" required>';
            $output .= '<div><img src="data:image/jpeg;base64,' . $base64Image . '" style="width: 100px; height: auto;" class="me-2"></div>';
            $output .= '<div class="d-flex align-items-center">';
            
            $output .= '<input type="file" name="image_data" class="form-control-file me-2">';
            $output .= '<button type="submit" name="_method" value="UPDATE" class="btn btn-primary me-2">Update</button>';
            $output .= '<button type="submit" name="_method" value="DELETE" class="btn btn-danger">Delete</button>';
            $output .= '</div>';
    
            $output .= '</div>';
            $output .= '</form>';
        }
        return $output; // Return the HTML output
    }
}

?>