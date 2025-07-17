<?php

use Illuminate\Support\Facades\Route;

Route::prefix('kv')->group(static function (): void {
    Route::get('', \ConsulConfigManager\Consul\KeyValue\Http\Controllers\KeyValue\KeyValueNamespacedController::class)
        ->name('domain.consul.kv');

    Route::get('references', \ConsulConfigManager\Consul\KeyValue\Http\Controllers\KeyValue\KeyValueReferencesController::class)
        ->name('domain.consul.kv.references');

    Route::get('menu', \ConsulConfigManager\Consul\KeyValue\Http\Controllers\KeyValue\KeyValueMenuController::class)
        ->name('domain.consul.kv.menu');

    Route::get('structure', \ConsulConfigManager\Consul\KeyValue\Http\Controllers\KeyValue\KeyValueStructureController::class)
        ->name('domain.consul.kv.structure');

    Route::prefix('pending')->group(static function (): void {
        Route::get('menu', \ConsulConfigManager\Consul\KeyValue\Http\Controllers\KeyValuePending\KeyValuePendingMenuController::class)
            ->name('domain.consul.kv.pending.menu');

        Route::get('structure', \ConsulConfigManager\Consul\KeyValue\Http\Controllers\KeyValuePending\KeyValuePendingStructureController::class)
            ->name('domain.consul.kv.pending.structure');

        Route::get('', \ConsulConfigManager\Consul\KeyValue\Http\Controllers\KeyValuePending\KeyValuePendingListController::class)
            ->name('domain.consul.kv.pending.list');

        Route::post('', \ConsulConfigManager\Consul\KeyValue\Http\Controllers\KeyValuePending\KeyValuePendingCreateController::class)
            ->name('domain.consul.kv.pending.create');

        Route::patch('', \ConsulConfigManager\Consul\KeyValue\Http\Controllers\KeyValuePending\KeyValuePendingUpdateController::class)
            ->name('domain.consul.kv.pending.update');

        Route::delete('{key}', \ConsulConfigManager\Consul\KeyValue\Http\Controllers\KeyValuePending\KeyValuePendingDeleteController::class)
            ->name('domain.consul.kv.pending.delete')
            ->where('key', '[\w\s\-_\/]+');

        Route::get('{key}', \ConsulConfigManager\Consul\KeyValue\Http\Controllers\KeyValuePending\KeyValuePendingGetController::class)
            ->name('domain.consul.kv.pending.information')
            ->where('key', '[\w\s\-_\/]+');
    });

    Route::prefix('directory')->group(static function (): void {
        Route::post('', \ConsulConfigManager\Consul\KeyValue\Http\Controllers\KeyValue\Directory\DirectoryCreateController::class)
            ->name('domain.consul.kv.directory.create');

        Route::get('{path}/keys', \ConsulConfigManager\Consul\KeyValue\Http\Controllers\KeyValue\Directory\DirectoryListKeysController::class)
            ->name('domain.consul.kv.directory.keys')
            ->where('path', '[\w\s\-_\/]+');

        Route::get('{path}', \ConsulConfigManager\Consul\KeyValue\Http\Controllers\KeyValue\Directory\DirectoryGetContentsController::class)
            ->name('domain.consul.kv.directory.contents')
            ->where('path', '[\w\s\-_\/]+');
    });

    Route::post('', \ConsulConfigManager\Consul\KeyValue\Http\Controllers\KeyValue\KeyValueCreateController::class)
        ->name('domain.consul.kv.create');

    Route::patch('', \ConsulConfigManager\Consul\KeyValue\Http\Controllers\KeyValue\KeyValueUpdateController::class)
        ->name('domain.consul.kv.update');

    Route::delete('{key}', \ConsulConfigManager\Consul\KeyValue\Http\Controllers\KeyValue\KeyValueDeleteController::class)
        ->name('domain.consul.kv.delete')
        ->where('key', '[\w\s\-_\/]+');

    Route::get('{key}', \ConsulConfigManager\Consul\KeyValue\Http\Controllers\KeyValue\KeyValueGetController::class)
        ->name('domain.consul.kv.information')
        ->where('key', '[\w\s\-_\/]+');
});

Route::prefix('stats')->group(static function (): void {
    Route::get('key-value', \ConsulConfigManager\Consul\KeyValue\Http\Controllers\KeyValue\KeyValueStatsController::class)
        ->name('domain.consul.stats.key_value');
    Route::get('pending-key-value', \ConsulConfigManager\Consul\KeyValue\Http\Controllers\KeyValuePending\KeyValuePendingStatsController::class)
        ->name('domain.consul.stats.pending_key_value');
});
