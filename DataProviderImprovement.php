<?php

namespace src\App\Provider;

interface Provider
{
    /**
     * @param Request $request
     * @return Response
     */
    public function get(Request $request): Response;
}

interface Request
{
}

interface Response
{
}

namespace src\App\Provider;

class DataProvider implements Provider
{
    /**
     * @var string
     */
    private $host;
    /**
     * @var string
     */
    private $user;
    /**
     * @var string
     */
    private $password;

    /**
     * @param string $host
     * @param string $user
     * @param string $password
     */
    public function __construct(string $host, string $user, string $password)
    {
        $this->host = $host;
        $this->user = $user;
        $this->password = $password;
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function get(Request $request): Response
    {
        // Some implementation
    }
}

namespace src\App\Provider;

class CacheDataProvider extends DataProvider
{
    // Or not...
}