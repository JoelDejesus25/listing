<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Plant</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1>Upload a Plant</h1>
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="plant-name">Plant Name:</label>
                <input type="text" id="plant-name" name="plant_name" placeholder="Enter plant name" required>
            </div>

            <div class="form-group">
                <label for="plant-description">Description:</label>
                <textarea id="plant-description" name="plant_description" rows="5" placeholder="Enter plant description" required></textarea>
            </div>

            <div class="form-group">
                <label for="plant-image">Upload Image:</label>
                <input type="file" id="plant-image" name="plant_image" required>
            </div>

            <div class="form-group">
                <label for="plant-type">Plant Type:</label>
                <select id="plant-type" name="plant_type" required>
                    <option value="Aquatic">Aquatic</option>
                    <option value="Outdoor">Outdoor</option>
                    <option value="Indoor">Indoor</option>
                    <option value="Leaves">Leaves</option>
                    <option value="Bushes">Bushes</option>
                    <option value="Flowers">Flowers</option>
                    <option value="Trees">Trees</option>
                    <option value="Climbers">Climbers</option>
                    <option value="Grasses">Grasses</option>
                    <option value="Succulent">Succulent</option>
                    <option value="Cacti">Cacti</option>
                </select>
            </div>

            <div class="form-group">
                <label for="plant-size">Plant Size:</label>
                <select id="plant-size" name="plant_size" required>
                    <option value="Small">Small</option>
                    <option value="Medium">Medium</option>
                    <option value="Large">Large</option>
                </select>
            </div>

            <div class="form-group">
                <label for="plant-color">Plant Color:</label>
                <select id="plant-color" name="plant_color" required>
                    <option value="Red">Red</option>
                    <option value="Purple">Purple</option>
                    <option value="Green">Green</option>
                    <option value="Yellow">Yellow</option>
                    <option value="Blue">Blue</option>
                </select>
            </div>

            <button type="submit" name="submit">Upload Plant</button>
        </form>
    </div>

    <?php
    // Enable error reporting
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    // Include the database connection file
    include 'conn.php'; // Ensure this file contains your connection details

    function uploadPlant($data, $file, $conn) {
        // Check if upload directory exists, if not, create it
        $targetDir = "uploads/";
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0777, true); // Create the directory with appropriate permissions
        }

        // Get plant data
        $plantName = $data['plant_name'];
        $plantDescription = $data['plant_description'];
        $plantType = $data['plant_type'];
        $plantSize = $data['plant_size'];
        $plantColor = $data['plant_color'];

        // Handle file upload
        $targetFile = $targetDir . basename($file["plant_image"]["name"]);
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        // Check if image file is an actual image
        $check = getimagesize($file["plant_image"]["tmp_name"]);
        if ($check === false) {
            return "File is not an image.";
        }

        // Check file size (limit to 2MB)
        if ($file["plant_image"]["size"] > 2000000) {
            return "Sorry, your file is too large.";
        }

        // Allow certain file formats
        if (!in_array($imageFileType, ['jpg', 'png', 'jpeg', 'gif'])) {
            return "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        }

        // Sanitize the file name
        $newFileName = uniqid('', true) . '.' . $imageFileType;
        $targetFile = $targetDir . $newFileName;

        // Attempt to move the uploaded file
        if (move_uploaded_file($file["plant_image"]["tmp_name"], $targetFile)) {
            // Prepare an SQL statement to prevent SQL injection
            $stmt = $conn->prepare("INSERT INTO plants (plant_name, plant_description, plant_type, plant_size, plant_color, plant_image, uploaded_at) VALUES (?, ?, ?, ?, ?, ?, NOW())");
            $stmt->bind_param("ssssss", $plantName, $plantDescription, $plantType, $plantSize, $plantColor, $targetFile);

            if ($stmt->execute()) {
                // Redirect to plants.php after successful upload
                header("Location: plants.php?success=1");
                exit; // Stop further script execution
            } else {
                return "Error saving plant data to the database: " . $stmt->error;
            }
        } else {
            return "Sorry, there was an error uploading your file. Error: " . error_get_last()['message'];
        }
    }

    if (isset($_POST['submit'])) {
        $result = uploadPlant($_POST, $_FILES, $conn);
        echo $result;
    }

    // Close the database connection
    $conn->close();
    ?>
</body>
</html>
