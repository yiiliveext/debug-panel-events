<?php

declare(strict_types=1);

use Yiisoft\Router\Route;
use Yiiliveext\Yii\Debug\Panel\Events\PanelEventsController;

return [
    Route::get('/debug/panels/events')
        ->action([PanelEventsController::class, 'view'])
        ->name('debug/panels/events'),
];
