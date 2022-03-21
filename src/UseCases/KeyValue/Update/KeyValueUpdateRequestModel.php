<?php

namespace ConsulConfigManager\Consul\KeyValue\UseCases\KeyValue\Update;

use ConsulConfigManager\Consul\KeyValue\Http\Requests\KeyValue\KeyValueCreateUpdateRequest;

/**
 * Class KeyValueUpdateRequestModel
 * @package ConsulConfigManager\Consul\KeyValue\UseCases\KeyValue\Update
 */
class KeyValueUpdateRequestModel
{
    /**
     * Request instance
     * @var KeyValueCreateUpdateRequest
     */
    private KeyValueCreateUpdateRequest $request;

    /**
     * KeyValueUpdateRequestModel constructor.
     * @param KeyValueCreateUpdateRequest $request
     * @return void
     */
    public function __construct(KeyValueCreateUpdateRequest $request)
    {
        $this->request = $request;
    }

    /**
     * Get request instance
     * @return KeyValueCreateUpdateRequest
     */
    public function getRequest(): KeyValueCreateUpdateRequest
    {
        return $this->request;
    }

    /**
     * Get path from request
     * @return string
     */
    public function getPath(): string
    {
        return $this->getRequest()->get('path');
    }

    /**
     * Get value from request
     * @return array
     */
    public function getValue(): array
    {
        return $this->getRequest()->get('value');
    }
}
