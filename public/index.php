<?php

use App\System\Context;

require_once __DIR__ . '/../app/bootstrap.php';

$app = Context::App(new App\Application($localConfig));

$app->run();
