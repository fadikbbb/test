<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Form</title>
    <link rel="stylesheet" href="main.css">
    <style>
        * {
            box-sizing: border-box;
        }

        form {
            display: flex;
            flex-direction: column;
            width: 400px;
            padding: 15px;
            background-color: #eee;
            border-radius: 10px;
            justify-content: center;
            align-items: center;
        }

        #submit {
            width: fit-content;
            padding: 5px 5px;
        }

        .img-product {
            width: 100px;
        }

        .products div {
            display: flex;
            flex-direction: row;
            width: 100%;
            justify-content: space-around;
        }

        main {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
        }

        section {
            width: 100%;
        }
    </style>
</head>

<body>
    <main>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"
            enctype="multipart/form-data">
            <label for="imgProduct">Image Product:</label>
            <input type="file" required name="imgPro[]" id="imgProduct" multiple />
            <label for="nameProduct">Name Product:</label>
            <input type="text" required name="namePro" id="nameProduct" />

            <label for="desProduct">Description Product:</label>
            <input type="text" required name="desPro" id="desProduct" />

            <label for="priceProduct">Price Product:</label>
            <input type="number" step="0.01" required name="pricePro" id="priceProduct" />

            <label for="category">Category:</label>
            <select name="category" id="category" required>
                <?php
                $categories = array("شوكالا", "راحة", "موالح", "عروضات","مكسرات");
                foreach ($categories as $category) {
                    echo "<option value='$category'>" . ucfirst($category) . "</option>";
                }
                ?>
            </select>

            <input type="submit" name="submit" id="submit" value="Submit" />
        </form>

        <section>
            <?php
            // Database connection
            $conn = new mysqli('localhost', 'root', '', 'alharmyn');

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                if (isset($_POST['namePro'], $_POST['desPro'], $_POST['pricePro'], $_POST['category']) && isset($_FILES['imgPro'])) {
                    $namePro = $_POST['namePro'];
                    $desPro = $_POST['desPro'];
                    $pricePro = $_POST['pricePro'];
                    $category = $_POST['category'];

                    // Check if files were uploaded
                    if (!empty($_FILES['imgPro']['name']) && is_array($_FILES['imgPro']['name'])) {
                        // Handle multiple file uploads
                        foreach ($_FILES['imgPro']['tmp_name'] as $key => $tmp_name) {
                            $imgName = $_FILES['imgPro']['name'][$key];
                            $imgTmpName = $_FILES['imgPro']['tmp_name'][$key];
                            $uploadDirectory = '../../uploads/';

                            // Move the uploaded file to the destination folder
                            if (move_uploaded_file($imgTmpName, $uploadDirectory . $imgName)) {
                                $imgPath = $imgName;
                                $stmt = $conn->prepare("INSERT INTO product (p_name, p_price, p_description, category, p_img) VALUES (?, ?, ?, ?, ?)");
                                if ($stmt) {
                                    $stmt->bind_param("sisss", $namePro, $pricePro, $desPro, $category, $imgPath);
                                    if ($stmt->execute()) {
                                        echo "Product inserted into database successfully.";
                                    } else {
                                        echo "Error inserting product into database: " . $conn->error;
                                    }
                                    $stmt->close();
                                } else {
                                    echo "Error preparing statement: " . $conn->error;
                                }
                            } else {
                                echo "Error moving file to destination folder.";
                            }
                        }
                    } else {
                        echo "No files uploaded.";
                    }
                } else {
                    echo "All fields are required.";
                }
            }
            $conn->close();
            ?>
        </section>
    </main>
</body>

</html>
