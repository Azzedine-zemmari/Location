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
            <!-- Vehicle Card -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <img src="/api/placeholder/400/200" alt="Voiture" class="w-full h-48 object-cover">
                <div class="p-4">
                    <h3 class="text-xl font-semibold mb-2">Toyota RAV4</h3>
                    <div class="flex justify-between mb-2">
                        <span class="text-gray-600">SUV</span>
                        <span class="text-blue-600 font-bold">100€/jour</span>
                    </div>
                    <div class="grid grid-cols-2 gap-2 mb-4 text-sm">
                        <div class="flex items-center">
                            <span class="text-gray-600">5 portes</span>
                        </div>
                        <div class="flex items-center">
                            <span class="text-gray-600">5 personnes</span>
                        </div>
                        <div class="flex items-center">
                            <span class="text-gray-600">Automatique</span>
                        </div>
                        <div class="flex items-center">
                            <span class="text-gray-600">Blanc</span>
                        </div>
                    </div>
                    <button class="w-full bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700"
                            data-modal-target="car-modal" data-modal-toggle="car-modal">
                        Voir détails
                    </button>
                </div>
            </div>
            <!-- Repeat for more vehicles -->
        </div>
    </div>

    <!-- Car Details Modal -->
    <div id="car-modal" tabindex="-1" aria-hidden="true" 
         class="fixed top-0 left-0 right-0 z-50 hidden w-full overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative w-full max-w-2xl max-h-full p-4">
            <div class="relative bg-white rounded-lg shadow">
                <div class="flex items-start justify-between p-4 border-b">
                    <h3 class="text-xl font-semibold">Toyota RAV4</h3>
                    <button type="button" class="text-gray-400 hover:text-gray-900" 
                            data-modal-hide="car-modal">
                        <span class="sr-only">Fermer</span>
                        ×
                    </button>
                </div>
                <div class="p-6">
                    <img src="/api/placeholder/600/300" alt="Voiture" class="w-full h-64 object-cover mb-4">
                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <h4 class="font-semibold mb-2">Caractéristiques</h4>
                            <ul class="space-y-2">
                                <li>Catégorie: SUV</li>
                                <li>Prix: 100€/jour</li>
                                <li>Transmission: Automatique</li>
                                <li>Nombre de portes: 5</li>
                            </ul>
                        </div>
                        <div>
                            <h4 class="font-semibold mb-2">Avis</h4>
                            <div class="space-y-2">
                                <div class="p-2 bg-gray-50 rounded">
                                    <p class="text-sm">Très satisfait de cette voiture</p>
                                    <p class="text-xs text-gray-500">★★★★★</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button class="w-full bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">
                        Réserver maintenant
                    </button>
                </div>
            </div>
        </div>
    </div>
</body>
</html>