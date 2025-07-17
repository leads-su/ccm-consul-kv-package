<?php

namespace ConsulConfigManager\Consul\KeyValue\Commands;

use ConsulConfigManager\Consul\KeyValue\Interfaces\KeyValueRepositoryInterface;
use Illuminate\Support\Str;
use Illuminate\Console\Command;
use Consul\Exceptions\RequestException;
use ConsulConfigManager\Consul\KeyValue\Interfaces\KeyValueServiceInterface;
use Symfony\Component\Console\Input\InputArgument;

// @codeCoverageIgnoreStart
/**
 * Class KeyValueDirDelete
 * @package ConsulConfigManager\Consul\KeyValue\Commands
 */
class KeyValueDirDelete extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    //protected $signature = 'consul:kv:dirdelete';

    /**
     * The console command description.
     *
     * @var string
     */
    //protected $description = 'Delete direcroty from KV storage with Consul';

    /**
     * Key Value repository instance
     * @var KeyValueRepositoryInterface
     */
    private KeyValueRepositoryInterface $repository;

    /**
     * Key Value service instance
     * @var KeyValueServiceInterface
     */
    private KeyValueServiceInterface $service;

    /**
     * KVTest constructor.
     * @param KeyValueRepositoryInterface $repository
     * @param KeyValueServiceInterface $service
     * @return void
     */
    public function __construct(KeyValueRepositoryInterface $repository, KeyValueServiceInterface $service)
    {
        $this->repository = $repository;
        $this->service = $service;
        parent::__construct();
    }

    protected function configure()
    {
        $this->setName('consul:kv:dirdelete')
            ->setDescription('Delete a directory from Consul KV store')
            ->addArgument('dir', InputArgument::REQUIRED, 'The name of the directory to delete');
    }

    /**
     * Execute console command.
     * @return int
     * @throws RequestException
     */
    public function handle(): int
    {
        $dir = $this->argument('dir');
        $this->info(sprintf('Delete directory %s...', $dir));

        if ($dir[strlen($dir) - 1] !== '/') {
            $dir .= '/';
        }

        $allKeys = $this->repository->allKeys();
        $keys = [];
        foreach ($allKeys as $key) {
            if (stripos($key, $dir) === 0) {
                $keys[] = $key;
            }
        }

        if (empty($keys)) {
            $this->error(sprintf('Directory %s not found.', $dir));
            return 1;
        }

        $this->info('The following keys will be removed: ');
        $this->info(print_r($keys, true));

        foreach ($keys as $key) {
            $this->repository->delete($key);
        }

        $this->service->deleteDirectory($dir);
        $this->info('Finished');

        return 0;
    }
}
// @codeCoverageIgnoreEnd
