<?php

use App\Models\SettingsPage;

function getConfigValueSettingTable($configKey)
{
    $setting_page = SettingsPage::where('config_key', $configKey)->first();
    if (!empty($setting_page)) {
        return $setting_page->config_value;
    }
    return null;
}
