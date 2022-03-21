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
