<?php
// process-order.php

// Database credentials
$servername = "localhost";
$username = "root"; // Your MySQL username
$password = ""; // Your MySQL password
$dbname = "restaurant_db"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get data from form
$pizza_name = $_POST['pizza_name'];
$quantity = $_POST['quantity'];
$customer_name = $_POST['customer_name'];
$customer_email = $_POST['customer_email'];

// Calculate total price (you can change this logic as per your requirements)
$price_per_pizza = 10.00; // Price per pizza (you can change this to dynamic pricing)
$total_price = $price_per_pizza * $quantity;

// SQL query to insert the order into the database
$sql = "INSERT INTO orders (food_name, quantity, total_price, customer_name, customer_email)
        VALUES ('$pizza_name', '$quantity', '$total_price', '$customer_name', '$customer_email')";

// Execute the query
if ($conn->query($sql) === TRUE) {
    // Redirect to a Thank You page
    header('Location: thank-you.html');
    exit();
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close the connection
$conn->close();
?>

<?php
if (isset($_GET['food_id'])) {
    // Capture the food ID from the URL
    $food_id = $_GET['food_id'];

    // Connect to the database (replace with your database details)
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "restaurant_db";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Query the database to get the food details based on the food_id
    $sql = "SELECT * FROM burgers WHERE id = $food_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Fetch the result
        $row = $result->fetch_assoc();
        echo "<h2>Order Details</h2>";
        echo "<p>Food: " . $row['name'] . "</p>";
        echo "<p>Description: " . $row['description'] . "</p>";
        echo "<p>Price: " . $row['price'] . "</p>";

        // You can now add form fields to capture customer info, e.g., name, address, etc.
    } else {
        echo "No such food item found.";
    }

    // Close the database connection
    $conn->close();
} else {
    echo "Food ID not provided.";
}
?>

<?php
// Check if the food_id is passed in the URL
if (isset($_GET['food_id'])) {
    // Capture the food ID from the URL
    $food_id = $_GET['food_id'];

    // Connect to the database (replace with your database details)
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "restaurant_db"; // Use your database name here

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Query the database to get the pizza details based on the food_id
    $sql = "SELECT * FROM pizzas WHERE id = $food_id"; // Assuming you have a `pizzas` table
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Fetch the result
        $row = $result->fetch_assoc();
        echo "<h2>Order Details</h2>";
        echo "<p>Pizza: " . $row['name'] . "</p>";
        echo "<p>Description: " . $row['description'] . "</p>";
        echo "<p>Price: " . $row['price'] . "</p>";

        // You can add additional code here to process the order (e.g., order form, confirmation)
    } else {
        echo "No such pizza found.";
    }

    // Close the database connection
    $conn->close();
} else {
    echo "Pizza ID not provided.";
}
?>
<?php
// Step 1: Establish a connection to the database
$servername = "localhost";
$username = "root";  // Your MySQL username
$password = "";  // Your MySQL password
$dbname = "restaurant_db";  // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Step 2: Check if food_id is passed in the URL
if (isset($_GET['food_id'])) {
    // Get the food ID from the URL
    $food_id = $_GET['food_id'];

    // Step 3: Define a default quantity for the item
    $quantity = 1;  // Default quantity (can be changed with user input)

    // Step 4: Retrieve food details from the database (optional but recommended for verifying the food)
    $sql = "SELECT * FROM pizzas WHERE id = $food_id";  // Assuming you have a 'pizzas' table
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Fetch pizza details (optional)
        $row = $result->fetch_assoc();
        $pizza_name = $row['name'];  // Food name from the table
        $pizza_price = $row['price'];  // Price from the table

        // Step 5: Add the pizza to the cart
        session_start();  // Start a session to track cart
        $user_id = session_id();  // For simplicity, using session ID, you can replace it with user ID if authenticated
        
        // Prepare the SQL query to insert the order into the cart
        $insert_sql = "INSERT INTO cart (food_id, user_id, quantity) VALUES (?, ?, ?)";
        
        // Prepare statement
        $stmt = $conn->prepare($insert_sql);
        
        // Bind parameters to the SQL query
        $stmt->bind_param("iii", $food_id, $user_id, $quantity);

        // Execute the query
        if ($stmt->execute()) {
            // If successful, redirect to the cart page or thank you page
            header('Location: cart.php');  // Redirect to cart.php or thank-you.php
            exit();
        } else {
            // If there is an error, show an error message
            echo "Error: " . $stmt->error;
        }
    } else {
        // If the pizza doesn't exist in the database
        echo "Food item not found!";
    }
} else {
    echo "No food selected!";
}

// Close the connection
$conn->close();
?>

<?php
// Database Connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "restaurant";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve Form Data
$food = "Food Title"; // Replace with dynamic food title from session or GET parameter
$price = 150;         // Replace with dynamic food price from session or GET parameter
$quantity = $_POST['qty'];
$full_name = $_POST['full-name'];
$contact = $_POST['contact'];
$email = $_POST['email'];
$address = $_POST['address'];

// Insert into Database
$sql = "INSERT INTO orders (food, price, quantity, full_name, contact, email, address) 
        VALUES ('$food', '$price', '$quantity', '$full_name', '$contact', '$email', '$address')";

if ($conn->query($sql) === TRUE) {
    echo "Order placed successfully!";
    header("Location: order-confirm.html"); // Redirect to confirmation page
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>


