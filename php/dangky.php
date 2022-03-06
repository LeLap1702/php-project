<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký</title>
    <link rel="stylesheet" href="../Css/dk.css">
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/@emailjs/browser@3/dist/email.min.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>


</head>

<body>

    <div id="comeback-btn">
        <p style="text-align: center;">Chào mừng bạn, vui lòng đăng ký!</p>
    </div>

    <div class="container">
        <div class="imga">
        </div>
        <div class="loginBox">
            <h3 style="text-align: center;"> Welcome to our website <br> Please register</h3>
            <form action="" method="POST">
                <div class="inputBox">
                    <span>
						<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-lines-fill" viewBox="0 0 16 16">
                <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm-5 6s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zM11 3.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5zm.5 2.5a.5.5 0 0 0 0 1h4a.5.5 0 0 0 0-1h-4zm2 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1h-2zm0 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1h-2z"/>
                </svg>
					</span>
                    <input type="text" id="name" name="name" placeholder="Họ và tên...." required>
                </div>
                <div class="inputBox">
                    <span>
						<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-lines-fill" viewBox="0 0 16 16">
                    <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm-5 6s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zM11 3.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5zm.5 2.5a.5.5 0 0 0 0 1h4a.5.5 0 0 0 0-1h-4zm2 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1h-2zm0 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1h-2z"/>
                    </svg>
					</span>
                    <input type="text" id="phone" name="phone" placeholder="Số điện thoại..." required>
                </div>
                <div class="inputBox">
                    <span>
						<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-lines-fill" viewBox="0 0 16 16">
                    <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm-5 6s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zM11 3.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5zm.5 2.5a.5.5 0 0 0 0 1h4a.5.5 0 0 0 0-1h-4zm2 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1h-2zm0 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1h-2z"/>
                    </svg>
					</span>
                    <input type="text" id="email" name="email" placeholder="Email của bạn...." required>
                </div>
                <div class="inputBox">
                    <span>
						<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-lock2-fill" viewBox="0 0 16 16">
                <path d="M7 6a1 1 0 0 1 2 0v1H7V6z"/>
                <path d="M12 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zm-2 6v1.076c.54.166 1 .597 1 1.224v2.4c0 .816-.781 1.3-1.5 1.3h-3c-.719 0-1.5-.484-1.5-1.3V8.3c0-.627.46-1.058 1-1.224V6a2 2 0 1 1 4 0z"/>
                </svg>
					</span>
                    <input type="password" id="mk" name="password" placeholder="Mật khẩu..." required>
                </div>
                <button type="submit" class="login" >Đăng ký</button>
                <hr style="margin-top: 30px;">
                <a href="Home.php"> Quay lại Trang chủ</a>
            </form>

            <?php 
            require "Libraries.php";

            if(!empty($_POST["name"]) && !empty($_POST["phone"]) && !empty($_POST["email"]) && !empty($_POST["phone"]) && !empty($_POST["password"])){
                if(!file_exists("Customers.json") ){
                    $file = fopen("Customers.json","w");
                    fclose($file);
                }
                $arr = readFileData("Customers.json");
                if(is_array($arr)){
                    $count = count($arr);
                }else {
                    $count = 0;
                }

                if(!file_exists("Orders.json") ){
                    $orderFile = fopen("Orders.json","w");
                    fclose($orderFile);
                }
                $orderArr = readFileData("Orders.json");
                if(is_array($orderArr)){
                    $orderCount = count($orderArr);
                }else {
                    $orderCount = 0;
                }

                $name = $_POST["name"];
                $phone = $_POST["phone"];
                $email = $_POST["email"];
                $password = $_POST["password"];

                $CusArr = array("id"=>"Cus$count", "fullname"=> $name, "email"=> $email, "phone"=> $phone, "password"=> $password);
                $OrderArr = new Order("Order$orderCount","Pay0","Cus$count");
                session_start();
                $_SESSION["orderId"]= "Order$orderCount";

                writeFileData("Customers.json",$CusArr);
                writeFileData("Orders.json",$OrderArr->convertArray());
                header('Refresh: 1; Home.php');

            }
            ?>

        </div>
    </div>

    
</body>

</html>