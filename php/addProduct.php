<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="Description" content="Enter your description here" />
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <title>OOP session 1</title>
</head>

<body>
	
<div class="container">
        <form action="" method="post" class="w-50 mt-4">
        <div class="form-group">
                <label for="length">Link ảnh</label>
                <input type="text" class="form-control" name="image" >
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
            <button type="submit" name="submit" class="btn btn-primary" >Add</button>
        </form>

        <?php
        
        if (!empty($_POST["image"]) && !empty($_POST["name"]) && !empty($_POST["des"]) && !empty($_POST["price"]) && !empty($_POST["num"])) {
        require "Libraries.php";
        $image=$_POST['image'];
        $name=$_POST['name'];
        $des=$_POST['des'];
        $price=$_POST['price'];
        $num=$_POST['num'];
        
        if(!file_exists("Products.json")){
            $file = fopen("Products.json","w");
            fclose($file);
        }
        $arr = readFileData("Products.json");
        if(is_array($arr)){
            $count = count($arr);
        }else {
            $count = 0;
        }

        $data = array("id"=> "Prd$count", "image"=>$image, "name"=>$name, "des"=>$des, "price"=>$price, "num"=>$num);
    
        writeFileData("Products.json",$data);
        } 
        ?>

</div>

</body>

</html>