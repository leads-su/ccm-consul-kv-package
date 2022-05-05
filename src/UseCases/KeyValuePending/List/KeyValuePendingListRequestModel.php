<?php

namespace ConsulConfigManager\Consul\KeyValue\UseCases\KeyValuePending\List;

use Illuminate\Http\Request;

/**
 * Class KeyValuePendingListRequestModel
 * @package ConsulConfigManager\Consul\KeyValue\UseCases\KeyValuePending\List
 */
class KeyValuePendingListRequestModel
{
    /**
     * Request instance
     * @var Request
     */
    private Request $request;

    /**
     * KeyValuePendingListRequestModel constructor.
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
