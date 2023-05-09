<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "scaffolding";
// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
$rowsPerPage = 10;
$page = 1;

if (isset($_GET['rowsPerPage'])) {
    $rowsPerPage = $_GET['rowsPerPage'];
}

if (isset($_GET['page'])) {
    $page = $_GET['page'];
}

$offset = ($page - 1) * $rowsPerPage;

$sql = "SELECT * FROM inventory LIMIT $rowsPerPage OFFSET $offset";
$result = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Table - Inventory</title>
    <link rel="stylesheet" href="assets/bootstrap1.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i&amp;display=swap">
    <!-- <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css"> -->
    <script src="https://kit.fontawesome.com/961768b1ec.js" crossorigin="anonymous"></script>
</head>

<body id="page-top">
    <div id="wrapper">
        <nav class="navbar navbar-dark align-items-start sidebar sidebar-dark accordion bg-gradient-primary p-0" style="background: #2D3F50;">
            <div class="container-fluid d-flex flex-column p-0"><a class="navbar-brand d-flex justify-content-center align-items-center sidebar-brand m-0" href="#">
                    <div class="sidebar-brand-icon rotate-n-15"><i class="fas fa-dice-d20" style="font-size: 23px;"></i></div>
                    <div class="sidebar-brand-text mx-3"><span>asian enginners</span></div>
                </a>
                <hr class="sidebar-divider my-0">
                <ul class="navbar-nav text-light" id="accordionSidebar">
                    <li class="nav-item"><a class="nav-link" href="index.html"><i class="fas fa-bars"></i><span>Dashboard</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="profile.html"><i class="fas fa-user"></i><span>Profile</span></a></li>
                    <li class="nav-item"><a class="nav-link active" href="table.html"><i class="fas fa-cubes" style="font-size: 13px;"></i><span>Inventory</span></a><a class="nav-link" href="untitled.html"><i class="fas fa-user-friends" style="font-size: 13px;"></i><span>Customer</span></a><a class="nav-link" href="untitled.html"><i class="fas fa-box-open" style="font-size: 13px;"></i><span>Issued</span></a><a class="nav-link" href="untitled.html"><i class="fas fa-archive"></i><span>Return</span></a><a class="nav-link" href="untitled.html"><i class="fas fa-table"></i><span>Bill</span></a><a class="nav-link" href="untitled.html"><i class="fas fa-sticky-note" style="font-size: 13px;"></i><span>Payment</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="login.html"><i class="fas fa-sign-in-alt"></i><span>LogOut</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="register.html"><i class="fas fa-cog"></i><span>Settings</span></a></li>
                </ul>
                <div class="text-center d-none d-md-inline"><button class="btn rounded-circle border-0" id="sidebarToggle" type="button"></button></div>
            </div>
        </nav>
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                <nav class="navbar navbar-light navbar-expand bg-white shadow mb-4 topbar static-top">
                    <div class="container-fluid"><button class="btn btn-link d-md-none rounded-circle me-3" id="sidebarToggleTop" type="button"><i class="fas fa-bars"></i></button>
                        <form class="d-none d-sm-inline-block me-auto ms-md-3 my-2 my-md-0 mw-100 navbar-search">
                            <div class="input-group"><input class="bg-light form-control border-0 small" type="text" placeholder="Search for ..."><button class="btn btn-primary py-0" type="button" style="background: #2D3F50;"><i class="fas fa-search"></i></button></div>
                        </form>
                        <ul class="navbar-nav flex-nowrap ms-auto">
                            <li class="nav-item dropdown d-sm-none no-arrow"><a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown" href="#"><i class="fas fa-search"></i></a>
                                <div class="dropdown-menu dropdown-menu-end p-3 animated--grow-in" aria-labelledby="searchDropdown">
                                    <form class="me-auto navbar-search w-100">
                                        <div class="input-group"><input class="bg-light form-control border-0 small" type="text" placeholder="Search for ...">
                                            <div class="input-group-append"><button class="btn btn-primary py-0" type="button"><i class="fas fa-search"></i></button></div>
                                        </div>
                                    </form>
                                </div>
                            </li>
                            <li class="nav-item dropdown no-arrow mx-1">
                                <div class="nav-item dropdown no-arrow"><a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown" href="#"><span class="badge bg-danger badge-counter">3+</span><i class="fas fa-bell fa-fw"></i></a>
                                    <div class="dropdown-menu dropdown-menu-end dropdown-list animated--grow-in">
                                        <h6 class="dropdown-header">alerts center</h6><a class="dropdown-item d-flex align-items-center" href="#">
                                            <div class="me-3">
                                                <div class="bg-primary icon-circle"><i class="fas fa-file-alt text-white"></i></div>
                                            </div>
                                            <div><span class="small text-gray-500">December 12, 2019</span>
                                                <p>A new monthly report is ready to download!</p>
                                            </div>
                                        </a><a class="dropdown-item d-flex align-items-center" href="#">
                                            <div class="me-3">
                                                <div class="bg-success icon-circle"><i class="fas fa-donate text-white"></i></div>
                                            </div>
                                            <div><span class="small text-gray-500">December 7, 2019</span>
                                                <p>$290.29 has been deposited into your account!</p>
                                            </div>
                                        </a><a class="dropdown-item d-flex align-items-center" href="#">
                                            <div class="me-3">
                                                <div class="bg-warning icon-circle"><i class="fas fa-exclamation-triangle text-white"></i></div>
                                            </div>
                                            <div><span class="small text-gray-500">December 2, 2019</span>
                                                <p>Spending Alert: We've noticed unusually high spending for your account.</p>
                                            </div>
                                        </a><a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
                                    </div>
                                </div>
                            </li>
                            <li class="nav-item dropdown no-arrow mx-1">
                                <div class="nav-item dropdown no-arrow"><a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown" href="#"><span class="badge bg-danger badge-counter">7</span><i class="fas fa-envelope fa-fw"></i></a>
                                    <div class="dropdown-menu dropdown-menu-end dropdown-list animated--grow-in">
                                        <h6 class="dropdown-header">alerts center</h6><a class="dropdown-item d-flex align-items-center" href="#">
                                            <div class="dropdown-list-image me-3"><img class="rounded-circle" src="assets/img/avatars/avatar4.jpeg">
                                                <div class="bg-success status-indicator"></div>
                                            </div>
                                            <div class="fw-bold">
                                                <div class="text-truncate"><span>Hi there! I am wondering if you can help me with a problem I've been having.</span></div>
                                                <p class="small text-gray-500 mb-0">Emily Fowler - 58m</p>
                                            </div>
                                        </a><a class="dropdown-item d-flex align-items-center" href="#">
                                            <div class="dropdown-list-image me-3"><img class="rounded-circle" src="assets/img/avatars/avatar2.jpeg">
                                                <div class="status-indicator"></div>
                                            </div>
                                            <div class="fw-bold">
                                                <div class="text-truncate"><span>I have the photos that you ordered last month!</span></div>
                                                <p class="small text-gray-500 mb-0">Jae Chun - 1d</p>
                                            </div>
                                        </a><a class="dropdown-item d-flex align-items-center" href="#">
                                            <div class="dropdown-list-image me-3"><img class="rounded-circle" src="assets/img/avatars/avatar3.jpeg">
                                                <div class="bg-warning status-indicator"></div>
                                            </div>
                                            <div class="fw-bold">
                                                <div class="text-truncate"><span>Last month's report looks great, I am very happy with the progress so far, keep up the good work!</span></div>
                                                <p class="small text-gray-500 mb-0">Morgan Alvarez - 2d</p>
                                            </div>
                                        </a><a class="dropdown-item d-flex align-items-center" href="#">
                                            <div class="dropdown-list-image me-3"><img class="rounded-circle" src="assets/img/avatars/avatar5.jpeg">
                                                <div class="bg-success status-indicator"></div>
                                            </div>
                                            <div class="fw-bold">
                                                <div class="text-truncate"><span>Am I a good boy? The reason I ask is because someone told me that people say this to all dogs, even if they aren't good...</span></div>
                                                <p class="small text-gray-500 mb-0">Chicken the Dog · 2w</p>
                                            </div>
                                        </a><a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
                                    </div>
                                </div>
                                <div class="shadow dropdown-list dropdown-menu dropdown-menu-end" aria-labelledby="alertsDropdown"></div>
                            </li>
                            <div class="d-none d-sm-block topbar-divider"></div>
                            <li class="nav-item dropdown no-arrow">
                                <div class="nav-item dropdown no-arrow"><a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown" href="#"><span class="d-none d-lg-inline me-2 text-gray-600 small">Valerie Luna</span><img class="border rounded-circle img-profile" src="assets/img/avatars/avatar4.jpeg"></a>
                                    <div class="dropdown-menu shadow dropdown-menu-end animated--grow-in"><a class="dropdown-item" href="#"><i class="fas fa-user fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Profile</a><a class="dropdown-item" href="#"><i class="fas fa-cogs fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Settings</a><a class="dropdown-item" href="#"><i class="fas fa-list fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Activity log</a>
                                        <div class="dropdown-divider"></div><a class="dropdown-item" href="#"><i class="fas fa-sign-out-alt fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Logout</a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
                <div class="container-fluid">
                    <h3 class="text-dark mb-4">Scaffolding Inventory Info</h3>
                    <div class="card shadow">
                        <div class="card-header py-3">
                            <p class="text-primary m-0 fw-bold">Inventory</p>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 text-nowrap">
                                    <div id="dataTable_length" class="dataTables_length" aria-controls="dataTable">
                                        <label class="form-label">Show&nbsp;
                                            <select class="d-inline-block form-select form-select-sm" onchange="location.href = '?rowsPerPage=' + this.value;">
                                                <option value="10" <?php if ($rowsPerPage == 10) echo "selected"; ?>>10</option>
                                                <option value="25" <?php if ($rowsPerPage == 25) echo "selected"; ?>>25</option>
                                                <option value="50" <?php if ($rowsPerPage == 50) echo "selected"; ?>>50</option>
                                                <option value="100" <?php if ($rowsPerPage == 100) echo "selected"; ?>>100</option>
                                            </select>&nbsp;
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="text-md-end dataTables_filter" id="dataTable_filter">
                                        <form method="GET" action="item_search.php">
                                        <label class="form-label">
                                            <input type="search" class="form-control form-control-sm" aria-controls="dataTable" placeholder="Search ItemCode" name="itemCode">
                                        </label>
                                        <button type="submit" class="btn btn-primary btn-sm">Search</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                                <table class="table my-0" id="dataTable">
                                    <thead>
                                        <tr>
                                            <th>Item Code</th>
                                            <th>Item Name</th>
                                            <th>Category</th>
                                            <th>Purchase Price</th>
                                            <th>Market Price</th>
                                            <th>Quantity</th>
                                            <th></th>
                                            <th><a id="add-item-btn" class="btn btn-primary btn-circle ms-1" role="button" href="item_add.php"><i class="fas fa-plus text-white" style="font-size: 17pbx;"></i></a></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php while ($row = mysqli_fetch_assoc($result)) {
                                            echo "<tr> 
                <td>" . $row["itemCode"] . "</td>
                <td>" . $row["itemName"] . "</td>
                <td>" . $row["category"] . "</td>
                <td>" . $row["purchasePrice"] . "</td>
                <td>" . $row["marketPrice"] . "</td>
                <td>" . $row["quantity"] . "</td>
                <td>
                <button class='btn btn-danger btn-circle ms-1 edit-item-btn' data-item-code='" . $row["itemCode"] . "' role='button' href='#' style='background: #3ab795;border-color: #3ab795;'>
        <i class='fas fa-pencil-alt text-white' style='font-size: 16px;'></i>
    </button>
</td>
<td>
<button class='btn btn-danger btn-circle ms-1 delete-item-btn' data-item-code='" . $row["itemCode"] . "'>
    <i class='fas fa-trash text-white' style='font-size: 17px;'></i>
</button>
</td>
            </tr>";
                                        } ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td><strong>Item Code</strong></td>
                                            <td><strong>Item Name</strong></td>
                                            <td><strong>Category</strong></td>
                                            <td><strong>Purchased Price</strong></td>
                                            <td><strong>Market Price</strong></td>
                                            <td><strong>Quantity</strong></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <div class="row">
                                <div class="col-md-6 align-self-center">
                                    <p id="dataTable_info" class="dataTables_info" role="status" aria-live="polite"></p>
                                </div>
                                <div class="col-md-6">
                                    <nav class="d-lg-flex justify-content-lg-end dataTables_paginate paging_simple_numbers">
                                        <ul class="pagination">
                                            <?php
                                            // Get the total number of records
                                            $sql = "SELECT COUNT(*) AS count FROM inventory";
                                            $result_count = mysqli_query($conn, $sql);
                                            $row_count = mysqli_fetch_assoc($result_count);
                                            $totalRecords = $row_count['count'];

                                            // Calculate the total number of pages
                                            $totalPages = ceil($totalRecords / $rowsPerPage);

                                            $prevDisabled = ($page == 1) ? "disabled" : "";
                                            $nextDisabled = ($page == $totalPages) ? "disabled" : "";
                                            echo '<li class="page-item ' . $prevDisabled . '"><a class="page-link" aria-label="Previous" href="?rowsPerPage=' . $rowsPerPage . '&page=' . ($page - 1) . '"><span aria-hidden="true">«</span></a></li>';
                                            // Generate pagination links
                                            for ($i = 1; $i <= $totalPages; $i++) {
                                                $activeClass = ($page == $i) ? "active" : "";
                                                echo '<li class="page-item ' . $activeClass . '"><a class="page-link" href="?rowsPerPage=' . $rowsPerPage . '&page=' . $i . '">' . $i . '</a></li>';
                                            }
                                            echo '<li class="page-item ' . $nextDisabled . '"><a class="page-link" aria-label="Next" href="?rowsPerPage=' . $rowsPerPage . '&page=' . ($page + 1) . '"><span aria-hidden="true">»</span></a></li>';

                                            ?>

                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <footer class="bg-white sticky-footer">
                <div class="container my-auto">
                    <div class="text-center my-auto copyright"></div>
                </div>
            </footer>
        </div><a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a>
    </div>
    <script src="assets/bootstrap1.min.js"></script>
    <script src="assets/bs-init1.js"></script>
    <script src="assets/theme1.js"></script>
