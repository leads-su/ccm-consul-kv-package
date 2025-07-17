<?php

namespace ConsulConfigManager\Consul\KeyValue\UseCases\KeyValue\Directory;

/**
 * Class DirectoryGetContentsResponseModel
 * @package ConsulConfigManager\Consul\KeyValue\UseCases\KeyValue\Directory
 */
class DirectoryGetContentsResponseModel
{
    /**
     * Directory contents
     * @var array
     */
    private array $contents;

    /**
     * DirectoryGetContentsResponseModel constructor.
     * @param array $contents
     * @return void
     */
    public function __construct(array $contents = [])
    {
        $this->contents = $contents;
    }

    /**
     * Get directory contents
     * @return array
     */
    public function getContents(): array
    {
        return $this->contents;
    }

    /**
     * Set directory contents
     * @param array $contents
     * @return DirectoryGetContentsResponseModel
     */
    public function setContents(array $contents): DirectoryGetContentsResponseModel
    {
        $this->contents = $contents;
        return $this;
    }
}
