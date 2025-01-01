<?php 
// session_start();
// require "../ClientLogic/reservationLogic.php";

// if(isset($_POST['submit'])){
//     $cls = new reservation();
//     $userId = $_SESSION['userId'];
//     $vehiculeId = $_GET['id'];
//     $dd = $_POST['date_debut'];
//     $df = $_POST['date_fin'];
//     $lieu = $_POST['lieuId'];
//     $obj = $cls->insertRservation($userId,$vehiculeId,$dd,$df,$lieu);
//     if($obj){
//         header("Location: ./index.php");
//     }
//     else{
//         echo "errror";
//     }
// }
require "../ClientLogic/Avis.php";
require_once "../../Config.php";
$connection = new connection();
$conn = $connection->conn();
$class = new avis();
$id = $_GET['id'];
$sql = "select * from avis where id = :id";
$stmt = $conn->prepare($sql);
$stmt->bindParam(":id",$id);

if($stmt->execute()){
    $result = $stmt->fetch();
}
else{
    echo "error";
}
if(isset($_POST['submit'])){
    $rate = $_POST['rating'];
    $comment = $_POST['comment'];

    $avisId = $_POST['id'];

    $update = $class->updateReview($avisId,$rate,$comment);

    if($update){
        header("Location: ./index.php");
    }
    else{
        echo "error";
    }

}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vehicle Reservation</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .rating {
	margin-bottom: 20px;
	display: flex;
	flex-direction: row-reverse;
	justify-content: flex-end;
}

.rating input {
	display: none;
}

.rating label {
	font-size: 24px;
	cursor: pointer;
}

.rating label:hover,
.rating label:hover ~ label {
	color: orange;
}

.rating input:checked ~ label {
	color: orange;
}
.comment {
	margin-bottom: 20px;
}

.comment textarea {
	width: 100%;
	height: 60px;
    border: 1px solid black;
	resize: none;
}

.submit-btn {
	background-color: #007bff;
	color: #fff;
	padding: 10px 20px;
	border: none;
	cursor: pointer;
	border-radius: 5px;
}
    </style>
    </head>
<body class="bg-gray-50">
    <div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8 bg-white p-8 rounded-lg shadow-lg">
            <div>
                <h2 class="mt-6 text-center text-3xl font-extrabold text-blue-900">
                    Modifier Review
                </h2>
                <p class="mt-2 text-center text-sm text-gray-600">
                    Please fill in the reservation details
                </p>
            </div>
            <form class="mt-8 space-y-6" action="#" method="POST">
                <input type="hidden" name="id" value="<?php echo $result['id']?>">
            <div class="rating">
                    <!-- Notice that the stars are in reverse order -->
                    <input type="radio" id="star5" name="rating" value="satisfer" <?php echo ($result['avis'] == 'satisfer') ? 'checked' : ''; ?>>
                    <label for="star5">&#9733;</label>
                    <input type="radio" id="star4" name="rating" value="bien"  <?php echo ($result['avis'] == 'bien') ? 'checked' : ''; ?>>
                    <label for="star4">&#9733;</label>
                    <input type="radio" id="star3" name="rating" value="pas mal"  <?php echo ($result['avis'] == 'pas mal') ? 'checked' : ''; ?>>
                    <label for="star3">&#9733;</label>
                    <input type="radio" id="star2" name="rating" value="null"  <?php echo ($result['avis'] == 'null') ? 'checked' : ''; ?>>
                    <label for="star2">&#9733;</label>
                </div>
                <div class="comment">
				<label for="comment">Tell us more:</label><br>
				<textarea id="comment" name="comment"><?php echo $result['comment']?></textarea>
			</div>
                <button name="submit" type="submit" class="submit-btn">Submit</button>            
            </form>
        </div>
    </div>
</body>
</html>