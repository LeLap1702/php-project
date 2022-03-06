<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <title>Your Cart</title>


</head>

<body>
    <?php
    require "Libraries.php";
    session_start();

    $customerId = $_SESSION["customerId"];
    if (isset($_SESSION["orderId"])) {
        $orderId = $_SESSION["orderId"];
    } else {
        $_SESSION["orderId"] = "Order0";
        $orderId = "Order0";
    }
    error_reporting(0);
    $ordersArr = readFileData("Orders.json");
    $productsArr = readFileData("Products.json");
    $customersArr = readFileData("Customers.json");
    $PaymentsArr = readFileData("Payments.json");
    for ($i = 0; $i < count($ordersArr); $i++) {
        if ($ordersArr[$i]["customerId"] == $customerId) {

            if (count($ordersArr[$i]["orderDetailArr"]) == 0 && $ordersArr[$i]["id"] == $orderId) {

                echo '<h1 class="text-center text-success mt-4">Bạn chưa thêm sản phẩm nào vào giỏ hàng</h1>';
            } else {

                if ($ordersArr[$i]["id"] == $orderId) {
                    $htmlCart = '';
                    $stt = 1;
                    $totalPrice = 0;
                    foreach ($ordersArr[$i]["orderDetailArr"] as $orderDetail) {
                        foreach ($productsArr as $product) {
                            if ($orderDetail["productId"] == $product["id"]) {
                                $totalPrice += $product["price"] * $orderDetail["quantity"];
                                $htmlCart .= '<tr>
                        <td>' . $stt . '</td>
                        <td>' . $product["name"] . '</td>
                        <td> <img src="' . $product["image"] . '" style="width: 100px; height: auto; object-fit:cover"> </td>
                        <td class="text-danger">' . $product["price"] . '₫</td>
                        <td> ' . $orderDetail["quantity"] . '</td>
                        <td class="text-danger">' . $product["price"] * $orderDetail["quantity"] . '₫</td>
                        <td >Chỉnh sửa</td>
                    </tr>';
                                $stt += 1;

                                break;
                            }
                        }
                    }
                    $htmlCart .= '<tr>
                    <td colspan="6">Tổng tiền </td>
                    
                    <td class="text-danger">' . $totalPrice . '₫</td>
                    
                </tr>';

                    // if(isset($_POST["enter"])){
                    //     header('Refresh: 1; ./Home.php');
                    // }
                    $_SESSION["totalPrice"] = $totalPrice;
                    echo '<div class="container">
                <table class="table table-hover">
            <thead>
            <tr>
            <th >STT</th>
            <th >Tên Sản Phẩm</th>
            <th >Hình ảnh</th>
            <th >Giá</th>
            <th >Số lượng</th>
            <th >Tổng tiền</th>
            <th >Chỉnh sửa</th>
            </tr>
            </thead>
            <tbody>
                ' . $htmlCart . '
            </tbody>
            </table>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#payment">
        Tiến hành thanh toán
    </button> <form method="post">
    <br>
            <button type="submit" class="btn btn-primary my-3" name="back">
        Quay lại trang mua hàng
    </button> </form>
            ';
                    if (isset($_POST["back"])) {
                        header('Refresh: 1; ./Home.php');
                    }
                }
            }
        }
    }
    ?>


    <!-- Modal -->
    <div class="modal fade" id="payment" tabindex="-1" role="dialog" aria-labelledby="paymentLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title" id="paymentLabel">THÔNG TIN KHÁCH HÀNG</h2>

                </div>
                <div class="modal-body">
                    <form action="bill.php" method="post">
                        <div class="input-groupmb-3">

                            <span class="input-group-text" id="inputGroup-sizing-sm">Địa chỉ</span>
                            <input type="text" class="form-control" aria-label="Small" name="customerAddress" required>
                        </div>

                        <div class="input-groupmb-3">
                            <span class="input-group-text" id="inputGroup-sizing-sm">Phương thức thanh toán</span> <br>
                            <?php
                            for ($i = 0; $i < count($PaymentsArr); $i++) {


                            ?>
                                <input type="radio" id="pm1" name="paymentMethod" value="<?php echo $PaymentsArr[$i + 2]["id"] ?>" checked>
                                <label for="pm1">Phương thức 1 </label><br>
                                <input type="radio" id="pm2" name="paymentMethod" value="<?php echo $PaymentsArr[$i + 1]["id"] ?>">
                                <label for="pm2">Phương thức 2 </label><br>
                                <input type="radio" id="pm3" name="paymentMethod" value="<?php echo $PaymentsArr[$i]["id"];
                                                                                            break;
                                                                                        } ?>">
                                <label for="pm3">Phương thức 3</label>

                        </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" name="enter">Xác nhận</button>
                    </form>
                    <?php
                    if (!empty($_POST["customerAddress"]) && isset($_POST["enter"])) {
                        for ($i = 0; $i < count($ordersArr); $i++) {
                            if ($ordersArr[$i]["customerId"] == $customerId) {
                                $orderObj = new Order($ordersArr[$i]["id"], $_POST["paymentMethod"], $customerId);
                                $ordersArr[$i]["date"] = $orderObj->getDate();
                                $paymentFee = 0;
                                $totalPrice = $_SESSION["totalPrice"];
                                foreach ($PaymentsArr as $payment) {
                                    if ($payment["id"] == $orderObj->getPaymentMethodId()) {
                                        $paymentFee = $payment["fee"];
                                    }
                                }
                                $ordersArr[$i]["totalPrice"] = $totalPrice - ($totalPrice * $paymentFee);
                                $ordersArr[$i]["paymentMethodId"] = $orderObj->getPaymentMethodId();
                                $newCount = count($ordersArr);
                                $newOrderObj = new Order("Order$newCount", "Pay0", $customerId);
                                $newOrderObj->setAddress($_POST["customerAddress"]);
                                array_unshift($ordersArr, $newOrderObj->convertArray());
                                overWriteFileData("Orders.json", $ordersArr);

                                break;
                            }
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>


    </div>


</body>

</html>