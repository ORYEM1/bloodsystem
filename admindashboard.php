<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Administration Dashboard</title>
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css" />

  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/v4-font-face.min.css" />
  <link rel="stylesheet" href="styles.css" />
  <link rel="stylesheet" href="
    <link
      rel=" stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
    integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
    crossorigin="anonymous"
    referrerpolicy="no-referrer" />


  ">

  <style></style>

  <script>
    document.addEventListener('DOMContentLoaded', () => {
      // Toggle Blood Inventory Menu
      document.querySelector('.blood-btn').addEventListener('click', function() {
        document.querySelector('.blood-show').classList.toggle('show');
      });

      // Toggle History Menu
      document.querySelector('.hist-btn').addEventListener('click', function() {
        document.querySelector('.hist-show').classList.toggle('show');
      });

      // Toggle User Management Menu
      document.querySelector('.user-btn').addEventListener('click', function() {
        document.querySelector('.user-show').classList.toggle('show');
      });

      // Toggle Pages Menu
      document.querySelector('.page-btn').addEventListener('click', function() {
        document.querySelector('.page-show').classList.toggle('show');
      });

      // Toggle Account Menu
      document.querySelector('.account-btn').addEventListener('click', function() {
        document.querySelector('.account-show').classList.toggle('show');
      });

      // Toggle the sidebar
      document.getElementById('menu-btn').addEventListener('click', function() {
        document.getElementById('menu').classList.toggle('active');
      });
    });
  </script>
</head>

