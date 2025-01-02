<?php
require_once "../../Config.php";
$connection = new connection();
$connect = $connection->conn();

$sql = "select * from category";
$stmt = $connect->prepare($sql);
if ($stmt->execute()) {
    $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
                        <?php foreach ($categories as $categorie): ?>
                            <option value="<?php echo $categorie['id'] ?>"><?php echo $categorie['nom'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <hr class="my-6" />

            <!-- Vehicle Section -->
            <div id="MultipleForms">
                <h3 class="text-lg font-semibold mb-3">Vehicle</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="model" class="block text-sm font-medium text-gray-700">Model</label>
                        <input
                            type="text"
                            id="model"
                            name="model"
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
                            class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:ring-indigo-500 focus:border-indigo-500"
                            placeholder="Enter color" />
                    </div>
                    <div>
                        <label for="porte" class="block text-sm font-medium text-gray-700">Doors</label>
                        <input
                            type="number"
                            id="porte"
                            name="porte"
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
                            class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:ring-indigo-500 focus:border-indigo-500"
                            placeholder="Enter transmission type" />
                    </div>
                    <div>
                        <label for="personne" class="block text-sm font-medium text-gray-700">Capacity</label>
                        <input
                            type="number"
                            id="personne"
                            name="personne"
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
                            class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:ring-indigo-500 focus:border-indigo-500"
                            accept="image/*" />
                    </div>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="mt-6 text-center">
                <button
                    type="submit"
                    class="bg-indigo-600 text-white px-6 py-2 rounded-md hover:bg-indigo-700">
                    Submit
                </button>
                <button
                    type="submit"
                    id="moreVehicule"
                    class="bg-indigo-600 text-white px-6 py-2 rounded-md hover:bg-indigo-700">
                    add more vehicule
                </button>
            </div>
        </form>
    </div>
    <script>
        let devCounter = 1;
        const addForm = document.getElementById("moreVehicule");
        const MultipleForms = document.getElementById("MultipleForms")
        addForm.addEventListener("click", () => {
            const newDiv = document.createElement("div");
            newDiv.classList.add("grid", "grid-cols-1", "md:grid-cols-2", "gap-4", "mt-6");
            newDiv.innerHTML = `
        <div>
        <input type = "hidden" name='counter' value = '${devCounter}'/>
                        <label for="model" class="block text-sm font-medium text-gray-700">Model</label>
                        <input
                            type="text"
                            id="model${devCounter}"
                            name="model${devCounter}"
                            class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:ring-indigo-500 focus:border-indigo-500"
                            placeholder="Enter model"
                            required />
                    </div>
                    <div>
                        <label for="mark" class="block text-sm font-medium text-gray-700">Mark</label>
                        <input
                            type="text"
                            id="mark${devCounter}"
                            name="mark${devCounter}"
                            class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:ring-indigo-500 focus:border-indigo-500"
                            placeholder="Enter mark"
                            required />
                    </div>
                    <div>
                        <label for="prix" class="block text-sm font-medium text-gray-700">Price</label>
                        <input
                            type="number"
                            id="prix${devCounter}"
                            name="prix${devCounter}"
                            class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:ring-indigo-500 focus:border-indigo-500"
                            placeholder="Enter price"
                            step="0.01"
                            required />
                    </div>
                    <div>
                        <label for="disponibilite" class="block text-sm font-medium text-gray-700">Availability</label>
                        <select
                            id="disponibilite${devCounter}"
                            name="disponibilite${devCounter}"
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
                            id="color${devCounter}"
                            name="color${devCounter}"
                            class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:ring-indigo-500 focus:border-indigo-500"
                            placeholder="Enter color" />
                    </div>
                    <div>
                        <label for="porte" class="block text-sm font-medium text-gray-700">Doors</label>
                        <input
                            type="number"
                            id="porte${devCounter}"
                            name="porte${devCounter}"
                            class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:ring-indigo-500 focus:border-indigo-500"
                            placeholder="Enter number of doors"
                            required />
                    </div>
                    <div>
                        <label for="transmition" class="block text-sm font-medium text-gray-700">Transmission</label>
                        <input
                            type="text"
                            id="transmition${devCounter}"
                            name="transmition${devCounter}"
                            class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:ring-indigo-500 focus:border-indigo-500"
                            placeholder="Enter transmission type" />
                    </div>
                    <div>
                        <label for="personne" class="block text-sm font-medium text-gray-700">Capacity</label>
                        <input
                            type="number"
                            id="personne${devCounter}"
                            name="personne${devCounter}"
                            class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:ring-indigo-500 focus:border-indigo-500"
                            placeholder="Enter number of persons"
                            required />
                    </div>
                    <div class="col-span-1 md:col-span-2">
                        <label for="image" class="block text-sm font-medium text-gray-700">Image</label>
                        <input
                            type="file"
                            id="image${devCounter}"
                            name="image${devCounter}"
                            class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:ring-indigo-500 focus:border-indigo-500"
                            />
                    </div>
        `
        MultipleForms.appendChild(newDiv);
        devCounter++;
        })
    </script>
</body>

</html>