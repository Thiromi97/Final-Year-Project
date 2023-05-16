<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Table -Add Bill</title>
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
                    <li class="nav-item"><a class="nav-link" href="payment.php"><i class="fas fa-sticky-note" style="font-size: 13px;"></i><span>Payment</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="table.html"><i class="fas fa-file-invoice" style="font-size: 16px;"></i><span>Refund</span></a></li>
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
                    <h3 class="text-dark mb-4">Scaffolding Bill</h3>
                    <div class="card shadow">
                        <div class="card-header py-3">
                            <p class="text-primary m-0 fw-bold">Add New Bill</p>
                        </div>
                        <div class="card-body">
                            <form>
                                <div class="row">
                                    <div class="col-lg-8">
                                        <div>
                                            <div class="row">
                                                <div class="col">
                                                    <form><select class="form-select" name="Item">
                                                            <option value="Item 1">Item 1</option>
                                                            <option value="">Item 2</option>
                                                            <option value="13">Item 3</option>
                                                        </select></form>
                                                </div>
                                                <div class="col"><a class="btn btn-primary btn-icon-split" role="button"><span class="text-white-50 icon"><i class="fas fa-plus"></i></span><span class="text-white text">Add Item</span></a></div>
                                            </div>
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th>Item Code</th>
                                                            <th>Item Name</th>
                                                            <th>Quantity</th>
                                                            <th>Price</th>
                                                            <th></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>Item 1</td>
                                                            <td>Jack</td>
                                                            <td><input class="form-control" type="number"></td>
                                                            <td><input class="form-control" type="number"></td>
                                                            <td><a class="btn btn-danger btn-circle ms-1" role="button"><i class="fas fa-trash text-white"></i></a></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Item 2</td>
                                                            <td>Bolt</td>
                                                            <td><input class="form-control" type="number"></td>
                                                            <td><input class="form-control" type="number"></td>
                                                            <td><a class="btn btn-danger btn-circle ms-1" role="button"><i class="fas fa-trash text-white"></i></a></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <div><label class="form-label text-primary">Total Amount</label><input class="form-control" type="number" name="totalAmount" placeholder="Total Amount"></div>
                                            </div>
                                            <div class="col">
                                                <div></div><label class="form-label text-primary">Paid Amount</label><input class="form-control" type="number" name="paidAmount" placeholder="Paid Amount" required="">
                                            </div>
                                        </div>
                                        <div class="row" style="margin-top: 8px;">
                                            <div class="col">
                                                <div><label class="form-label text-primary">Remained Amount</label><input class="form-control" type="number" name="remainedAmount" placeholder="Remained Amount" required=""></div>
                                            </div>
                                            <div class="col" style="margin-bottom: 12px;">
                                                <div><label class="form-label text-primary">Payment Status</label><select class="form-select" name="paymentStatus" required="">
                                                        <option value="Paid">Paid</option>
                                                        <option value="Partialy Paid">Partialy Paid</option>
                                                        <option value="Unpaid">Unpaid</option>
                                                    </select></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col" style="margin-bottom: 18px;">
                                        <div>
                                            <form>
                                                <div><label class="form-label text-primary">Bill Code</label><input class="form-control" type="text" name="billCode" placeholder="Bill Code(BXXX format)"></div>
                                                <div style="margin-top: 12px;padding-bottom: 12px;"><label class="form-label text-primary">Customer Name</label><select class="form-select" name="customer">
                                                        <option value="undefined">Customer 1</option>
                                                        <option value="">Customer</option>
                                                        <option value="">Customer 3</option>
                                                    </select></div>
                                                <div style="padding-bottom: 12px;"><input class="form-control" type="text" name="customerCode" placeholder="Customer Code(CXX format)" required=""></div>
                                                <div style="padding-bottom: 12px;"><label class="form-label text-primary">Bill Date</label><input class="form-control" type="date" name="billDate" required=""></div>
                                                <div style="margin-bottom: 12px;"><label class="form-label text-primary">Due Date</label><input class="form-control" type="date" name="dueDate" required=""></div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div></div><a class="btn btn-primary btn-icon-split" role="button"><span class="text-white-50 icon"><i class="fas fa-save" style="font-size: 16px;"></i></span><span class="text-white text">Save</span></a>
                                    </div>
                                    <div class="col">
                                        <div></div><a class="btn btn-danger btn-icon-split" role="button"><span class="text-white-50 icon"><i class="fas fa-times-circle" style="font-size: 17px;"></i></span><span class="text-white text">Cancel</span></a>
                                    </div>
                                    <div class="col"><a class="btn btn-success btn-icon-split" role="button"><span class="text-white-50 icon"><i class="fas fa-pen-nib" style="font-size: 17px;"></i></span><span class="text-white text">Generate Invoice</span></a>
                                        <div></div>
                                    </div>
                                </div>
                            </form>
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

</html>