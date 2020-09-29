<?php

return [
    'frontend' => [
        'zeroseven/z7_blog/comment-control' => [
            'target' => \Zeroseven\Z7BlogComments\Middleware\CommentControl::class,
            'before' => [
                'typo3/cms-frontend/shortcut-and-mountpoint-redirect'
            ],
            'after' => [
                'typo3/cms-frontend/prepare-tsfe-rendering'
            ]
        ],
        'zeroseven/z7_blog/notification-state' => [
            'target' => \Zeroseven\Z7BlogComments\Middleware\StateNotification::class,
            'before' => [
                'typo3/cms-frontend/content-length-headers'
            ],
            'after' => [
                'typo3/cms-frontend/prepare-tsfe-rendering'
            ]
        ]
    ]
];
