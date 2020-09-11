<?php
return [
    'ctrl' => [
        'title' => 'LLL:EXT:z7_blog_comments/Resources/Private/Language/locallang_db.xlf:tx_z7blog_domain_model_comment',
        'label' => 'text',
        'label_alt' => 'crdate',
        'label_alt_force' => true,
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'default_sortby' => 'crdate',
        'delete' => 'deleted',
        'enablecolumns' => [
            'disabled' => 'hidden'
        ],
        'searchFields' => 'name, email, url, comment',
        'typeicon_classes' => [
            'default' => 'actions-chat'
        ]
    ],
    'palettes' => [
        'content' => [
            'label' => 'LLL:EXT:z7_blog_comments/Resources/Private/Language/locallang_db.xlf:tx_z7blog_domain_model_comment.palette.content',
            'showitem' => 'text, language_code'
        ],
        'author' => [
            'label' => 'LLL:EXT:z7_blog_comments/Resources/Private/Language/locallang_db.xlf:tx_z7blog_domain_model_comment.palette.author',
            'showitem' => 'name, email, url'
        ],
        'log' => [
            'label' => 'LLL:EXT:z7_blog_comments/Resources/Private/Language/locallang_db.xlf:tx_z7blog_domain_model_comment.palette.log',
            'showitem' => 'crdate, remote_address, user_agent'
        ]
    ],
    'types' => [
        '1' => [
            'showitem' => 'hidden, --palette--;;general, --palette--;;author, --palette--;;content, children, parent, --palette--;;log'
        ]
    ],
    'columns' => [
        'hidden' => [
            'exclude' => true,
            'label' => 'LLL:EXT:z7_blog_comments/Resources/Private/Language/locallang_db.xlf:tx_z7blog_domain_model_comment.hidden',
            'config' => [
                'type' => 'check',
                'renderType' => 'checkboxLabeledToggle',
                'items' => [[
                    0 => '',
                    1 => '',
                    'labelChecked' => 'LLL:EXT:z7_blog_comments/Resources/Private/Language/locallang_db.xlf:tx_z7blog_domain_model_comment.hidden.0',
                    'labelUnchecked' => 'LLL:EXT:z7_blog_comments/Resources/Private/Language/locallang_db.xlf:tx_z7blog_domain_model_comment.hidden.1',
                    'invertStateDisplay' => true
                ]]
            ]
        ],
        'language_code' => [
            'exclude' => false,
            'label' => 'LLL:EXT:z7_blog_comments/Resources/Private/Language/locallang_db.xlf:tx_z7blog_domain_model_comment.language_code',
            'description' => 'LLL:EXT:z7_blog_comments/Resources/Private/Language/locallang_db.xlf:tx_z7blog_domain_model_comment.language_code.description',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'minitems' => 1,
                'maxitems' => 1,
                'itemsProcFunc' => 'Zeroseven\Z7BlogComments\TCA\LanguageCode->renderIsoCodeSelectDropdown',
                'items' => [
                    ['LLL:EXT:z7_blog_comments/Resources/Private/Language/locallang_db.xlf:tx_z7blog_domain_model_comment.language_code.div.none', '--div--'],
                    ['-', ''],
                    ['LLL:EXT:z7_blog_comments/Resources/Private/Language/locallang_db.xlf:tx_z7blog_domain_model_comment.language_code.div.select', '--div--']
                ]
            ]
        ],
        'crdate' => [
            'label' => 'LLL:EXT:z7_blog_comments/Resources/Private/Language/locallang_db.xlf:tx_z7blog_domain_model_comment.crdate',
            'config' => [
                'readOnly' => true,
                'type' => 'input',
                'renderType' => 'inputDateTime',
                'size' => 10,
                'eval' => 'date'
            ]
        ],
        'name' => [
            'exclude' => false,
            'label' => 'LLL:EXT:z7_blog_comments/Resources/Private/Language/locallang_db.xlf:tx_z7blog_domain_model_comment.name',
            'config' => [
                'type' => 'input',
                'eval' => 'trim',
                'default' => ''
            ]
        ],
        'email' => [
            'exclude' => false,
            'label' => 'LLL:EXT:z7_blog_comments/Resources/Private/Language/locallang_db.xlf:tx_z7blog_domain_model_comment.email',
            'config' => [
                'type' => 'input',
                'renderType' => 'inputLink',
                'fieldControl' => [
                    'linkPopup' => [
                        'options' => [
                            'blindLinkOptions' => 'file, spec, folder, telephone, page, url'
                        ]
                    ]
                ],
                'eval' => 'trim',
                'default' => ''
            ]
        ],
        'url' => [
            'exclude' => false,
            'label' => 'LLL:EXT:z7_blog_comments/Resources/Private/Language/locallang_db.xlf:tx_z7blog_domain_model_comment.url',
            'config' => [
                'type' => 'input',
                'renderType' => 'inputLink',
                'fieldControl' => [
                    'linkPopup' => [
                        'options' => [
                            'blindLinkOptions' => 'file, spec, folder, telephone, page, mail'
                        ]
                    ]
                ],
                'eval' => 'trim',
                'default' => ''
            ]
        ],
        'text' => [
            'exclude' => true,
            'label' => 'LLL:EXT:z7_blog_comments/Resources/Private/Language/locallang_db.xlf:tx_z7blog_domain_model_comment.text',
            'config' => [
                'type' => 'text',
                'cols' => 40,
                'rows' => 15,
                'eval' => 'trim, required',
                'default' => ''
            ]
        ],
        'children' => [
            'label' => 'LLL:EXT:z7_blog_comments/Resources/Private/Language/locallang_db.xlf:tx_z7blog_domain_model_comment.children',
            'config' => [
                'type' => 'inline',
                'foreign_table' => 'tx_z7blog_domain_model_comment',
                'foreign_field' => 'parent',
                'minitems' => 0,
                'maxitems' => 100,
                'appearance' => [
                    'collapseAll' => true,
                    'expandSingle' => true,
                    'levelLinksPosition' => 'bottom',
                    'showSynchronizationLink' => false,
                    'showPossibleLocalizationRecords' => false,
                    'useSortable' => false,
                    'showAllLocalizationLink' => false,
                    'newRecordLinkTitle' => 'LLL:EXT:z7_blog_comments/Resources/Private/Language/locallang_db.xlf:tx_z7blog_domain_model_comment.children.add',
                ]
            ]
        ],
        'remote_address' => [
            'label' => 'LLL:EXT:z7_blog_comments/Resources/Private/Language/locallang_db.xlf:tx_z7blog_domain_model_comment.remote_address',
            'exclude' => true,
            'config' => [
                'readOnly' => true,
                'type' => 'input',
                'size' => 10,
            ]
        ],
        'user_agent' => [
            'label' => 'LLL:EXT:z7_blog_comments/Resources/Private/Language/locallang_db.xlf:tx_z7blog_domain_model_comment.user_agent',
            'exclude' => true,
            'config' => [
                'readOnly' => true,
                'type' => 'input',
                'size' => 10,
            ]
        ],
        'pid' => [
            'config' => [
                'type' => 'passthrough'
            ]
        ],
        'parent' => [
            'config' => [
                'type' => 'passthrough'
            ]
        ],
        'pending' => [
            'config' => [
                'type' => 'passthrough'
            ]
        ],
        'permission_key' => [
            'config' => [
                'type' => 'passthrough'
            ]
        ]
    ]
];



