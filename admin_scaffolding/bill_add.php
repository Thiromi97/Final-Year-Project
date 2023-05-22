<?php
// Assuming you have a database connection established
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "scaffolding";

// Create a connection
$connection = mysqli_connect($servername, $username, $password, $dbname);

// Check the connection
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

// Function to retrieve the market price based on the item code
function getMarketPrice($connection, $itemCode)
{
    $query = "SELECT marketPrice FROM inventory WHERE itemCode = '$itemCode'";
    $result = mysqli_query($connection, $query);
    $row = mysqli_fetch_assoc($result);
    return $row['marketPrice'];
}

// Initialize variables for messages
$successMessage = '';
$errorMessage = '';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $billCode = $_POST['billCode'];
    $paymentCode = $_POST['paymentCode'];

    $checkPayment = "SELECT * FROM payment WHERE paymentCode = '$paymentCode'";
    $checkAnsw = mysqli_query($connection, $checkPayment);

    if (mysqli_num_rows($checkAnsw) > 0) {
        $errorMessage = "Payment with the same paymentCode already exists.";
    } else {
        $checkQuery = "SELECT * FROM bill WHERE billCode = '$billCode'";
        $checkResult = mysqli_query($connection, $checkQuery);

        if (mysqli_num_rows($checkResult) > 0) {
            $errorMessage = "Bill with the same billCode already exists.";
        } else {
            // Insert record into the bill table
            $customerCode = $_POST['customerCode'];
            $billDate = $_POST['billDate'];
            $totalAmount = $_POST['totalAmount'];
            $paymentStatus = $_POST['paymentStatus'];
            $dueDate = $_POST['dueDate'];
            $remaningAmount = $_POST['remaningAmount'];
            $paidAmount = $_POST['paidAmount'];

            $insertBillQuery = "INSERT INTO bill (billCode, customerCode, billDate, totalAmount, paymentStatus, dueDate, remaningAmount) VALUES ('$billCode', '$customerCode', '$billDate', '$totalAmount', '$paymentStatus', '$dueDate', '$remaningAmount')";
            if (mysqli_query($connection, $insertBillQuery)) {
                // Get the inserted bill ID
                $billId = mysqli_insert_id($connection);

                // Insert records into the issued table for each item
                $addedItems = $_POST['itemCode'];
                $quantities = $_POST['quantity'];

                for ($i = 0; $i < count($addedItems); $i++) {
                    $itemCode = $addedItems[$i];
                    $quantity = $quantities[$i];
                    $marketPrice = getMarketPrice($connection, $itemCode);
                    $price = $quantity * $marketPrice;

                    $itemName = mysqli_real_escape_string($connection, $_POST['itemName'][$i]);

                    $insertIssuedQuery = "INSERT INTO issued (billCode, itemCode, itemName, quantity, price) VALUES ('$billCode', '$itemCode', '$itemName', '$quantity', '$price')";

                    mysqli_query($connection, $insertIssuedQuery);
                }

                $insertPaymentQuery = "INSERT INTO payment (paymentCode, billCode, customerCode, paymentDate, paymentAmount, isRefund) VALUES ('$paymentCode', '$billCode', '$customerCode', '$billDate', '$paidAmount', 'No')";
                mysqli_query($connection, $insertPaymentQuery);
                $successMessage = "Records inserted successfully.";
            } else {
                $errorMessage = "Error inserting records: " . mysqli_error($connection);
            }
        }
    }
}

