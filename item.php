<?php

    require_once __DIR__ . '/param.php';
    $itemId = '';
    if (array_key_exists('book', $_GET)){
        $itemId = $_GET['book'];
        $currentBook = $db->get_one(['id' => $itemId]);
        $bookName = $currentBook['title'];
        $bookImage = $currentBook['image'];
        $bookDescription = $currentBook['description'];
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
<div class="container">
    <div class="row">
        <form style="width: 100%" method="post" onsubmit="sendData();return false;" id="formBook" >
            <div class="form-group row">
                <label for="title" class="col-md-2 col-form-label">Название</label>
                <div class="col-md-10">
                    <input
                            type="text"
                            class="form-control"
                            id="title"
                            name="title"
                            value="<?php echo $bookName ?? ''; ?>"
                    >
                    <div class="invalid-feedback"></div>
                </div>
            </div>

            <div class="form-group row">
                <label for="image" class="col-md-2 col-form-label">Картинка</label>
                <div class="col-md-10">
                    <input
                            type="text"
                            name="image"
                            id="image"
                            class="form-control"
                            value="<?php echo $bookImage ?? ''; ?>"
                    >
                    <div class="invalid-feedback"></div>
                </div>
            </div>

            <div class="form-group row">
                <label for="description" class="col-md-2 col-form-label">Описание</label>
                <div class="col-md-10">
                    <textarea
                            name="description"
                            id="description"
                            class="form-control"
                            cols="30"
                            rows="10"><?php echo $bookDescription ?? ''; ?></textarea>
                    <div class="invalid-feedback"></div>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-md-9">
                    <button type="submit" class="btn btn-primary">Отправить</button>
                </div>
                <div class="col-md-3">
                    <div class="alert alert-success">Форма валидна</div>
                </div>
            </div>
        </form>

<style>
    .error{border-color:red;}
</style>

<script type="text/javascript">
    
    function sendData()
    {
        let itemId = '<?php echo $itemId; ?>';
        let form = '#formBook';

        let dataForm = $(form).serialize();
        if (itemId != '') {
            dataForm = dataForm + '&itemId=' + itemId;
        }

        $('*', form).removeClass('error');
        $('.invalid-feedback').empty();

        $.ajax({
            url: 'server.php',
            type: 'POST',
            dataType: 'json',
            data: dataForm,
            success: function(responce){
                if (responce !== 'done') {
                    for(key in responce)
                    {
                        $(`[name="${key}"]`, form).addClass('error');
                        $(`[name="${key}"]`, form).siblings('.invalid-feedback')
                            .html( responce[key]
                            .join("<br>") )
                            .show();
                    }
                } else {
                    window.location.href = 'success.php';
                }
            }
        })
    }
</script>

    </div>
</div>
</body>
</html>