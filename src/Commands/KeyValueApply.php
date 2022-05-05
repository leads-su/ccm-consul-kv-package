<?php

namespace ConsulConfigManager\Consul\KeyValue\Commands;

use Throwable;
use Illuminate\Console\Command;
use ConsulConfigManager\Consul\KeyValue\Interfaces\KeyValueRepositoryInterface;
use ConsulConfigManager\Consul\KeyValue\Interfaces\KeyValuePendingRepositoryInterface;

// @codeCoverageIgnoreStart

/**
 * Class KeyValueApply
 * @package ConsulConfigManager\Consul\KeyValue\Commands
 */
class KeyValueApply extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'consul:kv:apply {key}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Apply change to Consul Key Value Storage';

    /**
     * Key Value repository instance
     * @var KeyValueRepositoryInterface
     */
    private KeyValueRepositoryInterface $keyValueRepository;

    /**
     * Key Value Pending repository instance
     * @var KeyValuePendingRepositoryInterface
     */
    private KeyValuePendingRepositoryInterface $keyValuePendingRepository;

    /**
     * KeyValueApply constructor.
     * @param KeyValueRepositoryInterface $keyValueRepository
     * @param KeyValuePendingRepositoryInterface $keyValuePendingRepository
     * @return void
     */
    public function __construct(KeyValueRepositoryInterface $keyValueRepository, KeyValuePendingRepositoryInterface $keyValuePendingRepository)
    {
        $this->keyValueRepository = $keyValueRepository;
        $this->keyValuePendingRepository = $keyValuePendingRepository;
        parent::__construct();
    }

    /**
     * Execute console command.
     * @return int
     */
    public function handle(): int
    {
        $key = $this->argument('key');

        $pendingModel = $this->keyValuePendingRepository->find($key);

        if ($pendingModel === null) {
            $this->info('There is no pending key for: ' . $key);
            return Command::SUCCESS;
        }

        try {
            $this->keyValueRepository->update($pendingModel->getPath(), $pendingModel->getValue());
            $this->keyValuePendingRepository->delete($pendingModel->getPath());
            $this->info('Successfully updated value for key: ' . $pendingModel->getPath());
        } catch (Throwable $throwable) {
            $this->error('Failed to migrate key from pending to live database: ' . $throwable->getMessage());
            return Command::FAILURE;
        }

        return Command::SUCCESS;
    }
}

// @codeCoverageIgnoreEnd
