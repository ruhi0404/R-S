// JavaScript for login form validation
document.getElementById('loginForm').addEventListener('submit', function (e) {
    e.preventDefault(); // Prevent form submission

    // Get input values
    const email = document.querySelector('input[name="email"]').value.trim();
    const password = document.querySelector('input[name="password"]').value.trim();

    // Simple validation
    let isValid = true;
    let errorMessage = '';

    // Validate email
    if (email === '' || !/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/.test(email)) {
        isValid = false;
        errorMessage += 'Please enter a valid email address.\n';
    }

    // Validate password
    if (password === '') {
        isValid = false;
        errorMessage += 'Please enter your password.\n';
    }

    // Show errors or proceed
    if (!isValid) {
        alert(errorMessage); // Display error message
    } else {
        // If login is successful, redirect to the dashboard (or any other page)
        alert('Login successful!');
        window.location.href = "dashboard.html"; // Redirect to the dashboard or another page
    }
});
