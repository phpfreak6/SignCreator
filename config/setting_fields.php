<?php

return [
    'app' => [
        'title' => 'General',
        'desc'  => 'All the general settings for application.',
        'icon'  => 'fas fa-cube',

        'elements' => [
            [
                'type'  => 'text', // input fields type
                'data'  => 'string', // data type, string, int, boolean
                'name'  => 'app_name', // unique name for field
                'label' => 'App Name', // you know what label it is
                'rules' => '', // validation rule of laravel
                'class' => '', // any class for input
                'value' => '', // default value if you want
            ],
            [
                'type'  => 'text', // input fields type
                'data'  => 'string', // data type, string, int, boolean
                'name'  => 'footer_text', // unique name for field
                'label' => 'Footer Text', // you know what label it is
                'rules' => '', // validation rule of laravel
                'class' => '', // any class for input
                'value' => '', // default value if you want
            ],
            [
                'type'  => 'checkbox', // input fields type
                'data'  => 'text', // data type, string, int, boolean
                'name'  => 'show_copyright', // unique name for field
                'label' => 'Show Copyright', // you know what label it is
                'rules' => '', // validation rule of laravel
                'class' => '', // any class for input
                'value' => '', // default value if you want
            ],
        ],
    ],
    'email' => [
        'title' => 'Email',
        'desc'  => 'Email settings for app',
        'icon'  => 'fas fa-envelope',

        'elements' => [
            [
                'type'  => 'email', // input fields type
                'data'  => 'string', // data type, string, int, boolean
                'name'  => 'email', // unique name for field
                'label' => 'Email', // you know what label it is
                'rules' => 'required|email', // validation rule of laravel
                'class' => '', // any class for input
                'value' => '', // default value if you want
            ],
        ],

    ],
    'social' => [
        'title' => 'Social Profiles',
        'desc'  => 'Link of all the social profiles.',
        'icon'  => 'fas fa-users',

        'elements' => [
            [
                'type'  => 'text', // input fields type
                'data'  => 'string', // data type, string, int, boolean
                'name'  => 'facebook_url', // unique name for field
                'label' => 'Facebook Page URL', // you know what label it is
                'rules' => '', // validation rule of laravel
                'class' => '', // any class for input
                'value' => '', // default value if you want
            ],
            [
                'type'  => 'text', // input fields type
                'data'  => 'string', // data type, string, int, boolean
                'name'  => 'twitter_url', // unique name for field
                'label' => 'Twitter Profile URL', // you know what label it is
                'rules' => '', // validation rule of laravel
                'class' => '', // any class for input
                'value' => '', // default value if you want
            ],
            [
                'type'  => 'text', // input fields type
                'data'  => 'string', // data type, string, int, boolean
                'name'  => 'linkedin_url', // unique name for field
                'label' => 'LinkedIn URL', // you know what label it is
                'rules' => '', // validation rule of laravel
                'class' => '', // any class for input
                'value' => '', // default value if you want
            ],
            [
                'type'  => 'text', // input fields type
                'data'  => 'string', // data type, string, int, boolean
                'name'  => 'youtube_url', // unique name for field
                'label' => 'Youtube Channel URL', // you know what label it is
                'rules' => '', // validation rule of laravel
                'class' => '', // any class for input
                'value' => '', // default value if you want
            ],
        ],

    ],
    'meta' => [
        'title' => 'Meta ',
        'desc'  => 'Application Meta Data',
        'icon'  => 'fas fa-globe-asia',

        'elements' => [
            [
                'type'  => 'text', // input fields type
                'data'  => 'text', // data type, string, int, boolean
                'name'  => 'meta_site_name', // unique name for field
                'label' => 'Meta Site Name', // you know what label it is
                'rules' => '', // validation rule of laravel
                'class' => '', // any class for input
                'value' => '', // default value if you want
            ],
            [
                'type'  => 'text', // input fields type
                'data'  => 'text', // data type, string, int, boolean
                'name'  => 'meta_description', // unique name for field
                'label' => 'Meta Description', // you know what label it is
                'rules' => '', // validation rule of laravel
                'class' => '', // any class for input
                'value' => '', // default value if you want
            ],
            [
                'type'  => 'text', // input fields type
                'data'  => 'text', // data type, string, int, boolean
                'name'  => 'meta_keyword', // unique name for field
                'label' => 'Meta Keyword', // you know what label it is
                'rules' => '', // validation rule of laravel
                'class' => '', // any class for input
                'value' => '', // default value if you want
            ],
            [
                'type'  => 'text', // input fields type
                'data'  => 'text', // data type, string, int, boolean
                'name'  => 'meta_image', // unique name for field
                'label' => 'Meta Image', // you know what label it is
                'rules' => '', // validation rule of laravel
                'class' => '', // any class for input
                'value' => 'img/default_banner.jpg', // default value if you want
            ],
            [
                'type'  => 'text', // input fields type
                'data'  => 'text', // data type, string, int, boolean
                'name'  => 'meta_fb_app_id', // unique name for field
                'label' => 'Meta Facebook App Id', // you know what label it is
                'rules' => '', // validation rule of laravel
                'class' => '', // any class for input
                'value' => '', // default value if you want
            ],
            [
                'type'  => 'text', // input fields type
                'data'  => 'text', // data type, string, int, boolean
                'name'  => 'meta_twitter_site', // unique name for field
                'label' => 'Meta Twitter Site Account', // you know what label it is
                'rules' => '', // validation rule of laravel
                'class' => '', // any class for input
                'value' => '', // default value if you want
            ],
            [
                'type'  => 'text', // input fields type
                'data'  => 'text', // data type, string, int, boolean
                'name'  => 'meta_twitter_creator', // unique name for field
                'label' => 'Meta Twitter Creator Account', // you know what label it is
                'rules' => '', // validation rule of laravel
                'class' => '', // any class for input
                'value' => '', // default value if you want
            ],
        ],

    ],
];
