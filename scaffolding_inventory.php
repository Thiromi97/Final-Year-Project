<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "scaffolding";
// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
$sql = "SELECT * FROM inventory";
$result = mysqli_query($conn, $sql);
?>


<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="scaffolding_inventory_style.css">
  <!-- Boxicons CDN Link -->
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
  <div class="sidebar">
    <div class="logo-details">
      <i class='bx bxl-slack-old'></i>
      <span class="logo_name">Asian</br>Enginners</span>
    </div>
    <ul class="nav-links">
      <li>
        <a href="#" class="active">
          <i class='bx bx-grid-alt'></i>
          <span class="links_name">Dashboard</span>
        </a>
      </li>
      <li>
        <a href="scaffolding_inventory.php">
          <i class='bx bx-outline'></i>
          <span class="links_name">Inventory</span>
        </a>
      </li>
      <li>
        <a href="#">
          <i class='bx bx-cuboid'></i>
          <span class="links_name">Issued Products</span>
        </a>
      </li>
      <li>
        <a href="#">
          <i class='bx bx-shape-square'></i>
          <span class="links_name">Reinforcement</br> Estimate</span>
        </a>
      </li>
      <li>
        <a href="#">
          <i class='bx bx-cog'></i>
          <span class="links_name">Setting</span>
        </a>
      </li>
      <li class="log_out">
        <a href="#">
          <i class='bx bx-log-out'></i>
          <span class="links_name">Log out</span>
        </a>
      </li>
    </ul>
  </div>
  <section class="home-section">
    <nav>
      <div class="sidebar-button">
        <i class='bx bx-menu sidebarBtn'></i>
        <span class="dashboard">Dashboard</span>
      </div>
      <div class="search-box">
        <input type="text" placeholder="Search...">
        <i class='bx bx-search'></i>
      </div>
      <div class="profile-details">
        <img src="images/girl.jpg" alt="">
        <span class="admin_name">Thiromi</span>
        <i class='bx bx-chevron-down'></i>
      </div>
    </nav>
    <div class="home-content">
      <div class="sales-boxes">
        <div class="recent-sales box">
          <div class="button">
            <a href="#">+ Add New</a>
          </div>
          <div class="title">Inventory</div>
          <div class="search-box">
        <input type="text" placeholder="Search...">
        <i class='bx bx-search'></i>
      </div>
          <div class="sales-details">
            <table class="details">
              <tr>
                <th class="topic">Item</th>
                <th class="topic">Name</th>
                <th class="topic">Rate</th>
                <th class="topic">Extra</th>
                <th class="topic">Market Value</th>
                <th class="topic">Full Stock</th>
                <th class="topic">MMStock</th>
                <th class="topic">Settings</th>
              </tr>
              <?php while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr> 
                        <td>" . $row["item"] . "</td>
                        <td>" . $row["name"] . "</td>
                        <td>" . $row["rate"] . "</td>
                        <td>" . $row["extra"] . "</td>
                        <td>" . $row["marketValue"] . "</td>
                        <td>" . $row["fullStock"] . "</td>
                        <td>" . $row["MMStock"] . "</td>
                        <td>
                          <a href='#'><i class='bx bx-trash'></i></a>
                        </td>
                        <td>
                        </td>
                      </tr>";
              } ?>
            </table>
          </div>
        </div>
      </div>
    </div>
  </section>
  <script src="script.js"></script>
</body>

</html>