<?php

namespace ConsulConfigManager\Consul\KeyValue\UseCases\KeyValuePending\Structure;

use Illuminate\Http\Request;

/**
 * Class KeyValuePendingStructureRequestModel
 * @package ConsulConfigManager\Consul\KeyValue\UseCases\Structure
 */
class KeyValuePendingStructureRequestModel
{
    /**
     * Request instance
     * @var Request
     */
    private Request $request;

    /**
     * KeyValuePendingStructureRequestModel constructor.
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
