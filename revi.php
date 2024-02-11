<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Review Doctor</title>

    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <!-- Optional: Add your own styles here -->
    <style>
        body {
            background-color: #f8f9fa;
            padding: 20px;
        }

        .container {
            max-width: 600px;
            border: 1px solid #ced4da;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            padding: 20px;
            background-color: #ffffff;
        }

        .form-group {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

    <div class="container">
        <form action="submit_review.php" method="post">
            <div class="form-group">
                <label for="doctor_name">เลือกหมอ:</label>
                <select class="form-control" name="doctor_name" required>
                    <option value="A">หมอ A</option>
                    <option value="B">หมอ B</option>
                    <option value="C">หมอ C</option>
                    <option value="D">หมอ D</option>
                    <option value="E">หมอ E</option>
                    <option value="F">หมอ F</option>
                </select>
            </div>

            <div class="form-group">
                <label for="rating">คะแนน:</label>
                <input type="number" class="form-control" name="rating" min="1" max="5" required>
            </div>

            <div class="form-group">
                <label for="comment">ความคิดเห็น:</label>
                <textarea class="form-control" name="comment" rows="4" required></textarea>
            </div>

            <button type="submit" class="btn btn-primary">ส่งรีวิว</button>
        </form>
    </div>

    <!-- Bootstrap JS and Popper.js (optional) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
