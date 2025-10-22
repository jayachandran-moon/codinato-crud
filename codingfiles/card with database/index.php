<!DOCTYPE html>
<?php include 'connect.php';?>
<html lang="en">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
  integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <style>
    .navbar {
      text-decoration: none;
      background-color: rgb(153, 255, 255);
    }

    .nav-item:hover {
      color: grey;
      text-decoration: none;
    }

    a {
      color: black;
    }

    a:hover {
      color: gray;
    }
  </style>


</head>
<form action="connect.php" method="post">
  <div class="navbar">
    <ul class="nav nav-pills ">
      <li class="nav-item">
        <a class="nav p-1 m-1 " style="text-decoration:none;" aria-current="page" href="index.php">Home</a>
      </li>
      <li class="nav-item">

        <a class="nav p-1 m-1" style="text-decoration:none;" href="sevice.php">Services</a>
      </li>
    </ul>
  </div>
  </div>

  <!-- card start to heare -->

  <div class="card mb-3">
    <div class="card-body">



      <div class="row m-5">
        <div class="col-3">
          <div class="card text-center mb-3" style="width: 18rem;">
            <div class="card-body">
              <h5 class="card-title">Document</h5>
              <p class="card-text">20</p>
            </div>
          </div>
        </div>
        <div class="col-3">
          <div class="card text-center mb-3" style="width: 18rem;">
            <div class="card-body">
              <h5 class="card-title">Document</h5>
              <p class="card-text">20</p>
            </div>
          </div>
        </div>
        <div class="col-3">
          <div class="card text-center mb-3" style="width: 18rem;">
            <div class="card-body">
              <h5 class="card-title">Document</h5>
              <p class="card-text">20</p>
            </div>
          </div>
        </div>
        <div class="col-3">
          <div class="card text-center mb-3" style="width: 18rem;">
            <div class="card-body">
              <h5 class="card-title">Document</h5>
              <p class="card-text">20</p>
            </div>
          </div>
        </div>
        <div class="col-3">
          <div class="card text-center mb-3" style="width: 18rem;">
            <div class="card-body">
              <h5 class="card-title">Document</h5>
              <p class="card-text">20</p>
            </div>
          </div>
        </div>
        <div class="col-3">
          <div class="card text-center mb-3" style="width: 18rem;">
            <div class="card-body">
              <h5 class="card-title">Document</h5>
              <p class="card-text">20</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</form>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
  integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>

</html>