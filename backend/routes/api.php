<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


// User routes
include __DIR__ . '/../app/Modules/Users/routes.php';

// Customer routes
include __DIR__ . '/../app/Modules/Customers/routes.php';
