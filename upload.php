<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $course = $_POST["course"];
    $title = $_POST["title"];

    // Directory to store uploaded assignments
    $upload_directory = "uploads/"; // Create this directory if it doesn't exist

    // Check if a file was uploaded
    if (isset($_FILES["assignment"])) {
        $file = $_FILES["assignment"];
        $filename = $file["name"];
        $temp_file = $file["tmp_name"];

        if (move_uploaded_file($temp_file, $upload_directory . $filename)) {
            // File uploaded successfully
            // Provide a link for the user to access their uploaded assignment
            $assignment_link = $upload_directory . $filename;
        } else {
            // Handle file upload failure
            $upload_error = "File upload failed. Please try again.";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Assignment Submission</title>
</head>
<body>
    <h1>Assignment Submission</h1>

    <?php
    if (isset($upload_error)) {
        echo '<p style="color: red;">' . $upload_error . '</p>';
    }

    if (isset($assignment_link)) {
        echo "<p>Assignment successfully uploaded. You can access it here: ";
        echo "<a href='" . $assignment_link . "' download>Download Assignment</a></p>";
    }
    ?>

    <form action="upload.php" method="post" enctype="multipart/form-data">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required><br><br>

        <label for="course">Course:</label>
        <input type="text" id="course" name="course" required><br><br>

        <label for="title">Assignment Title:</label>
        <input type="text" id="title" name="title" required><br><br>

        <label for="assignment">Select Assignment (PDF only):</label>
        <input type="file" id="assignment" name="assignment" accept=".pdf" required><br><br>

        <input type="submit" value="Submit Assignment">
    </form>
</body>
</html>
