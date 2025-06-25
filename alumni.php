<?php
include 'db.php';
session_start();
?>

<!DOCTYPE html>
<html>
<head>
  <title>Alumni Directory</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: Arial, sans-serif;
      background-color: #f4f4f4;
      display: flex;
      flex-direction: column;
      min-height: 100vh;
    }

    
    .alumni-container {
      max-width: 1000px;
      margin: 40px auto;
      background-color: #fff;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }

    .alumni-container h2 {
      text-align: center;
      margin-bottom: 20px;
    }

    .search-sort {
      display: flex;
      justify-content: space-between;
      gap: 10px;
      margin-bottom: 20px;
    }

    .search-bar, select {
      padding: 10px;
      font-size: 16px;
      width: 48%;
      border-radius: 5px;
      border: 1px solid #ccc;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      text-align: left;
    }

    th, td {
      padding: 12px;
      border-bottom: 1px solid #ddd;
    }

    th {
      background-color: orange;
      color: white;
    }

    tr:hover {
      background-color: #f1f1f1;
    }

    td img {
      border-radius: 50%;
      width: 50px;
      height: 50px;
      object-fit: cover;
    }


    @media (max-width: 768px) {
      .navbar {
        flex-direction: column;
        align-items: flex-start;
      }

      .search-sort {
        flex-direction: column;
      }

      .search-bar, select {
        width: 100%;
      }
    }
  </style>
</head>
<body>

<?php include 'header.php';?>

<!-- MAIN CONTENT -->
<div class="alumni-container">
  <h2>Alumni Directory</h2>

  <!-- Search and Sort -->
  <div class="search-sort">
    <input type="text" id="searchInput" class="search-bar" placeholder="Search by name or email...">
    <select id="sortSelect">
      <option value="">Sort By</option>
      <option value="branch">Branch</option>
      <option value="grad_year">Graduation Year</option>
    </select>
  </div>

  <!-- Alumni Table -->
  <table id="alumniTable">
    <tr>
      <th>Photo</th>
      <th>Name</th>
      <th>Email</th>
      <th>Branch</th>
      <th>Grad Year</th>
      <th>Status</th>
      <th>Action</th>
    </tr>

    <?php
    $sql = "SELECT * FROM users WHERE role = 'alumni'";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
      while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>
          <td><img src='uploads/" . htmlspecialchars($row['profile_pic']) . "' alt='profile'></td>
          <td>" . htmlspecialchars($row['full_name']) . "</td>
          <td>" . htmlspecialchars($row['email']) . "</td>
          <td>" . htmlspecialchars($row['branch']) . "</td>
          <td>" . htmlspecialchars($row['grad_year']) . "</td>
          <td>" . htmlspecialchars($row['status']) . "</td>
          <td><a href='send_message.php?to_id=" . urlencode($row['id']) . "' style='color: blue;'>Message</a></td>
        </tr>";
      }
    } else {
      echo "<tr><td colspan='7'>No alumni found.</td></tr>";
    }
    ?>
  </table>
</div>

<!-- Footer -->
<?php include'footer.php';?>

<!-- SEARCH + SORT SCRIPT -->
<script>
  const searchInput = document.getElementById('searchInput');
  const sortSelect = document.getElementById('sortSelect');
  const rows = Array.from(document.querySelectorAll("#alumniTable tr")).slice(1);

  searchInput.addEventListener('keyup', function () {
    const filter = this.value.toLowerCase();
    rows.forEach(row => {
      const name = row.cells[1].textContent.toLowerCase();
      const email = row.cells[2].textContent.toLowerCase();
      row.style.display = name.includes(filter) || email.includes(filter) ? "" : "none";
    });
  });

  sortSelect.addEventListener('change', function () {
    const value = this.value;
    if (!value) return;

    const tableBody = document.getElementById('alumniTable');
    const sortedRows = rows.slice().sort((a, b) => {
      const aText = a.querySelector(`td:nth-child(${value === 'branch' ? 4 : 5})`).textContent;
      const bText = b.querySelector(`td:nth-child(${value === 'branch' ? 4 : 5})`).textContent;
      return aText.localeCompare(bText);
    });

    rows.forEach(row => tableBody.removeChild(row));
    sortedRows.forEach(row => tableBody.appendChild(row));
  });
</script>

</body>
</html>
