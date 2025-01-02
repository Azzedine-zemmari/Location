<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <!-- Navbar -->
  <nav class="bg-black shadow-md p-4 flex justify-between items-center">
    <div class="flex items-center"><a href="#">
                <!-- <img src=".../img/cuisine_logo-removebg-preview.png" class="max-w-full h-auto w-[100px] " alt="logo"> -->
            </a>
    <h1 class="text-2xl font-bold text-white">Dashboard panel</h1></div>
    <div class="flex items-center">
      <span class="mr-4 text-white">Hello, <strong>User</strong></span>
      <img src="../../client/fromtClient/image/User.png" alt="profile" class="rounded-full w-4 h-4">
    </div>
  </nav>
  

    
<div class="flex h-screen">
  <!-- Sidebar -->
  <aside class="w-64 bg-gray-800">
      
      <nav class="mt-8">
          <a href="#" class="block py-2 px-4 text-gray-400 hover:bg-gray-700 hover:text-white">Dashboard</a>
          <a href="view_menus.php" class="block py-2 px-4 text-gray-400 hover:bg-gray-700 hover:text-white"> View Menus</a>
          <a href="make_reservation.php" class="block py-2 px-4 text-gray-400 hover:bg-gray-700 hover:text-white"> Make a reservation</a>
          <a href="view_reservations.php" class="block py-2 px-4 text-gray-400 hover:bg-gray-700 hover:text-white">View reservations</a>
          <a href="logout.php" class="block py-2 px-4 text-gray-400 hover:bg-gray-700 hover:text-white">Logout</a>
      </nav>
  </aside>
  <main class="flex-1  overflow-y-auto">
    <div class="container mx-auto p-4">
        <!-- Welcome Section -->
    <div class="bg-white p-6 rounded-lg shadow-md mb-6 flex justify-between items-center">
      <div>
        <h2 class="text-3xl font-semibold text-gray-800">Welcome, Client!</h2>
        <p class="text-gray-600 mt-2">Check your profil, and stay connecte!</p>
      </div>
      <div>
        <img src="https://via.placeholder.com/120" alt="chef icon" class="w-32">
      </div>
    </div>
     
        <!-- Reservations Section -->
        <section class="mb-8">
            <h2 class="text-xl font-bold mb-4"> Reservations History</h2>
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <table class="min-w-full bg-white">
                    <thead >
                        <tr>
                            <th class="py-2 px-4 text-left">Client</th>
                            <th class="py-2 px-4 text-left">Date</th>
                            <th class="py-2 px-4 text-left">Time</th>
                            <th class="py-2 px-4 text-left">Guests</th>
                            <th class="py-2 px-4 text-left">Status</th>
                            <th class="py-2 px-4 text-left">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        <tr class="border-t">
                            <td class="py-2 px-4">Asma lachhab</td>
                            <td class="py-2 px-4">2024-12-17</td>
                            <td class="py-2 px-4">19:00</td>
                            <td class="py-2 px-4">4</td>
                            <td class="py-2 px-4 text-yellow-500">Pending</td>
                            <td class="border-b p-3">
              <button class="text-green-500 hover:underline">Accept</button> | 
              <button class="text-red-500 hover:underline">Refuse</button>
            </td>
                        </tr>
                        
                        <tr class="border-t">
                            <td class="py-2 px-4">Sara boulahia</td>
                            <td class="py-2 px-4">2024-12-18td>
                            <td class="py-2 px-4">15:00</td>
                            <td class="py-2 px-4">6</td>
                            <td class="py-2 px-4 text-yellow-500">Pending</td>
                            <td class="border-b p-3">
              <button class="text-green-500 hover:underline">Accept</button> | 
              <button class="text-red-500 hover:underline">Refuse</button>
            </td>
                        </tr>
                        <tr class="border-t">
                            <td class="py-2 px-4">Sara boulahia</td>
                            <td class="py-2 px-4">2024-12-18td>
                            <td class="py-2 px-4">15:00</td>
                            <td class="py-2 px-4">6</td>
                            <td class="py-2 px-4 text-yellow-500">Pending</td>
                            <td class="border-b p-3">
              <button class="text-green-500 hover:underline">Accept</button> | 
              <button class="text-red-500 hover:underline">Refuse</button>
            </td>
                        </tr>

                        <tr class="border-t">
                            <td class="py-2 px-4">Sara boulahia</td>
                            <td class="py-2 px-4">2024-12-18td>
                            <td class="py-2 px-4">15:00</td>
                            <td class="py-2 px-4">6</td>
                            <td class="py-2 px-4 text-yellow-500">Pending</td>
                            <td class="border-b p-3">
              <button class="text-green-500 hover:underline">Accept</button> | 
              <button class="text-red-500 hover:underline">Refuse</button>
            </td>
                        </tr>

                        <tr class="border-t">
                            <td class="py-2 px-4">Sara boulahia</td>
                            <td class="py-2 px-4">2024-12-18td>
                            <td class="py-2 px-4">15:00</td>
                            <td class="py-2 px-4">6</td>
                            <td class="py-2 px-4 text-yellow-500">Pending</td>
                            <td class="border-b p-3">
              <button class="text-green-500 hover:underline">Edit</button> | 
              <button class="text-red-500 hover:underline">Cancel</button>
            </td>
                        </tr>                    </tbody>
                </table>
            </div>
        </section>

   
    

        <!-- Add Menu Section -->
        <section class="mb-8">
        <a href="activites.php" class="bg-orange-950 text-white px-4 py-2 rounded-md">Ajouter reservation</a>
        </section>
    </div>

    

    <!-- Footer -->
    <footer class="bg-gray-800 text-white text-center p-4">
        <p>&copy; 2024 Travigo set web de voyage. All rights reserved.</p>
    </footer>
    </main>
    </body>
</html>