<?php
require "FileFunction.php";
class Custommer{
    private $id;
    private $fullname;
    private $email;
    private $phone;
    private $address;
    private $password;

    public function __construct(array $customer)
    {
        $this->id = $customer["id"];
        $this->fullname = $customer["fullname"];
        $this->email = $customer["email"];
        $this->phone = $customer["phone"];
        $this->address = $customer["address"];
        $this->password = $customer["password"];
    }
    public function getId(){
        return $this->id;
    }
    public function getFullName(){
        return $this->fullname;
    }
    public function getEmail(){
        return $this->email;
    }
    public function getPhone(){
        return $this->phone;
    }
    public function getAddress(){
        return $this->address;
    }
    public function getPassword(){
        return $this->password;
    }
}

class Product
{
    private $image;
    private $id;
    private $name;
    private $price;
    private $num;
    private $des;


    // Methods
    function setImage($image)
    {
        $this->image = $image;
    }
    function getImage()
    {
        return $this->image;
    }
    function getId()
    {
        return $this->id;
    }

    function setName($name)
    {
        $this->name = $name;
    }
    function getName()
    {
        return $this->name;
    }

    function setDes($des)
    {
        $this->des = $des;
    }
    function getDes()
    {
        return $this->des;
    }

    function setPrice($price)
    {
        $this->price = $price;
    }
    function getPrice()
    {
        return $this->price;
    }

    function setNum($num)
    {
        $this->num = $num;
    }
    function getNum()
    {
        return $this->num;
    }


    //Constructor
    function __construct(array $product)
    {
        $this->id = $product["id"];
        $this->image = $product["image"];
        $this->name = $product["name"];
        $this->des = $product["des"];
        $this->price = $product["price"];
        $this->num = $product["num"];
    }

    
}
class OrderDetail
{
    private $orderDetailId;
    private $productId;
    private $quantity;

    function __construct($orderDetailId, $productId, $quantity)
    {
        $this->orderDetailId = $orderDetailId;
        $this->productId = $productId;
        $this->quantity = $quantity;
    }


    function getProductId()
    {
        return $this->productId;
    }
    function getQuantity()
    {
        return $this->quantity;
    }
    public function getProduct() {
        $productArr = readFileData("Products.json");
        foreach($productArr as $product) {
            if ($this->id == $product["id"]){
                return $product;
            }
        }
    }
    public function getAmount() {
        return $this->getProduct()["price"]*$this->quantity;
    }
    public function convertArray(){
        return array("orderDetailId"=>$this->orderDetailId,"productId"=>$this->productId, "quantity"=>$this->quantity);
    }
    
}
class PaymentMethod
{
    private $id;
    private $name;
    private $fee;

    public function __construct($id, $name, $fee)
    {
        $this->id = $id;
        $this->name = $name;
        $this->fee = $fee;
    }
    public function setId($id)
    {
        $this->id = $id;
    }
    public function getId()
    {
        return $this->id;
    }
    public function setName($name)
    {
        $this->name = $name;
    }
    public function getName()
    {
        return $this->name;
    }
    public function setFee($fee)
    {
        $this->fee= $fee;
    }
    public function getFee()
    {
        return $this->fee;
    }
    
}

class Order
{
    private $id;
    private $date;
    private $status;
    private $paymentMethodId;
    private $orderDetailArr;
    private $customerId;
    private $totalPrice;
    private $address;
    

    //Constructor
    function __construct($orderId, $paymentMethodId, $customerId)
    {
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $this->id = $orderId;
        $this->status = "Chờ xác nhận";
        $this->paymentMethodId = $paymentMethodId;
        $this->customerId = $customerId;
        $this->totalPrice = 0;
        $this->orderDetailArr = [];
    }

    //Getter and Setter
    public function getOrderId()
    {
        return $this->id;
    }
    public function getDate()
    {
        return $this->date = date("F j, Y, g:i a");;
    }
    public function setStatus($status)
    {
        $this->status = $status;
    }
    public function getStatus()
    {
        return $this->status;
    }
    public function setAddress($address)
    {
        $this->address = $address;
    }
    public function getAddress()
    {
        return $this->address;
    }
    public function getOrderDetailArr() {
        return $this->orderDetailArr;
    }
    public function getPaymentMethodId() {
        return $this->paymentMethodId;
    }
    public function setPaymentMethodId($paymentMethodId) {
        $this->paymentMethodId = $paymentMethodId;
    }
    public function addDetail(OrderDetail $orderDetail) {
        if(!empty($this->getOrderDetailArr())){
            array_push($this->getOrderDetailArr, $orderDetail->convertArray());
        }else{
            $this->orderDetailArr[] = $orderDetail->convertArray();
        }
    }

    public function convertArray(){;
        return array("id"=>$this->id, "date"=> $this->date, "status"=> $this->status, "paymentMethodId"=>$this->paymentMethodId, "orderDetailArr"=>$this->orderDetailArr, "customerId"=> $this->customerId,"totalPrice"=>$this->totalPrice,"address"=>$this->address);
    }

    public function getTotalPrice() {
        return $this->totalPrice;
    }
    public function setTotalPrice($totalPrice){
        $this->totalPrice = $totalPrice;
    }
}
// preg_match ("/^[0-9]*$/", $_POST["quantity"])