<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - Location de Voitures</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="min-h-screen flex items-center justify-center">
        <div class="max-w-md w-full bg-white rounded-lg shadow-lg p-8">
            <a href="/" class="text-2xl font-bold text-blue-600 block text-center mb-8">CarLoc</a>
            <h2 class="text-2xl font-bold mb-6 text-center">Connexion</h2>
            <form class="space-y-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" required class="mt-1 block w-full px-3 py-2 border rounded-md">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Mot de passe</label>
                    <input type="password" required class="mt-1 block w-full px-3 py-2 border rounded-md">
                </div>
                <button type="submit" class="w-full bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">
                    Se connecter
                </button>
            </form>
            <p class="mt-4 text-center">
                Pas encore de compte ? 
                <a href="/register" class="text-blue-600 hover:underline">S'inscrire</a>
            </p>
        </div>
    </div>
</body>
</html>