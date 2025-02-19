<?php

use App\Models\StoreSettings;
use App\Models\Logs;

/**
 * Save or update store settings.
 *
 * @param int $storeId
 * @param array $settings
 * @return void
 */
function saveStoreSettings(int $storeId, array $settings)
{
    foreach ($settings as $key => $value) {
        $metaValue = is_array($value) ? json_encode($value) : $value;

        StoreSettings::updateOrCreate(
            [
                'store_id' => $storeId,
                'meta_key' => $key,
            ],
            [
                'meta_value' => $metaValue,
            ]
        );
    }
}

/**
 * Retrieve a specific setting value for a store.
 *
 * @param int $storeId
 * @param string $key
 * @param mixed $default
 * @return mixed
 */
function getStoreSetting(int $storeId, string $key, $default = [])
{
    $setting = StoreSettings::where('store_id', $storeId)
        ->where('meta_key', $key)
        ->first();

    if (!$setting) {
        return $default;
    }

    $value = $setting->meta_value;

    // Decode JSON if stored value is JSON
    $decoded = json_decode($value, true);
    return $decoded === null ? $value : $decoded;
}

/**
 * Retrieve all settings for a store.
 *
 * @param int $storeId
 * @return array
 */
function getAllStoreSettings(int $storeId): array
{
    $settings = StoreSettings::where('store_id', $storeId)->get();
    $result = [];

    foreach ($settings as $setting) {
        $decoded = json_decode($setting->meta_value, true);
        $result[$setting->meta_key] = $decoded === null ? $setting->meta_value : $decoded;
    }

    return $result;
}

function storeLog($data)
    {
        return Logs::create([
            'customer_id'  => $data['customer_id'] ?? null,
            'store_id'     => $data['store_id'] ?? null,
            'user_id'      => $data['user_id'] ?? null,
            'event_type'   => $data['event_type'],
            'event_action' => $data['event_action'],
            'status'       => $data['status'],
            'message'      => $data['message'] ?? null,
            'payload'      => json_encode($data['payload'] ?? [])
        ]);
    }
