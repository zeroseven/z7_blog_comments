<?php declare(strict_types=1);

return [
    \Zeroseven\Z7Blog\Domain\Model\Post::class => [
        'properties' => [
            'comments' => [
                'fieldName' => 'post_comments'
            ],
            'commentsEnabled' => [
                'fieldName' => 'post_comments_enabled'
            ]
        ]
    ],
    \Zeroseven\Z7BlogComments\Domain\Model\Comment::class => [
        'tableName' => 'tx_z7blog_domain_model_comment',
        'properties' => [
            'createDate' => [
                'fieldName' => 'crdate'
            ]
        ]
    ]
];
