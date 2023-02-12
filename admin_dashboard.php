<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- Boxicons CSS -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel='stylesheet' href='admin_style.css'>
</head>

<body>
    <div class="sidebar">
        <div class="logo-details">
            <i class='bx bxs-diamond'></i>
            <span class="logo_name">ASIAN ENGINNERS</span>
        </div>
        <ul class="nav-links">
            <li>
                <a href="#">
                    <i class='bx bx-home-alt'></i>
                    <span class="link_name">Home</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class='bx bx-outline'></i>
                    <span class="link_name">Scaffolding</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class='bx bx-cuboid'></i>
                    <span class="link_name">Reinforcement</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class='bx bx-shape-square'></i>
                    <span class="link_name">Reinforcement Estimate</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class='bx bx-cog'></i>
                    <span class="link_name">Settings</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class='bx bx-log-out'></i>
                    <span class="link_name">Logout</span>
                </a>
            </li>
        </ul>
    </div> 

    <!-- home section-->
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
                <img src="images/girl.jpg">
                <span class="admin_name">Thiromi</span>
                <i class='bx bx-chevron-down'></i>
            </div>
        </nav>

        <!--home-content-->
        <div class="home-content">
            <div class="overview-boxes">
                <div class="box">
                    <div class="left-side">
                        <div class="box_topic">Order List</div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- <script src="script.js"></script> -->

</body>

</html>