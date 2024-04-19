<!DOCTYPE html>
<html lang="en" class="h-full bg-gray-100">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php
   
    switch (parse_url($_SERVER["REQUEST_URI"])['path']) {
        case '/':
            echo "Welcome to Avwave Blog | HOME";
            break;
        case '/about':
            echo "About us";
            break;
        case '/contact':
            echo "Contact us";
            break;
        default:
            echo "404 Not Found!";
    }
    ?></title>
     <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="h-full">

<div class="min-h-full">
