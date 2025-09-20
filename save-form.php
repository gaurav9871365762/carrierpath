<?php
include('db.php'); // isme apka $conn connection hoga

// Helper: sanitize input
function s($v){ return htmlspecialchars(trim($v), ENT_QUOTES, 'UTF-8'); }

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone_no = mysqli_real_escape_string($conn, $_POST['phone_no'] ?? "");
    $massage = mysqli_real_escape_string($conn, $_POST['massage']);

    $resumeFile = "";

    // ✅ Resume Upload Handling
    if (isset($_FILES['resume']) && $_FILES['resume']['error'] === UPLOAD_ERR_OK) {
        $allowedExts = ['pdf','doc','docx'];
        $fileTmp = $_FILES['resume']['tmp_name'];
        $fileName = basename($_FILES['resume']['name']);
        $fileSize = $_FILES['resume']['size'];
        $ext = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

        if (!in_array($ext, $allowedExts)) {
            die("<div style='background:#7f1d1d;color:#fecaca;padding:12px;border-radius:8px;margin:20px;'>
                ❌ Only PDF, DOC, DOCX files allowed.
                </div>");
        }
        if ($fileSize > 2*1024*1024) {
            die("<div style='background:#7f1d1d;color:#fecaca;padding:12px;border-radius:8px;margin:20px;'>
                ❌ File must be less than 2MB.
                </div>");
        }

        $uploadDir = __DIR__ . "/uploads/";
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        $resumeFile = "uploads/" . time() . "_" . $fileName;

        if (!move_uploaded_file($fileTmp, $resumeFile)) {
            die("<div style='background:#7f1d1d;color:#fecaca;padding:12px;border-radius:8px;margin:20px;'>
                ❌ Error uploading resume.
                </div>");
        }
    } else {
        die("<div style='background:#7f1d1d;color:#fecaca;padding:12px;border-radius:8px;margin:20px;'>
            ❌ Resume upload required.
            </div>");
    }

    // ✅ Insert Query
     $sql = "INSERT INTO form_ (name, email, phone_no, massage, resume) 
            VALUES ('$name', '$email', '$phone_no', '$massage', '$resumeFile')";

    if (mysqli_query($conn, $sql)) {
        echo "<div style='background:#14532d;color:#bbf7d0;padding:12px;border-radius:8px;margin:20px;'>
                ✅ Thank you! Your message has been sent successfully.
              </div>";
        echo "<a href='form.php' style='color:#4dd0e1;'>⬅ Back to Form</a>";
    } else {
        echo "<div style='background:#7f1d1d;color:#fecaca;padding:12px;border-radius:8px;margin:20px;'>
                ❌ Error: " . mysqli_error($conn) . "
              </div>";
    }
}
?>
