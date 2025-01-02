<?php
session_start();
require "../../admin/adminLogic/Vehicule.php";
require "../ClientLogic/reservationLogic.php";
require "../ClientLogic/Avis.php";
$cls = new Vehicule();
$id = isset($_GET['id']) ? $_GET['id'] : null; 
$obj2 = $cls->detail($id);

$cls2 = new reservation();
$userId = $_SESSION['userId'];
$hasReserv = $cls2->hasReservation($userId);
$cls3 = new avis();
if($hasReserv){
if(isset($_POST['submit'])){
    $rating = $_POST['rating'];
    $comment = $_POST['comment'];
    $review = $cls3->ajouterAvis($userId,$id,$rating,$comment);
    if($review){
        $_SESSION['message'] = "avis ajouter avec success";
    }
}
}
$allReviews = $cls3->showAll($id);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails du Véhicule</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>
    <style>.rating {
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
<body class="bg-gray-100">
        <!-- Session Message Modal -->
        <?php if(isset($_SESSION['message'])): ?>
    <div id="message-modal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full flex items-center justify-center z-50">
        <div class="relative p-5 bg-white w-96 max-w-md mx-auto rounded-lg shadow-lg">
            <div class="mt-3 text-center">
                <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-green-100">
                    <svg class="h-6 w-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>
                <h3 class="text-lg leading-6 font-medium text-gray-900 mt-4">Succès!</h3>
                <div class="mt-2 px-7 py-3">
                    <p class="text-sm text-gray-500">
                        <?php echo $_SESSION['message']; ?>
                    </p>
                </div>
                <div class="items-center px-4 py-3">
                    <button id="close-modal" class="px-4 py-2 bg-blue-600 text-white text-base font-medium rounded-lg w-full shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        OK
                    </button>
                </div>
            </div>
        </div>
    </div>
    <?php 
    // Clear the message after displaying
    unset($_SESSION['message']);
    endif; 
    ?>
    <div class="container mx-auto px-4 py-8">
        <?php if ($obj2): ?>
            <div class="bg-white rounded-lg shadow-md p-6">
                <!-- Vehicle Header -->
                <div class="mb-6">
                    <h1 class="text-2xl font-bold text-gray-800"><?php echo $obj2['mark'] . " " . $obj2['model']; ?></h1>
                </div>
                <!-- Vehicle Image -->
                <div class="mb-6">
                    <img src="../../folder/<?php echo $obj2['image']; ?>" alt="Voiture" class="w-full h-80 object-cover rounded-lg">
                </div>
                <!-- Vehicle Details -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Characteristics -->
                    <div>
                        <h2 class="text-xl font-semibold text-gray-700 mb-4">Caractéristiques</h2>
                        <ul class="space-y-2 text-gray-600">
                            <li><strong>Catégorie:</strong> <?php echo $obj2['category_name']; ?></li>
                            <li><strong>Prix:</strong> <?php echo $obj2['prix']; ?> /jour</li>
                            <li><strong>Transmission:</strong> <?php echo $obj2['transmition']; ?></li>
                            <li><strong>Nombre de portes:</strong> <?php echo $obj2['porte']; ?></li>
                            <li><strong>Disponibilité:</strong> <?php echo $obj2['disponibilite']; ?></li>
                        </ul>
                    </div>
                     <!-- form avis -->
        <?php if($hasReserv):?>
        <form method="POST" id="feedbackForm">
                <div class="rating">
                    <!-- Notice that the stars are in reverse order -->
                    <input type="radio" id="star5" name="rating" value="satisfer">
                    <label for="star5">&#9733;</label>
                    <input type="radio" id="star4" name="rating" value="bien">
                    <label for="star4">&#9733;</label>
                    <input type="radio" id="star3" name="rating" value="pas mal">
                    <label for="star3">&#9733;</label>
                    <input type="radio" id="star2" name="rating" value="null">
                    <label for="star2">&#9733;</label>
                </div>
                <div class="comment">
				<label for="comment">Tell us more:</label><br>
				<textarea id="comment" name="comment"></textarea>
			</div>
                <button name="submit" type="submit" class="submit-btn">Submit</button>
            </form>
            <?php endif;?>
                </div>
                <!-- Action Button -->
                <div class="mt-6">
                    <a href="reservation.php?id=<?php echo $obj2['id']; ?>" 
                       class="inline-block w-full md:w-auto text-center bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700">
                        Réserver maintenant
                    </a>
                </div>
            </div>
        <?php else: ?>
            <div class="text-center">
                <h2 class="text-xl font-semibold text-red-500">Aucune information disponible pour ce véhicule.</h2>
            </div>
        <?php endif; ?>
          <!-- Reviews Section -->
    <div class="container mx-auto px-4 py-8">
        <div class="bg-white rounded-lg shadow-md p-6">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">Avis des clients</h2>
            
            <?php if (!empty($allReviews)): ?>
                <div class="grid gap-6">
                    <?php foreach ($allReviews as $review): ?>
                        <?php if($review['deleted_at'] == null):?>
                        <div class="border-b border-gray-200 pb-6 last:border-b-0">
                            <div class="flex items-center justify-between mb-4">
                                <div class="flex items-center">
                                    <!-- User Avatar -->
                                    <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center">
                                        <span class="text-blue-600 font-semibold">
                                            <?php echo substr($review['nom'], 0, 1); ?>
                                        </span>
                                    </div>
                                    <!-- User Name and Date -->
                                    <div class="ml-4">
                                        <h4 class="font-semibold text-gray-800"><?php echo $review['nom']; ?></h4>
                                    </div>
                                </div>
                                <!-- Rating -->
                                <div class="flex items-center">
                                    <div class="flex items-center text-yellow-400">
                                        <?php
                                        $rating = $review['avis'];
                                        $ratingText = '';
                                        switch($rating) {
                                            case 'satisfer':
                                                $ratingText = '★★★★★';
                                                break;
                                            case 'bien':
                                                $ratingText = '★★★★☆';
                                                break;
                                            case 'pas mal':
                                                $ratingText = '★★★☆☆';
                                                break;
                                            case 'null':
                                                $ratingText = '★★☆☆☆';
                                                break;
                                            default:
                                                $ratingText = '☆☆☆☆☆';
                                        }
                                        echo $ratingText;
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <!-- Review Comment -->
                            <div class="prose prose-sm text-gray-600">
                                <p><?php echo $review['comment']; ?></p>
                                <div class="flex justify-end gap-3">
                                    <?php if($review['userId'] == $userId):?>
                                        <a href="../ClientLogic/deleteAvis.php?id=<?php echo $review['id'] ?>"><img src="./image/delete.svg" class="w-4 h-4" alt=""></a>
                                        <a href="./updateAvis.php?id=<?php echo $review['id'] ?>"><img src="./image/update.svg" class="w-4 h-4" alt=""></a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <div class="text-center py-8">
                    <div class="text-gray-400 mb-4">
                        <svg class="w-16 h-16 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                  d="M8 12h.01M12 12h.01M16 12h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                            </path>
                        </svg>
                    </div>
            <?php endif; ?>
    </div>
        <!-- Modal Control Script -->
        <script>
    document.addEventListener('DOMContentLoaded', function() {
        const modal = document.getElementById('message-modal');
        const closeButton = document.getElementById('close-modal');

        if (closeButton) {
            closeButton.addEventListener('click', function() {
                modal.classList.add('hidden');
            });
        }

        // Close modal when clicking outside
        if (modal) {
            modal.addEventListener('click', function(e) {
                if (e.target === modal) {
                    modal.classList.add('hidden');
                }
            });
        }

        // Auto-hide modal after 3 seconds
        if (modal) {
            setTimeout(function() {
                modal.classList.add('hidden');
            }, 3000);
        }
    });
    </script>
</body>
</html>
