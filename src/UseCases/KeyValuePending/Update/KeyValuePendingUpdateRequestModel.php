<?php

namespace ConsulConfigManager\Consul\KeyValue\UseCases\KeyValuePending\Update;

use ConsulConfigManager\Consul\KeyValue\Http\Requests\KeyValuePending\KeyValuePendingCreateUpdateRequest;

/**
 * Class KeyValuePendingUpdateRequestModel
 * @package ConsulConfigManager\Consul\KeyValue\UseCases\KeyValuePending\Update
 */
class KeyValuePendingUpdateRequestModel
{
    /**
     * Request instance
     * @var KeyValuePendingCreateUpdateRequest
     */
    private KeyValuePendingCreateUpdateRequest $request;

    /**
     * KeyValuePendingUpdateRequestModel constructor.
     * @param KeyValuePendingCreateUpdateRequest $request
     * @return void
     */
    public function __construct(KeyValuePendingCreateUpdateRequest $request)
    {
        $this->request = $request;
    }

    /**
     * Get request instance
     * @return KeyValuePendingCreateUpdateRequest
     */
    public function getRequest(): KeyValuePendingCreateUpdateRequest
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
