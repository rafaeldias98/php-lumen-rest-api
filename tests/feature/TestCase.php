<?php

abstract class TestCase extends Laravel\Lumen\Testing\TestCase
{
    protected $baseUrl = 'http://api.users.local';

    /**
     * Creates the application.
     *
     * @return \Laravel\Lumen\Application
     */
    public function createApplication()
    {
        return require __DIR__.'/../../bootstrap/app.php';
    }

    public function getHeaders($additionalHeaders = [])
    {
        $headers = [
            'Accept' => 'application/prs.users.v1+json',
        ];

        return array_merge($headers, $additionalHeaders);
    }
}
