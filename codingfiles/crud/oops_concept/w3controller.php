<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fruit Input Form</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            min-height: 100vh;
            display: flex;
            align-items: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">
                <div class="card shadow">
                    <div class="card-body">
                        <h2 class="card-title text-center mb-4">Enter Fruit Details</h2>
                        
                        <form method="POST" action="">
                            <div class="mb-3">
                                <label for="name" class="form-label">Fruit Name:</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                            
                            <div class="mb-3">
                                <label for="color" class="form-label">Color:</label>
                                <input type="text" class="form-control" id="color" name="color" required>
                            </div>
                            
                            <div class="mb-3">
                                <label for="weight" class="form-label">Weight (grams):</label>
                                <input type="text" class="form-control" id="weight" name="weight" required>
                            </div>
                            
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary" name="submit">Add Fruit</button>
                            </div>
                        </form>
                        <?php
                        class Fruit {
                            public $name;
                            public $color;
                            public $weight;
                            function set_name($n) { $this->name = $n; }
                            function set_color($n) { $this->color = $n; }
                            function set_weight($n) { $this->weight = $n; }
                            function get_name() { return $this->name; }
                            function get_color() { return $this->color; }
                            function get_weight() { return $this->weight; }
                            function display_info() {
                                return "Fruit: {$this->name}, Color: {$this->color}, Weight: {$this->weight} grams";
                            }
                        }

                        if(isset($_POST['submit'])) {
                            $fruit_name = htmlspecialchars($_POST['name']);
                            $fruit_color = htmlspecialchars($_POST['color']);
                            $fruit_weight = htmlspecialchars($_POST['weight']);
                            
                            $fruit = new Fruit();
                            $fruit->set_name($fruit_name);
                            $fruit->set_color($fruit_color);
                            $fruit->set_weight($fruit_weight);
                            
                            echo '<div class="alert alert-success mt-4">';
                            echo '<h5>Fruit Added Successfully!</h5>';
                            echo '<p class="mb-1"><strong>Name:</strong> ' . $fruit->get_name() . '</p>';
                            echo '<p class="mb-1"><strong>Color:</strong> ' . $fruit->get_color() . '</p>';
                            echo '<p class="mb-1"><strong>Weight:</strong> ' . $fruit->get_weight() . ' grams</p>';
                            echo '<p class="mb-0"><strong>Full Info:</strong> ' . $fruit->display_info() . '</p>';
                            echo '</div>';
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>