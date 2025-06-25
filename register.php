<?php
include 'db.php';

if (isset($_POST['submit'])) {
    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // ✅ Hash the password here
    $branch = $_POST['branch'];
    $grad_year = $_POST['grad_year'];
    $status = $_POST['status'];
    $role = $_POST['role'];

    $targetDir = "uploads/";
    $fileName = basename($_FILES["profile_pic"]["name"]);
    $targetFilePath = $targetDir . $fileName;
    $fileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));

    $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];

    if (in_array($fileType, $allowedTypes)) {
        if (move_uploaded_file($_FILES["profile_pic"]["tmp_name"], $targetFilePath)) {
            $sql = "INSERT INTO users (full_name, email, password, branch, grad_year, status, role, profile_pic)
                    VALUES ('$full_name', '$email', '$password', '$branch', '$grad_year', '$status', '$role', '$fileName')";
            if (mysqli_query($conn, $sql)) {
                echo "<p style='color:green; text-align:center;'>✅ Registration Successful!</p>";
            } else {
                echo "<p style='color:red; text-align:center;'>❌ Error inserting data.</p>";
            }
        } else {
            echo "<p style='color:red; text-align:center;'>❌ Error uploading profile photo.</p>";
        }
    } else {
        echo "<p style='color:red; text-align:center;'>❌ Invalid file type. Use JPG, JPEG, PNG, GIF.</p>";
    }
}

?>

<!DOCTYPE html>
<html>
<head>
  <title>Register</title>
  <style>
    * { margin: 0; padding: 0; box-sizing: border-box; }

    body {
      font-family: Arial, sans-serif;
      background-color: #f4f4f4;
      min-height: 100vh;
      display: flex;
      flex-direction: column;
    }

    .form-container {
      background-color: #fff;
      width: 400px;
      margin: 40px auto;
      padding: 30px;
      border-radius: 12px;
      box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }

    .form-container h2 {
      text-align: center;
      margin-bottom: 20px;
    }

    .form-container input,
    .form-container select {
      width: 100%;
      padding: 12px;
      margin: 10px 0;
      border-radius: 6px;
      border: 1px solid #ccc;
    }

    .form-container label {
      font-weight: bold;
      margin-top: 10px;
      display: block;
    }

    .form-container button {
      width: 100%;
      padding: 12px;
      background-color: orange;
      color: white;
      border: none;
      border-radius: 6px;
      font-size: 16px;
      cursor: pointer;
    }

    .form-container button:hover {
      background-color: #e69500;
    }

    #preview {
      display: none;
      width: 100px;
      height: 100px;
      margin: 10px auto 0;
      border-radius: 50%;
      object-fit: cover;
    }

    
  </style>
</head>
<body>

<?php include'header.php';?>

<!-- REGISTRATION FORM -->
<div class="form-container">
  <h2>Register</h2>
  <form action="" method="POST" enctype="multipart/form-data">
    <input type="text" name="full_name" placeholder="Full Name" required>
    <input type="email" name="email" placeholder="Email" required>
    <input type="password" name="password" placeholder="Password" required>
    <input type="text" name="branch" placeholder="Branch" required>
    <input type="text" name="grad_year" placeholder="Graduation Year" required>
    <input type="text" name="status" placeholder="Current Work/Study Status" required>

    <label for="profile_pic">Upload Profile Picture</label>
    <input type="file" name="profile_pic" id="profile_pic" accept="image/*" required>

    <select name="role" required>
      <option value="">Select Role</option>
      <option value="student">Student</option>
      <option value="alumni">Alumni</option>
    </select>

    <button type="submit" name="submit">Register</button>
    <img id="preview" src="#" alt="Profile Preview" />
  </form>
</div>

<!-- PREVIEW SCRIPT -->
<script>
  const fileInput = document.getElementById("profile_pic");
  const preview = document.getElementById("preview");

  fileInput.addEventListener("change", function () {
    const file = this.files[0];
    if (file) {
      preview.src = URL.createObjectURL(file);
      preview.style.display = "block";
    } else {
      preview.src = "#";
      preview.style.display = "none";
    }
  });
</script>

<!-- Footer -->
<?php include'footer.php';?>

</body>
</html>
