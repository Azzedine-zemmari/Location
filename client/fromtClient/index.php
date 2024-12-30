<?php 

require "../../admin/adminLogic/Vehicule.php";

$cls = new Vehicule();
$obj = $cls->getVehicule();

?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Location de Voitures</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <!-- Navigation -->
    <nav class="bg-white shadow-lg">
        <div class="max-w-6xl mx-auto px-4">
            <div class="flex justify-between items-center h-16">
                <a href="#" class="text-2xl font-bold text-blue-600">CarLoc</a>
                <div class="hidden md:flex space-x-4">
                    <a href="#" class="text-gray-700 hover:text-blue-600">Accueil</a>
                    <a href="#vehicles" class="text-gray-700 hover:text-blue-600">Véhicules</a>
                    <a href="#" class="text-gray-700 hover:text-blue-600">Réservation</a>
                </div>
                <div class="flex items-center space-x-4">
                    <button class="px-4 py-2 text-gray-700 hover:text-blue-600">Connexion</button>
                    <button class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">Inscription</button>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="relative bg-blue-600 h-96">
        <div class="max-w-6xl mx-auto px-4 h-full flex items-center">
            <div class="text-white">
                <h1 class="text-4xl font-bold mb-4">Louez votre voiture idéale</h1>
                <p class="text-xl mb-8">Des prix compétitifs pour tous vos besoins</p>
                <a href="#vehicles" class="bg-white text-blue-600 px-6 py-3 rounded-md font-semibold hover:bg-gray-100">
                    Voir nos véhicules
                </a>
            </div>
        </div>
    </div>

    <!-- Search and Filter Section -->
    <div class="max-w-6xl mx-auto px-4 py-8">
        <div class="bg-white rounded-lg shadow p-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <input type="text" placeholder="Rechercher un véhicule..." 
                       class="w-full px-4 py-2 border rounded-md">
                <select class="w-full px-4 py-2 border rounded-md">
                    <option value="">Catégorie</option>
                    <option value="suv">SUV</option>
                    <option value="berline">Berline</option>
                    <option value="citadine">Citadine</option>
                </select>
                <button class="w-full bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">
                    Rechercher
                </button>
            </div>
        </div>
    </div>

    <!-- Vehicles Grid -->
    <div id="vehicles" class="max-w-6xl mx-auto px-4 py-8">
        <h2 class="text-2xl font-bold mb-6">Nos Véhicules</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php foreach($obj as $o): ?>
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <img src="<?php echo $o['image']; ?>" alt="Voiture" class="w-full h-48 object-cover">
                <div class="p-4">
                    <h3 class="text-xl font-semibold mb-2"><?php echo $o['model']; ?></h3>
                    <div class="flex justify-between mb-2">
                        <span class="text-gray-600"><?php echo $o['category_name']; ?></span>
                        <span class="text-blue-600 font-bold"><?php echo $o['prix']; ?>/jour</span>
                    </div>
                    <a href="./DetailVehicule.php?id=<?php echo $o['id'] ?>" class="w-full bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">
                        Voir détails
                    </a>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Car Details Modal -->
</body>
</html>