<?php 
session_start();
if (!isset($_SESSION['userId']) || ($_SESSION['role'] !== 'admin')) {
    echo "Access denied!";
    exit();
}
require "../../Class/themeClass.php";
require "../../Class/articleClass.php";
$theme = new them();
$themes = $theme->showAll();

$article = new article();
$articles = $article->ShowallArticles();


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
            #modalOverlay {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5);
    justify-content: center;
    align-items: center;
    z-index: 1050; /* Add this */
}

.modal {
    background: white;
    padding: 20px;
    border-radius: 5px;
    position: relative; /* Add this */
    width: 400px; /* Add this */
    max-width: 90%; /* Add this */
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
                 
                <!-- Users Table -->
                <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary"></h6>
                        <a href="./modalAddTheme.php"><button type="button" name="addTheme" id="addTheme" class="btn btn-success btn-sm" >
                            <i class="bi bi-plus-circle"></i> Add Another theme
                        </button></a>
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
                                            <a class="text-red-400" href="../traitementPage/deleteTheme.php?theme=<?= $theme['id'] ?>">delete</a>
                                            </td>
                                        </tr>
                                    <?php endforeach;?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="card-header py-3 d-flex justify-content-between">
                    </div>
                    <div class="card-body">

                        <div class="table-responsive">
                            <table class="table table-bordered" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>id</th>
                                        <th>title</th>
                                        <th>content</th>
                                        <th>theme</th>
                                        <th>status</th>
                                        <th>action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($articles as $article): ?>
                                        <tr>
                                            <td><?= $article['id']?></td>
                                            <td><?= $article['title']?></td>
                                            <td><?= $article['content']?></td>
                                            <td><?= $article['themeName']?></td>
                                            <td><?= $article['status']?></td>
                                            <td>
                                            <a class="text-red-400" href="../traitementPage/aproveArticle.php?id=<?= $article['id'] ?>">approve</a>
                                            <a class="text-red-400" href="../traitementPage/denyArticle.php?id=<?= $article['id'] ?>">deny</a>
                                            </td>
                                        </tr>
                                    <?php endforeach;?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>