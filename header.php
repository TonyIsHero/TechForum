<?php
session_start();
echo '<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
<div class="container-fluid">
  <a class="navbar-brand" href="/forum">TechHUB</a>
  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
      <li class="nav-item">
        <a class="nav-link active" aria-current="page" href="/forum">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="about.php">About</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          Categories
        </a>
        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
          <li><a class="dropdown-item" href="/forum/threadlist.php?catid=1">CPU</a></li>
          <li><a class="dropdown-item" href="/forum/threadlist.php?catid=2">GPU</a></li>
          <li><a class="dropdown-item" href="/forum/threadlist.php?catid=3">RAM</a></li>
          <li><a class="dropdown-item" href="/forum/threadlist.php?catid=4">Storage</a></li>
          <li><a class="dropdown-item" href="/forum/threadlist.php?catid=5">Monitor</a></li>
          <li><a class="dropdown-item" href="/forum/threadlist.php?catid=6">Peripherals</a></li>

        </ul>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="contact.php" tabindex="-1">Contact</a>
      </li>
    </ul>';
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
    echo '<p class="text-light my-1 mx-2">Welcome ' . $_SESSION['username']. '</p>
    <button class="btn btn-success mx-2"><a href="logout.php" style="text-decoration:none" class="text-white">Logout</a></button>
    <form class="d-flex">
      <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success" type="submit">Search</button>
    </form>';
    }
    else{
     echo'<div class="mx-2">
      <button class="btn btn-success"  data-bs-toggle="modal" data-bs-target="#loginModal">Login</button>
      <button class="btn btn-success"  data-bs-toggle="modal" data-bs-target="#signupModal">Signup</button>
      </div>
      <form class="d-flex">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
       <button class="btn btn-outline-success" type="submit">Search</button>
      </form>';
   }
  echo'</div>
</div>
</nav>';
include 'loginmodal.php';
include 'signupmodal.php';
if(isset($_GET['signupsuccess']) && $_GET['signupsuccess']=="true"){
  echo '<div class="alert alert-success alert-dismissible fade show my-0" role="alert">
  <strong>Success!</strong> You can now login.
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
}
?>