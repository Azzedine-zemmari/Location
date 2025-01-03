<?php
session_start();
if (!isset($_SESSION['userId']) || ($_SESSION['role'] !== 'admin')) {
    echo "Access denied!";
    exit();
}
require "../adminLogic/Vehicule.php";

$class = new Vehicule();
$vehicules = $class->getAllVehicule();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100">
    <div class="min-h-screen flex">
        <!-- Sidebar -->
        <aside class="bg-indigo-800 text-white w-64 min-h-screen p-4 hidden md:block">
            <div class="mb-8">
                <h2 class="text-2xl font-bold">Admin Panel</h2>
            </div>
            <nav>
                <ul class="space-y-2">
                    <li>
                        <a href="./dashboard.php" class="flex items-center space-x-2 p-2 hover:bg-indigo-700 rounded">
                            <i class="fas fa-home"></i>
                            <span>Home</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="flex items-center space-x-2 p-2 hover:bg-indigo-700 rounded">
                            <i class="fas fa-car"></i>
                            <span>Vehicles</span>
                        </a>
                    </li>
                    <li>
                        <a href="./avisDash.php" class="flex items-center space-x-2 p-2 hover:bg-indigo-700 rounded">
                            <i class="fas fa-users"></i>
                            <span>AVIS</span>
                        </a>
                    </li>
                    <li>
                        <a href="./ReservationDash.php" class="flex items-center space-x-2 p-2 hover:bg-indigo-700 rounded">
                            <i class="fas fa-calendar"></i>
                            <span>Reservations</span>
                        </a>
                    </li>
                    <li>
                        <a href="./categoryDash.php" class="flex items-center space-x-2 p-2 hover:bg-indigo-700 rounded">
                            <i class="fas fa-cog"></i>
                            <span>Category</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </aside>

        <!-- Main Content -->
        <div class="flex-1">
            <!-- Top Navigation -->
            <header class="bg-white shadow p-4">
                <div class="flex items-center justify-between">
                    <button class="md:hidden text-gray-600">
                        <i class="fas fa-bars text-xl"></i>
                    </button>
                    <div class="flex items-center space-x-4">
                        <div class="relative">
                            <i class="fas fa-bell text-gray-600"></i>
                            <span class="absolute -top-1 -right-1 bg-red-500 text-white rounded-full w-4 h-4 text-xs flex items-center justify-center">3</span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <img src="/api/placeholder/32/32" alt="Profile" class="w-8 h-8 rounded-full">
                            <span class="text-gray-700">Admin User</span>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Dashboard Content -->
            <main class="p-6">

                <!--  vehicules -->
                <div class="mt-6 bg-white rounded-lg shadow">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold mb-4">Vehicules</h3>
                        <div class="overflow-x-auto">
                            <table class="min-w-full">
                                <thead>
                                    <tr class="border-b">
                                        <th class="text-left p-3">#</th>
                                        <th class="text-left p-3">image</th>
                                        <th class="text-left p-3">categoryName</th>
                                        <th class="text-left p-3">model</th>
                                        <th class="text-left p-3">mark</th>
                                        <th class="text-left p-3">prix</th>
                                        <th class="text-left p-3">disponibilite</th>
                                        <th class="text-left p-3">color</th>
                                        <th class="text-left p-3">porte</th>
                                        <th class="text-left p-3">transmition</th>
                                        <th class="text-left p-3">personne</th>
                                        <th class="text-left p-3">action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($vehicules as $vehicule): ?>
                                        <tr class="border-b">
                                            <td class="p-3"><?= $vehicule['id'] ?></td>
                                            <td class="p-3"><img src="../../folder/<?=$vehicule['image'] ?>" class="w-10 h-10"></td>
                                            <td class="p-3"><?= $vehicule['category_name'] ?></td>
                                            <td class="p-3"><?= $vehicule['model'] ?></td>
                                            <td class="p-3"><?= $vehicule['mark'] ?></td>
                                            <td class="p-3"><?= $vehicule['prix'] ?></td>
                                            <td class="p-3 text-center">
                                                <?php echo ($vehicule['disponibilite'] == true) ? 'Disponible' : 'No disponible' ?>
                                            </td>
                                            <td class="p-3"><?= $vehicule['color'] ?></td>
                                            <td class="p-3"><?= $vehicule['porte'] ?></td>
                                            <td class="p-3"><?= $vehicule['transmition'] ?></td>
                                            <td class="p-3"><?= $vehicule['personne'] ?></td>
                                            <td class="p-3"><a class="text-blue-400" href="./updateVehicule.php?id=<?= $vehicule['id']?>">update</a></td>
                                            <td class="p-3"><a class="text-red-400" href="./deleteVehicule.php?id=<?= $vehicule['id']?>">delete</a></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
</body>

</html>