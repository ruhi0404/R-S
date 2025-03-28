<?php
// Start the session to access cart data
session_start();

// Check if the cart exists
if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) {
    echo "<h2>Your Cart:</h2>";
    foreach ($_SESSION['cart'] as $item) {
        echo "<p>{$item['name']} - \${$item['price']}</p>";
    }
} else {
    echo "<p>Your cart is empty.</p>";
}
?>
<?php
// Start session to track cart
session_start();
$user_id = session_id();  // Get the user session ID

// Connect to the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "restaurant_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the items in the user's cart
$sql = "SELECT c.id, p.name, c.quantity, p.price FROM cart c JOIN pizzas p ON c.food_id = p.id WHERE c.user_id = '$user_id' AND c.order_status = 'pending'";
$result = $conn->query($sql);

echo "<h2>Your Cart</h2>";
echo "<table>";
echo "<tr><th>Food Name</th><th>Quantity</th><th>Price</th><th>Total</th></tr>";

$total_price = 0;

while ($row = $result->fetch_assoc()) {
    $item_total = $row['quantity'] * $row['price'];
    $total_price += $item_total;
    echo "<tr>";
    echo "<td>" . $row['name'] . "</td>";
    echo "<td>" . $row['quantity'] . "</td>";
    echo "<td>" . $row['price'] . "</td>";
    echo "<td>" . $item_total . "</td>";
    echo "</tr>";
}

echo "<tr><td colspan='3'><strong>Total</strong></td><td><strong>" . $total_price . "</strong></td></tr>";
echo "</table>";

// Close the connection
$conn->close();
?>
