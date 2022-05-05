<?php

namespace ConsulConfigManager\Consul\KeyValue\UseCases\KeyValue\Structure;

use Illuminate\Http\Request;

/**
 * Class KeyValueStructureRequestModel
 * @package ConsulConfigManager\Consul\KeyValue\UseCases\Structure
 */
class KeyValueStructureRequestModel
{
    /**
     * Request instance
     * @var Request
     */
    private Request $request;

    /**
     * KeyValueStructureRequestModel constructor.
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
