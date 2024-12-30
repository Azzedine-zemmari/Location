<?php
require "../../admin/adminLogic/Vehicule.php";

$cls = new Vehicule();
$id = isset($_GET['id']) ? $_GET['id'] : null; 
$obj2 = $cls->detail($id);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails du Véhicule</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto px-4 py-8">
        <?php if ($obj2): ?>
            <div class="bg-white rounded-lg shadow-md p-6">
                <!-- Vehicle Header -->
                <div class="mb-6">
                    <h1 class="text-2xl font-bold text-gray-800"><?php echo $obj2['mark'] . " " . $obj2['model']; ?></h1>
                </div>
                <!-- Vehicle Image -->
                <div class="mb-6">
                    <img src="<?php echo $obj2['image']; ?>" alt="Voiture" class="w-full h-80 object-cover rounded-lg">
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
    </div>
</body>
</html>
