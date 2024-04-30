<?php
include_once("partials/header.php");
$feedback_object = new Feedback();
?>

<main class="container-fluid d-flex row justify-content-center align-items-center">
    <div class="d-flex col-6 col-sm-12 card form-item p-2 m-3">
        <h3 class="card-title text-center">Have a question?</h3>
        <form class="d-flex flex-column gap-3">
            <input class="form-control" type="email" placeholder="Your email">
            <textarea class="form-control"></textarea>
            <button type="submit" class="btn btn-outline-secondary">Ask a question</button>
        </form>
    </div>
    <div class="d-flex col-6 col-sm-12 card form-item p-2 m-3">
        <h3 class="card-title text-center">Leave a feedback)</h3>
        <form class="d-flex flex-column gap-3" action="../_inc/feedback.php" method="POST">
            <input class="form-control" type="text" placeholder="Your nickname" name="nickname">
            <textarea class="form-control" name="body"></textarea>
            <button type="submit" class="btn btn-outline-secondary">Send a feedback</button>
        </form>
    </div>
    <h1 class="text-center">Comments</h1>
    <div class="d-flex flex-wrap justify-content-center gap-3">
        <?php
            echo($feedback_object->displayFeedbacks());
        ?>
    </div>
</main>

<?php
include_once("partials/footer.php");
?>