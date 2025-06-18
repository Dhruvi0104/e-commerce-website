<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Bar Toggle</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .navbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background-color: #6b8e23;
            padding: 15px 20px;
        }

        .search-icon {
            width: 30px;
            height: 30px;
            cursor: pointer;
        }

        .search-container {
            display: none;
            /* Initially hidden */
            position: absolute;
            top: 60px;
            right: 20px;
            background: white;
            padding: 10px;
            border-radius: 5px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
        }

        .search-input {
            width: 200px;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .close-btn {
            cursor: pointer;
            font-size: 16px;
            color: #ff3333;
            margin-left: 5px;
            font-weight: bold;
        }
    </style>
</head>

<body>

    <div class="navbar">
        <h2 style="color: white;">My Store</h2>
        <img src="search-icon.png" alt="Search" class="search-icon" onclick="toggleSearch()">
    </div>

    <div class="search-container" id="searchBox">
        <input type="text" class="search-input" placeholder="Search products...">
        <span class="close-btn" onclick="toggleSearch()">×</span>
    </div>

    <script>
        function toggleSearch() {
            var searchBox = document.getElementById("searchBox");
            if (searchBox.style.display === "block") {
                searchBox.style.display = "none";
            } else {
                searchBox.style.display = "block";
            }
        }
    </script>

</body>

</html>