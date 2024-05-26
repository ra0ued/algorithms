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
    public function toArray();
}

interface Response
{
}

class HTMLResponse implements Response
{
    public function toArray(): array
    {
        return [];
    }
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
        return new HTMLResponse();
    }
}

namespace src\App\Provider;

use DateTime;
use Psr\Cache\CacheItemPoolInterface;
use Psr\Log\LoggerInterface;
use Throwable;

class CacheDataProvider implements Provider
{
    /**
     * @var Provider
     */
    private $provider;

    /**
     * @var CacheItemPoolInterface
     */
    private $cache;

    /**
     * @var LoggerInterface
     */
    private $logger;

    public function __construct(Provider $provider, LoggerInterface $logger, CacheItemPoolInterface $cache)
    {
        $this->provider = $provider;
        $this->cache = $cache;
        $this->logger = $logger;
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function get(Request $request): Response
    {
        try {
            $cacheKey = $this->getCacheKey($request->toArray());
            $cacheItem = $this->cache->getItem($cacheKey);
            if ($cacheItem->isHit()) {
                return $cacheItem->get();
            }

            $result = $this->provider->get($request);

            $cacheItem
                ->set($result)
                ->expiresAt(
                    (new DateTime())->modify('+1 day')
                );

            return $result;
        } catch (Throwable $e) {
            $this->logger->critical($e->getMessage());

            return new HTMLResponse();
        }
    }

    /**
     * @param array $input
     * @return string
     */
    private function getCacheKey(array $input): string
    {
        return md5(json_encode($input));
    }
}