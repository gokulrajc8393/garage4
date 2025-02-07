<?php
session_start();
/*include("header.php");*/
require("../connect.php");
$username = $_SESSION['email_id'];
   $sql="select * from registration where email_id='$username'" ;
   $res=select_data($sql);
   $arr=mysqli_fetch_assoc($res);




$id = $_GET['id'];
$sql1="select * from booking where booking_id='$id'" ;
$res1=select_data($sql1);
$arr1=mysqli_fetch_assoc($res1);


?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">


<title>Invoice receipt</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
<style type="text/css">
    	.receipt-content .logo a:hover {
  text-decoration: none;
  color: #7793C4; 
}

.receipt-content .invoice-wrapper {
  background: #FFF;
  border: 1px solid #CDD3E2;
  box-shadow: 0px 0px 1px #CCC;
  padding: 40px 40px 60px;
  margin-top: 40px;
  border-radius: 4px; 
}

.receipt-content .invoice-wrapper .payment-details span {
  color: #A9B0BB;
  display: block; 
}
.receipt-content .invoice-wrapper .payment-details a {
  display: inline-block;
  margin-top: 5px; 
}

.receipt-content .invoice-wrapper .line-items .print a {
  display: inline-block;
  border: 1px solid #9CB5D6;
  padding: 13px 13px;
  border-radius: 5px;
  color: #708DC0;
  font-size: 13px;
  -webkit-transition: all 0.2s linear;
  -moz-transition: all 0.2s linear;
  -ms-transition: all 0.2s linear;
  -o-transition: all 0.2s linear;
  transition: all 0.2s linear; 
}

.receipt-content .invoice-wrapper .line-items .print a:hover {
  text-decoration: none;
  border-color: #333;
  color: #333; 
}

.receipt-content {
  background: #ECEEF4; 
}
@media (min-width: 1200px) {
  .receipt-content .container {width: 900px; } 
}

.receipt-content .logo {
  text-align: center;
  margin-top: 50px; 
}

.receipt-content .logo a {
  font-family: Myriad Pro, Lato, Helvetica Neue, Arial;
  font-size: 36px;
  letter-spacing: .1px;
  color: #555;
  font-weight: 300;
  -webkit-transition: all 0.2s linear;
  -moz-transition: all 0.2s linear;
  -ms-transition: all 0.2s linear;
  -o-transition: all 0.2s linear;
  transition: all 0.2s linear; 
}

.receipt-content .invoice-wrapper .intro {
  line-height: 25px;
  color: #444; 
}

.receipt-content .invoice-wrapper .payment-info {
  margin-top: 25px;
  padding-top: 15px; 
}

.receipt-content .invoice-wrapper .payment-info span {
  color: #A9B0BB; 
}

.receipt-content .invoice-wrapper .payment-info strong {
  display: block;
  color: #444;
  margin-top: 3px; 
}

@media (max-width: 767px) {
  .receipt-content .invoice-wrapper .payment-info .text-right {
  text-align: left;
  margin-top: 20px; } 
}
.receipt-content .invoice-wrapper .payment-details {
  border-top: 2px solid #EBECEE;
  margin-top: 30px;
  padding-top: 20px;
  line-height: 22px; 
}


@media (max-width: 767px) {
  .receipt-content .invoice-wrapper .payment-details .text-right {
  text-align: left;
  margin-top: 20px; } 
}
.receipt-content .invoice-wrapper .line-items {
  margin-top: 40px; 
}
.receipt-content .invoice-wrapper .line-items .headers {
  color: #A9B0BB;
  font-size: 13px;
  letter-spacing: .3px;
  border-bottom: 2px solid #EBECEE;
  padding-bottom: 4px; 
}
.receipt-content .invoice-wrapper .line-items .items {
  margin-top: 8px;
  border-bottom: 2px solid #EBECEE;
  padding-bottom: 8px; 
}
.receipt-content .invoice-wrapper .line-items .items .item {
  padding: 10px 0;
  color: #696969;
  font-size: 15px; 
}
@media (max-width: 767px) {
  .receipt-content .invoice-wrapper .line-items .items .item {
  font-size: 13px; } 
}
.receipt-content .invoice-wrapper .line-items .items .item .amount {
  letter-spacing: 0.1px;
  color: #84868A;
  font-size: 16px;
 }
@media (max-width: 767px) {
  .receipt-content .invoice-wrapper .line-items .items .item .amount {
  font-size: 13px; } 
}

.receipt-content .invoice-wrapper .line-items .total {
  margin-top: 30px; 
}

.receipt-content .invoice-wrapper .line-items .total .extra-notes {
  float: left;
  width: 40%;
  text-align: left;
  font-size: 13px;
  color: #7A7A7A;
  line-height: 20px; 
}

@media (max-width: 767px) {
  .receipt-content .invoice-wrapper .line-items .total .extra-notes {
  width: 100%;
  margin-bottom: 30px;
  float: none; } 
}

