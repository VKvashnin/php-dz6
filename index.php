<?php

    require_once __DIR__ . '/param.php';

    function formList($books, $baseUrl) {
        echo '<div class="row">';
        for ($i=0; $i<sizeof($books); $i++) {
            $imageUrl = $books[$i]['image'] ?: $baseUrl;
            $bookTitle = $books[$i]['title'];
            $bookDescription = $books[$i]['description'];
            $bookId = $books[$i]['id'];
            echo ("
                <div class=\"col-12 col-md-6\">
                    <form action=\"item.php\" method=\"get\">
                        <div class=\"text-center\">$bookTitle</div>
                        <div><img class=\"img-fluid\" src=\"$imageUrl\"></div>
                        <div>$bookDescription</div>
                        <div class=\"text-center\">
                            <button name=\"book\" value=\"$bookId\" type=\"submit\" class=\"btn btn-primary m-auto\">Редактировать</button>
                            <button type=\"button\" onclick=\"testFun($bookId)\" >Delete</button>
                        </div>
                    </form>
                </div>
            ");
        }
        echo '</div>';

        return;
    }
?>
<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dz6 main</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>

</head>

<body>
    <div class="container">
            <?php 
                echo "<div class=\"row\">";
                echo "<div class=\"text-center text-md-left col-12 col-md-9\">Общее количество книг в базе: {$db->get_count()}</div>";
                echo "<div class=\"text-center col-12 col-md-3\"><a href=\"/PHP/dz6/item.php\">Добавить книгу</a></div>";
                echo "</div>";
                formList($books, $baseUrl);
            ?>
    </div>
</body>
<style type="text/css">
    form div {
        margin: 10px;
    }
</style>
<script type="text/javascript">
    function testFun(bookId) {
        let dataSend = 'itemId=' + bookId;
        $.ajax({
            url: 'server2.php',
            type: 'POST',
            dataType: 'json',
            data: dataSend,
            success: function(responce){
                if (responce === 'done') {
                    window.location.href = '/PHP/dz6/';
                }
            }
        })

    }
</script>
</html>



