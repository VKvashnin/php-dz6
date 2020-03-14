<?php

    require_once __DIR__ . '/param.php';

    if( $_SERVER['REQUEST_METHOD'] == 'POST' )
    {
    	$db->delete_item($_POST['itemId']);
    	echo json_encode('done');
    }
