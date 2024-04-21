<?php
include('../_inc/functions.php');
$order_object = new Order();
$total = $order_object->selectTotal();
$count = $order_object->selectCount();
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Mermaid's song</title>
    <?php
        add_stylesheets();
    ?>
</head>
<body class="background">
    <div class="container-fluid background p-0">
        <header>
            <nav class="navbar bg-white">
                <div class="container-fluid">
                    <!-- Logo -->
                    <a class="navbar-brand d-flex align-items-center justify-content-center gap-2" href="home.php">
                         <img class="p-2" src="../assets/img/logo.jpg" alt="Mermaid's song logo" width="50">
                         <h3>
                        Mermaid's song
                    </h3>
                    </a>
                    <!-- Nav Links -->
                    
                    <div class="d-none d-sm-flex">
                        
                    <ul class="navbar-nav flex-row gap-3 pe-3">
                    <?php
                     $pages = array('Home'=>'home.php',
                     'Cart'=>'cart.php',
                     'Contact'=>'contact.php',
                    );

                        echo(generate_menu($pages));
                    ?>

                    </ul>
                    <div class="cart d-flex align-items-center justify-content-center px-3 py-1">
                        <div><?php echo($total);?> € | <?php echo($count);?> <i class="bi bi-cart"></i></div>
                    </div>
                </div>
                
                <!-- Toggle button -->
                <button class="navbar-toggler  d-sm-none" type="button" data-bs-toggle="offcanvas"
                    data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <!-- Side Menu -->
                <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar"
                    aria-labelledby="offcanvasNavbarLabel">
                    <div class="offcanvas-header">
                        <div class="cart d-flex align-items-center justify-content-center px-3 py-1">
                        <div><?php echo($total);?> € | <?php echo($count);?> <i class="bi bi-cart"></i></div>
                    </div>
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">
                        <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                            <?php 
                                 $pages = array('Home'=>'home.php',
                                 'Cart'=>'cart.php',
                                 'Contact'=>'contact.php',
                                );

                                echo(generate_menu($pages));
                            ?>
                        </ul>
                    </div>
                </div>
                </div>
            </nav>
        </header>