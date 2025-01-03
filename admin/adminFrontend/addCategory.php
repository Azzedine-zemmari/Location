<?php 

require "../adminLogic/category.php";

$connection = new connection();
$connect = $connection->conn();

$category = new category();
if(isset($_POST['submit'])){
    $addCategory = $category->insertCategory($_POST['category']);
    if($addCategory){
        header("Location: ./dashboard.php");
    }
    else{
        echo "error";   
    }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Simple Form</title>
</head>
<body class="min-h-screen bg-gray-100 flex items-center justify-center p-4">
    <div class="bg-white rounded-lg shadow-md p-6 w-full max-w-md">
        <h2 class="text-2xl font-bold mb-6 text-gray-800">category</h2>
        <form action="" method="POST">
            <div class="mb-6">
                <input 
                    name="category"
                    type="text" 
                    placeholder="Enter your category here"
                    class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200"
                >
            </div>
            <button 
                name="submit"
                type="submit"
                class="w-full bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600 transition duration-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50"
            >
                Submit
            </button>
        </form>
    </div>
</body>
</html>