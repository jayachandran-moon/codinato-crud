
<!DOCTYPE html>
<html lang="en" style="margin:0px">
<head>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <?php
// database connection
$conn = new mysqli('localhost','root','','indexfirstdatabase');


// Check connection
if ($conn->connect_error) {
    die("Connection error: " . mysqli_connect_error());
}

$msg = '';
if(isset($_POST['submit'])){
    $customer = mysqli_real_escape_string($conn, $_POST['customer']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $amount = mysqli_real_escape_string($conn, $_POST['ammount']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);

    $select1 = "SELECT * FROM `indexfirstdatabase` WHERE customer_no='$customer' AND phone_number='$phone'";
    $select_user = mysqli_query($conn, $select1);
    
    if(!$select_user) {
        $msg = "Database error: " . mysqli_error($conn);
    }
    elseif(mysqli_num_rows($select_user) > 0){
        $msg = "User already exists!";
    }
    else{

        $insert1 = "INSERT INTO `indexfirstdatabase` (customer_no, phone_number, ammount, des) VALUES ('$customer', '$phone', '$amount', '$description')";
        
        if(mysqli_query($conn, $insert1)){
            header('location:index.php');
            exit();
        } else {
            $msg = "Error: " . mysqli_error($conn);
        }
    }
}
?>
  <style>
    body{margin: 0%;}
    .button { display: flex; justify-content: flex-end; align-items: flex-end; }
    .navbar { text-decoration: none; background-color: rgb(153, 255, 255); }
    .nav-item:hover { color: grey; text-decoration: none; }
    a { color: black; }
    a:hover { color: gray; }
  </style>
</head>
<body>
  
  <form action="sevice.php" method="post">

  
    <p class="msg"><?php echo $msg; ?></p>
    
    <div class="navbar">
      <ul class="nav nav-pills">
        <li class="nav-item">
          <a class="nav p-1 m-1" style="text-decoration:none;" href="index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav p-1 m-1" style="text-decoration:none;" href="sevice.php">Services</a>
        </li>
      </ul>
    </div>

    <div class="row m-5">
      <div class="col-6 mb-3">
        <label>Select Type</label>
        <select class="form-select" name="option" id="inputGroupSelect01">
          <option selected>Choose...</option>
          <option value="1">Recharge</option>
          <option value="2">money Transfer</option>
          <option value="3">DTH Recharge</option>
        </select>
      </div>
      <div class="col-6 mb-3">
        <span>Customer Number :</span>
        <input type="number" class="form-control" name="customer" placeholder="User Id" required>
      </div>
      <div class="col-6 mb-3">
        <span>Phone Number :</span>
        <input type="number" class="form-control" name="phone" placeholder="Phone Number" required>
      </div>
      <div class="col-6 mb-3">
        <span>Amount :</span>
        <input type="number" class="form-control" name="ammount" placeholder="Enter Your Amount" required>
      </div>
      <div class="col-12 mb-3">
        <span>Description :</span>
        <textarea class="form-control" name="description" aria-label="With textarea"></textarea>
      </div>
      <div class="button">
        <button class="btn btn-outline-secondary" name="submit" type="submit">Submit</button>
      </div>
    </div>
  </form>
  
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>