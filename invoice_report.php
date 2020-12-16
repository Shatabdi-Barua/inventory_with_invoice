
<?php
// if(('' == $_GET['admin_name'])) header('Location: redirect.php');
  include('include/our_connect.php');
  include('include/inc_item_id.php');
  include('include/max_lot_no.php');

  
    
    // include('include/inc_item_id.php');

    
    
   // $sql= "SELECT * FROM items WHERE Item_id=$Item_id";
   //     $stid  = mysqli_query($conn, $sql);
   //    if (!$stid) die('stid');
   //     $info = mysqli_fetch_assoc($stid );

  //  if (0==mysqli_num_rows($stid)){


   $sql="Update items, invoice set invoice.TP=invoice.Amount*items.per_unit_selling_price WHERE items.Item_id=invoice.Item_id";
  mysqli_query($conn,$sql);
   $invo_two="SELECT i.Name, invoice.Item_id, SUM(invoice.Amount) as Amount, i.per_unit_selling_price, invoice.Order_date, SUM(invoice.TP) as TP FROM invoice, items as i where Order_date=CURRENT_DATE and i.Item_id=invoice.Item_id GROUP BY Item_id";
   $invo_two_query=mysqli_query($conn, $invo_two);
   if (!$invo_two_query) die('invo_two_query');

   // $invo_three="Update invoice set invoice.TP = items.per_unit_selling_price*invoice.Quantity WHERE invoice.Item_id = items.Item_id"
  // }
   // else{
   //       $error="This ID already used.";
   //     }

?>


<html>
<head>
  <title>report</title>
    <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/all.css">
  <script src="js/jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
<style type="text/css">
      fieldset {
        /*height: 500px;*/
        background-color: lavender;//#ffffe6;
      }
     
</style>
</head>
<body>
  <?php include('include/nav.php'); ?>


<div class="container container-fluid">
    
    
    <table class="data-table table table-responsive">
      <h1 class="jumbotron in-middle txtgreen">Order Receipt</h1> <br>
      <thead>
        <tr>
           <th>Item_Id</th>
           <th>Item_name</th>
          
          <th>Amount</th>
          <th>Per unit price(selling)</th>
          <th>Order Date</th>
          <th>Total price</th>
        
          
        </tr>
      </thead>
      <tbody>
        <?php
          $no = 1;
          $total = 0; 
              
          while($row = mysqli_fetch_array($invo_two_query)) {  
            //$amount = $row['amount'] == 0 ? '' : number_format($row['amount']);
        echo '<tr>
        <td>'.$row['Item_id'].'</td>
        <td>'.$row['Name'].'</td>
        
        <td>'.$row['Amount'].'</td>
        <td>'.$row['per_unit_selling_price'].'</td>
        <td>'.date("d-m-Y", strtotime($row['Order_date'])).'</td>
        <td>'.$row['TP'].'</td>
          </tr>';
          $total += $row['TP'];
          $no++;
        

          }
          

        ?>
      </tbody> 
      <tfoot>
        <tr class = "danger">
          <th colspan="5">Total</th>
          <th style="text-align: left;"> <?= number_format($total)?></th>
        </tr>

      </tfoot>
      
    </table>
    
    <button>Create PDF</button>
    
    
  </div>

</body>
</html>