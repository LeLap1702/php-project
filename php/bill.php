<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <title>Your Bill</title>
</head>

<body>
    <?php
    require "cart.php";
    if (isset($_POST["enter"])) {
$ordersArr = readFileData("Orders.json");
        foreach ($ordersArr as $order) {
            if ($order["id"] == $orderId) {
                $htmlCart .= '<tr>
                    <td colspan="6">Tổng tiền bạn cần thanh toán </td>
                    
                    <td class="text-danger">' . $order["totalPrice"] . '₫</td>
                    
                </tr>
                <tr>
                    <td colspan="6">Địa chỉ</td>
                    
                    <td class="text-danger">' . $order["address"] . '</td>
                    
                </tr>
                <tr>
                    <td colspan="6">Thời gian mua hàng</td>
                    
                    <td class="text-danger">' . $order["date"] . '</td>
                    
                </tr>
                
                ';
            }
        }
        echo '<div class="container" style="position: fixed; top:0; right:0; bottom:0; left:0 ; background-color:#ffff">
    <h1>Your Bill</h1>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Tên Sản Phẩm</th>
                    <th>Hình ảnh</th>
                    <th>Giá</th>
                    <th>Số lượng</th>
                    <th>Tổng tiền</th>
                    <th>Chỉnh sửa</th>
                </tr>
            </thead>
            <tbody>
                ' . $htmlCart . '
            </tbody>
        </table>
    <form method="post">
    <p clas="text-center">Chúc mừng bạn đã mua hàng thành công!</p>
    <br>
    
            <button type="submit" class="btn btn-primary my-3" name="backf">
        Quay lại trang mua hàng
    </button> </form>
    </div>';

            $_SESSION["orderId"] = $ordersArr[0]["id"];
        if (isset($_POST["backf"])) {
            header('Refresh: 1; ./Home.php');
        }
    }

    ?>



</body>

</html>