// Close the database connection
// mysqli_close($connection);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Bill Add</title>
    <link rel="stylesheet" href="assets/bootstrap1.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i&amp;display=swap">
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
                    <li class="nav-item"><a class="nav-link" href="admin_scaffolding.php"><i class="fas fa-bars"></i><span>Dashboard</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="profile.php"><i class="fas fa-user"></i><span>Profile</span></a>
                    <li class="nav-item"><a class="nav-link" href="inventory.php"><i class="fas fa-cubes"></i><span>Inventory</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="customer.php"><i class="fas fa-user-friends" style="font-size: 13px;"></i><span>Customer</span></a>
                    <li class="nav-item"><a class="nav-link" href="issued.php"><i class="fas fa-box-open" style="font-size: 13px;"></i><span>Issued</span></a>
                    <li class="nav-item"><a class="nav-link" href="return.php"><i class="fas fa-archive"></i><span>Return</span></a>
                    <li class="nav-item"><a class="nav-link" href="bill.php"><i class="fas fa-table" style="font-size: 15px;"></i><span>Bill</span></a>
                    <li class="nav-item"><a class="nav-link active" href="bill_add.php"><i class="fas fa-newspaper" style="font-size: 16px;"></i><span>Add Bill</span></a>
                    <li class="nav-item"><a class="nav-link" href="payment.php"><i class="fas fa-sticky-note" style="font-size: 13px;"></i><span>Payment</span></a>
                    <li class="nav-item"><a class="nav-link" href="refund.php"><i class="fas fa-file-invoice" style="font-size: 16px;"></i><span>Refund</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="scaffolding_login.php"><i class="fas fa-sign-in-alt"></i><span>LogOut</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="settings.php"><i class="fas fa-cog"></i><span>Settings</span></a></li>
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
                    <h3 class="text-dark mb-4">Scaffolding Add Bill</h3>
                </div>
                <div class="card shadow mb-4" style="margin-left: 20px;margin-right: 20px;">
                    <div class="card-header py-3">
                        <h6 class="text-primary m-0 fw-bold">Add Bill</h6>
                    </div>
                    <div class="card-body">
                        <form method="post">
                            <div class="mb-3">
                                <div class="row">
                                    <div class="col-lg-9">
                                        <label class="form-label">Item Name List</label>
                                        <input class="form-control" type="text" id="search-bar" placeholder="Search for items" style="margin-bottom: 7px;padding-bottom: 3px;margin-top: 5px;">
                                        <?php
                                        $query = "SELECT itemCode,itemName FROM inventory";
                                        $result = mysqli_query($connection, $query);

                                        // Check if the query was successful
                                        if ($result && mysqli_num_rows($result) > 0) {
                                            // Start the <select> element
                                            echo '<select class="form-select" name="items" id="item-select">';

                                            // Loop through the results and create an <option> element for each item name
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                $itemCode = $row['itemCode'];
                                                $itemName = $row['itemName'];
                                                echo '<option value="' . $itemCode . '">' . $itemName . '</option>';
                                            }
                                            echo '</select>
                                         </div>
                                         <div class="col">
                                         <button class="btn btn-primary btn-icon-split" id="add-item-btn" type="button" style="margin-top: 38px;">
                                         <span class="text-white text">Add Item</span>
                                        </button>
                                         </div>
                                      </div>';
                                        } else {
                                            echo 'No items found in the inventory.';
                                        }


                                        // mysqli_close($connection);
                                        ?>
                                    </div>
                                    <div class="row">
                                        <div id="added-items-container"></div>
                                    </div>
                                    <div id="added-items-container"></div> <!-- Container to hold the added items -->
                                    <div class="mb-3"></div>
                                    <div class="mb-3"></div>
                                    <div class="mb-3" style="margin-bottom: 15px;"><label class="form-label">Total Amount</label><input class="form-control" type="number" name="totalAmount" id="totalAmount" readonly></div>
                                    <div class="mb-3"><label class="form-label">Paid Amount</label><input class="form-control" type="number" name="paidAmount" oninput="calculateRemainingAmount()"></div>
                                    <div class="mb-3"><label class="form-label">Remaining Amount</label><input class="form-control" type="number" name="remaningAmount" id="remaningAmount" readonly></div>
                                    <div class="mb-3"><label class="form-label">Payment Status</label><select class="form-select" name="paymentStatus">
                                            <option value="Paid">Paid</option>
                                            <option value="Partially Paid">Partially Paid</option>
                                            <option value="Unpaid">Unpaid</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <div class="row">
                                            <div class="col-lg-10"><label class="form-label">Customer Name</label>
                                                <input class="form-control" type="text" id="search-bar-customer" placeholder="Search for customers" style="margin-bottom: 7px;padding-bottom: 3px;margin-top: 5px;">
                                                <?php
                                                $query = "SELECT customerCode,customerName FROM customer";
                                                $result = mysqli_query($connection, $query);

                                                // Check if the query was successful
                                                if ($result && mysqli_num_rows($result) > 0) {
                                                    // Start the <select> element
                                                    echo '<select class="form-select" name="customerName" id="customer-select">';

                                                    // Loop through the results and create an <option> element for each item name
                                                    while ($row = mysqli_fetch_assoc($result)) {
                                                        $customerCode = $row['customerCode'];
                                                        $customerName = $row['customerName'];
                                                        echo '<option value="' . $customerCode . '">' . $customerName . '</option>';
                                                    }
                                                    echo '</select>
                                         </div>
                                         <div class="col">
                                         <button class="btn btn-primary btn-icon-split" id="add-customer-btn" type="button" style="margin-top: 38px;">
                                         <span class="text-white text">Add Customer</span>
                                        </button>
                                         </div>
                                      </div>';
                                                } else {
                                                    echo 'No customer found in the  customer table.';
                                                }

                                                mysqli_close($connection);
                                                ?>
                                            </div>
                                            <div class="mb-3"><label class="form-label">Customer Code</label><input class="form-control" type="text" name="customerCode" placeholder="Customer Code"></div>
                                            <div class="mb-3"><label class="form-label">Bill Code</label><input class="form-control" type="text" name="billCode" placeholder="Bill Code"></div>
                                            <div class="mb-3"><label class="form-label">Payment Code</label><input class="form-control" type="text" name="paymentCode" placeholder="Payment Code"></div>
                                            <div class="mb-3"><label class="form-label">Bill Date</label><input class="form-control" type="date" name="billDate"></div>
                                            <div class="mb-3"><label class="form-label">Due Date</label><input class="form-control" type="date" name="dueDate"></div>
                                            <div>
                                                <div class="row">
                                                    <div class="col"><input class="btn btn-primary" type="submit" style="width: 100%;" name="Save" value="Save"></div>
                                                </div>
                                            </div>
                        </form>
                        <?php
                    // Print the success or error messages
                    if (!empty($successMessage)) {
                        echo '<div class="alert alert-success">' . $successMessage . '</div>';
                    }
                    if (!empty($errorMessage)) {
                        echo '<div class="alert alert-danger">' . $errorMessage . '</div>';
                    }
                    ?>
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
    var searchBar = document.getElementById('search-bar');
    var itemSelect = document.getElementById('item-select');
    var originalItemOptions = Array.from(itemSelect.options);

    searchBar.addEventListener('input', function(event) {
        var searchTerm = event.target.value.toLowerCase();

        // Reset the select options
        itemSelect.innerHTML = '';

        // Filter the original options based on the search term
        var filteredOptions = originalItemOptions.filter(function(option) {
            var optionText = option.text.toLowerCase();
            return optionText.startsWith(searchTerm);
        });

        // Append the filtered options to the select element
        filteredOptions.forEach(function(option) {
            itemSelect.appendChild(option.cloneNode(true));
        });
    });

    var addItemBtn = document.getElementById('add-item-btn');
    var addedItemsContainer = document.getElementById('added-items-container');
    var totalAmountInput = document.getElementById('totalAmount');

    addItemBtn.addEventListener('click', function() {
        var itemSelect = document.getElementById('item-select');
        var selectedItemCode = itemSelect.value;
        var selectedItemName = itemSelect.options[itemSelect.selectedIndex].text;

        // Make an AJAX request to get the market price dynamically
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    var marketPrice = parseFloat(xhr.responseText);

                    var newItemContainer = document.createElement('div');
                    newItemContainer.className = 'row added-item';
                    newItemContainer.innerHTML = `
                        <div class="col" style="margin-bottom: 30px;">
                            <label class="form-label">Item Code</label>
                            <input class="form-control" type="text" name="itemCode[]" value="${selectedItemCode}" readonly>
                        </div>  
                        <div class="col" style="margin-bottom: 15px;">
                            <label class="form-label">Item Name</label>
                            <input class="form-control" type="text" name="itemName[]" value="${selectedItemName}" readonly>
                        </div> 
                        <div class="col" style="margin-bottom: 15px;">
                            <label class="form-label">Quantity</label>
                            <input class="form-control" type="number" name="quantity[]" oninput="calculatePrice(this)">
                        </div>  
                        <div class="col" style="margin-bottom: 15px;">
                            <label class="form-label">Price</label>
                            <input class="form-control" type="number" name="price[]" readonly data-market-price="${marketPrice}">
                        </div>
                        <div class="col">
                            <button class="btn btn-danger btn-circle ms-1" type="button" style="margin-top: 29px;" onclick="deleteItem(this)"><i class="fas fa-trash text-white"></i></button>
                        </div>
                    `;

                    addedItemsContainer.appendChild(newItemContainer);
                } else {
                    console.log('Error: ' + xhr.status);
                }
            }
        };

        xhr.open('GET', 'get_market_price.php?itemCode=' + selectedItemCode, true);
        xhr.send();
    });

    function deleteItem(element) {
        var row = element.closest('.added-item');
        row.remove();
        calculateTotalAmount();
    }

    function calculatePrice(input) {
        var quantity = input.value;
        var priceInput = input.parentElement.nextElementSibling.querySelector('input[name="price[]"]');
        var marketPrice = parseFloat(priceInput.dataset.marketPrice);

        if (!isNaN(quantity) && !isNaN(marketPrice)) {
            var calculatedPrice = quantity * marketPrice;
            // Update the price input with the calculated price
            priceInput.value = calculatedPrice.toFixed(2);

            calculateTotalAmount();
        }
    }

    function calculateTotalAmount() {
        var totalPrice = 0;
        var priceInputs = addedItemsContainer.querySelectorAll('input[name="price[]"]');

        // Calculate the total price by summing up all the item prices
        priceInputs.forEach(function(input) {
            var price = parseFloat(input.value);
            if (!isNaN(price)) {
                totalPrice += price;
            }
        });

        // Update the total amount input with the calculated total price
        totalAmountInput.value = totalPrice.toFixed(2);
        calculateRemainingAmount();
    }

    function calculateRemainingAmount() {
        var totalAmount = parseFloat(totalAmountInput.value);
        var paidAmount = parseFloat(document.getElementsByName('paidAmount')[0].value); // Parse paidAmount as float
        var remainingAmountInput = document.getElementById('remaningAmount');
        var remainingAmount = totalAmount - paidAmount;
        remainingAmountInput.value = remainingAmount.toFixed(2);
    }
