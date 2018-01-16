<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Filesystem Disk
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default filesystem disk that should be used
    | by the framework. The "local" disk, as well as a variety of cloud
    | based disks are available to your application. Just store away!
    |
    */

    'default' => env('FILESYSTEM_DRIVER', 'local'),

    /*
    |--------------------------------------------------------------------------
    | Default Cloud Filesystem Disk
    |--------------------------------------------------------------------------
    |
    | Many applications store files both locally and in the cloud. For this
    | reason, you may specify a default "cloud" driver here. This driver
    | will be bound as the Cloud disk implementation in the container.
    |
    */

    'cloud' => env('FILESYSTEM_CLOUD', 's3'),

    /*
    |--------------------------------------------------------------------------
    | Filesystem Disks
    |--------------------------------------------------------------------------
    |
    | Here you may configure as many filesystem "disks" as you wish, and you
    | may even configure multiple disks of the same driver. Defaults have
    | been setup for each driver as an example of the required options.
    |
    | Supported Drivers: "local", "ftp", "s3", "rackspace"
    |
    */

    'disks' => [
        'parent' => [
            'driver' => 'local',
            'root' => storage_path('app/public/profiles'),
        ],

        'local' => [
            'driver' => 'local',
            'root' => storage_path('app'),
        ],

        'public' => [
            'driver' => 'local',
            'root' => storage_path('app/public'),
            'url' => env('APP_URL').'/storage',
            'visibility' => 'public',
        ],
        /*个人头像、企业logo*/
        'profile' => [
            'driver' => 'local',
            'root' => storage_path('app/public/profiles'),
        ],
        /*法人照片、企业营业执照*/
        'authentication' => [
            'driver' => 'local',
            'root' => storage_path('app/public/authentication'),
        ],
        /*新闻图片*/
        'newspic' => [
            'driver' => 'local',
            'root' => storage_path('app/public/newspic'),
        ],
        /*企业圈图片*/
        'cooperpic' => [
            'driver' => 'local',
            'root' => storage_path('app/public/cooperpic'),
        ],
        /*广告图片*/
        'adpic' => [
            'driver' => 'local',
            'root' => storage_path('app/public/adpic'),
        ],
        's3' => [
            'driver' => 's3',
            'key' => env('AWS_KEY'),
            'secret' => env('AWS_SECRET'),
            'region' => env('AWS_REGION'),
            'bucket' => env('AWS_BUCKET'),
        ],

    ],

];
