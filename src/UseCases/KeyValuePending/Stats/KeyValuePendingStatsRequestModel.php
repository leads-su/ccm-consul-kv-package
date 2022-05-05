<?php

namespace ConsulConfigManager\Consul\KeyValue\UseCases\KeyValuePending\Stats;

use Illuminate\Http\Request;

/**
 * Class KeyValuePendingStatsRequestModel
 * @package ConsulConfigManager\Consul\KeyValue\UseCases\KeyValuePending\Stats
 */
class KeyValuePendingStatsRequestModel
{
    /**
     * Request instance
     * @var Request
     */
    private Request $request;

    /**
     * KeyValuePendingStatsRequestModel constructor.
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
