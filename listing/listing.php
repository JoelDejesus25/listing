<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plant Categories</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <!-- Link to Google Fonts for Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1>Plant Categories</h1>
        <div class="search-bar">
            <input type="text" id="searchInput" placeholder="Search..." onkeyup="filterCategories()" />
        </div>

        <div class="category-section">
            <h2>Plant Type:</h2>
            <div class="categories" id="plantTypeCategories"></div>
        </div>

        <div class="category-section">
            <h2>Plant Size:</h2>
            <div class="categories" id="plantSizeCategories"></div>
        </div>

        <div class="category-section">
            <h2>Plant Color:</h2>
            <div class="categories" id="plantColorCategories"></div>
        </div>
    </div>

    <script>
        function filterCategories() {
            const input = document.getElementById('searchInput').value.toLowerCase();
            const categories = document.querySelectorAll('.category-card');

            categories.forEach(card => {
                if (card.textContent.toLowerCase().includes(input)) {
                    card.style.display = ''; // Show card
                } else {
                    card.style.display = 'none'; // Hide card
                }
            });
        }

        const categoriesData = {
            plantTypes: [
                "Aquatic", "Outdoor", "Indoor", "Leaves", 
                "Bushes", "Flowers", "Trees", "Climbers", 
                "Grasses", "Succulent", "Cacti"
            ],
            plantSizes: [
                "Small", "Medium", "Large"
            ],
            plantColors: [
                "Red", "Purple", "Green", "Yellow", "Blue"
            ]
        };

        const plantTypeContainer = document.getElementById('plantTypeCategories');
        const plantSizeContainer = document.getElementById('plantSizeCategories');
        const plantColorContainer = document.getElementById('plantColorCategories');

        // Function to create category cards
        function createCategoryCards(data, container) {
            data.forEach(category => {
                const card = document.createElement('div');
                card.className = 'category-card';
                card.textContent = category;
                container.appendChild(card);
            });
        }

        // Add categories to the respective containers
        createCategoryCards(categoriesData.plantTypes, plantTypeContainer);
        createCategoryCards(categoriesData.plantSizes, plantSizeContainer);
        createCategoryCards(categoriesData.plantColors, plantColorContainer);
    </script>
</body>
</html>
