<?php require "./includes/header.php";

$id = $_POST['oid'];
$status = $_POST['order-status'];
$paymentstatus = $_POST['payment-status'];
$postprice = $_POST['post-price'];
$paymenttracking = $_POST['payment-tracking-code'];
$ordersubmit = $_POST['order-submited-date'];

if ($id== "" ||$status== "" ||$paymentstatus== "" ||$postprice== ""||$paymenttracking== ""||$ordersubmit== "")
{
  show_result("error","لطفا مقادیر معتبر را وارد کنید","","","Lc Melody","current"); //mode , text , button lable , button target ,title , window (current)
}



$id = (int)$id;
$paymentstatus = (int)$paymentstatus;


 $thequery = "UPDATE t_orders SET `o_status` = '$status',`o_PSC`='$paymentstatus',`o_PTC`= '$paymenttracking', `o_PP`= '$postprice', `o_date`='$ordersubmit' WHERE `o_id`='$id';";

 if ($conn->query($thequery) === TRUE)
 {
      show_result("success","محصول با موفقیت ویرایش شد","","","Lc Melody","current"); //mode , text , button lable , button target ,title , window (current)
 }
 else
 {
   $te = convert_error_2str($conn->error);
   show_result("error","خطا در ویرایش محصول <br/>.$te","","","Lc Melody","current");
 }

require "./includes/footer.php";?>
