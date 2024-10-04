<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Uploaded Plants</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1>Uploaded Plants</h1>
        <div class="search-bar">
            <input type="text" id="searchInput" placeholder="Search..." onkeyup="filterPlants()" />
            <img src="filter-icon.png" alt="Filter" class="filter-icon" onclick="openModal()" />
        </div>

        <div class="modal" id="filterModal">
            <div class="modal-content">
                <span class="close" onclick="closeModal()">&times;</span>
                <h2>Filter Plants</h2>

                <div class="category-section">
                    <h3>Plant Type:</h3>
                    <div class="categories" id="plantTypeCategories"></div>
                </div>

                <div class="category-section">
                    <h3>Plant Size:</h3>
                    <div class="categories" id="plantSizeCategories"></div>
                </div>

                <div class="category-section">
                    <h3>Plant Color:</h3>
                    <div class="categories" id="plantColorCategories"></div>
                </div>
                
                <button onclick="applyFilters()">Apply Filters</button>
            </div>
        </div>

        <div class="plant-list" id="plantList">
            <?php
            include 'conn.php';
            $result = $conn->query("SELECT * FROM plants ORDER BY uploaded_at DESC");
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<a href='plant_detail.php?id=" . htmlspecialchars($row['id']) . "' class='plant-card'>";
                    echo "<h2>" . htmlspecialchars($row['plant_name']) . "</h2>";
                    echo "<img src='" . htmlspecialchars($row['plant_image']) . "' alt='" . htmlspecialchars($row['plant_name']) . "' class='plant-image'>";
                    echo "<p>Description: " . htmlspecialchars($row['plant_description']) . "</p>";
                    echo "<p>Type: " . htmlspecialchars($row['plant_type']) . "</p>";
                    echo "<p>Size: " . htmlspecialchars($row['plant_size']) . "</p>";
                    echo "<p>Color: " . htmlspecialchars($row['plant_color']) . "</p>";
                    echo "</a>";
                }
            } else {
                echo "<p>No plants uploaded yet.</p>";
            }
            $conn->close();
            ?>
        </div>
    </div>

    <script>
        function openModal() {
            const modal = document.getElementById('filterModal');
            modal.style.display = 'block';
        }

        function closeModal() {
            const modal = document.getElementById('filterModal');
            modal.style.display = 'none';
        }

        // Close modal if clicking outside of it
        window.onclick = function(event) {
            const modal = document.getElementById('filterModal');
            if (event.target === modal) {
                closeModal();
            }
        };

        function filterPlants() {
            const input = document.getElementById('searchInput').value.toLowerCase();
            const plants = document.querySelectorAll('.plant-card');

            plants.forEach(card => {
                if (card.textContent.toLowerCase().includes(input)) {
                    card.style.display = ''; // Show card
                } else {
                    card.style.display = 'none'; // Hide card
                }
            });
        }

        const selectedFilters = {
            plantTypes: [],
            plantSizes: [],
            plantColors: []
        };

        const categoriesData = {
            plantTypes: ["Aquatic", "Outdoor", "Indoor", "Leaves", "Bushes", "Flowers", "Trees", "Climbers", "Grasses", "Succulent", "Cacti"],
            plantSizes: ["Small", "Medium", "Large"],
            plantColors: ["Red", "Purple", "Green", "Yellow", "Blue"]
        };

        const plantTypeContainer = document.getElementById('plantTypeCategories');
        const plantSizeContainer = document.getElementById('plantSizeCategories');
        const plantColorContainer = document.getElementById('plantColorCategories');

        function createCategoryCards(data, container, categoryType) {
            data.forEach(category => {
                const card = document.createElement('div');
                card.className = 'category-card';

                const checkbox = document.createElement('input');
                checkbox.type = 'checkbox';
                checkbox.value = category;
                checkbox.id = `${categoryType}-${category}`;

                checkbox.addEventListener('change', function() {
                    if (this.checked) {
                        selectedFilters[categoryType].push(this.value);
                    } else {
                        selectedFilters[categoryType] = selectedFilters[categoryType].filter(item => item !== this.value);
                    }
                });

                const label = document.createElement('label');
                label.htmlFor = checkbox.id;
                label.textContent = category;

                card.appendChild(checkbox);
                card.appendChild(label);
                container.appendChild(card);
            });
        }

        function applyFilters() {
            const plants = document.querySelectorAll('.plant-card');

            // Log selected filters for debugging
            console.log(`Selected Filters: ${JSON.stringify(selectedFilters)}`);

            plants.forEach(card => {
                const plantType = card.querySelector('p:nth-child(3)').textContent.split(': ')[1].trim(); // Type
                const plantSize = card.querySelector('p:nth-child(4)').textContent.split(': ')[1].trim(); // Size
                const plantColor = card.querySelector('p:nth-child(5)').textContent.split(': ')[1].trim(); // Color

                const typeMatch = selectedFilters.plantTypes.length === 0 || selectedFilters.plantTypes.includes(plantType);
                const sizeMatch = selectedFilters.plantSizes.length === 0 || selectedFilters.plantSizes.includes(plantSize);
                const colorMatch = selectedFilters.plantColors.length === 0 || selectedFilters.plantColors.includes(plantColor);

                // Show or hide the card based on filter matches
                if (typeMatch && sizeMatch && colorMatch) {
                    card.style.display = ''; // Show card
                } else {
                    card.style.display = 'none'; // Hide card
                }
            });

            closeModal(); // Close modal after applying filters
        }

        // Create category cards for filter options
        createCategoryCards(categoriesData.plantTypes, plantTypeContainer, 'plantTypes');
        createCategoryCards(categoriesData.plantSizes, plantSizeContainer, 'plantSizes');
        createCategoryCards(categoriesData.plantColors, plantColorContainer, 'plantColors');
    </script>
</body>
</html>
