<!DOCTYPE html>
<html>
<head>
    <title>Fruit Input Form</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; }
        .form-container { max-width: 500px; margin: 0 auto; }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; font-weight: bold; }
        input[type="text"] { width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px; }
        button { background: #4CAF50; color: white; padding: 10px 20px; border: none; border-radius: 4px; cursor: pointer; }
        .result { margin-top: 20px; padding: 15px; background: #f9f9f9; border-radius: 4px; }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Enter Fruit Details</h2>
        
        <form method="POST" action="">
            <div class="form-group">
                <label for="name">Fruit Name:</label>
                <input type="text" id="name" name="name" required>
            </div>
            
            <div class="form-group">
                <label for="color">Color:</label>
                <input type="text" id="color" name="color" required>
            </div>
            
            <div class="form-group">
                <label for="weight">Weight (grams):</label>
                <input type="text" id="weight" name="weight" required>
            </div>
            
            <button type="submit" name="submit">Add Fruit</button>
        </form>

        <?php
        class Fruit {
            public $name;
            public $color;
            public $weight;

            function set_name($n) {
                $this->name = $n;
            }
            
            function set_color($n) {
                $this->color = $n;
            }
            
            function set_weight($n) {
                $this->weight = $n;
            }
            
            function get_name() {
                return $this->name;
            }
            
            function get_color() {
                return $this->color;
            }
            
            function get_weight() {
                return $this->weight;
            }
            
            function display_info() {
                return "Fruit: {$this->name}, Color: {$this->color}, Weight: {$this->weight} grams";
            }
        }

        // Process form submission
        if(isset($_POST['submit'])) {
            $fruit_name = htmlspecialchars($_POST['name']);
            $fruit_color = htmlspecialchars($_POST['color']);
            $fruit_weight = htmlspecialchars($_POST['weight']);
            
            // Create new fruit object
            $fruit = new Fruit();
            $fruit->set_name($fruit_name);
            $fruit->set_color($fruit_color);
            $orange = new Fruit();
            $orange->set_name("orange");
            // Display results
            echo "<div class='result'>";
            echo "<h3>Fruit Added Successfully!</h3>";
            echo "<p><strong>Name:</strong> " . $fruit->get_name() . "</p>";
            echo "<p><strong>Color:</strong> " . $fruit->get_color() . "</p>";
            echo "<p><strong>Weight:</strong> " . $fruit->get_weight() . " grams</p>";
            echo "<p><strong>Full Info:</strong> " . $fruit->display_info() . "</p>";
            echo "</div>";
        }
        ?>
    </div>
</body>
</html>