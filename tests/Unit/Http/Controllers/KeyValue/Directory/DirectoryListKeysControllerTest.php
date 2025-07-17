<?php

namespace ConsulConfigManager\Consul\KeyValue\Test\Unit\Http\Controllers\KeyValue\Directory;

use Mockery;
use Illuminate\Http\Response;
use ConsulConfigManager\Consul\KeyValue\Test\TestCase;
use ConsulConfigManager\Domain\ViewModels\HttpResponseViewModel;
use ConsulConfigManager\Consul\KeyValue\Http\Controllers\KeyValue\Directory\DirectoryListKeysController;
use ConsulConfigManager\Consul\KeyValue\UseCases\KeyValue\Directory\DirectoryListKeysInputPort;
use ConsulConfigManager\Consul\KeyValue\UseCases\KeyValue\Directory\DirectoryListKeysRequestModel;

/**
 * Class DirectoryListKeysControllerTest
 * @package ConsulConfigManager\Consul\KeyValue\Test\Unit\Http\Controllers\KeyValue\Directory
 */
class DirectoryListKeysControllerTest extends TestCase
{
    /**
     * @var Mockery\MockInterface|DirectoryListKeysInputPort
     */
    private $interactor;

    /**
     * @var DirectoryListKeysController
     */
    private DirectoryListKeysController $controller;

    /**
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $this->interactor = Mockery::mock(DirectoryListKeysInputPort::class);
        $this->controller = new DirectoryListKeysController($this->interactor);
    }

    /**
     * @return void
     */
    public function testShouldPassIfValidDataReturnedFromListKeysMethod(): void
    {
        $this->interactor
            ->shouldReceive('list')
            ->once()
            ->with(Mockery::type(DirectoryListKeysRequestModel::class))
            ->andReturnUsing(function (DirectoryListKeysRequestModel $requestModel) {
                $this->assertEquals('test/directory', $requestModel->getPath());
                return new HttpResponseViewModel(new Response(['success' => true], Response::HTTP_OK));
            });

        $response = $this->controller->__invoke(new \Illuminate\Http\Request(), 'test/directory');

        $this->assertInstanceOf(Response::class, $response);
    }

    /**
     * @return void
     */
    public function testShouldPassIfRequestModelIsCreatedCorrectly(): void
    {
        $this->interactor
            ->shouldReceive('list')
            ->once()
            ->with(Mockery::on(function (DirectoryListKeysRequestModel $requestModel) {
                return $requestModel->getPath() === 'test/directory';
            }))
            ->andReturn(new HttpResponseViewModel(new Response(['success' => true], Response::HTTP_OK)));

        $response = $this->controller->__invoke(new \Illuminate\Http\Request(), 'test/directory');

        $this->assertInstanceOf(Response::class, $response);
        $this->assertEquals(Response::HTTP_OK, $response->getStatusCode());
    }

    /**
     * @return void
     */
    public function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }
}
