<?php

namespace ConsulConfigManager\Consul\KeyValue\UseCases\KeyValue\Directory;

/**
 * Class DirectoryCreateResponseModel
 * @package ConsulConfigManager\Consul\KeyValue\UseCases\KeyValue\Directory
 */
class DirectoryCreateResponseModel
{
    /**
     * Creation result
     * @var bool
     */
    private bool $result;

    /**
     * DirectoryCreateResponseModel constructor.
     * @param bool $result
     * @return void
     */
    public function __construct(bool $result = false)
    {
        $this->result = $result;
    }

    /**
     * Get creation result
     * @return bool
     */
    public function getResult(): bool
    {
        return $this->result;
    }

    /**
     * Set creation result
     * @param bool $result
     * @return DirectoryCreateResponseModel
     */
    public function setResult(bool $result): DirectoryCreateResponseModel
    {
        $this->result = $result;
        return $this;
    }
}
