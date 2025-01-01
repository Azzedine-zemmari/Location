<?php 
session_start();
require "../ClientLogic/reservationLogic.php";

if(isset($_POST['submit'])){
    $cls = new reservation();
    $userId = $_SESSION['userId'];
    $vehiculeId = $_GET['id'];
    $dd = $_POST['date_debut'];
    $df = $_POST['date_fin'];
    $lieu = $_POST['lieuId'];
    $obj = $cls->insertRservation($userId,$vehiculeId,$dd,$df,$lieu);
    if($obj){
        header("Location: ./index.php");
    }
    else{
        echo "errror";
    }
}

$class = new connection();
$connection = $class->conn();

$sql = "select * from lieu";
$stmt = $connection->prepare($sql);
if($stmt->execute()){
    $lieus = $stmt->fetchAll(PDO::FETCH_ASSOC);
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vehicle Reservation</title>
    <script src="https://cdn.tailwindcss.com"></script>
    </head>
<body class="bg-gray-50">
    <div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8 bg-white p-8 rounded-lg shadow-lg">
            <div>
                <h2 class="mt-6 text-center text-3xl font-extrabold text-blue-900">
                    Vehicle Reservation
                </h2>
                <p class="mt-2 text-center text-sm text-gray-600">
                    Please fill in the reservation details
                </p>
            </div>
            <form class="mt-8 space-y-6" action="#" method="POST">
                <div class="rounded-md shadow-sm space-y-4">
                    <div>
                        <label for="date_debut" class="block text-sm font-medium text-gray-700">
                            Start Date
                        </label>
                        <input id="date_debut" 
                               name="date_debut" 
                               type="date" 
                               required 
                               class="mt-1 appearance-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 focus:z-10 sm:text-sm">
                    </div>
                    
                    <div>
                        <label for="date_fin" class="block text-sm font-medium text-gray-700">
                            End Date
                        </label>
                        <input id="date_fin" 
                               name="date_fin" 
                               type="date" 
                               required 
                               class="mt-1 appearance-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 focus:z-10 sm:text-sm">
                    </div>
                    
                    <div>
                        <label for="lieuId" class="block text-sm font-medium text-gray-700">
                            Location
                        </label>
                        <select id="lieuId" 
                                name="lieuId" 
                                required 
                                class="mt-1 block w-full pl-3 pr-10 py-2 text-base border border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md">
                            <option value="">Select a location</option>
                            <?php foreach($lieus as $lieu): ?>
                            <option value="<?php echo $lieu['id']?>"><?php echo $lieu['lieuName']?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <div>
                    <button type="submit" 
                            name="submit"
                            class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Confirm Reservation
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>