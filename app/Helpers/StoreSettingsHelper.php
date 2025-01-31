<?php

use App\Models\StoreSettings;

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
function getStoreSetting(int $storeId, string $key, $default = null)
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
