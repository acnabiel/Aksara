<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Temporary File Upload Configuration
    |--------------------------------------------------------------------------
    |
    | Configure file upload behavior for Livewire components.
    |
    */

    'temporary_file_upload' => [
        'disk' => null,        // Uses default filesystem disk (local)
        'rules' => 'file|max:102400',       // 100MB max limit
        'directory' => null,   // Uses livewire-tmp by default
        'middleware' => null,   // Uses web middleware
        'preview_mimes' => [   // Supported MIME types for file previews
            'png', 'gif', 'bmp', 'svg', 'wav', 'mp4',
            'mov', 'avi', 'wmv', 'mp3', 'm4a',
            'jpg', 'jpeg', 'mpga', 'webp', 'wma',
            'webm', 'mpeg', 'quicktime',
        ],
        'max_upload_time' => 300, // 5 minutes max upload time (in seconds)
    ],

];
