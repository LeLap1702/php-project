<?php
require "Libraries.php";
$productId = $_GET["productId"];
$productArr = readFileData("Products.json");
foreach ($productArr as $product) {
    if ($product["id"] == $productId) {

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="Description" content="Enter your description here" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <title><?php echo $product["name"] ?></title>
</head>

<body>
    <div class="container bg-secondary ">
        <div class="row pt-3">
            <div class="col-md-5 col-sm-12">
                <img src="<?php echo $product["image"] ?>" alt="">
            </div>
            <div class="col-md-7  col-sm-12 text-center">

                <form action="" method="POST">
                    <div class="input-group input-group-lg mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-warning">Tên sản phẩm</span>
                        </div>
                        <input type="text" class="form-control bg-success text-white" aria-label="Large"
                            value="<?php echo $product["name"] ?>" aria-describedby="inputGroup-sizing-sm" disabled>
                    </div>

                    <div class="input-group input-group-lg mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text  bg-warning">Giá sản phẩm</span>
                        </div>
                        <input type="text" class="form-control text-danger font-weight-bold bg-success"
                            aria-label="Large" value="<?php echo $product["price"] ?>₫"
                            aria-describedby="inputGroup-sizing-sm" disabled>
                    </div>

                    <div class="input-group input-group-lg mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text  bg-warning">Mô tả sản phẩm</span>
                        </div>
                        <input type="text" class="form-control bg-success text-white" aria-label="Large"
                            value="<?php echo $product["des"] ?>" aria-describedby="inputGroup-sizing-sm" disabled>
                    </div>

                    <div class="input-group input-group-lg mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text  bg-warning ">Chọn số lượng</span>
                        </div>
                        <input type="number" name="quantity" min="1" max="<?php echo $product["num"]?> "
                            class="form-control bg-success text-white" aria-label="Large"
                            aria-describedby="inputGroup-sizing-sm">
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <button type="submit" class="btn btn-outline-warning" name="addToCart"> Thêm vào giỏ
                                hàng</button>
                        </div>
                        <div class="col-6">
                            <button type="submit" class="btn btn-outline-warning" name="backHome"> Quay về trang
                                chủ</button>
                        </div>
                    </div>
                </form>
                <?php 
                if(isset($_POST["addToCart"]) && !empty($_POST["quantity"])){
                    $quantity =  $_POST["quantity"];
                    session_start();
                    $customerId = $_SESSION["customerId"];
                    $orderId = $_SESSION["orderId"];
                    
                    $ordersArr = readFileData("Orders.json");
                    $count;

                    for($i=0; $i<count($ordersArr); $i++){
                        if($ordersArr[$i]["customerId"]=$customerId){
                            if($ordersArr[$i]["id"]== $orderId){
                                $count = count($ordersArr[$i]["orderDetailArr"]);
                            $orderDetail = new OrderDetail("OrderDt$count",$productId,$quantity);
                            array_unshift($ordersArr[$i]["orderDetailArr"],$orderDetail->convertArray());
                            $newContent = json_encode($ordersArr, JSON_UNESCAPED_UNICODE);
                            file_put_contents("Orders.json", $newContent);
                            echo "Success!";
                            }
                            
                        }
                    }

                    // foreach($ordersArr as $order){
                    //     if($order["id"] == $orderId){
                    //         $count = count($order["orderDetailArr"]);
                    //         $orderDetail = new OrderDetail("OrderDt$count",$productId, $quantity);
                    //         array_unshift($order["orderDetailArr"],$orderDetail->convertArray());
                    //         $newContent = json_encode($ordersArr, JSON_UNESCAPED_UNICODE);
                    //         file_put_contents("Orders.json", $newContent);
                    //         echo "Success!";
                    //     }
                    // }

                }
                if(isset($_POST["backHome"]) || isset($_POST["addToCart"])){
                    header('Refresh: 1; ../Home.php');
                }
                ?>
            </div>
        </div>
    </div>
    <?php
    }
} 
?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.1/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"></script>
</body>

</html>