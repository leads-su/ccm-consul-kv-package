<?php

namespace ConsulConfigManager\Consul\KeyValue\UseCases\KeyValuePending\Menu;

use Illuminate\Http\Request;

/**
 * Class KeyValuePendingMenuRequestModel
 * @package ConsulConfigManager\Consul\KeyValue\UseCases\Menu
 */
class KeyValuePendingMenuRequestModel
{
    /**
     * Request instance
     * @var Request
     */
    private Request $request;

    /**
     * KeyValuePendingMenuRequestModel constructor.
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
