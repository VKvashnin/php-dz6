<?php

    use Academy\db;

    require_once __DIR__ . '/vendor/autoload.php';

    $db = new db();

    $baseUrl = 'https://www.mirprognozov.ru/uploads/images/old/1452868777-95e48841e8ebcc94e135134c7a20f455f60b1add.png';

    $books = $db->createList('books');
