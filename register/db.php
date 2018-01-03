<?php

require "rb.php";
 R::setup( 'mysql:host=localhost; dbname=registertest',
        'root', '123' );

 session_start();