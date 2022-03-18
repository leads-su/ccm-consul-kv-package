<?php

namespace ConsulConfigManager\Consul\KeyValue\UseCases\KeyValuePending\List;

use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;

/**
 * Class KeyValuePendingListResponseModel
 * @package ConsulConfigManager\Consul\KeyValue\UseCases\KeyValuePending\List
 */
class KeyValuePendingListResponseModel
{
    /**
     * Entities list
     * @var EloquentCollection|Collection|array
     */
    private EloquentCollection|Collection|array $entities;

    /**
     * KeyValuePendingListResponseModel constructor.
     * @param EloquentCollection|Collection|array $entities
     * @return void
     */
    public function __construct(EloquentCollection|Collection|array $entities = [])
    {
        $this->entities = $entities;
    }

    /**
     * Get entities list
     * @return array
     */
    public function getEntities(): array
    {
        if (is_array($this->entities)) {
            return $this->entities;
        }
        return $this->entities->toArray();
    }
}
