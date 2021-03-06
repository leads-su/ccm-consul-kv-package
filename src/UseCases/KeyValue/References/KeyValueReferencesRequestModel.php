<?php

namespace ConsulConfigManager\Consul\KeyValue\UseCases\KeyValue\References;

use Illuminate\Http\Request;

/**
 * Class KeyValueReferencesRequestModel
 * @package ConsulConfigManager\Consul\KeyValue\UseCases\References
 */
class KeyValueReferencesRequestModel
{
    /**
     * Request instance
     * @var Request
     */
    private Request $request;

    /**
     * KeyValueReferencesRequestModel constructor.
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
