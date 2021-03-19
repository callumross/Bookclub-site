<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
</head>
<body>
<div class="container">
<header>
    <!--Logo and Title-->
    <h1>Online Book Club</h1>
    <img src="style/logo.png" alt="site logo" id="logo">
    <!--Search bar-->
    <div>
        <form action="" method="POST">
            <input type ="text" id="searchTerm" name="searchTerm" placeholder="Search for title..">
            <input type="submit" value="Search">
        </form>
    </div>
</header>

<!--Nav bar-->
<nav class="navbar navbar-expand-md navbar-light" style="background-colour: red">
   <button
      class="navbar-toggler"
      type="button"
      data-bs-toggle="collapse"
      data-bs-target="#toggleMobileMenu"
      aria-controls="toggleMobileMenu"
      aria-expand="false"
      aria-label="Toggle navigation"
   >
      <span class="navbar-toggler-icon"></span>
   </button>
   <div class="collapse navbar-collapse" id="toggleMobileMenu">
      <ul class="navbar-nav text-center">
        <li class="nav-item"><a class="nav-link" href="fiction.php">Fiction Reviews</a></li>
        <li class="nav-item"><a class="nav-link" href="non-fiction.php">Non-Fiction Reviews</a></li>
        <li class="nav-item"><a class="nav-link" href="children.php">Children Reviews</a></li>
        <li class="nav-item"><a class="nav-link" href="educational.php">Educational Reviews</a></li>
        <li class="nav-item"><a class="nav-link" href="audiobook.php">Audiobook Reviews</a></li>
      </ul>
   </div>
</nav>
<!--/.Navbar-->

<main>
    <h1>Search Results</h1>
    <p><a href="index.php">Home</a></p>
<?php
$searchTerm = $_POST['searchTerm'];
searchBar($searchTerm);
?>
</main>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
</body>
</html>

<?php
function searchBar($searchTerm){
$servername = "localhost";
$dbname = "bookClub";
$password = "root";
$username ="root";
$conn = new mysqli($servername, $username, $password, $dbname);

$like = "%".$searchTerm."%";
$stmt = $conn->prepare("SELECT *  FROM bookReviews WHERE bookTitle LIKE ?");
$stmt->bind_param("s", $like);
$stmt->execute();
$result = $stmt->get_result();
while($row = $result->fetch_assoc()){
    $bookTitle = $row["bookTitle"];
    $bookPublisher = $row["bookPublisher"];
    $bookSummary= $row["bookSummary"];
    $bookRating = $row["bookRating"];
    $bookRecommended = $row["bookRecommended"];
    $bookGenre = $row["bookGenre"];
    $authorFirst = $row["authorFirstName"];
    $authorLast = $row["authorLastName"];
    $bookID = $row["bookID"];
    $bookCoverExt = $row["bookCover"];
    $bookCover = "uploads/{$bookID}.{$bookCoverExt}";
    echo "<h3>{$bookTitle} by {$authorFirst} {$authorLast}</h3>
    <div class='d-flex mb-3'>
    <div class='p-2'>
    <img src = '$bookCover' class='img2 width='170' height='170'>
    </div>
    <div class='p-2'>
     <p>Publisher = {$bookPublisher}</p>
     <p>Genre = {$bookGenre}</p>
     <p>Rating = {$bookRating}</p>
     <p>{$bookSummary}</p>
     </div>
     </div>";
}
$stmt->close();
}
?>
            