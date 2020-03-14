<?php

    require_once "request.class.php";
    require_once __DIR__ . '/param.php';

    $requestClass = new Request();

    if( $requestClass->isPost() )
    {
        $requestClass->required('title');
        $requestClass->required('description');

        $requestClass->minLength('title', 5);
        $requestClass->minLength('description', 10);

        $requestClass->maxLength('title', 100);
        $requestClass->maxLength('image', 250);
        $requestClass->maxLength('description', 300);

        if ($requestClass->getErrors())
        {
            echo json_encode($requestClass->getErrors());
        } else
        {
            if (!empty($_POST['itemId'])){
                $date = Date('Y-m-d H:m:s',time());
                $dataNew = [
                    "id" => $_POST['itemId'],
                    "title" => $_POST['title'],
                    "description" => $_POST['description'],
                    "image" => $_POST['image'],
                    "update_at" => $date
                ];
                $db->update($dataNew);
                echo json_encode('done');
            } else {
                $dataNew = [
                    "title" => $_POST['title'],
                    "description" => $_POST['description'],
                    "image" => $_POST['image'],
                ];
                $db->insert($dataNew);
                echo json_encode('done');
            }
        }
    }
?>