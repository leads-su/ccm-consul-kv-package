<?php

namespace ConsulConfigManager\Consul\KeyValue\Test\Unit\Http\Controllers\KeyValue\Directory;

use Mockery;
use Illuminate\Http\Response;
use ConsulConfigManager\Consul\KeyValue\Test\TestCase;
use ConsulConfigManager\Domain\ViewModels\HttpResponseViewModel;
use ConsulConfigManager\Consul\KeyValue\Http\Requests\KeyValue\DirectoryCreateRequest;
use ConsulConfigManager\Consul\KeyValue\Http\Controllers\KeyValue\Directory\DirectoryCreateController;
use ConsulConfigManager\Consul\KeyValue\UseCases\KeyValue\Directory\DirectoryCreateInputPort;
use ConsulConfigManager\Consul\KeyValue\UseCases\KeyValue\Directory\DirectoryCreateRequestModel;

/**
 * Class DirectoryCreateControllerTest
 * @package ConsulConfigManager\Consul\KeyValue\Test\Unit\Http\Controllers\KeyValue\Directory
 */
class DirectoryCreateControllerTest extends TestCase
{
    /**
     * @var Mockery\MockInterface|DirectoryCreateInputPort
     */
    private $interactor;

    /**
     * @var DirectoryCreateController
     */
    private DirectoryCreateController $controller;

    /**
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $this->interactor = Mockery::mock(DirectoryCreateInputPort::class);
        $this->controller = new DirectoryCreateController($this->interactor);
    }

    /**
     * @return void
     */
    public function testShouldPassIfValidDataReturnedFromCreateMethod(): void
    {
        $request = new DirectoryCreateRequest([
            'path' => 'test/directory',
        ]);

        $this->interactor
            ->shouldReceive('create')
            ->once()
            ->with(Mockery::type(DirectoryCreateRequestModel::class))
            ->andReturnUsing(function (DirectoryCreateRequestModel $requestModel) {
                $this->assertEquals('test/directory', $requestModel->getPath());
                return new HttpResponseViewModel(new Response(['success' => true], Response::HTTP_CREATED));
            });

        $response = $this->controller->__invoke($request);

        $this->assertInstanceOf(Response::class, $response);
    }

    /**
     * @return void
     */
    public function testShouldPassIfRequestModelIsCreatedCorrectly(): void
    {
        $request = new DirectoryCreateRequest([
            'path' => 'test/directory',
        ]);

        $this->interactor
            ->shouldReceive('create')
            ->once()
            ->with(Mockery::on(function (DirectoryCreateRequestModel $requestModel) {
                return $requestModel->getPath() === 'test/directory';
            }))
            ->andReturn(new HttpResponseViewModel(new Response(['success' => true], Response::HTTP_CREATED)));

        $response = $this->controller->__invoke($request);

        $this->assertInstanceOf(Response::class, $response);
        $this->assertEquals(Response::HTTP_CREATED, $response->getStatusCode());
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
