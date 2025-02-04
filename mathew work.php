<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php include('connect.php') ?>
    <?php include('header') ?>
</div>
</form>

<section id="team" class="team section-bg">
    <div class="container aos-init aos-animate" data-aos="fade-up">
        
    <div class="section-title">
        <h2>latest Movies</h2>
        <h3>our <span>Movies</span></h3>
</div>
<form action="movies.php" method="post">
<div class="row">
    <div class="col-lg-3 col-md-b d-flex">
        <div class="form-group">
            <input type="text" class="form-control" name="movie_search" placeholder="search">
        </div>
    </div>
    <div class="col-lg-3 col-md-b d-flex">
        <div class="form-group">
            <select name="catid" class="form-control">
                <option value="">select category</option>
                <?php
                $sql = "SELECT * FROM categories";
                $res = mysqli_query($conn, $sql);
                if (mysqli_num_rows($res) > 0) {
                    while ($data = mysqli_fetch_array($res)) {
                        ?><option value="<?=$data['catid']?>"><?=$data['catname']?></option>
                    <?php
                    }
                } else {
                    ?><option value="">no category found</option> <?php
                }
                ?>
            </select>
        </div>
    </div>
    <div class="col-lg-1 col-md-b d-flex">
        <div class="form-group">
            <input type="submit" name="btnsearch" value="search" class="btn btn-primary">
        </div>
    </div>
</div>
</form>
<div class="row mt-5">
<?php

if (isset($_POST['btnsearch'])) {
    $movie_search = $_POST['movie_search'];
    $catid = $_POST['catid'];

    $sql = "SELECT movies.*, categories.catname
    FROM movies
    INNER JOIN categories ON categories.catid = movies.catid
    WHERE movies.title LIKE '%$movie_search%' AND movies.catid ='$catid'";
    $res = mysqli_query($conn, $sql);
    if (mysqli_num_rows($res) > 0) {
        while ($data = mysqli_fetch_array($res)) {
            ?>
            <div class="col-lg-3 col-md-6 d-flex align-items-stretch init aos-animate" data-aos="fade-up">
                <div class="member">
                    <div class="member-img">
                        <img src="admin/uploads/<?=$data['image']?>" style="height:250px !important; width:250px">
                        <div class="social">
                            <a href="admin/uploads/<?=$data['trailer']?>" target="_blank" class="btn btn-primary">
                            </a>
                        </div>
                    </div>
                    <div class="member-info">
                        <h4><?=$data['title']?></h4>
                        <span><?=$data['catname']?></span>
                    </div>
                </div>
            </div>
            <?php
        }
    }
}

$sql = "SELECT movies.*, categories.catname
FROM movies
INNER JOIN categories ON categories.catid = movies.catid
ORDER BY movies.movieid DESC";
$res = mysqli_query($conn, $sql);
if (mysqli_num_rows($res) > 0) {
    while ($data = mysqli_fetch_array($res)) {
        ?>
        <div class="col-lg-3 col-md-6 d-flex align-items-stretch init aos-animate" data-aos="fade-up">
        </div>
    }
}
</body>
</html>