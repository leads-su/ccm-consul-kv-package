<?php

namespace ConsulConfigManager\Consul\KeyValue\UseCases\KeyValue\Directory;

use Illuminate\Http\Request;

/**
 * Class DirectoryGetContentsRequestModel
 * @package ConsulConfigManager\Consul\KeyValue\UseCases\KeyValue\Directory
 */
class DirectoryGetContentsRequestModel
{
    /**
     * Request instance
     * @var Request
     */
    private Request $request;

    /**
     * Directory path
     * @var string
     */
    private string $path;

    /**
     * DirectoryGetContentsRequestModel constructor.
     * @param Request $request
     * @param string $path
     * @return void
     */
    public function __construct(Request $request, string $path = '')
    {
        $this->request = $request;
        $this->path = $path;
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
     * Get directory path
     * @return string
     */
    public function getPath(): string
    {
        return $this->path;
    }
}
