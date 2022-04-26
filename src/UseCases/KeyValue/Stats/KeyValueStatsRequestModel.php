<?php

namespace ConsulConfigManager\Consul\KeyValue\UseCases\KeyValue\Stats;

use Illuminate\Http\Request;

/**
 * Class KeyValueStatsRequestModel
 * @package ConsulConfigManager\Consul\KeyValue\UseCases\KeyValue\Stats
 */
class KeyValueStatsRequestModel
{
    /**
     * Request instance
     * @var Request
     */
    private Request $request;

    /**
     * KeyValueStatsRequestModel constructor.
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
