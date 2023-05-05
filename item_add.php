<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>scaffolding</title>
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
                            <h2 class="text-center mb-4">New Item</h2>
                            <form method="post">
                                <div class="mb-3"><label class="form-label">Item Code</label><input class="form-control" type="text" id="name-2" name="ItemCode" placeholder="ZA" minlength="3" maxlength="3" required="" value="ZA"></div>
                                <div class="mb-3"><label class="form-label">Item Name</label><input class="form-control" type="text" id="name-3" name="ItemName" maxlength="200" required="" placeholder="ItemName"></div>
                                <div class="mb-3"></div>
                                <div class="mb-3"><label class="form-label">Category</label><select class="form-select" name="Category" required="" value="Category">
                                        <option value="Supplies">Supplies</option>
                                        <option value="Tools">Tools</option>
                                        <option value="Equipment">Equipment</option>
                                    </select></div>
                                <div class="mb-3"><label class="form-label">Purchased Price</label><input class="form-control" type="number" name="PurchasedPrice" max="100" placeholder="$" required=""></div>
                                <div class="mb-3"><label class="form-label">Market Price</label><input class="form-control" type="number" name="MarketPrice" max="100" placeholder="$" required=""></div>
                                <div class="mb-3"><label class="form-label">Quantity</label><input class="form-control" type="number" name="Quantity" max="100" required="" placeholder="Quantity"></div>
                                <div><button class="btn btn-primary d-block w-100" type="submit">Save</button></div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/bs-init.js"></script>
    <script src="assets/js/theme.js"></script>
</body>

</html>