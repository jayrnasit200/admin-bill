<?php   
require_once 'core.php';

$orderId = $_GET['orderId'];

$sql = "SELECT * FROM orders WHERE order_id = $orderId";

$orderResult = $connect->query($sql);
$orderData = $orderResult->fetch_array();

$orderItemSql = "SELECT order_item.product_id, order_item.rate, order_item.quantity, order_item.total,
product.product_name, product.hsn, product.gst_rate,  product.pro_mrp FROM order_item
    INNER JOIN product ON order_item.product_id = product.product_id 
 WHERE order_item.order_id = $orderId";


$orderItemResult = $connect->query($orderItemSql);
 
 ?>
<link href="js/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<!-- <script src="js/bootstrap.min.js"></script>
 --><script src="js/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->
<style type="text/css">

    body {
  background: rgb(204,204,204); 
}
* {
    font-size: 10px;
}
page {
  background: white;
  display: block;
  margin: 0 auto;
  margin-bottom: 0.5cm;
  box-shadow: 0 0 0.5cm rgba(0,0,0,0.5);
}
page[size="A4"] {  
  width: 21cm;
  height: 29.7cm; 
}
page[size="A4"][layout="landscape"] {
  width: 29.7cm;
  height: 21cm;  
}
page[size="A3"] {
  width: 29.7cm;
  height: 42cm;
}
page[size="A3"][layout="landscape"] {
  width: 42cm;
  height: 29.7cm;  
}
page[size="A5"] {
  width: 14.8cm;
  height: 21cm;
}
page[size="A5"][layout="landscape"] {
  width: 21cm;
  height: 14.8cm;  
}
@media print {
  page[size="A4"] {
    margin: 0;
    box-shadow: 0;
        width: 21cm;
  height: 29.7cm;
  }
}
@media print {
  body, page {
    margin: 0;
    box-shadow: 0;
  }
}
    .invoice-title h2, .invoice-title h3 {
    display: inline-block;
}

.table > tbody > tr > .no-line {
    border-top: none;
}

.table > thead > tr > .no-line {
    border-bottom: none;
}

.table > tbody > tr > .thick-line {
    border-top: 2px solid;
}
.panel.panel-default td
{

    border-right: 1px solid;
    padding: 0px 7px;

}

@media print {
  body {
    margin: 0;
    color: #000;
    background-color: #fff;
  }
  @page
  {
    margin: 0.3cm;
  }
}

<?php 
$user_id = $_SESSION['userId'];
$sql = "SELECT * FROM users WHERE user_id = {$user_id}";
$query = $connect->query($sql);
$result = $query->fetch_assoc();