.receipt-content .invoice-wrapper .line-items .total .extra-notes strong {
  display: block;
  margin-bottom: 5px;
  color: #454545; 
}

.receipt-content .invoice-wrapper .line-items .total .field {
  margin-bottom: 7px;
  font-size: 14px;
  color: #555; 
}

.receipt-content .invoice-wrapper .line-items .total .field.grand-total {
  margin-top: 10px;
  font-size: 16px;
  font-weight: 500; 
}

.receipt-content .invoice-wrapper .line-items .total .field.grand-total span {
  color: #20A720;
  font-size: 16px; 
}

.receipt-content .invoice-wrapper .line-items .total .field span {
  display: inline-block;
  margin-left: 20px;
  min-width: 85px;
  color: #84868A;
  font-size: 15px; 
}

.receipt-content .invoice-wrapper .line-items .print {
  margin-top: 50px;
  text-align: center; 
}



.receipt-content .invoice-wrapper .line-items .print a i {
  margin-right: 3px;
  font-size: 14px; 
}

.receipt-content .footer {
  margin-top: 40px;
  margin-bottom: 110px;
  text-align: center;
  font-size: 12px;
  color: #969CAD; 
}                    
    </style>
</head>
<body>
<div class="receipt-content">
<div class="container bootstrap snippets bootdey">
<div class="row">
<div class="col-md-12">
<div class="invoice-wrapper">
<div class="intro">
Hi <strong>[USERNAME]</strong>,
<br>
This is a receipt for booking <strong>[CARNAME]</strong> from our website GARAGE4
</div>
<div class="payment-info">
<div class="row">
<div class="col-sm-6">
<span>Booking No.</span>
<strong>[ID]</strong>

</div>
<div class="col-sm-6 text-right">
<span>Booking Date</span>
<strong>[BOOKINGDATE]</strong>
</div>
</div>
</div>
<div class="payment-details">
<div class="row">
<div class="col-sm-6">
<span>Payment From</span>
<strong>
[USERNAME]
</strong>
<!-- <p>
989 5th Avenue <br>
City of monterrey <br>
55839 <br>
USA <br>
<a href="#">
<span class="__cf_email__" data-cfemail="e983868787908d8c8f8fa98e84888085c78a8684">[email&#160;protected]</span>
</a>
</p> -->
</div>
<div class="col-sm-6 text-right">
<span>Payment To</span>
<strong>
GARAGE 4
</strong>
<!-- <p>
344 9th Avenue <br>
San Francisco <br>
99383 <br>
USA <br>
<a href="#">
<span class="__cf_email__" data-cfemail="325847535c54574072555f535b5e1c515d5f">[email&#160;protected]</span>
</a>
</p> -->
</div>
</div>
</div>
<!--<div class="line-items">
<div class="headers clearfix">
<div class="row">
<div class="col-xs-4">Car Name</div>
<div class="col-xs-3">Quantity</div>
<div class="col-xs-5 text-right">Amount</div>
</div>
</div>-->
<div class="items">
<div class="row item">
<div class="col-xs-4 desc">
<!-- Html theme -->
</div>
<div class="col-xs-3 qty">
<!-- 3 -->
</div>
<div class="col-xs-5 amount text-right">
<!-- $60.00 -->
</div>
</div>
<div class="row item">
<div class="col-xs-4 desc">
<!-- Bootstrap snippet -->
</div>
<div class="col-xs-3 qty">
<!-- 1 -->
</div>
<div class="col-xs-5 amount text-right">
<!-- $20.00 -->
</div>
</div>
<div class="payment-info">
<div class="row">
<div class="col-sm-6">
<span>Pick Up Date</span>
<strong>[PICKDATE]</strong>

</div>
<div class="col-sm-6 text-right">
<span>Drop Date</span>
<strong>[DROPDATE]</strong>
</div>
</div>
</div>
<div class="payment-details">
<div class="row">
<div class="col-sm-6">
<span>No Of Days</span>
<strong>
[NOOFDAYS]
</strong>
<!-- <p>
989 5th Avenue <br>
City of monterrey <br>
55839 <br>
USA <br>
<a href="#">
<span class="__cf_email__" data-cfemail="e983868787908d8c8f8fa98e84888085c78a8684">[email&#160;protected]</span>
</a>
</p> -->
</div>
<div class="total text-right">
<!-- <p class="extra-notes">
<strong>Extra Notes</strong>
Please send all items at the same time to shipping address by next week.
Thanks a lot.
</p>
<div class="field">
Subtotal <span>$379.00</span>
</div>
<div class="field">
Shipping <span>$0.00</span>
</div>
<div class="field">
Discount <span>4.5%</span>
</div>-->
<div class="field grand-total">
Total Amount <span>₹[TOTALAMOUNT]</span> 
</div>
</div>
<div class="print">


</div>
</div>
</div>
<div class="footer">
Copyright © garage4
</div>
</div>
</div>
</div>
</div>
<script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script><script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
<script src="https://netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<script type="text/javascript">
	                        
                    
</script>
</body>
</html>