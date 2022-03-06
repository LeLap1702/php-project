<?php
session_start();


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>juno </title>
    <link rel="stylesheet" href="../Css/mainstyle.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js "></script>
</head>

<body>
    <?php
    require "Libraries.php";
    $customerArr = readFileData("Customers.json");
    $ProductsArr = readFileData("Products.json")

    ?>
    <div class="container">
        <div class="menu-bar" id="menu">
            <a class="navbar-brand" href="#">
                <img src="https://gigamall.com.vn/data/2019/09/20/17074742_LOGO-JUNO-500x500.jpg" alt="logo" style="width:100px;">
            </a>
            <ul class="active">
                <li>
                    <a href="">TRANG CHỦ</a>
                </li>
                <li>
                    <a href="">HÀNG MỚI</a>
                </li>
                <li>
                    <a href="">SẢN PHẨM </a>
                </li>
                <li>
                    <a href="">UNSTOPPABLEW YEAR</a>
                </li>
                <li>
                    <a href="">SHOWROOM</a>
                </li>
                <li>
                    <!-- Button trigger modal -->
                    <a data-toggle="modal" class="cursor_pointer" data-target="#exampleModalLong">
                        THÊM SẢN PHẨM
                    </a>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">ADD PRODUCT FORM</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="" method="post" class="text-left mt-4">
                                        <div class="form-group">
                                            <label for="length">Link ảnh</label>
                                            <input type="text" class="form-control" name="image">
                                        </div>
                                        <div class="form-group">
                                            <label for="width">Tên hàng</label>
                                            <input type="text" class="form-control" name="name" placeholder="Enter the name">
                                        </div>
                                        <div class="form-group">
                                            <label for="width">Mô tả</label>
                                            <input type="text" class="form-control" name="des" placeholder="Description">
                                        </div>
                                        <div class="form-group">
                                            <label for="width">Giá</label>
                                            <input type="text" class="form-control" name="price" placeholder="Enter the price">
                                        </div>
                                        <div class="form-group">
                                            <label for="width">Số lượng</label>
                                            <input type="text" class="form-control" name="num" placeholder="Enter number">
                                        </div>

                                        <?php

                                        if (!empty($_POST["image"]) && !empty($_POST["name"]) && !empty($_POST["des"]) && !empty($_POST["price"]) && !empty($_POST["num"])) {
                                            $image = $_POST['image'];
                                            $name = $_POST['name'];
                                            $des = $_POST['des'];
                                            $price = $_POST['price'];
                                            $num = $_POST['num'];

                                            if (!file_exists("Products.json")) {
                                                $file = fopen("Products.json", "w");
                                                fclose($file);
                                            }
                                            $arr = readFileData("Products.json");
                                            if (is_array($arr)) {
                                                $count = count($arr);
                                            } else {
                                                $count = 0;
                                            }

                                            $data = array("id" => "Prd$count", "image" => $image, "name" => $name, "des" => $des, "price" => $price, "num" => $num);

                                            writeFileData("Products.json", $data);
                                        }
                                        ?>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" name="submit" class="btn btn-primary">Add</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="row">
                        <button type="button" class="btn" id="icons" data-toggle="modal" data-target="#myModal">
                            <i class="fas fa-search"></i> |
                        </button>
                        <!-- Modal -->
                        <div class="modal fade" id="myModal" role="dialog">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-contents">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h2 style="color: rgb(90, 74, 5);">Tìm kiếm trong tài khoản NEM fashion </h2>
                                    <form action="">

                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" style="width:50%px" placeholder="Bắt đầu tìm kiếm...">
                                            <div class="input-group-append">
                                                <button class="btn btn-dark" type="button"><i class="fas fa-search"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="row">
                        <button type="button" class="btn " id="icons" data-toggle="modal" data-target=".bg-example-modal-lg">
                            <i class="fas fa-user-circle"></i> Đăng nhập |
                        </button>

                        <div class="modal fade bg-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-5 col-lg-5 block-image">
                                                <img src="https://image.shutterstock.com/image-vector/contact-icon-vector-triangulation-art-260nw-1741357919.jpg" alt="" class="img-responsive">
                                            </div>
                                            <div class="col-md-6 col-lg-6 block-contact">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <form action="" method="post">
                                                    <h2 style="color: rgb(90, 74, 5);">TRANG TÀI KHOẢN CỦA JUNO FASHION
                                                    </h2>
                                                    <div class="form-group">
                                                        <input type="email" class="form-control" name="email" placeholder="Email">
                                                    </div>
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" name="pass" placeholder="Mật khẩu">
                                                    </div>

                                                    <button type="submit" class="btn btn-primary btn-block" name="sigin">Đăng nhập</button>
                                                    
                                                    <br>
                                                    <p class="lost">
                                                        <a href="#" style="color: black"> <a class="text-center" href="dangky.php" id="a1">Đăng kí tài khoản mới</a></a>
                                                    </p>
                                                </form>
                                                <?php
                                                    if(isset($_POST["sigin"]) && !empty($_POST["email"]) && !empty($_POST["pass"])){
                                                        $email = $_POST["email"];
                                                        $pass = $_POST["pass"];
                                                        for ($i = 0; $i< count($customerArr); $i++){
                                                            if($customerArr[$i]["email"]==$email && $customerArr[$i]["password"]==$pass){
                                                                $_SESSION["customerId"] = $customerArr[$i]["id"];
                                                                
                                                            }
                                                        }
                                                    }

                                                    ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                <li>
                    <a href="./bill.php " style="color: black;"> <i class="fas fa-shopping-bag"></i> Giỏ hàng</a>
                </li>
            </ul>
        </div>
        <br>
        <div id="demo" class="carousel slide" data-ride="carousel">
            <ul class="carousel-indicators">
                <li data-target="#demo" data-slide-to="0" class="active"></li>
                <li data-target="#demo" data-slide-to="1"></li>
                <li data-target="#demo" data-slide-to="2"></li>
            </ul>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="https://codex-themes.com/thegem/sites/shop-online/wp-content/uploads/2019/03/1.jpg" alt="Los Angeles" width="100%" height="500">
                </div>
                <div class="carousel-item">
                    <img src="https://file.hstatic.net/1000003969/file/banner-web-1920x870-new_792610d2f7e04e9683e3c5635a74e262.jpg" alt="Chicago" width="100%" height="500">
                </div>
                <div class="carousel-item">
                    <img src="https://file.hstatic.net/1000003969/file/banner-cho-voucher-login_1200x900_2_1435af7667254bb8830b4ec3ac5b39ab.jpg" alt="New York" width="100%" height="500">
                </div>
            </div>
            <a class="carousel-control-prev" href="#demo" data-slide="prev">
                <span class="carousel-control-prev-icon"></span>
            </a>
            <a class="carousel-control-next" href="#demo" data-slide="next">
                <span class="carousel-control-next-icon"></span>
            </a>
        </div>
        <br>
        <div class="sanpham1">
            <div>
                <h1>HÀNG MỚI VỀ
                </h1>
                <p style="color: black;"> Các sản phẩm bắt nhịp quốc tế, nàng thời thượng không nên bỏ lỡ</p>
            </div>
            <div class="container text-center my-3">
                <div id="recipeCarousel" class="carousel slide w-100" data-ride="carousel">
                    <div class="carousel-inner w-100" role="listbox">
                        <div class="carousel-item row no-gutters active">
                            <?php
                            $ProductsArr = readFileData("Products.json");
                            $html = '';
                            for ($i = 0; $i < 4; $i++) {
                                $html .= '<div class="col-3 float-left">
                            <div class="card  mr-1 ">
                                <img src="' . $ProductsArr[$i]["image"] . '" class="d-block w-100" >
                                    <div class="card-body ">
                                        <p>
                                            <a href="#" style="color: rgb(54, 52, 19);">' . $ProductsArr[$i]["name"] . '</a>
                                        </p>
                                        <p style="color: black;">' . $ProductsArr[$i]["price"] . '₫</p>
                                        <button type="button" class="btn btn-info"><a href="ProductDetail.php/?productId=' . $ProductsArr[$i]["id"] . '">Xem chi tiết</a></button>
                                    </div>
                                </div>
                            </div>';
                            }
                            echo $html;
                            ?>
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#recipeCarousel" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#recipeCarousel" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>

                </div>
            </div>
        </div>
        <div class="sanpham2">
            <div>
                <h2>Gợi ý dành riêng cho bạn</h2>
            </div>
            <div class="sp row">
                <?php
                            
                    $ProductsArr = readFileData("Products.json");
                    $html = '';
                    for ($i = 4;  $i < 8; $i++) {
                    $html .= '<div class="infoItem col-md-3">
                    <div class="anh">
                        <img src="' . $ProductsArr[$i]["image"] . '" alt="" style="width:100%;">
                        <marquee>' . $ProductsArr[$i]["name"] .' - '. $ProductsArr[$i]["price"] .'₫</marquee>
                        <button type="button" class="btn btn-info"><a href="ProductDetail.php/?productId=' . $ProductsArr[$i]["id"] . '">Xem chi tiết</a></button>
                    </div>
                </div>
                ';
                    }
                    echo $html;
                ?>
            </div>
        </div>
        <div class="spdb">
            <div class="content2" style="margin-top: 30px;">
                <h3>NHÓM SẢN PHẨM ĐƯỢC QUAN TÂM NHẤT</h3>
            </div>
            <br>
            <div class="row">
            <?php
                            
                $ProductsArr = readFileData("Products.json");
                $html = '';
                for ($i = 9; $i < 12; $i++) {
                    $html .= '<div class="col-md-4 text-center">
                    <div class="anhqt">
                        <img src="' . $ProductsArr[$i]["image"] . '" alt="" style="width:100%;">
                        <marquee>' . $ProductsArr[$i]["name"] .' - '. $ProductsArr[$i]["price"] .'₫</marquee>
                        <button type="button" class="btn btn-info"><a href="ProductDetail.php/?productId=' . $ProductsArr[$i]["id"] . '">Xem chi tiết</a></button>
                    </div>
                </div>
                ';
                }
                echo $html;
                ?>
            </div>
        </div>
    </div>
    <hr>
    <div class="footer">
        <div class="container">
            <h4>JUNO- THỜI TRANG CÔNG SỞ</h4>
            <div class="row">
                <div class="col-md-3">
                    <p>Công ty TNHH Dịch vụ và Thương mại An Thành.</p>
                    <p>Số ĐKKD 0107861393, Sở KHĐT Tp. Hà Nội cấp ngày 04/10/2017</p>
                    <p>Địa chỉ: Phòng 1002, tầng 10, Tòa nhà NEM số 545 đường Nguyễn Văn Cừ, P. Gia Thụy, Q. Long Biên,
                        Hà Nội</p>
                    <p>Hotline: 024 3938 8512</p>
                    <p>Email: nemcskh@stripe-vn.com</p>
                </div>
                <div class="col-md-3">
                    <p>
                        <a href="#">Giới thiệu</a>
                    </p>
                    <p>
                        <a href="# ">NEM's Blog</a>
                    </p>
                    <p>
                        <a href="# ">Tuyển Dụng</a>
                    </p>
                    <p>
                        <a href="# ">Hệ thống showroom</a>
                    </p>
                    <p>
                        <a href="# ">Liên hệ</a>
                    </p>
                </div>
                <div class="col-md-3 ">
                    <p>
                        <a href="# ">Chính sách giao nhận - vận chuyển</a>
                    </p>
                    <p>
                        <a href="# ">Hướng dẫn thanh toán</a>
                    </p>
                    <p>
                        <a href="# ">Tra cứu đơn hàng</a>
                    </p>
                    <p>
                        <a href="# ">Hướng dẫn chọn size</a>
                    </p>
                    <p>
                        <a href="# ">Quy định đơn hàng</a>
                    </p>
                    <p>
                        <a href="# ">Quy định bảo hành và sửa chữa</a>
                    </p>
                    <p>
                        <a href="# ">Khách hàng thân thiết</a>
                    </p>
                </div>
                <div class="col-md-3 ">
                    <p>
                        <a href="# ">Phương thức thanh toán</a>
                    </p>
                    <div>
                        <img src="https://theme.hstatic.net/200000182297/1000658038/14/image_method_3.png?v=1642 " alt="phương thức tt ">
                    </div>
                    <br>
                    <div>
                        <img src="https://theme.hstatic.net/200000182297/1000658038/14/bct.png?v=1642 " alt="logo " width="100px ">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr>
    </div>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="slider/frontend/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js" integrity="sha512-HGOnQO9+SP1V92SrtZfjqxxtLmVzqZpjFFekvzZVWoiASSQgSr4cw9Kqd2+l8Llp4Gm0G8GIFJ4ddwZilcdb8A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.js" integrity="sha512-eP8DK17a+MOcKHXC5Yrqzd8WI5WKh6F1TIk5QZ/8Lbv+8ssblcz7oGC8ZmQ/ZSAPa7ZmsCU4e/hcovqR8jfJqA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

</body>

</html>