$connect->close();
?>
</style>
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Orelega+One&display=swap" rel="stylesheet">
<!-- <body onload="window.print();location.href = 'http://localhost/stock-management-system-master/orders.php?o=manord'"></body> -->
<body>
    <page size="A4">
        <div class="container" style="width: 100%;height: 54px;display: inline-block;">
    <div class="row" style="padding: 0px 15px 0 14px;">
        <div class="col-xs-12" style="border: 1px solid;">
            <center>
            <div class="invoice-title">

                <b><h3 style="margin: 5px 34px; font-family: 'Orelega One', cursive;"> <img src="../assests/me.png" height="20" width="20"> <?php echo $result['username']; ?></h3></b>
            </div>
                <div style="float: left;">GST NO :- <?php echo $result['gst']; ?></div>
                <strong> Address :- <?php echo $result['Address']; ?></strong>
                <div style="float: right;">Mobile No :- <?php echo $result['mobile']; ?></div>
            </center>
            <!-- <div class="row"> -->
                <!--  <div style="float: right;"><h6>Mobile No :- <?php //echo $result['mobile']; ?></h6></div> -->
                 <!-- <div><h6>GST NO :- <?php //echo $result['gst']; ?></h6></div> -->
            <!-- </div> -->
            <div class="row" style="border-top: 1px solid;">

                <!-- <div class="col-xs-5" style="border-right: 1px solid;height: 70px;">
                    <address>
                        <strong>Address :- </strong><?php// echo $result['Address']; ?><br>
                        <strong>Mobile No :-</strong><?php// echo $result['mobile']; ?><br>
                        <strong>GST NO :- </strong><?php// echo $result['gst']; ?><br>
                    </address>
                </div> -->
                <div class="col-xs-9    "style="border-right: 1px solid;height: 56px;">
                        <strong>Customer.</strong><br>
                        <div style="float: right;"> <strong>Mobile No :-</strong><?php echo $orderData['client_contact'];?><br>
                        <strong>GST :- </strong><?php echo $orderData['client_Gst'];?><br></div>
                        <strong>Name :- </strong><?php echo $orderData['client_name']; ?><br>
                        <strong>Address :- </strong><?php echo $orderData['client_add']; ?><br>
                </div>
                <div class="col-xs-3 text-right" style="/* border-top: 1px solid; */height: 45px;padding: 2px;">
                    
                        <table  border="0">
                            <tr>
                                <th>Invoice No : </th>
                                <td><?php echo $result['billno']; ?></td>                                
                            </tr>
                            <tr>
                                
                                <th>Invoice Date : </th>
                                <td><?php echo $orderData['order_date']; ?></td>
                            </tr>
                            <tr>
                                <th>Paymet Method : </th>
                                <td>cash</td>
                            </tr>
                        </table>
                    
                </div>
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-12" style="padding: 0px 14px;">
            <div class="panel panel-default" style="border-radius: 0;border-left: 1.5px solid;border-right: 1.5px solid;">
                
                <div class="panel-body" style="padding: 0px;">
                    <div>
                        <table style="width: 100%;">
                            <thead>
                                
                                    <tr style="border-bottom: 1px solid black;background: antiquewhite;">
                                        <td style="width: 4%;text-align: center;"><strong>No</strong></td>
                                        <td><strong>Item</strong></td>
                                        <td class="text-center"><strong>HSN</strong></td>
                                        <td class="text-center"><strong>Qty</strong></td>
                                        <td class="text-center"><strong>MRP</strong></td>
                                        <td class="text-center"><strong>Rate</strong></td>
                                        <td class="text-center"><strong>Discount</strong></td>
                                        <td class="text-center"><strong>Amounts</strong></td>
                                        <td class="text-center"><strong>Taxes</strong></td>
                                        <td style="border: none;" class="text-center"><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Total&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong></td>
                                    </tr>
                                    
                            </thead>
                            <tbody>
                                <!-- foreach ($order->lineItems as $line) or some such thing here -->
                                <?php
                                $x = 1;
                                $gst_count=0;
                                $gst_count_total=0;
                                while($row = $orderItemResult->fetch_array()) 
                                {  
                                ?>
                                <span style="display: none;">
                                <?php    
                                $gst_count =   ($row['gst_rate'] * $row['total'] / 100);
                                $gst_count_total +=   ($row['gst_rate'] * $row['total'] / 100);    
                                ?>
                                </span>

                                <tr>
                                    <td style="width: 4%;text-align: center;"><?php echo $x; ?></td>
                                    <td><?php echo $row['product_name'];?></td>
                                    <td class="text-center"><?php echo $row['hsn'];?></td>
                                    <td class="text-center"><?php echo $row['quantity'];?></td>
                                    <td class="text-center"><?php echo $row['pro_mrp'];?></td>
                                    <td class="text-center"><?php echo $row['rate'];?></td>
                                    <td class="text-center">0.00</td>
                                    <td class="text-center"><?php echo $row['total'];?></td>
                                    <td class="text-center"><?php echo number_format($gst_count, 2, '.', '');?>(<?php echo $row['gst_rate']; ?>)</td>
                                    <td class="text-center" style="border: none;"><?php echo number_format($row['total']+$gst_count, 2, '.', '');?></td>
                                </tr>

                                <?php

                                $x++;
                                }   

                              
                                $total_row = 30 - $x;
                                for ($x = 0; $x <= $total_row; $x++) {
                                 ?>
                                 <tr>
                                    <td style="width: 4%;text-align: center;">&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td class="text-center">&nbsp;</td>
                                    <td class="text-center">&nbsp;</td>
                                    <td class="text-right">&nbsp;</td>
                                                                        <td>&nbsp;</td>
                                    <td class="text-center">&nbsp;</td>
                                    <td class="text-center">&nbsp;</td>
                                    <td class="text-right">&nbsp;</td>

                                </tr>
                                <?php
                                } 
                                ?>
                                
                                <tr style="border-top: 1px solid;">                                 
                                    <td class="no-line" colspan="8" ><strong>Bank Details :-</strong></td>
                                    <td class="thick-line text-center"><strong>Subtotal</strong></td>
                                    <td class="thick-line text-right" style="border: none;"><?php echo $orderData['sub_total']; ?></td>
                                </tr>
                                <tr>
                                    <td class="no-line" colspan="8"><strong>Bank Name :-</strong><?php echo $result['bank_name']; ?></td>
                                    <td class="no-line text-center"><strong>IGST <?php //echo $orderData['sgst']; ?></strong></td>
                                    <td class="no-line text-right" style="border: none;"><?php echo number_format($gst_count_total, 2, '.', '');?><?php  //echo $orderData['vat']; ?></td>
                                </tr>
                                <tr>
                                    <td class="no-line" colspan="8"><strong>Bank Ac :-</strong><?php echo $result['bank_ac']; ?></td>
                                    <td class="no-line text-center"><strong>----------<?php //echo $orderData['cgst']; ?></strong></td>
                                    <td class="no-line text-right" style="border: none;"><strong>-----------</strong><?php //echo $orderData['vat1']; ?></td>
                                </tr>
                                <tr>
                                    <td class="no-line" colspan="8"><strong>Bank IFSC Code :-</strong><?php echo $result['Bank_IFSC_Code']; ?></td>
                                    <td class="no-line text-center"><strong>Total Amount</strong></td>
                                    <td class="no-line text-right" style="border: none;"><?php echo number_format($gst_count_total+$orderData['sub_total'], 2, '.', '');?><?php //echo $orderData['total_amount']; ?></td>
                                </tr>

                              



                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row"style="margin: 0;">

                <div class="col-xs-8" style="border-top: 1px solid;border-bottom: 1px solid;height: 45px;">
                    <strong>Description</strong><br>
                    <?php echo $result['Description']; ?>
                </div>
                <div class="col-xs-4 text-right" style="border-bottom: 1px solid;border-left: 1px solid;border-top: 1px solid;height: 45px;">
                    
                       <strong>Sing</strong>
                    
                </div>
            </div>
            </div>
        </div>
    </div>
</div>
    </page>

</body>
<script type="text/javascript">
    window.print();
    window.setTimeout(function() {
    window.location.href = 'http://muskaan.rf.gd/admin/orders.php?o=manord';
}, 1000);
</script>