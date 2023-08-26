<?php
  session_start();
  $email = $_SESSION['email'];
 
  $msg = $_SESSION['view_cart'];
  $_SESSION['view_cart']=null;
  $msg1 = $_SESSION['view_cart1'];
  $_SESSION['view_cart1']=null;

?>
<?php
include '_dbconnect.php';
$q3 =  "SELECT * FROM `cart` WHERE `email`='$email';";
$run = mysqli_query($con, $q3);
$html = "";
if(mysqli_num_rows($run)>0){
          while($row = $run->fetch_assoc()){
              $html = $html. "<tr><td>" . $row["name"] . "</td><td>" . $row["details"] . "</td><td>" . '<h4 class="taka">৳</h4>'. $row["price"] . "</td><td>". $row["quantity"] . "</td><td>". '<a class="btn btn-lg btn-block btn btn-outline-danger" href="delete_cart.php?id=' . $row["id"] .'"><i class="fa-solid fa-trash"></i> Delete from Cart</a>' . '<button type="submit" id="' . $row["id"] .'" class="qnt btn btn-lg btn-block btn btn-outline-info id = "q_id""><i class="fa-solid fa-align-justify"></i> Quantity</button>' ." </td></tr>";
             
          }
        
      }
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
  <title>My cart</title>
  <link rel = "icon" href="img/fav.png">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap5.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <link rel="stylesheet" href="css/table.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@900&display=swap" rel="stylesheet">
</head>

<body>
  
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    
    <div class="logo">
      <a href="userhome.php">
      <img class = "logo" src="img/LOGO3.png" alt="img">
      </a>
    </div>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto test">
      <li class="nav-item">
        <a id= "test2" class="nav-link" href="userhome.php"><i class="fa-solid fa-house-user"></i> Home</a>
      </li>
      <li class="nav-item">
        <a id= "test2" class="nav-link" href="#Sec"><i class="fa-brands fa-pagelines"></i> Plants</a>
      </li>
      <li class="nav-item">
        <a id= "test2" class="nav-link" href="#Sec2"><i class="fa-solid fa-seedling"></i> Seeds</a>
      </li>
      <li class="nav-item">
        <a id= "test2" class="nav-link" href="#Sec3"><i class="fa-solid fa-briefcase"></i> Other Services</a>
      </li>
      <li class="nav-item">
        <a id= "test2" class="nav-link" href="#Sec4"><i class="fa-solid fa-u"></i> Pots</a>
      </li>
      <li class="nav-item">
        <a id= "test2" class="nav-link" href="feedback.php"><i class="fa-solid fa-comment"></i> Give Feedback</a>
      </li>
      <li class="nav-item">
        <a id= "test2" class="nav-link" href="rqst_product.php"><i class="fa-solid fa-list-check"></i> Request Plants</a>
      </li>
        <!-- <li class="nav-item">
        <a id= "test2" class="nav-link" href="Recycled_Product.php"><i class="fa-solid fa-recycle"></i> My Recycles</a>
      </li> -->
      <li class="nav-item">
          <a id= "test2" class="nav-link" href="suggetion.php"><i class="fa-solid fa-bag-shopping">Suggetion</i></a>
        </li>
      <li class="nav-item">
        <a id= "test2" class="nav-link" href="viewcart.php"><i class="fa-solid fa-bag-shopping"></i> My Cart</a>
      </li>

      <li class="nav-item">
        <a id= "test2" class="nav-link" href="logout.php"><i class="fa-solid fa-user"></i> Logout</a>
      </li>
      
    </ul>
    </div>
    </nav>
    

  
  <div id="cta">
  <h1 class = "cta-heading"><i class="fa-solid fa-bag-shopping"></i> My cart</h1>
  </div>
  
  <form class="form" action="mycart.php" method="POST">
   <div class="form-group" id="pad">
      <input type="text" class="form-control" name="search" aria-describedby="emailHelp" placeholder="Search">
   </div>
   
   
   <div class="form-group" id="pad2">
          <select class="form-control" name="cat">
          <option value="name">Name</option>
          <option value="price">Price</option>
          <option value="details">Details</option>
      </select>
  </div>
  
   <div class="col-lg-12 col-md-12 col-sm-12" id = "pad3">
   <button type="submit" class="btn btn-lg btn-block btn-success submittt"><i class="fa-solid fa-magnifying-glass"></i> Search</button>
   <button onclick="window.location.href='viewcart.php'" type="button" class="btn btn-lg btn-block btn-info"><i class="fa-solid fa-list"></i> See All</button>
   </div>
  </form>
  
  
  
  
      <table id="example" class="table table-light table-hover table-bordered pad" style="width:100%">
      
      <thead>
          <tr>
                      <th>Name</th>
                      <th>Details</th>
                      <th>Price</th>
                      <th>Quantity</th>
                      <th>Action</th>
          </tr>
      </thead>
          
      <tbody>
              <?php
              echo  $html
              ?>  
          </tbody>
          
      
      </table>
      
      <?php
    
      
     
      if($msg1){?>

      <div class="row" id="pad3">
      <div class="col-md-12">
          <div class="alert alert-success" role="alert">
              <?php echo $msg1; ?>
          </div>
      </div>

      </div>

      <?php }
      if($msg){?>

        <div class="row" id="pad3">
        <div class="col-md-12">
            <div class="alert alert-danger" role="alert">
                <?php echo $msg; ?>
            </div>
        </div>
        
        </div>
  <?php }

      
      $amount = "";
        include '_dbconnect.php';
        $q3 =  "SELECT SUM(price*quantity) AS value_sum FROM cart WHERE `email`='$email';";
        $run = mysqli_query($con, $q3);
      ?>
      <div class="cart">
      <center><h3 class="cart2">Total Amount ৳<?php
       while($row = $run->fetch_assoc()) {
        $amount = $row["value_sum"];
        echo $amount;
      }
      ?></h3></center>
     
      <a href="payment.php?amount=<?php echo $amount?>" type="button" class="btn btn-lg btn-block btn-success"><i class="fa-solid fa-hand-pointer"></i> Buy Now</a>
   </div>
  
  <footer id="footer">
  <a id="icon-fb" href="#">
    <i class="s-icons fa-brands fa-facebook"></i>
  </a>
  <a id="icon-insta" href="#">
    <i class="s-icons fa-brands fa-instagram"></i>
  </a>
  <a id="icon-mail" href="mailto:#">
    <i class="s-icons fa-solid fa-envelope" href=""></i>
  </a>
  
  
  <p>© Copyright ProjectO2</p>

 </footer>
  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap5.min.js"></script>
  <script>
      $(document).ready(function() {
      $('#example').DataTable();
      } );
  </script>
        <script>
			$(function () {
            $(".qnt").click(function () {
              
                var q_id = $(this).attr("id");
                
                let todo_id = prompt("Please Enter Quantity:");
                
                    location.assign('show.php?id='+q_id+'&todo_id='+todo_id)
                
                return false;
  });
});

	</script>
  <script src="https://use.fontawesome.com/2c7ebecd35.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>