</script>

<script>
   var searchBarCustomer = document.getElementById('search-bar-customer');
    var customerSelect = document.getElementById('customer-select');
    var originalCustomerOptions = Array.from(customerSelect.options);

    searchBarCustomer.addEventListener('input', function(event) {
        var searchTerm = event.target.value.toLowerCase();

        // Reset the select options
        customerSelect.innerHTML = '';

        // Filter the original options based on the search term
        var filteredOptions = originalCustomerOptions.filter(function(option) {
            var optionText = option.text.toLowerCase();
            return optionText.startsWith(searchTerm);
        });

        // Append the filtered options to the select element
        filteredOptions.forEach(function(option) {
            customerSelect.appendChild(option.cloneNode(true));
        });
    });
    var addCustomerBtn = document.getElementById('add-customer-btn');
    var addedCustomerContainer = document.getElementById('added-customers-container');

    addCustomerBtn.addEventListener('click', function() {
        var customerSelect = document.getElementById('customer-select');
        var selectedCustomerCode = customerSelect.value;

        // Retrieve the selected customer name
        var selectedCustomerName = customerSelect.options[customerSelect.selectedIndex].text;

        // Add the customer code to the input field
        var customerCodeInput = document.getElementsByName('customerCode')[0];
        customerCodeInput.value = selectedCustomerCode;
    });
</script>


</body>
</html>