<?php

$EM_CONF[$_EXTKEY] = [
    'title' => 'Blog (Comments)',
    'description' => 'Comments for extension z7_blog',
    'category' => 'plugin',
    'author' => 'Raphael Thanner',
    'author_email' => 'r.thanner@zeroseven.de',
    'author_company' => 'zeroseven design studios GmbH',
    'state' => 'beta',
    'clearCacheOnLoad' => 1,
    'version' => '0.5.0',
    'constraints' => [
        'depends' => [
            'typo3' => '9.5.0-10.4.99'
            'form' => '9.5.0-10.4.99',
            'z7_blog' => '0.6.0-0.99.99'
        ]
    ]
];
