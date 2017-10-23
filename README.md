# Package name: laravel-mobile-notifications

## Installation for composer
<pre>composer require edyrkaj/laravel-mobile-notification</pre>

## Laravel 4 5 Push Notification from Server Side

This is a package to manage push notification to devices iOS | Android through Laravel.

The workflow that we suggest can be:
    - Create a migration file create_table_devices with fields like:
        id
        device_type
        language
        manufacturer
        model
        os
        os_version
        region
        sdk_version
        uuid
        created_at
        updated_at
        deleted_at
    - Create a model Device with these fillable data
    - Create a controller for Devices DeviceController
    - Implement methods to call Service PushService which comes with this installation on Services/PushService
    

## License

This package is released under the MIT License.

Copyright (c) 2017 Eledi Dyrkaj
