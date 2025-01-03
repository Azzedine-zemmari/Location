<?php 
session_start();
if (!isset($_SESSION['userId']) || ($_SESSION['role'] !== 'admin')) {
    echo "Access denied!";
    exit();
}
require "../adminLogic/statistics.php";

$static = new statics();
$numberClient = $static->getUserCount();
$numberVehicule = $static->getVehiculeCount();
$numberReservation = $static->getReservationCount();
$numberRservationAttent = $static->getReservationattent();
$numberReservationAccepter = $static->getReservationAccepter();
$numberReservationAnnuler = $static->getReservationRefuser();



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
                        <a href="./VehiculeDah.php" class="flex items-center space-x-2 p-2 hover:bg-indigo-700 rounded">
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
                <!-- Stats Cards -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
                    <div class="bg-white rounded-lg shadow p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="text-gray-500 text-sm">Total Vehicles</h3>
                                <p class="text-2xl font-bold"><?= $numberVehicule ?></p>
                            </div>
                            <div class="bg-blue-100 p-3 rounded-full">
                                <i class="fas fa-car text-blue-600"></i>
                            </div>
                        </div>
                        <p class="text-green-500 text-sm mt-2">
                            <i class="fas fa-arrow-up"></i> 12% increase
                        </p>
                    </div>

                    <div class="bg-white rounded-lg shadow p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="text-gray-500 text-sm">Client</h3>
                                <p class="text-2xl font-bold"><?= $numberClient?></p>
                            </div>
                            <div class="bg-green-100 p-3 rounded-full">
                                <i class="fas fa-key text-green-600"></i>
                            </div>
                        </div>
                        <p class="text-green-500 text-sm mt-2">
                            <i class="fas fa-arrow-up"></i> 8% increase
                        </p>
                    </div>

                    <div class="bg-white rounded-lg shadow p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="text-gray-500 text-sm">Total Reservation</h3>
                                <p class="text-2xl font-bold"><?= $numberReservation?></p>
                            </div>
                            <div class="bg-purple-100 p-3 rounded-full">
                                <i class="fas fa-users text-purple-600"></i>
                            </div>
                        </div>
                        <p class="text-green-500 text-sm mt-2">
                            <i class="fas fa-arrow-up"></i> 15% increase
                        </p>
                    </div>

                    <div class="bg-white rounded-lg shadow p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="text-gray-500 text-sm">Rservation accepter</h3>
                                <p class="text-2xl font-bold"><?= $numberReservationAccepter?></p>
                            </div>
                            <div class="bg-yellow-100 p-3 rounded-full">
                                <i class="fas fa-dollar-sign text-yellow-600"></i>
                            </div>
                        </div>
                        <p class="text-green-500 text-sm mt-2">
                            <i class="fas fa-arrow-up"></i> 10% increase
                        </p>
                    </div>
                </div>

                <!-- Charts -->
                <!-- <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <div class="bg-white rounded-lg shadow p-6">
                        <h3 class="text-lg font-semibold mb-4">Revenue Overview</h3>
                        <canvas id="revenueChart" height="300"></canvas>
                    </div>

                    <div class="bg-white rounded-lg shadow p-6">
                        <h3 class="text-lg font-semibold mb-4">Vehicle Categories</h3>
                        <canvas id="categoriesChart" height="300"></canvas>
                    </div>
                </div> -->

                <!-- Recent Activity
                <div class="mt-6 bg-white rounded-lg shadow">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold mb-4">Recent Activity</h3>
                        <div class="overflow-x-auto">
                            <table class="min-w-full">
                                <thead>
                                    <tr class="border-b">
                                        <th class="text-left p-3">#</th>
                                        <th class="text-left p-3">Vehicle</th>
                                        <th class="text-left p-3">Action</th>
                                        <th class="text-left p-3">Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="border-b">
                                        <td class="p-3">John Doe</td>
                                        <td class="p-3">Toyota Camry</td>
                                        <td class="p-3">Rental Started</td>
                                        <td class="p-3">2024-01-02</td>
                                    </tr>
                                    <tr class="border-b">
                                        <td class="p-3">Jane Smith</td>
                                        <td class="p-3">Honda Civic</td>
                                        <td class="p-3">Rental Ended</td>
                                        <td class="p-3">2024-01-02</td>
                                    </tr>
                                    <tr>
                                        <td class="p-3">Mike Johnson</td>
                                        <td class="p-3">Ford Mustang</td>
                                        <td class="p-3">Reserved</td>
                                        <td class="p-3">2024-01-02</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div> -->
            </main>
        </div>
    </div>


</body>
</html>