<?php
require "../adminLogic/Vehicule.php";
$id = $_GET['id'];
$vehicule = new Vehicule();
$vehicules = $vehicule->selectID($id);

$connection = new connection();
$conn = $connection->conn();

if(isset($_POST['submit'])){
    $categorie = $_POST['categorie'];
    $model = $_POST['model'];
    $mark = $_POST['mark'];
    $prix = $_POST['prix'];
    $disponibilite = $_POST['disponibilite'];
    $color = $_POST['color'];
    $porte = $_POST['porte'];
    $transmition = $_POST['transmition'];
    $personne = $_POST['personne'];
    $id = $_POST['id'];

    if (isset($_FILES['image'])) {
        $image = $_FILES['image']['name'];
        $image_tmp = $_FILES['image']['tmp_name'];
        $upload_dir = '../../folder/';
        $upload_path = $upload_dir . basename($image);

        // Move the uploaded file to the uploads directory
        if (move_uploaded_file($image_tmp, $upload_path)) {
            $image = basename($upload_path);
        } else {
            echo "Error uploading the image.";
            exit;
        }
    } 
    $update = $vehicule->update($id,$categorie,$model,$mark,$prix,$disponibilite,$color,$porte,$transmition,$personne,$image);
    if($update){
        header("location: ./VehiculeDah.php");
    }
    else{
        echo '<p>ERRRROR</p>';
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Vehicle and Category</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto py-10 px-5">
        <h2 class="text-2xl font-bold text-center mb-8">Insert Vehicle and Category</h2>

        <!-- Form for Vehicle and Category -->
        <form action="" method="POST" enctype="multipart/form-data" class="bg-white shadow-md rounded-lg p-6">
            <!-- Category Section -->
            <div class="mb-6">
                <h3 class="text-lg font-semibold mb-3">Category</h3>
                <div>
                    <label for="categorieId" class="block text-sm font-medium text-gray-700">Category name</label>
                    <select name="categorie" id="">
                      <?php 
                        $sql_category = "SELECT * FROM category";
                        $stmt = $conn->prepare($sql_category);
                        if ($stmt->execute()) {
                            $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
                            foreach ($categories as $categorie) {
                                $selected = ($categorie['id'] == $vehicules['categorieId']) ? 'selected' : '';
                                echo "<option value='" . $categorie['id'] . "' $selected>" . $categorie['nom'] . "</option>";
                            }
                        } else {
                            echo "<option>error fetching types</option>";
                        }
                      
                      ?>
                    </select>
                </div>
            </div>

            <hr class="my-6" />

            <!-- Vehicle Section -->
            <div >
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <input type="hidden" value="<?= $vehicules['id'] ?>" name="id">
                        <label for="model" class="block text-sm font-medium text-gray-700">Model</label>
                        <input
                            type="text"
                            id="model"
                            name="model"
                            value="<?= $vehicules['model']?>"
                            class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:ring-indigo-500 focus:border-indigo-500"
                            placeholder="Enter model"
                            required />
                    </div>
                    <div>
                        <label for="mark" class="block text-sm font-medium text-gray-700">Mark</label>
                        <input
                            type="text"
                            id="mark"
                            name="mark"
                            value="<?= $vehicules['mark']?>"
                            class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:ring-indigo-500 focus:border-indigo-500"
                            placeholder="Enter mark"
                            required />
                    </div>
                    <div>
                        <label for="prix" class="block text-sm font-medium text-gray-700">Price</label>
                        <input
                            type="number"
                            id="prix"
                            name="prix"
                            value="<?= $vehicules['prix']?>"
                            class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:ring-indigo-500 focus:border-indigo-500"
                            placeholder="Enter price"
                            step="0.01"
                            required />
                    </div>
                    <div>
                        <label for="disponibilite" class="block text-sm font-medium text-gray-700">Availability</label>
                        <select
                            id="disponibilite"
                            name="disponibilite"
                            value="<?= $vehicules['disponibilite']?>"
                            class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:ring-indigo-500 focus:border-indigo-500"
                            required>
                            <option value="1">Available</option>
                            <option value="0">Unavailable</option>
                        </select>
                    </div>
                    <div>
                        <label for="color" class="block text-sm font-medium text-gray-700">Color</label>
                        <input
                            type="text"
                            id="color"
                            name="color"
                            value="<?= $vehicules['color']?>"
                            class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:ring-indigo-500 focus:border-indigo-500"
                            placeholder="Enter color" />
                    </div>
                    <div>
                        <label for="porte" class="block text-sm font-medium text-gray-700">Doors</label>
                        <input
                            type="number"
                            id="porte"
                            name="porte"
                            value="<?= $vehicules['porte']?>"
                            class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:ring-indigo-500 focus:border-indigo-500"
                            placeholder="Enter number of doors"
                            required />
                    </div>
                    <div>
                        <label for="transmition" class="block text-sm font-medium text-gray-700">Transmission</label>
                        <input
                            type="text"
                            id="transmition"
                            name="transmition"
                            value="<?= $vehicules['transmition']?>"
                            class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:ring-indigo-500 focus:border-indigo-500"
                            placeholder="Enter transmission type" />
                    </div>
                    <div>
                        <label for="personne" class="block text-sm font-medium text-gray-700">Capacity</label>
                        <input
                            type="number"
                            id="personne"
                            name="personne"
                            value="<?= $vehicules['personne']?>"
                            class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:ring-indigo-500 focus:border-indigo-500"
                            placeholder="Enter number of persons"
                            required />
                    </div>
                    <div class="col-span-1 md:col-span-2">
                        <label for="image" class="block text-sm font-medium text-gray-700">Image</label>
                        <input
                            type="file"
                            id="image"
                            name="image"
                            value="<?= $vehicules['image']?>"
                            class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:ring-indigo-500 focus:border-indigo-500"
                            accept="image/*" />
                    </div>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="mt-6 text-center">
                <button
                name="submit"
                    type="submit"
                    class="bg-indigo-600 text-white px-6 py-2 rounded-md hover:bg-indigo-700">
                    Submit
                        </button>
            </div>
        </form>
    </div>
</body>
</html>