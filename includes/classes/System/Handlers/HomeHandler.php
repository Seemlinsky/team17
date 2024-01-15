<?php namespace System\Handlers;

/**
 * Class HomeHandler
 * @package MusicCollection\Handlers
 * @noinspection PhpUnused
 */
class HomeHandler extends BaseHandler
{
    protected function index(): void
    {
        //Return formatted data
        $this->renderTemplate([
            'pageTitle' => 'Welcome to my date collection!'
        ]);
    }
}
