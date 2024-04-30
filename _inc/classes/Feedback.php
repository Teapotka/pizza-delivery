<?php
class Feedback extends Database {
    private $db;

    public function __construct(){
        $this->db = $this->db_connection(); // Establish database connection
    }

    public function selectFeedbacks(){
        $sql = "SELECT nickname, body, DATE_FORMAT(created_at, '%d.%m.%Y') as created_at FROM feedbacks";
        $stmt = $this->db->query($sql); // Execute the query
        $feedbacks = $stmt->fetchAll(); // Fetch all pizzas as objects
        return $feedbacks; // Return
    }

    public function createFeedback($nickname, $body){
        $sql = "INSERT INTO feedbacks (nickname, body) VALUES (:nickname, :body)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':nickname', $nickname);
        $stmt->bindValue(':body', $body);
        $stmt->execute();
    }

    public function displayFeedbacks(){
        $feedbacks = $this->selectFeedbacks();
        $output = '';
        if(empty($feedbacks)){
            return '<h1 class="text-white">No feedbacks yet</h1>';
        }
        foreach($feedbacks as $feedback){
            $output .= '<div class="card p-3 d-flex flex-row gap-2">@'. $feedback->nickname .': '.$feedback->body.' <i class="text-tag">'.$feedback->created_at .'</i></div>';
        }
        return $output;
    }
}
?>