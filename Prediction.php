<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $total_marks = $_POST['total_marks'];

    // Call the Python script
    $output = exec("python predict_progress.py $total_marks");

    // Display the output
    echo "Predicted Progress: $output";
}
?>

<!DOCTYPE html>
<html>
<body>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        Enter Total Marks: <input type="text" name="total_marks">
        <input type="submit" value="Predict">
    </form>
</body>
</html>
