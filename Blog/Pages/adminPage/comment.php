<?php 
session_start();
if (!isset($_SESSION['userId']) || ($_SESSION['role'] !== 'admin')) {
    echo "Access denied!";
    exit();
}
require "../../Class/Commentaire.php";

$class = new commentaire();
$all = $class->getAllComments();

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
                            <a class="nav-link active" href="./ThemeDashboard.php">
                                <i class="bi bi-speedometer2"></i> Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="bi bi-people"></i> comment
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="./tags.php">
                                <i class="bi bi-car-front"></i> tags
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../../../client/ClientLogic/logoutUser.php">
                                logout
                            </a>
                        </li>
                </div>
            </nav>

            <main class="col-md-10 ms-sm-auto px-4">
                <div class="card-header py-3 d-flex justify-content-between">
                    </div>
                    <div class="card-body">

                        <div class="table-responsive">
                            <table class="table table-bordered" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>article</th>
                                        <th>writer</th>
                                        <th>comment</th>
                                        <th>action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($all as $comment): ?>
                                        <tr>
                                            <td><?= $comment['title']?></td>
                                            <td><?= $comment['nom']?></td>
                                            <td><?= $comment['comment']?></td>
                                            <td>
                                            <a class="text-red-400" href="../traitementPage/deletecomment.php?id=<?= $comment['id'] ?>">deny</a>
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