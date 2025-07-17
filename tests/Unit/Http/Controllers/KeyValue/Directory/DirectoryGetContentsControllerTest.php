<?php

namespace ConsulConfigManager\Consul\KeyValue\Test\Unit\Http\Controllers\KeyValue\Directory;

use Mockery;
use Illuminate\Http\Response;
use ConsulConfigManager\Consul\KeyValue\Test\TestCase;
use ConsulConfigManager\Domain\ViewModels\HttpResponseViewModel;
use ConsulConfigManager\Consul\KeyValue\Http\Controllers\KeyValue\Directory\DirectoryGetContentsController;
use ConsulConfigManager\Consul\KeyValue\UseCases\KeyValue\Directory\DirectoryGetContentsInputPort;
use ConsulConfigManager\Consul\KeyValue\UseCases\KeyValue\Directory\DirectoryGetContentsRequestModel;

/**
 * Class DirectoryGetContentsControllerTest
 * @package ConsulConfigManager\Consul\KeyValue\Test\Unit\Http\Controllers\KeyValue\Directory
 */
class DirectoryGetContentsControllerTest extends TestCase
{
    /**
     * @var Mockery\MockInterface|DirectoryGetContentsInputPort
     */
    private $interactor;

    /**
     * @var DirectoryGetContentsController
     */
    private DirectoryGetContentsController $controller;

    /**
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $this->interactor = Mockery::mock(DirectoryGetContentsInputPort::class);
        $this->controller = new DirectoryGetContentsController($this->interactor);
    }

    /**
     * @return void
     */
    public function testShouldPassIfValidDataReturnedFromGetContentsMethod(): void
    {
        $this->interactor
            ->shouldReceive('get')
            ->once()
            ->with(Mockery::type(DirectoryGetContentsRequestModel::class))
            ->andReturnUsing(function (DirectoryGetContentsRequestModel $requestModel) {
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
            ->shouldReceive('get')
            ->once()
            ->with(Mockery::on(function (DirectoryGetContentsRequestModel $requestModel) {
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
