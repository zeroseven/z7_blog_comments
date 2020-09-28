<?php

declare(strict_types=1);

return [
    'services' => [
        '_defaults' => [
            'autowire' => true,
            'autoconfigure' => true,
            'public' => false
        ],

        'Zeroseven\\Z7BlogComments\\' => [
            'resource' => '../Classes/*'
        ],

        \Zeroseven\Z7BlogComments\Hooks\StructuredData::class => [
            'tags' => [
                [
                    'name' => 'event.listener',
                    'identifier' => 'z7-blog-comments/structured-data',
                    'event' => \Zeroseven\Z7Blog\Event\StructuredDataEvent::class
                ]
            ]
        ],

        'dashboard.widget.pendingComments' => [
            'class' => \Zeroseven\Z7BlogComments\Widgets\PendingComments::class,
            'arguments' => [
                '$view' => '@dashboard.views.widget'
            ],
            'tags' => [
                [
                    'name' => 'dashboard.widget',
                    'identifier' => 'pendingComments',
                    'groupNames' => 'general',
                    'title' => 'LLL:EXT:z7_blog_comments/Resources/Private/Language/locallang_be.xlf:widget.pendingComments.title',
                    'description' => 'LLL:EXT:z7_blog_comments/Resources/Private/Language/locallang_be.xlf:widget.pendingComments.description',
                    'iconIdentifier' => 'content-widget-list',
                    'height' => 'medium',
                    'width' => 'medium'
                ]
            ]
        ]
    ]
];
