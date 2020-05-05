<?php

// ACCESS_TOKEN_SECRET
putenv('ACCESS_TOKEN_SECRET=pro3-parcial');


// PERSONAS_DATA_DIR
putenv('CLIENTS_FILENAME=' . __DIR__ . '\..\data\users.json');

// PRODUCTS_DATA_DIR
putenv('TEACHERS_FILENAME=' . __DIR__ . '\..\data\profesores.json');

// ORDERS_DATA_DIR
putenv('ORDERS_FILENAME=' . __DIR__ . '\..\data\orders.txt');


// DEFAULT_IMAGE_DIR
putenv('DEFAULT_IMAGE_DIR=' . __DIR__ . '\..\data\imagenes');
putenv('DEFAULT_TEACHER_IMAGE=' . __DIR__ . '\..\data\default.jpg');

// PHOTO_WATERMARK_DIR
putenv('PHOTO_WATERMARK_DIR=' . __DIR__ . '\..\data\img\watermark.png');

// BUCKUP_IMAGE_DIR
putenv('BUCKUP_IMAGE_DIR=' . __DIR__ . '\..\data\bak');