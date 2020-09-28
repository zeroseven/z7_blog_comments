<?php

return [
    'frontend' => [
        'zeroseven/z7_blog/comment_control' => [
            'target' => \Zeroseven\Z7BlogComments\Middleware\CommentControl::class,
            'before' => [
                'zeroseven/z7_blog/redirecthandler'
            ],
            'after' => [
                'typo3/cms-frontend/authentication'
            ]
        ]
    ]
];
