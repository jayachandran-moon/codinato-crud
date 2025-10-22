<?php
include 'connect.php';

$msg = ""; // Initialize message variable

if(isset($_POST['submit'])){
    $name = mysqli_real_escape_string($conn, $_POST['firstname']);
    $secondname = mysqli_real_escape_string($conn, $_POST['secondname']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $textcontent = mysqli_real_escape_string($conn, $_POST['textcontent']);

    // Validate phone number
    if(!preg_match('/^[0-9]{10}$/', $phone)) {
        $msg = "Please enter a valid 10-digit phone number!";
    } else {
        // Check if user already exists
        $select1 = "SELECT * FROM `mooncontent` WHERE firstname='$name' AND phone='$phone'";
        $select_user = mysqli_query($conn, $select1);
        
        if(!$select_user) {
            $msg = "Database error: " . mysqli_error($conn);
        }
        elseif(mysqli_num_rows($select_user) > 0){
            $msg = "User already exists!";
        }
        else{
            // Insert new record
            $insert1 = "INSERT INTO mooncontent (firstname, secondname, phone, textcontent) VALUES ('$name', '$secondname', '$phone','$textcontent')";
            if(mysqli_query($conn, $insert1)){
                header('location:display.php');
                exit();
            } else {
                $msg = "Error: " . mysqli_error($conn);
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

    <style>
    body {
        width: 98%;
    }
    .fullcotainer-fluid{
        display:flex;
        justify-content: space-around;
        flex-wrap: wrap;
    }
    .container-fluid-1{
        width:45%;
        min-width: 300px;
    }
    .container-fluid-2{
        margin-top:30px;
        width:40%;
        min-width: 300px;
    }
    .alert {
        margin: 10px 0;
    }
    @media (max-width: 768px) {
        .container-fluid-1, .container-fluid-2 {
            width: 100%;
        }
    }
    </style>

</head>

<body>
    <nav class="navbar bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand">𝓶𝓸𝓸𝓷</a>
            <form class="d-flex" role="search">
                <a class="navbar-brand col-sm-4 col-md-8">Jayachandran</a>
                <button class="btn btn-outline-success" type="submit">button</button>
            </form>
        </div>
    </nav>

    <!-- Display messages -->
    <?php if(!empty($msg)): ?>
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <?php echo $msg; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <div class="fullcotainer-fluid">
        <div class="container-fluid-1 mt-3">
            <table class="table mt-3">
                <thead>
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">பெயர்</th>
                        <th scope="col">Phone</th>
                        <th scope="col">Input</th>
                        <th scope="col">Date And Time</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    <?php 
                    $sql = "SELECT * FROM `mooncontent` ORDER BY reg_date DESC";
                    $result = mysqli_query($conn, $sql);
                    if($result && mysqli_num_rows($result) > 0){
                        while($row = mysqli_fetch_assoc($result)){
                            echo '
                            <tr>
                                <td>'.htmlspecialchars($row['firstname']).'</td>
                                <td>'.htmlspecialchars($row['secondname']).'</td>
                                <td>'.htmlspecialchars($row['phone']).'</td>
                                <td>'.htmlspecialchars($row['textcontent']).'</td>
                                <td>'.htmlspecialchars($row['reg_date']).'</td>
                            </tr>';
                        }
                    } else {
                        echo '<tr><td colspan="5" class="text-center">No records found</td></tr>';
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <div class="container-fluid-2">
            <form method="post">
                <div class="mb-3">
                    <label for="firstname" class="form-label">Name (English)</label>
                    <input type="text" class="form-control" id="thanglishInput" name="firstname" 
                           value="<?php echo isset($_POST['firstname']) ? htmlspecialchars($_POST['firstname']) : ''; ?>" 
                           placeholder='Enter name in English' required>
                </div>
                
                <div class="mb-2">
                    <button type="button" class="btn btn-outline-secondary" onclick="convertToTamil()">Convert to Tamil</button>
                </div>
                
                <div class="mb-3">
                    <label for="secondname" class="form-label">பெயர் (Tamil)</label>
                    <input type="text" class="form-control" id="result" name="secondname" 
                           value="<?php echo isset($_POST['secondname']) ? htmlspecialchars($_POST['secondname']) : ''; ?>" 
                    >
                </div>

                <div class="mb-3">
                    <label for="phone" class="form-label">Phone Number</label>
                    <div class="input-group">
                        <span class="input-group-text" id="basic-addon1">+91</span>
                        <input type="tel" class="form-control" id="phone" name="phone" 
                               value="<?php echo isset($_POST['phone']) ? htmlspecialchars($_POST['phone']) : ''; ?>" 
                               placeholder="Phone No" aria-label="Phone" aria-describedby="basic-addon1" 
                               pattern="[0-9]{10}" required>
                    </div>
                    <div class="form-text">Enter 10-digit phone number</div>
                </div>

                <div class="mb-3">
                    <label for="textcontent" class="form-label">Comments</label>
                    <textarea class="form-control" placeholder="Leave a comment here" name="textcontent" 
                              id="textcontent" style="height: 100px"><?php echo isset($_POST['textcontent']) ? htmlspecialchars($_POST['textcontent']) : ''; ?></textarea>
                </div>

                <div class="input-group mb-3 mt-3">
                    <button type="reset" class="btn btn-secondary w-50">Clear</button>
                    <button type="submit" name="submit" class="btn btn-primary w-50">Submit</button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous">
    </script>
    
    <script>
    async function convertToTamil() {
        const input = document.getElementById('thanglishInput').value.trim();
        const resultInput = document.getElementById('result');

        if (!input) {
            alert('Please enter some text to convert.');
            return;
        }

        try {
            const url = `https://inputtools.google.com/request?text=${encodeURIComponent(input)}&itc=ta-t-i0-und&num=1&cp=0&cs=1&ie=utf-8&oe=utf-8&app=demopage`;
            const response = await fetch(url);
            const data = await response.json();

            if (data[0] === 'SUCCESS') {
                const tamilText = data[1][0][1][0];
                resultInput.value = tamilText;
            } else {
                alert('Conversion failed. Please try again.');
            }
        } catch (error) {
            console.error('Conversion error:', error);
            alert('Error during conversion. Please check your connection.');
        }
    }
    </script>
</body>
</html>