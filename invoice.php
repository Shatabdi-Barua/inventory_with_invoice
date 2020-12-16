
<?php
// if(('' == $_GET['admin_name'])) header('Location: redirect.php');
	include('include/our_connect.php');
  include('include/inc_item_id.php');
  include('include/max_lot_no.php');

	if ($_SERVER["REQUEST_METHOD"]=="POST"){
		
    // include('include/inc_item_id.php');

		$Item_id = $_POST['Item_id'];
		// $Name=$_POST['Name'];
		$Amount=$_POST['Amount'];
		
		
	 // $sql= "SELECT * FROM items WHERE Item_id=$Item_id";
	 // 		$stid  = mysqli_query($conn, $sql);
	 // 	 if (!$stid) die('stid');
	 // 		$info = mysqli_fetch_assoc($stid );

  //  if (0==mysqli_num_rows($stid)){
	$invo_one="INSERT INTO invoice VALUES ( '$Item_id', '$Amount','-1', curdate())";
	$invo_query=mysqli_query($conn, $invo_one);
  if (!$invo_query) die('invo_query');

  //  $sql="Update items, invoice set invoice.TP=invoice.Amount*items.per_unit_selling_price WHERE items.Item_id=invoice.Item_id";
  // mysqli_query($conn,$sql);
  //  $invo_two="SELECT invoice.Item_id, i.Name, invoice.Amount, i.per_unit_selling_price, invoice.TP FROM invoice, orders as o, contains as c, items as i WHERE i.Item_id=invoice.Item_id GROUP BY i.Item_id";
  //  $invo_two_query=mysqli_query($conn, $invo_two);
  //  if (!$invo_two_query) die('invo_two_query');

   // $invo_three="Update invoice set invoice.TP = items.per_unit_selling_price*invoice.Quantity WHERE invoice.Item_id = items.Item_id"
  // }
   // else{
   //       $error="This ID already used.";
   //     }
  header('Location: invoice_report.php');
}
?>


<html>
<head>
	<title>Order</title>
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

	<div class="container"> <br><br><br>
        <div class="row">
           <div class="col-sm-offset-1 col-sm-10">
              <form method="post" action="invoice.php?admin_name=<?=$admin_name?>">
              <fieldset style="border: 2px solid skyblue">
                <legend class="in-middle txtdark"> Place Your Order </legend>
                 <div class="row">
                  <div class="col-sm-offset-1 col-sm-10">
                    <div class="form-group input-group">
                            <span class="input-group-addon"><i class="fa fa-tag"> Item no:</i></span>
                            <input class="form-control" type="text" name='Item_id' placeholder="ID" required>          
                        </div>


                        <!-- <div class="form-group input-group">
                            <span class="input-group-addon"><i class="fa fa-cube"></i> Name</span>
                            <input class="form-control" type="text" name='Name' placeholder="Name" required>          
                        </div> -->

                        <div class="form-group input-group">
                            <span class="input-group-addon"><i class="fa fa-shopping-bag"> Amount</i></span>
                            <input class="form-control" type="text" name='Amount' placeholder="Amount in kg" required>        
                        </div> 

                         <!-- <div class="form-group input-group">
                            <span class="input-group-addon"><i class="fa fa-usd"> Price per unit(selling)</i></span>
                            <input class="form-control" type="text" name='per_unit_selling_price' placeholder="Selling price per unit in taka" value="<?= $item_id ?>">
                        </div>    -->                      
                        
                <button class="btn btn-primary col-sm-offset-5 col-sm-2" type="submit"> Add </button> <br><br>
              </div>
              </fieldset>
            </form>
           </div> 
         
        </div>  
    </div>



<!-- <div class="container container-fluid">
    
    
    <table class="data-table table table-responsive">
      <h1 class="jumbotron in-middle txtgreen">Order Receipt</h1> <br>
      <thead>
        <tr>
           <th>Item_Id</th>
           <th>Item_name</th>
          
          <th>Amount</th>
          <th>Per unit price(selling)</th>
          
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
        
        <td>'.$row['TP'].'</td>
          </tr>';
          $total += $row['TP'];
          $no++;
          }
          

        ?>
      </tbody> 
      <tfoot>
        <tr class = "danger">
          <th colspan="4">Total</th>
          <th style="text-align: center;"> <?= number_format($total)?></th>
        </tr>

      </tfoot>
      
    </table>
    
    
    
  </div> -->
</body>
</html>