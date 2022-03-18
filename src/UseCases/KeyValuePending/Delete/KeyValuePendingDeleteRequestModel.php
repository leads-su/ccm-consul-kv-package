<?php

namespace ConsulConfigManager\Consul\KeyValue\UseCases\KeyValuePending\Delete;

use Illuminate\Http\Request;

/**
 * Class KeyValuePendingDeleteRequestModel
 * @package ConsulConfigManager\Consul\KeyValue\UseCases\KeyValuePending\Delete
 */
class KeyValuePendingDeleteRequestModel
{
    /**
     * Request instance
     * @var Request
     */
    private Request $request;

    /**
     * Identifier instance
     * @var string|int
     */
    private string|int $identifier;

    /**
     * KeyValuePendingDeleteRequestModel constructor.
     * @param Request $request
     * @param string|int $identifier
     * @return void
     */
    public function __construct(Request $request, string|int $identifier)
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
     * @return string|int
     */
    public function getIdentifier(): string|int
    {
        return $this->identifier;
    }
}
