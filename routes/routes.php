<?php

use Illuminate\Support\Facades\Route;

Route::prefix('kv')->group(static function (): void {
    Route::get('', \ConsulConfigManager\Consul\KeyValue\Http\Controllers\KeyValueNamespacedController::class)
        ->name('domain.consul.kv');
    Route::get('references', \ConsulConfigManager\Consul\KeyValue\Http\Controllers\KeyValueReferencesController::class)
        ->name('domain.consul.kv.references');
    Route::get('{key}', \ConsulConfigManager\Consul\KeyValue\Http\Controllers\KeyValueGetController::class)
        ->name('domain.consul.kv.information')
        ->where('key', '[\w\s\-_\/]+');
});
