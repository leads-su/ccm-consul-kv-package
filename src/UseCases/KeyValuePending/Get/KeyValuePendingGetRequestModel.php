<?php

namespace ConsulConfigManager\Consul\KeyValue\UseCases\KeyValuePending\Get;

use Illuminate\Http\Request;

/**
 * Class KeyValuePendingGetRequestModel
 * @package ConsulConfigManager\Consul\KeyValue\UseCases\KeyValuePending\Get
 */
class KeyValuePendingGetRequestModel
{
    /**
     * Request instance
     * @var Request
     */
    private Request $request;

    /**
     * Identifier instance
     * @var string
     */
    private string $identifier;

    /**
     * KeyValuePendingGetRequestModel constructor.
     * @param Request $request
     * @param string $identifier
     * @return void
     */
    public function __construct(Request $request, string $identifier)
    {
        $this->request = $request;
        $this->identifier = $identifier;
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
     * Get identifier instance
     * @return string
     */
    public function getIdentifier(): string
    {
        return $this->identifier;
    }
}
