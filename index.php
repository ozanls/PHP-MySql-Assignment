<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Top 200 Songs in Canada</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>

<?php
$connect = mysqli_connect("localhost", "root", "root", "spotify_top200");

$query = 'SELECT *
  FROM spotify_top200
  ORDER BY rank ASC';
$result = mysqli_query($connect, $query);

echo '<h1 class="page-title">Top 200 Songs in Canada (January 1st, 2017)</h1>';
echo '<a href="https://www.kaggle.com/datasets/dhruvildave/spotify-charts/data"><h2 class="page-subtitle">Data courtesy of Dhruvil Dave and Aneri Dalwadi (Kaggle)</h2></a>';

echo '<div id="songs">';

foreach ($result as $row) {
    echo '<div class="song-container" id="rank' .
        $row["rank"] .
        '">' .
        '<a class="song" href="' .
        $row["url"] .
        '">' .
        '<div class="song-rank">';

    if ($row["RANK_CHANGE"] == "MOVE_UP") {
        echo '<img class="rank_img" src="img/up.png">';
    } elseif ($row["RANK_CHANGE"] == "MOVE_DOWN") {
        echo '<img class="rank_img" src="img/down.png">';
    } elseif ($row["RANK_CHANGE"] == "SAME_POSITION") {
        echo '<img class="rank_img" src="img/same.png">';
    } else {
        echo '<img class="rank_img" src="img/new.png">';
    }

    echo '<span class="rank">' .
        $row["rank"] .
        "</span></div>" .
        '<div class="song-info">' .
        '<span class="title">' .
        $row["title"] .
        "</span><br>" .
        '<span class="artists">' .
        $row["artists"] .
        "</span>" .
        "</div>" .
        "</a>" .
        "</div>" .
        "<br>";
}

echo "</div>";

if (!$connect) {
    echo "Error Code: " . mysqli_connect_errno() . "<br>";
    echo "Error Message: " . mysqli_connect_error() . "<br>";
    exit();
}

mysqli_close($connect);
?>

</body>
</html>
