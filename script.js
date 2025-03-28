document.addEventListener('DOMContentLoaded', function() {
    // Categories for the dropdown
    const categories = ['Pizza', 'Burger', 'Momo', 'Cake'];

    // Find the search input and form
    const searchInput = document.querySelector('input[name="search"]');
    const foodSearchForm = document.querySelector('.food-search form');

    // Create a dropdown for category selection dynamically
    const categoryDropdown = document.createElement('select');
    categoryDropdown.setAttribute('name', 'category');
    categoryDropdown.setAttribute('id', 'category-dropdown');

    // Create a default "Select Category" option
    const defaultOption = document.createElement('option');
    defaultOption.value = '';
    defaultOption.textContent = 'Select Category';
    categoryDropdown.appendChild(defaultOption);

    // Add categories to the dropdown
    categories.forEach(category => {
        const option = document.createElement('option');
        option.value = category.toLowerCase();
        option.textContent = category;
        categoryDropdown.appendChild(option);
    });

    // Insert the dropdown before the search input in the form
    foodSearchForm.insertBefore(categoryDropdown, searchInput);

    // Handle the category selection
    categoryDropdown.addEventListener('change', function() {
        filterFoodItems();
    });

    // Handle the search input
    searchInput.addEventListener('input', function() {
        filterFoodItems();
    });

    function filterFoodItems() {
        const query = searchInput.value.toLowerCase();
        const selectedCategory = categoryDropdown.value;
        
        // Get all food items and filter based on category and search query
        const foodItems = document.querySelectorAll('.box-3');
        foodItems.forEach(item => {
            const foodCategory = item.querySelector('h3').textContent.toLowerCase();
            const foodName = item.querySelector('h3').textContent.toLowerCase();

            // Check if the item matches both the search query and the selected category (if any)
            if (
                (foodName.includes(query) || query === '') &&
                (foodCategory.includes(selectedCategory) || selectedCategory === '')
            ) {
                item.style.display = 'block';  // Show item
            } else {
                item.style.display = 'none';   // Hide item
            }
        });
    }
});
// JavaScript for Momo and Burger options

document.addEventListener("DOMContentLoaded", function () {

    // Functionality for "Order Now" buttons
    const orderButtons = document.querySelectorAll('.order-btn');

    orderButtons.forEach(function (button) {
        button.addEventListener('click', function () {
            alert('Your order has been placed!');
        });
    });

    // If you want to add more functionality like a "hover effect" or show "order options" dynamically, you can do it here
    const momoImages = document.querySelectorAll('.momo-img');
    const burgerImages = document.querySelectorAll('.burger-img');

    // For Momo images (if you have specific JS effects for them)
    momoImages.forEach(function (image) {
        image.addEventListener('mouseenter', function () {
            image.style.transform = 'scale(1.1)';
        });

        image.addEventListener('mouseleave', function () {
            image.style.transform = 'scale(1)';
        });
    });

    // For Burger images (similar hover effect can be added for burgers if needed)
    burgerImages.forEach(function (image) {
        image.addEventListener('mouseenter', function () {
            image.style.transform = 'scale(1.1)';
        });

        image.addEventListener('mouseleave', function () {
            image.style.transform = 'scale(1)';
        });
    });
});
