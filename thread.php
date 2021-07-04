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
$id=$_GET['threadid'];
$sql="SELECT * FROM `threads` WHERE thread_id=$id";
$result=mysqli_query($conn,$sql);
while($row=mysqli_fetch_assoc($result))
{
    $title=$row['thread_title'];
    $desc=$row['thread_desc'];
}
?>

    <?php
    $showAlert=false;
$method = $_SERVER['REQUEST_METHOD'];
if($method=='POST'){

    $content=$_POST['comment'];
    $sno=$_POST['sno'];
    $sql="INSERT INTO `comments` (`comment_content`, `thread_id`, `comment_by`, `comment_time`) VALUES ('$content', '$id', '$sno', current_timestamp())";
    $result=mysqli_query($conn,$sql);
    $showAlert=true;
    if($showAlert){
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> You have successfully posted a comment!
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';  
    }
}
?>

    <!-- card container starts here-->
    <div class="container my-4">
        <div class="p-3 mb-2 bg-secondary text-white">
            <div class="jumbotron">
                <h1 class="display-4"><?php echo $title ?></h1>
                <p class="lead"><?php echo $desc ?></p>
                <hr class="my-4">
                <p>This is a peer to peer forum. Don't spam. Use of unnecessary words may result to permanent ban. </p>
                <p><b>Posted by Tony<b></p>
            </div>
        </div>
    </div>


    <?php
    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
    echo'<div class="container fw-normal">
        <h1 class="py-2">Start a Discussion</h1>
        <form action="'. $_SERVER["REQUEST_URI"] . '" method="post">
    <div class="form-floating">
        <textarea class="form-control" placeholder="Comment Here" id="comment" name="comment"
            style="height: 100px"></textarea>
            
        <label for="floatingTextarea2">Post a Comment</label>
        <input type="hidden" name="sno" value="'. $_SESSION['sno']. '">
    </div>
    <button type="submit" class="btn btn-success my-4">Post</button>
    </form>
    </div>';
    }
    else{
    echo '<div class="jumbotron jumbotron-fluid">
        <div class="container">
            <div class="p-3 mb-2 bg-light text-dark">
                <h3 class="display-4">Log in to post a comment</h3>

                <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#loginModal">Login</button>
            </div>
        </div>
    </div>';
    }
    ?>



    <div class="container">
        <h1 class="my-0 py-2">Discussions</h1>
    </div>
    <?php
$id=$_GET['threadid'];
$sql="SELECT * FROM `comments` WHERE thread_id=$id";
$result=mysqli_query($conn,$sql);
$noResult=true;
while($row=mysqli_fetch_assoc($result))
{
    $noResult=false;
    $content=$row['comment_content'];
    $id=$row['comment_id'];
    $comment_time=$row['comment_time'];
    $thread_user_id=$row['comment_by'];
    $sql2="SELECT username FROM `users` WHERE sno='$thread_user_id'";
    $result2=mysqli_query($conn,$sql2);
    $row2=mysqli_fetch_assoc($result2);


    echo '<div class="container my-4 fw-normal">
    <div class="media">
            <img src="User.png" width="34px" alt="Generic placeholder image">
            <p class="my-0"><b>' .$row2['username']. '</b> on ' . $comment_time. '</p>
            <div class="media-body fw-normal">
                '. $content .'
            </div>
        </div>
        </div>
    </div>';

}
if($noResult){
    echo '<div class="jumbotron jumbotron-fluid">
    <div class="container">
    <div class="p-3 mb-2 bg-light text-dark">
      <h3 class="display-4">No Threads Found</h3>
      <p class="lead">Be the first person to Post</p>
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