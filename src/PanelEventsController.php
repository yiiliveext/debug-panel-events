<?php

declare(strict_types=1);

namespace Yiiliveext\Yii\Debug\Panel\Events;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Yiisoft\DataResponse\DataResponseFactoryInterface;
use Yiisoft\View\ViewContextInterface;
use Yiisoft\View\WebView;

final class PanelEventsController implements ViewContextInterface
{
    private DataResponseFactoryInterface $responseFactory;
    private WebView $view;

    /**
     * PanelEventsController constructor.
     */
    public function __construct(
        DataResponseFactoryInterface $responseFactory,
        WebView $view
    ) {
        $this->responseFactory = $responseFactory;
        $this->view = $view;
    }

    /**
     * @return ResponseInterface
     */
    public function view(ServerRequestInterface $request): ResponseInterface
    {
        try {
            $params = $request->getQueryParams();
            $targetHost = $params['targetHost'];
            $session = $params['session'];
            $collectors = json_decode(file_get_contents($targetHost . '/debug/view/' . $session), true)['data'];
            $events = $collectors["Yiisoft\\Yii\\Debug\\Collector\\EventCollector"];
            $success = true;
        } catch (\RuntimeException $e) {
            $success = false;
        }

        return $this->responseFactory
            ->createResponse(
                $this->view
                    ->withContext($this)
                    ->render('view', ['events' => $events, 'success' => $success])
            );
    }

    public function getViewPath(): string
    {
        return __DIR__;
    }
}
