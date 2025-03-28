<?php
session_start();
?>

<?php
// Start the session to track cart data
session_start();

// Check if the food_id is passed via the URL
if (isset($_GET['food_id'])) {
    $food_id = $_GET['food_id'];

    // Retrieve the food details (this could come from a database)
    // For simplicity, we'll just use an array of example foods
    $foods = [
        1 => ['name' => 'Chocolate Cake', 'price' => 5.99],
        2 => ['name' => 'Vanilla Cake', 'price' => 4.99],
    ];

    // Check if the food_id exists
    if (array_key_exists($food_id, $foods)) {
        // If the food_id exists, add the item to the cart (session)
        $_SESSION['cart'][] = $foods[$food_id];

        // Redirect to the cart page (or you can stay on the same page)
        header("Location: cart.php");
        exit();
    } else {
        // If the food_id is invalid
        echo "Food item not found!";
    }
} else {
    // If no food_id is passed
    echo "No food selected!";
}
?>
<?php
// Start the session to track cart data
session_start();

// Define food items for different categories (Burgers, Momo, Cake, etc.)
$foods = [
    // Burger Items
    1 => ['name' => 'Cheese Burger', 'price' => 5.99, 'description' => 'A delicious cheesy delight with extra cheese and a juicy patty.', 'image_url' => 'cheese.jpg', 'category' => 'burger'],
    2 => ['name' => 'Chicken Burger', 'price' => 6.49, 'description' => 'Crispy chicken with lettuce, tomatoes, and a special sauce.', 'image_url' => 'ck burger.jpg', 'category' => 'burger'],
    3 => ['name' => 'Veggie Burger', 'price' => 4.99, 'description' => 'A healthy veggie patty loaded with fresh veggies and sauce.', 'image_url' => 'veggg.jpg', 'category' => 'burger'],
    4 => ['name' => 'BBQ Burger', 'price' => 6.99, 'description' => 'Grilled beef patty with smoky BBQ sauce and crispy onions.', 'image_url' => 'bbq.jpg', 'category' => 'burger'],
    5 => ['name' => 'Spicy Burger', 'price' => 5.49, 'description' => 'A spicy kick with jalapenos, chili sauce, and hot seasoning.', 'image_url' => 'spicy.jpg', 'category' => 'burger'],
    6 => ['name' => 'Double Burger', 'price' => 7.49, 'description' => 'Two juicy patties stacked high with cheese and bacon.', 'image_url' => 'double.jpg', 'category' => 'burger'],
    
    // You can add other categories like Cake, Momo, etc. if needed
];

// Check if the food_id is passed via the URL
if (isset($_GET['food_id'])) {
    $food_id = $_GET['food_id'];

    // Check if the food_id exists in the foods array
    if (array_key_exists($food_id, $foods)) {
        // Add the item to the cart session
        $_SESSION['cart'][] = $foods[$food_id];

        // Redirect to the cart page after adding the item
        header("Location: cart.php");
        exit();
    } else {
        // If food_id is invalid
        echo "Food item not found!";
    }
} else {
    // If no food_id is passed
    echo "No food selected!";
}
?>
