<?php
require "../../Class/tagClass.php";
$message = "";
if (isset($_POST['submit'])) {

    $tagsInput = $_POST['tags'];  

    // Split the input string by commas
    $tagsArray = explode(',', $tagsInput);

    $tagClass = new tags();
    $tagClass->insertTags($tagsArray); 

}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet">
    <script>
        function hideMessage() {
            setTimeout(function() {
                var messageElement = document.getElementById("message");
                if (messageElement) {
                    messageElement.style.display = 'none';
                }
            }, 2000); 
        }
    </script>
</head>

<body>
    <?php if ($message): ?>
                <div id="message" class="alert alert-<?php echo ($message == 'Theme added successfully!') ? 'success' : 'danger'; ?>" role="alert">
                    <?php echo $message; ?>
                </div>
                <script>hideMessage();</script>
            <?php endif; ?>
    <div class="container mt-5">
        <h2 class="mb-4">Add New tags</h2>
        <form method="post" action="">
            <div class="mb-3">
                <label for="theme" class="form-label">tags</label>
                <input type="text" class="form-control" name="tags" id="tags" placeholder="Enter theme name" required>
            </div>
            <div class="mb-3 text-end">
                <button type="submit" name="submit" class="btn btn-primary">Add Theme</button>
                <button type="reset" class="btn btn-secondary">Clear</button>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>