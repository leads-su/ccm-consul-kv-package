<?php

namespace ConsulConfigManager\Consul\KeyValue\Test\Unit\Events;

use Exception;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;
use ConsulConfigManager\Users\Models\User;
use ConsulConfigManager\Consul\KeyValue\Test\TestCase;
use ConsulConfigManager\Users\ValueObjects\EmailValueObject;
use ConsulConfigManager\Consul\KeyValue\Events\AbstractEvent;
use ConsulConfigManager\Users\ValueObjects\UsernameValueObject;

/**
 * Class AbstractEventTest
 * @package ConsulConfigManager\Consul\KeyValue\Test\Unit\Events
 */
abstract class AbstractEventTest extends TestCase
{
    /**
     * Currently active event handler
     * @var string
     */
    protected string $activeEventHandler;

    /**
     * @param array $data
     *
     * @return void
     * @dataProvider eventDataProvider
     * @throws Exception
     */
    public function testShouldPassIfValidDataReturnedFromGetDateTimeMethod(array $data): void
    {
        $this->assertNotEquals(0, $this->createClassInstance($data)->getDateTime());
    }

    /**
     * @param array $data
     *
     * @return void
     * @dataProvider eventDataProvider
     * @throws Exception
     */
    public function testShouldPassIfValidDataReturnedFromSetDateTimeMethod(array $data): void
    {
        if (!Arr::exists($data, 'time')) {
            $this->markTestSkipped('There is no `time` present on the data array');
        }

        $instance = $this->createClassInstance($data);

        /**
         * @var Carbon $carbonInstance
         */
        $carbonInstance = Arr::get($data, 'time');
        $instance->setDateTime($carbonInstance);

        $this->assertEquals($carbonInstance->getTimestamp(), $instance->getDateTime());
    }

    /**
     * @param array $data
     *
     * @return void
     * @dataProvider eventDataProvider
     * @throws Exception
     */
    public function testShouldPassIfValidDataReturnedFromGetUserMethod(array $data): void
    {
        $this->assertEquals(1, $this->createClassInstance($data)->getUser());
    }

    /**
     * @param array $data
     *
     * @return void
     * @dataProvider eventDataProvider
     * @throws Exception
     */
    public function testShouldPassIfValidDataReturnedFromSetUserMethod(array $data): void
    {
        if (!Arr::exists($data, 'user')) {
            $this->markTestSkipped('There is no `user` present on the data array');
        }
        $instance = $this->createClassInstance($data);
        /**
         * @var UserEntity $user
         */
        $user = Arr::get($data, 'user');
        $user->setID(2);
        $instance->setUser($user);
        $this->assertEquals(2, $instance->getUser());
    }

    /**
     * Create new instance of event handler class
     * @param array $data
     * @return AbstractEvent
     */
    abstract protected function createClassInstance(array $data): AbstractEvent;

    /**
     * Created event data provider
     * @return \array[][]
     */
    public function eventDataProvider(): array
    {
        return [
            'consul/example'            =>  [
                'data'                  =>  [
                    'path'              =>  'consul/example',
                    'value'             =>  [
                        'type'          => 'string',
                        'value'         => 'Hello World',
                    ],
                    'time'              =>  Carbon::now(),
                    'user'              =>  new User([
                        'id'            =>  1,
                        'first_name'    =>  'John',
                        'last_name'     =>  'Doe',
                        'username'      =>  new UsernameValueObject('john.doe'),
                        'email'         =>  new EmailValueObject('john.doe@example.com'),
                    ]),
                ],
            ],
        ];
    }
}
