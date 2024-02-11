<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor Reviews</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .container {
            margin-top: 50px;
        }

        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            transition: box-shadow 0.3s;
        }

        .card:hover {
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        .card-body {
            padding: 20px;
        }

        .btn-outline-secondary {
            color: #fff;
            background-color: #6c757d;
            border-color: #6c757d;
        }

        .btn-outline-secondary:hover {
            color: #6c757d;
            background-color: #fff;
            border-color: #6c757d;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <!-- Search Form -->
                <form method="GET" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Search for a doctor" name="search_query">
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary" type="submit">Search</button>
                        </div>
                    </div>
                </form>

                <div class="container">
                    <div class="row">

                        <div class="col-md-8 offset-md-2">
                            <?php
                            $servername = "localhost";
                            $username = "root";
                            $password = "";
                            $dbname = "fund";

                            $conn = new mysqli($servername, $username, $password, $dbname);

                            if ($conn->connect_error) {
                                die("Connection failed: " . $conn->connect_error);
                            }

                            // Check if the search query is set
                            $search_query = isset($_GET['search_query']) ? '%' . $_GET['search_query'] . '%' : '';

                            // Use a prepared statement for better security
                            if (!empty($search_query)) {
                                $sql = "SELECT * FROM reviews WHERE doctor_name LIKE ?";
                                $stmt = $conn->prepare($sql);
                                $stmt->bind_param("s", $search_query);
                                $stmt->execute();
                                $result = $stmt->get_result();
                            } else {
                                $sql = "SELECT * FROM reviews";
                                $result = $conn->query($sql);
                            }

                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo '<div class="card">';
                                    echo '<div class="card-body">';
                                    echo '<h5 class="card-title" style="color: #007bff;">Doctor: ' . $row["doctor_name"] . '</h5>';
                                    echo '<p class="card-text">Rating: ' . $row["rating"] . '</p>';
                                    echo '<p class="card-text">Comment: ' . $row["comment"] . '</p>';
                                    echo '</div>';
                                    echo '</div>';
                                }
                            } else {
                                echo '<p class="alert alert-info">No reviews found.</p>';
                            }

                            $conn->close();
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Include Bootstrap JS and Popper.js -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
