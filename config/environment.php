<?php

// ACCESS_TOKEN_SECRET
putenv('ACCESS_TOKEN_SECRET=pro3-parcial');


// PERSONAS_DATA_DIR
putenv('CLIENTS_FILENAME=' . __DIR__ . '\..\data\users.json');

// PRODUCTS_DATA_DIR
putenv('PRODUCTS_FILENAME=' . __DIR__ . '\..\data\products.json');

// ORDERS_DATA_DIR
putenv('ORDERS_FILENAME=' . __DIR__ . '\..\data\orders.txt');


// DEFAULT_IMAGE_DIR
putenv('DEFAULT_IMAGE_DIR=' . __DIR__ . '\..\data\img');

// PHOTO_WATERMARK_DIR
putenv('PHOTO_WATERMARK_DIR=' . __DIR__ . '\..\data\img\watermark.png');

// BUCKUP_IMAGE_DIR
putenv('BUCKUP_IMAGE_DIR=' . __DIR__ . '\..\data\bak');