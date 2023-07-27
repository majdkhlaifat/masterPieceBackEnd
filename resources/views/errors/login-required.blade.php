<!DOCTYPE html>
<html>
<head>
    <title>Login Required</title>
    <!-- Add your CSS styles here -->
    <style>
        /* Popup styles */
        .popup {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: white;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            z-index: 9999;
        }
    </style>
</head>
<body>
    <div class="popup">
        <h1>Login Required</h1>
        <p>You need to log in to access this page.</p>
        <!-- Add additional content or styling as needed -->
    </div>

    <!-- Add your JavaScript code to close the popup on click -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var popup = document.querySelector('.popup');

            popup.addEventListener('click', function() {
                popup.style.display = 'none';
            });
        });
    </script>
</body>
</html>
