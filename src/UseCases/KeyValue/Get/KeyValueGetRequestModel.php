<?php

namespace ConsulConfigManager\Consul\KeyValue\UseCases\KeyValue\Get;

use Illuminate\Http\Request;

/**
 * Class KeyValueGetRequestModel
 * @package ConsulConfigManager\Consul\KeyValue\UseCases\Get
 */
class KeyValueGetRequestModel
{
    /**
     * Request instance
     * @var Request
     */
    private Request $request;

    /**
     * Key value key
     * @var string
     */
    private string $key;

    /**
     * KeyValueGetRequestModel constructor.
     * @param Request $request
     * @param string $key
     */
    public function __construct(Request $request, string $key)
    {
        $this->request = $request;
        $this->key = $key;
    }

    /**
     * Get request instance
     * @return Request
     */
    public function getRequest(): Request
    {
        return $this->request;
    }

    /**
     * Get key path
     * @return string
     */
    public function getKey(): string
    {
        return $this->key;
    }
}
