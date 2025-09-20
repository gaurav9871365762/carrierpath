<?php
include('db.php'); // isme apka $conn connection hoga

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $subject = mysqli_real_escape_string($conn, $_POST['subject']);

    // insert query
    $sql = "INSERT INTO contact (name, email, subject) 
            VALUES ('$name', '$email', '$subject')";

    if (mysqli_query($conn, $sql)) {
        echo "<div style='background:#14532d;color:#bbf7d0;padding:12px;border-radius:8px;margin:20px;'>
                ✅ Thank you! Your message has been sent successfully.
              </div>";
        echo "<a href='contact.php' style='color:#4dd0e1;'>Back to Contact</a>";
    } else {
        echo "<div style='background:#7f1d1d;color:#fecaca;padding:12px;border-radius:8px;margin:20px;'>
                ❌ Error: " . mysqli_error($conn) . "
              </div>";
    }
}
?>