<body>
  <section id="menu">
    <header class="header">
      <div class="logo">
        <img src="c:\Users\rtr\Pictures\blood.jpg" alt="">
        <h2>Saves lives</h2>
      </div>
    </header>
    <div class="items">
      <ul>
        <li>
          <div class="items">
            <a href="#"> <i class="fas fa-desktop"></i>Dashboard</a>
          </div>
        </li>
        <li>
          <div class="items">
            <a href="addblood.php" class="blood-btn">
              <i class="fa fa-address-book" aria-hidden="true"></i>Add Blood

              <span class="fas fa-caret-down first"></span>
            </a>
          </div>

        </li>

        <li>
          <div class="items">
            <a href="expiring.php" class="blood-btn">
              <i class="fa fa-address-book" aria-hidden="true"></i>Blood
              Inventory

            </a>
          </div>

        </li>

        <li>
          <div class="items">
            <a href="#" class="hist-btn"><i class="fa fa-history" aria-hidden="true"></i>History
              <span class="fas fa-caret-down second"></span>
            </a>
          </div>

          <ul class="hist-show">
            <li><a href="#">Donation History</a></li>
            <li><a href="#">Supplied History</a></li>
          </ul>
        </li>
        <li>
          <div class="items">
            <a href="donortable.php" class="user-btn">
              <i class="fas fa-newspaper"></i>User Management

            </a>
          </div>


        </li>
        <li>
          <div>
            <a href="registerdonor.php" class="page-btn"><i class="fa fa-file" aria-hidden="true"></i>Register Users
              <span class=""></span>
            </a>
          </div>

        <li>
          <div>
            <a href="login.html" class="page-btn"><i class="fa fa-file" aria-hidden="true"></i>Login
              <span class=""></span>
            </a>
          </div>
        <li>
          <div>
            <a href="donor.html" class="page-btn"><i class="fa fa-file" aria-hidden="true"></i>user page
              <span class=""></span>
            </a>
          </div>
        </li>
        <li>
          <div>
            <a href="home.html" class="page-btn"><i class="fa fa-file" aria-hidden="true"></i>Home Page
              <span class=""></span>
            </a>
          </div>


        </li>
        <div>
          <a href="message.php" class="page-btn"><i class="fa fa-file" aria-hidden="true"></i>message
            <span class=""></span>
          </a>
        </div>
        <li>
          <div>
            <a href="#" class="account-btn"><i class="fas fa-user-friends"></i>Account
              <span class="fas fa-caret-down fifth"></span>
            </a>
          </div>

          <ul class="user-show">
            <li><a href="#">Users Accounts</a></li>
            <li><a href="#">Admin Account</a></li>
          </ul>
        </li>
        <li>
          <div>
            <a href="#"> <i class="fas fa-screwdriver"></i>Settings</a>
          </div>
        </li>
      </ul>
    </div>
  </section>
  <section id="interface">
    <div class="nav">
      <div class="n1">
        <div>
          <i id="menu-btn" class="fas fa-bars"></i>
        </div>
        <div class="search">
          <i class="fa fa-search" aria-hidden="true"></i>
          <input type="text" placeholder="Search" />
        </div>
      </div>
      <div class="profile">
        <i class="far fa-bell"></i>
        <i class="far fa-envelope"></i>
        <span class="badge blinking" id="messageCount">3</span>
        <span class="fas fa-caret-down"></span>
        <ul>
          <li><a href="">Profile</a></li>

          <li><a href="">Change Password</a></li>

          <li><a href="">Edit Profile</a></li>
        </ul>
      </div>
    </div>

    <h3 class="i-name">Dashboard</h3>
    <div class="values">
      <div class="val-box">
        <i class="fas fa-users"></i>
        <h3>0</h3>
        <span style="font-weight: 600; color: brown">A</span>
      </div>

      <div class="val-box">
        <i class="fas fa-users"></i>
        <h3>0</h3>
        <span style="font-weight: 600; color: brown">AB</span>
      </div>

      <div class="val-box">
        <i class="fas fa-users"></i>
        <h3>0</h3>
        <span style="font-weight: 600; color: brown">B</span>
      </div>

      <div class="val-box">
        <i class="fas fa-users"></i>
        <h3>0</h3>
        <span style="font-weight: 600; color: brown">O</span>
      </div>
    </div>
    <dir class="board">
      <table width="100%">
        <thead>
          <tr>
            <td>Name</td>
            <td>Title</td>
            <td>Contact</td>
            <td>Blood Type</td>
            <td>Amount (litre)</td>
            <td>Date</td>
            <td>status</td>
            <td></td>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td class="people">

              <div class="people-de">
                <h5>oryem reagan</h5>
                <p>oryemreagan7@gmail.com</p>
              </div>
            </td>
            <td class="people-des">
              <h5>Software Engineering</h5>
              <p>Web development</p>
            </td>
            <td class="active">
              <p>Active</p>
            </td>
            <td class="role">
              <p>Owner</p>
            </td>
            <td class="edit"><a href="#">Edit</a></td>
          </tr>
          <tr>
            <td class="people">

              <div class="people-de">
                <h5>oryem reagan</h5>
                <p>oryemreagan7@gmail.com</p>
              </div>
            </td>
            <td class="people-des">
              <h5>Software Engineering</h5>
              <p>Web development</p>
            </td>
            <td class="active">
              <p>Active</p>
            </td>
            <td class="role">
              <p>Owner</p>
            </td>
            <td class="edit"><a href="#">Edit</a></td>
          </tr>
          <tr>
            <td class="people">

              <div class="people-de">
                <h5>oryem reagan</h5>
                <p>oryemreagan7@gmail.com</p>
              </div>
            </td>
            <td class="people-des">
              <h5>Software Engineering</h5>
              <p>Web development</p>
            </td>
            <td class="active">
              <p>Active</p>
            </td>
            <td class="role">
              <p>Owner</p>
            </td>
            <td class="edit"><a href="#">Edit</a></td>
          </tr>
          <tr>
            <td class="people">

              <div class="people-de">
                <h5>oryem reagan</h5>
                <p>oryemreagan7@gmail.com</p>
              </div>
            </td>
            <td class="people-des">
              <h5>Software Engineering</h5>
              <p>Web development</p>
            </td>
            <td class="active">
              <p>Active</p>
            </td>
            <td class="role">
              <p>Owner</p>
            </td>
            <td class="edit"><a href="#">Edit</a></td>
          </tr>
          <tr>
            <td class="people">

              <div class="people-de">
                <h5>oryem reagan</h5>
                <p>oryemreagan7@gmail.com</p>
              </div>
            </td>
            <td class="people-des">
              <h5>Software Engineering</h5>
              <p>Web development</p>
            </td>
            <td class="active">
              <p>Active</p>
            </td>
            <td class="role">
              <p>Owner</p>
            </td>
            <td class="edit"><a href="#">Edit</a></td>
          </tr>
          <tr>
            <td class="people">

              <div class="people-de">
                <h5>oryem reagan</h5>
                <p>oryemreagan7@gmail.com</p>
              </div>
            </td>
            <td class="people-des">
              <h5>Software Engineering</h5>
              <p>Web development</p>
            </td>
            <td class="active">
              <p>Active</p>
            </td>
            <td class="role">
              <p>Owner</p>
            </td>
            <td class="edit"><a href="#">Edit</a></td>
          </tr>
          <tr>
            <td class="people">

              <div class="people-de">
                <h5>oryem reagan</h5>
                <p>oryemreagan7@gmail.com</p>
              </div>
            </td>
            <td class="people-des">
              <h5>Software Engineering</h5>
              <p>Web development</p>
            </td>
            <td class="active">
              <p>Active</p>
            </td>
            <td class="role">
              <p>Owner</p>
            </td>
            <td class="edit"><a href="#">Edit</a></td>
          </tr>
          <tr>
            <td class="people">

              <div class="people-de">
                <h5>oryem reagan</h5>
                <p>oryemreagan7@gmail.com</p>
              </div>
            </td>
            <td class="people-des">
              <h5>Software Engineering</h5>
              <p>Web development</p>
            </td>
            <td class="active">
              <p>Active</p>
            </td>
            <td class="role">
              <p>Owner</p>
            </td>
            <td class="edit"><a href="#">Edit</a></td>
          </tr>
          <tr>
            <td class="people">

              <div class="people-de">
                <h5>oryem reagan</h5>
                <p>oryemreagan7@gmail.com</p>
              </div>
            </td>
            <td class="people-des">
              <h5>Software Engineering</h5>
              <p>Web development</p>
            </td>
            <td class="active">
              <p>Active</p>
            </td>
            <td class="role">
              <p>Owner</p>
            </td>
            <td class="edit"><a href="#">Edit</a></td>
          </tr>
          <tr>
            <td class="people">

              <div class="people-de">
                <h5>oryem reagan</h5>
                <p>oryemreagan7@gmail.com</p>
              </div>
            </td>
            <td class="people-des">
              <h5>Software Engineering</h5>
              <p>Web development</p>
            </td>
            <td class="active">
              <p>Active</p>
            </td>
            <td class="role">
              <p>Owner</p>
            </td>
            <td class="edit"><a href="#">Edit</a></td>
          </tr>
          <tr>
            <td class="people">

              <div class="people-de">
                <h5>oryem reagan</h5>
                <p>oryemreagan7@gmail.com</p>
              </div>
            </td>
            <td class="people-des">
              <h5>Software Engineering</h5>
              <p>Web development</p>
            </td>
            <td class="active">
              <p>Active</p>
            </td>
            <td class="role">
              <p>Owner</p>
            </td>
            <td class="edit"><a href="#">Edit</a></td>
          </tr>
          <tr>
            <td class="people">

              <div class="people-de">
                <h5>oryem reagan</h5>
                <p>oryemreagan7@gmail.com</p>
              </div>
            </td>
            <td class="people-des">
              <h5>Software Engineering</h5>
              <p>Web development</p>
            </td>
            <td class="active">
              <p>Active</p>
            </td>
            <td class="role">
              <p>Owner</p>
            </td>
            <td class="edit"><a href="#">Edit</a></td>
          </tr>
          <tr>
            <td class="people">

              <div class="people-de">
                <h5>oryem reagan</h5>
                <p>oryemreagan7@gmail.com</p>
              </div>
            </td>
            <td class="people-des">
              <h5>Software Engineering</h5>
              <p>Web development</p>
            </td>
            <td class="active">
              <p>Active</p>
            </td>
            <td class="role">
              <p>Owner</p>
            </td>
            <td class="edit"><a href="#">Edit</a></td>
          </tr>
        </tbody>
      </table>
    </dir>
  </section>

</body>

</html>