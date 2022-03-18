<?php

namespace ConsulConfigManager\Consul\KeyValue\Factories;

use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use ConsulConfigManager\Consul\KeyValue\Models\KeyValuePending;

/**
 * Class KeyValuePendingFactory
 * @package ConsulConfigManager\Consul\KeyValue\Factories
 */
class KeyValuePendingFactory extends Factory
{
    /**
     * @inheritDoc
     */
    protected $model = KeyValuePending::class;

    /**
     * @inheritDoc
     */
    public function definition(): array
    {
        return [
            'id'            =>  $this->faker->unique()->numberBetween(1, 10),
            'uuid'          =>  $this->faker->uuid(),
            'path'          =>  sprintf('consul/%s', Str::snake(rtrim($this->faker->sentence(2), '.'))),
            'value'         =>  [
                'type'      =>  'string',
                'value'     =>  $this->faker->sentence(3),
            ],
            'created_at'    =>  Carbon::now(),
            'updated_at'    =>  Carbon::now(),
        ];
    }
}
