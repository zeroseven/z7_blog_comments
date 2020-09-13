<?php

declare(strict_types=1);

return [
    \Zeroseven\Z7Blog\Domain\Model\Post::class => [
        'properties' => [
            'comments' => [
                'fieldName' => 'post_comments'
            ],
            'commentMode' => [
                'fieldName' => 'post_comment_mode'
            ]
        ]
    ],
    \Zeroseven\Z7BlogComments\Domain\Model\Comment::class => [
        'tableName' => 'tx_z7blog_domain_model_comment',
        'properties' => [
            'post' => [
                'fieldName' => 'pid'
            ],
            'createDate' => [
                'fieldName' => 'crdate'
            ]
        ]
    ]
];
