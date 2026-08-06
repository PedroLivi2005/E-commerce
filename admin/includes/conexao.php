<?php

$pdo = new PDO("mysql:hostname=localhost;dbname=db_ecommerce", "root", "");

$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);