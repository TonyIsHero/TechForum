<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">


    <title>Welcome to TechHUB</title>
</head>


<body>
    <?php include 'header.php' ?>
    <?php include 'dbconnect.php' ?>
    <?php
$id=$_GET['catid'];
$sql="SELECT * FROM `categories` WHERE category_id=$id";
$result=mysqli_query($conn,$sql);
while($row=mysqli_fetch_assoc($result))
{   
    $catname=$row['category_name'];
    $catdesc=$row['category_description'];
}

?>

    <?php
    $showAlert=false;
$method = $_SERVER['REQUEST_METHOD'];
if($method=='POST'){

    $th_title=$_POST['title'];
    $th_desc=$_POST['desc'];
    $sno=$_POST['sno'];
    $sql="INSERT INTO `threads` (`thread_title`, `thread_desc`, `thread_cat_id`, `thread_user_id`, `timestamp`) VALUES ('$th_title', '$th_desc', '$id', '$sno', current_timestamp())";
    $result=mysqli_query($conn,$sql);
    $showAlert=true;
    if($showAlert){
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> Your thread has been added. Please wait for community to respond.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';  
    }
}
?>

    <!-- card container starts here-->
    <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active"
                aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1"
                aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2"
                aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="https://source.unsplash.com/1920x500/?dark,dark-wallpaper" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <h2>Welcome to <?php echo$catname;?> forums</h5>
                        <p>"Technology is best when it brings people together..."</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="https://source.unsplash.com/1920x500/?wallpaper,dark-wallpaper" class="d-block w-100"
                    alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <h2>Welcome to <?php echo$catname;?> forums</h5>
                        <p>"It has become appallingly obvious that our technology has exceeded our humanity."</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="https://source.unsplash.com/1920x500/?dark,ultrahd-dark" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <h2>Welcome to <?php echo$catname;?> forums</h5>
                        <p>"It is only when they go wrong that machines remind you how powerful they are."</p>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <div class="container">
        <div class="p-3 mb-2 bg-secondary text-white my-3 py-2">
            <h2 class="my-0 py-2"><?php echo $catname;?></h2>
            <div class="media">
                <div class="media-body">
                    <h5 class="mt-0"><?php echo $catdesc;?></h5>
                </div>
            </div>
        </div>
    </div>



    <?php
    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
    echo'<div class="container">
        <h1 class="py-2">Start a Discussion</h1>
        <form action="'. $_SERVER["REQUEST_URI"] . '"method="post">
    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Title</label>
        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" id="title"
            name="title">
        <div id="emailHelp" class="form-text">Keep your title as crisp as possible.</div>
    </div>
    <div class="form-floating">
        <textarea class="form-control" placeholder="Describe your concern" id="desc" name="desc"
            style="height: 100px"></textarea>
        <label for="floatingTextarea2">Describe your concern</label>
    </div>
    <input type="hidden" name="sno" value="'. $_SESSION['sno']. '">
    <button type="submit" class="btn btn-success my-4">Post</button>
    </form>
    </div>';
    }
    else{
    echo '<div class="jumbotron jumbotron-fluid">
    <div class="container">
    <div class="p-3 mb-2 bg-light text-dark">
      <h3 class="display-4">Log in to ask Questions</h3>
    
    <button class="btn btn-success"  data-bs-toggle="modal" data-bs-target="#loginModal">Login</button>
    </div>
    </div>
  </div>';
    }
    ?>

    <div class="container">
        <h1 class="my-4 py-4">Browse Questions</h1>
    </div>

    <?php

$id=$_GET['catid'];
$sql="SELECT * FROM `threads` WHERE thread_cat_id=$id";
$result=mysqli_query($conn,$sql);
$noResult=true;
while($row=mysqli_fetch_assoc($result))
{
    $noResult=false;
    $title=$row['thread_title'];
    $desc=$row['thread_desc'];
    $id=$row['thread_id'];
    $thread_time=$row['timestamp'];
    $thread_user_id=$row['thread_user_id'];
    $sql2="SELECT username FROM `users` WHERE sno='$thread_user_id'";
    $result2=mysqli_query($conn,$sql2);
    $row2=mysqli_fetch_assoc($result2);
    $username=$row2['username'];
    echo 
    '<div class="container my-4">
        <div class="media">
            <img src="User.png" width="34px" alt="Generic placeholder image">
            <p class="my-0"><b>' .$username. '</b> on ' . $thread_time. '</p>
            <div class="media-body">
                <h5 class="mt-0 my-0"><a href="thread.php?threadid=' . $id. '" style="text-decoration:none">'. $title .'</a></h5>
                <div class="py-2">'. $desc .'</div>
            </div>
        </div>
        </div>
    </div>';

}
if($noResult){
    echo '<div class="jumbotron jumbotron-fluid">
    <div class="container">
    <div class="p-3 mb-2 bg-light text-dark">
      <h3 class="display-4">No Questions in this Category</h3>
      <p class="lead">Be the first person to Ask</p>
    </div>
    </div>
  </div>';
}
?>

    <?php include 'footer.php' ?>


    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous">
    </script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
    -->
</body>

</html>