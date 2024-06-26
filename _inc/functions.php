<?php
require_once("config.php");

function add_stylesheets(){
    echo '<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">';
    echo '<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">';
    echo '<link rel="stylesheet" href="../assets/css/style.css">';
}

function add_script(){
    echo '<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
    crossorigin="anonymous"></script>';
    echo ' <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
    integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
    crossorigin="anonymous"></script>';
    echo '<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
    integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
    crossorigin="anonymous"></script>';
}

function redirect_homepage(){
    header("Location: templates/home.php");
}

function current_page(){
    $page_name = basename($_SERVER["SCRIPT_NAME"], '.php');
    echo $page_name;
    return $page_name;
}

function generate_menu(array $pages): string{
    $menuItems = '';
    $current_page = strtolower(basename($_SERVER["SCRIPT_NAME"], '.php'));
    foreach($pages as $page_name => $page_url){
        $active_class = (strtolower($page_name) == $current_page) ? ' active' : '';
        $menuItems .= '<li class="nav-item"><a class="nav-link'.$active_class.'" aria-current="page" href="' . $page_url . '">' . $page_name . '</a></li>';
    }
    return $menuItems;
}

?>