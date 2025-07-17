<?php

namespace ConsulConfigManager\Consul\KeyValue\Services;

use Throwable;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Log;
use Consul\Services\KeyValue\KeyValue;
use Consul\Exceptions\RequestException;
use ConsulConfigManager\Consul\KeyValue\Interfaces\KeyValueServiceInterface;
use ConsulConfigManager\Consul\KeyValue\Exceptions\KeyValueAlreadyExistsException;
use ConsulConfigManager\Consul\KeyValue\Exceptions\KeyValueDoesNotExistsException;

/**
 * Class KeyValueService
 * @package ConsulConfigManager\Consul\KeyValue\Services
 */
class KeyValueService extends AbstractService implements KeyValueServiceInterface
{
    /**
     * SDK service reference
     * @var KeyValue
     */
    private KeyValue $service;

    /**
     * KeyValueService Constructor.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->service = new KeyValue($this->client());
    }

    /**
     * @inheritDoc
     */
    public function getKeyValue(string $key): array
    {
        return $this->service->get($key, [
            'raw',
        ]);
    }

    /**
     * @inheritDoc
     */
    public function getKeysList(string $prefix = ''): array
    {
        return $this->service->get($prefix, [
            'keys',
        ]);
    }

    /**
     * @inheritDoc
     */
    public function getKeysValuesInPrefix(string $prefix): array
    {
        $response = $this->service->get($prefix, ['recurse']);
        $result = [];

        foreach ($response as $entry) {
            $key = trim(Arr::get($entry, 'Key'));
            $value = Arr::get($entry, 'Value');
            if ($value !== null) {
                $value = base64_decode($value);
                try {
                    $value = json_decode($value, true, 512, JSON_THROW_ON_ERROR);
                    // @codeCoverageIgnoreStart
                } catch (Throwable $exception) {
                    Log::info(sprintf('Failed to decode value for key `%s` with exception: %s', $key, $exception->getMessage()));
                }
                // @codeCoverageIgnoreEnd
            }
            Arr::set($result, $key, $value);
        }

        return $result;
    }

    /**
     * @inheritDoc
     */
    public function createKeyValue(string $key, array $value): bool
    {
        try {
            $this->getKeyValue($key);
            throw new KeyValueAlreadyExistsException('Please use `updateKeyValue` for existing entries.');
        } catch (RequestException) {
            return $this->service->put($key, json_encode($value, JSON_THROW_ON_ERROR | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
        }
    }

    /**
     * @inheritDoc
     */
    public function updateKeyValue(string $key, array $value): bool
    {
        try {
            $this->getKeyValue($key);
            return $this->service->put($key, json_encode($value, JSON_THROW_ON_ERROR | JSON_UNESCAPED_UNICODE));
        } catch (RequestException) {
            throw new KeyValueDoesNotExistsException('Please use `createKeyValue` to create new entry.');
        }
    }

    /**
     * @inheritDoc
     */
    public function createOrUpdateKeyValue(string $key, array $value): bool
    {
        return $this->service->put($key, json_encode($value, JSON_THROW_ON_ERROR | JSON_UNESCAPED_UNICODE));
    }

    /**
     * @inheritDoc
     */
    public function deleteKey(string $key): bool
    {
        return $this->service->delete($key);
    }

    /**
     * @inheritDoc
     */
    public function createDirectory(string $path): bool
    {
        $directoryPath = $this->normalizeDirectoryPath($path);
        $creationResult = $this->service->put($directoryPath, null);

        if ($creationResult) {
            $this->createKeyValue(
                sprintf('%s%s', $directoryPath, '__ccm_system'),
                [
                    'created_at' => now()->format('Y-m-d'),
                ]
            );
        }

        return $creationResult;
    }

        /**
     * @inheritDoc
     */
    public function deleteDirectory(string $path, bool $recursive = true): bool
    {
        if ($recursive) {
            $prefixPath = rtrim(trim($path), '/');

            try {

                $keys = $this->service->get($prefixPath, ['keys' => true]);


                foreach ($keys as $key) {
                    $this->service->delete($key);
                }

                $this->service->delete($prefixPath, ['recurse' => true]);

                $directoryPath = $this->normalizeDirectoryPath($path);
                return $this->service->delete($directoryPath, ['recurse' => true]);

            } catch (\Exception $e) {

                return $this->service->delete($prefixPath, ['recurse' => true]);
            }
        } else {
            $directoryPath = $this->normalizeDirectoryPath($path);
            return $this->service->delete($directoryPath);
        }
    }

    /**
     * @inheritDoc
     */
    public function listDirectoryKeys(string $path): array
    {
        $directoryPath = $this->normalizeDirectoryPath($path);
        return $this->service->get($directoryPath, ['keys' => true]);
    }

    /**
     * @inheritDoc
     */
    public function getDirectoryContents(string $path): array
    {
        $directoryPath = $this->normalizeDirectoryPath($path);
        $response = $this->service->get($directoryPath, ['recurse' => true]);
        $result = [];

        foreach ($response as $entry) {
            $key = trim(Arr::get($entry, 'Key'));
            $value = Arr::get($entry, 'Value');
            if ($value !== null) {
                $value = base64_decode($value);
                try {
                    $decodedValue = json_decode($value, true, 512, JSON_THROW_ON_ERROR);
                    $value = $decodedValue;
                    // @codeCoverageIgnoreStart
                } catch (Throwable $exception) {
                    Log::info(sprintf('Failed to decode value for key `%s` with exception: %s', $key, $exception->getMessage()));
                }
                // @codeCoverageIgnoreEnd
            }
            $result[$key] = $value;
        }

        return $result;
    }

    /**
     * Normalize directory path to ensure it ends with a slash
     * @param string $path
     * @return string
     */
    private function normalizeDirectoryPath(string $path): string
    {
        return rtrim(trim($path), '/') . '/';
    }
}
