<?php 
session_start();
if (!isset($_SESSION['userId']) || ($_SESSION['role'] !== 'admin')) {
    echo "Access denied!";
    exit();
}
require "../../Class/themeClass.php";
$theme = new them();
$themes = $theme->showAll();


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        .sidebar {
            min-height: 100vh;
            background-color: #343a40;
            padding-top: 20px;
        }

        .nav-link {
            color: #fff;
        }

        .nav-link:hover {
            color: #f8f9fa;
        }

        .stat-card {
            transition: transform 0.2s;
        }

        .stat-card:hover {
            transform: translateY(-5px);
        }
            /* Modal background */
            .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.6);
            display: none;
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }

        /* Modal content */
        .modal {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            width: 300px;
            max-width: 90%;
            text-align: center;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
        }

        /* Close button */
        .close-btn {
            background: #f44336;
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 4px;
            cursor: pointer;
            margin-top: 10px;
        }

        .close-btn:hover {
            background: #d32f2f;
        }

        /* Open modal button */
        .open-modal-btn {
            padding: 10px 20px;
            background: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .open-modal-btn:hover {
            background: #0056b3;
        }
    </style>
</head>

<body>

    <div class="container-fluid">
        <div class="row">

            <nav class="col-md-2 d-none d-md-block sidebar">
                <div class="position-sticky">
                    <div class="text-center mb-4">
                        <h4 class="text-white">Admin Panel</h4>
                    </div>
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link active" href="#dashboard">
                                <i class="bi bi-speedometer2"></i> Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#users">
                                <i class="bi bi-people"></i> Users
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="manage_car.php">
                                <i class="bi bi-car-front"></i> Cars
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="view_reservation.php">
                                <i class="bi bi-calendar-check"></i> Reservations
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="gestionArticle.php">
                                <i class="bi bi-calendar-check"></i> gerer les articles
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="theme_article.php">
                                <i class="bi bi-calendar-check"></i> gerer les theme
                            </a>
                        </li>
                        
                    </ul>
                    <div class="absolute bottom-0 start-0 w-100 p-3">
                        <form action="../controller/logout.php" method="POST">
                            <button type="submit" class="btn btn-danger w-100">
                                <i class="bi bi-box-arrow-right"></i> Logout
                            </button>
                        </form>
                    </div>
                </div>
            </nav>


            <main class="col-md-10 ms-sm-auto px-4">
                <?php if (isset($errorMessage)): ?>
                    <div class="alert alert-danger mt-3">
                        <?php echo htmlspecialchars($errorMessage); ?>
                    </div>
                <?php endif; ?>

                <?php if (isset($successMessage)): ?>
                    <div class="alert alert-success mt-3">
                        <?php echo htmlspecialchars($successMessage); ?>
                    </div>
                <?php endif; ?>


                <div class="row mt-4">
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card stat-card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                            Total Users</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="bi bi-people fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card stat-card border-left-success shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                            Total Cars</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="bi bi-car-front fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card stat-card border-left-info shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                            Active Reservations</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="bi bi-calendar-check fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card stat-card border-left-warning shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                            Total Reviews</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="bi bi-star fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                 <!-- Modal structure -->
    <div class="modal-overlay" id="modalOverlay">
        <div class="modal">
            <form method="post">
                <label for="theme">Theme</label>
                <input type="text" name="theme" id="theme" required>
                <button name="addTheme">Add</button>
                <button type="button" class="close-btn" id="closeModal">Close</button>
            </form>
        </div>
    </div>
                <!-- Users Table -->
                <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary"></h6>
                        <button type="button" name="addTheme" id="addTheme" class="btn btn-success btn-sm" >
                            <i class="bi bi-plus-circle"></i> Add Another theme
                        </button>
                    </div>
                    <div class="card-body">

                        <div class="table-responsive">
                            <table class="table table-bordered" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>id</th>
                                        <th>name</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($themes as $theme): ?>
                                        <tr>
                                            <td><?= $theme['id']?></td>
                                            <td><?= $theme['name']?></td>
                                            <td>
                                                <a class="text-red-400" href="../traitementPage/deleteTheme?theme=<?=$theme['id'] ?>">delete</a>
                                            </td>
                                        </tr>
                                    <?php endforeach;?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>


                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Add New Cars</h6>
                        <button type="button" class="btn btn-success btn-sm" >
                            <i class="bi bi-plus-circle"></i> Add Another Car
                        </button>
                    </div>
                    <div class="card-body">
                        <form method="POST" enctype="multipart/form-data" id="multipleCarForm">
                            <input type="hidden" name="action" value="add_multiple_cars">
                            <div id="carFormsContainer">
                                <div class="car-form mb-4 border-bottom pb-4">
                                    <div class="row">
                                        <div class="col-md-3 mb-3">
                                            <label class="form-label">Brand</label>
                                            <input type="text" class="form-control" name="cars[0][marque]" required>
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label class="form-label">Model</label>
                                            <input type="text" class="form-control" name="cars[0][modele]" required>
                                        </div>
                                        <div class="col-md-2 mb-3">
                                            <label class="form-label">Year</label>
                                            <input type="number" class="form-control" name="cars[0][annee]" required>
                                        </div>
                                        <div class="col-md-2 mb-3">
                                            <label class="form-label">Category</label>
                                            <select class="form-control" name="cars[0][categorie_id]" required>
                                                <option value="">Select category</option>
                                               
                                            </select>
                                        </div>
                                        <div class="col-md-2 mb-3">
                                            <label class="form-label">Price</label>
                                            <input type="number" class="form-control" name="cars[0][price]" required>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label class="form-label">Car Image</label>
                                            <input type="file" class="form-control" name="cars[0][image]" accept="image/*" required>
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-danger btn-sm" onclick="removeCarForm(this)" style="display: none;">
                                        <i class="bi bi-trash"></i> Remove Car
                                    </button>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary mt-3">Add Cars</button>
                        </form>
                    </div>
                </div>
            </main>
        </div>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Category Management</h6>
            <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addCategoryModal">
                <i class="bi bi-plus-circle"></i> Add New Category
            </button>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Add Category Modal -->
    <div class="modal fade" id="addCategoryModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form method="POST">
                    <div class="modal-body">
                        <input type="hidden" name="action" value="add_category">
                        <div class="mb-3">
                            <label for="categoryName" class="form-label">Category Name</label>
                            <input type="text" class="form-control" id="categoryName" name="nom" required>
                        </div>
                        <div class="mb-3">
                            <label for="categoryDescription" class="form-label">Description</label>
                            <textarea class="form-control" id="categoryDescription" name="description" rows="3" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add Category</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
    // Get references to the modal elements
    const addThemeBtn = document.getElementById("addTheme");
    const modalOverlay = document.getElementById("modalOverlay");
    const closeModalBtn = document.getElementById("closeModal");

    addThemeBtn.addEventListener("click", function() {
        modalOverlay.style.display = "flex"; // Show the modal overlay
    });

    closeModalBtn.addEventListener("click", function() {
        modalOverlay.style.display = "none"; // Hide the modal overlay
    });

    modalOverlay.addEventListener("click", function(event) {
        if (event.target === modalOverlay) {
            modalOverlay.style.display = "none"; // Hide the modal overlay
        }
    });
</script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>