</body>

<script>
    // Get a reference to the button element
    const addButton = document.getElementById('add-item-btn');

    // Add a click event listener to the button
    addButton.addEventListener('click', function(event) {
        // Prevent the default behavior of the link
        event.preventDefault();

        // Calculate the position of the popup window
        const width = 600;
        const height = 400;
        const left = (screen.width / 2) - (width / 2);
        const top = (screen.height / 2) - (height / 2);

        // Open the popup window
        window.open('item_add.php', 'Popup Window', `width=${width},height=${height},left=${left},top=${top}`);
    });
</script>

<script>
    // Get a reference to all the edit buttons
    const editButtons = document.querySelectorAll('.edit-item-btn');

    // Add a click event listener to each edit button
    editButtons.forEach(function(editButton) {
        editButton.addEventListener('click', function(event) {
            // Prevent the default behavior of the link
            event.preventDefault();

            // Get the itemCode of the item that needs to be edited
            const itemCode = editButton.getAttribute('data-item-code');

            // Calculate the position of the popup window
            const width = 600;
            const height = 400;
            const left = (screen.width / 2) - (width / 2);
            const top = (screen.height / 2) - (height / 2);

            // Open the popup window with the item_edit.php page and pass the itemCode in the URL
            window.open(`item_edit.php?itemCode=${itemCode}`, 'Popup Window', `width=${width},height=${height},left=${left},top=${top}`);
        });
    });
</script>

<script>
    // Get a reference to all the delete buttons
    const deleteButtons = document.querySelectorAll('.delete-item-btn');

    // Add a click event listener to each delete button
    deleteButtons.forEach(function(deleteButton) {
        deleteButton.addEventListener('click', function(event) {
            // Prevent the default behavior of the button
            event.preventDefault();

            // Get the itemCode of the item that needs to be deleted
            const itemCode = deleteButton.getAttribute('data-item-code');

            // Show a confirmation dialog box
            const confirmed = confirm('Are you sure you want to delete this record?');

            // If the user clicked "OK", delete the record
            if (confirmed) {
                window.location.href = `item_delete.php?itemCode=${itemCode}`;
            }
        });
    });
</script>

</html>