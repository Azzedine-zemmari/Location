<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription - Location de Voitures</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="min-h-screen flex items-center justify-center">
        <div class="max-w-md w-full bg-white rounded-lg shadow-lg p-8">
            <a href="/" class="text-2xl font-bold text-blue-600 block text-center mb-8">CarLoc</a>
            <h2 class="text-2xl font-bold mb-6 text-center">Inscription</h2>
            <form action="" method="POST" class="space-y-6">
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Nom</label>
                        <input type="text" name="nom" required class="mt-1 block w-full px-3 py-2 border rounded-md">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Prénom</label>
                        <input type="text" name="prenom" required class="mt-1 block w-full px-3 py-2 border rounded-md">
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" name="email" required class="mt-1 block w-full px-3 py-2 border rounded-md">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Mot de passe</label>
                    <input type="password" name="password" required class="mt-1 block w-full px-3 py-2 border rounded-md">
                </div>
                <button type="submit" name="submit" class="w-full bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">
                    S'inscrire
                </button>
            </form>
            <p class="mt-4 text-center">
                Déjà un compte ? 
                <a href="./login.php" class="text-blue-600 hover:underline">Se connecter</a>
            </p>
        </div>
    </div>
    <?php 
    include "../ClientLogic/user.php";
    if(isset($_POST['submit'])){
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $cls = new user();
        $register = $cls->register($nom,$prenom,$email,$password);
        if($register){
            header("Location: ./index.php");
        }
        else{
            echo "error in the register";
        }
    }
    ?>
</body>
</html>