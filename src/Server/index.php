<?php

declare(strict_types=1);

use PhpPact\Consumer\Matcher\Matcher;
use Ramsey\Uuid\Uuid;

include __DIR__ . '/../../vendor/autoload.php';

error_reporting(-1);
ini_set('display_errors', '1');


if ($_SERVER['REQUEST_URI'] === '/api/products') {
    $uuid = Uuid::uuid4()->toString();
    $uuid = '123';

    header($_SERVER['SERVER_PROTOCOL'] . ' 200 OK', true, 200);
    header('Content-type: application/json');

    echo <<<JSON
    {
        "id": "$uuid"
    }
    JSON;

    exit();
}

header($_SERVER['SERVER_PROTOCOL'] . ' 404 Not Found', true, 404);
echo 'Not found';
