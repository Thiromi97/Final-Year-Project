<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>ADD BILL</title>
    <link rel="stylesheet" href="assets/bootstrap1.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i&amp;display=swap">
</head>

<body>
    <section class="py-4 py-xl-5">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-5 col-xxl-4">
                    <div class="card mb-5">
                        <div class="card-body p-sm-5">
                            <h2 class="text-center mb-4">New Bill</h2>
                            <form method="post">
                                <div class="mb-3"><label class="form-label">Bill Code</label><input class="form-control" type="text" id="name-2" name="billCode" placeholder="Bill Code(BXXX format)" minlength="4" maxlength="4" required=""></div>
                                <div class="mb-3"><label class="form-label">Customer Code</label><input class="form-control" type="text" id="name-1" name="customerCode" placeholder="Customer Code (CXX format)" minlength="3" maxlength="3" required=""></div>
                                <div class="mb-3"><label class="form-label">Bill Date</label><input class="form-control" type="date" name="billDate" required=""></div>
                                <div class="mb-3"><label class="form-label">Total Amount</label><input class="form-control" type="number" required="" name="totalAmount" placeholder="Total Amount"></div>
                                <div class="mb-3"><label class="form-label">Payment Status</label><select class="form-select" name="paymentSatus" value="paymentStatus" required="">
                                        <option value="Paid">Paid</option>
                                        <option value="Partialy Paid">Partialy Paid</option>
                                        <option value="Unpaid">Unpaid</option>
                                    </select></div>
                                <div class="mb-3"><label class="form-label">Due Date</label><input class="form-control" type="date" name="billDate" required=""></div>
                                <div class="mb-3"><label class="form-label">Remaining Amount</label><input class="form-control" type="number" required="" name="remainingAmount" placeholder="Remaning Amount"></div>
                                <div>
                                    <div class="row">
                                        <div class="col"><input class="btn btn-primary" type="submit" style="width: 100%;" name="Save" value="Save"></div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="assets/bootstrap1.min.js"></script>
    <script src="assets/bs-init1.js"></script>
    <script src="assets/theme1.js"></script>
</body>

</html>