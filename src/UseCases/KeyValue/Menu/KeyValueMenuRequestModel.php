<?php

namespace ConsulConfigManager\Consul\KeyValue\UseCases\KeyValue\Menu;

use Illuminate\Http\Request;

/**
 * Class KeyValueMenuRequestModel
 * @package ConsulConfigManager\Consul\KeyValue\UseCases\Menu
 */
class KeyValueMenuRequestModel
{
    /**
     * Request instance
     * @var Request
     */
    private Request $request;

    /**
     * KeyValueMenuRequestModel constructor.
     * @param Request $request
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Get request instance
     * @return Request
     */
    public function getRequest(): Request
    {
        return $this->request;
    }
}
