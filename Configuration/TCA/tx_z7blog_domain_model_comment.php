<?php
return [
    'ctrl' => [
        'title' => 'LLL:EXT:z7_blog/Resources/Private/Language/locallang_db.xlf:tx_z7blog_domain_model_comment',
        'label' => 'comment',
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
        'searchFields' => 'firstname, lastname, email, url, comment',
        'typeicon_classes' => [
            'default' => 'plugin-z7blog-author'
        ]
    ],
    'palettes' => [
        'overview' => [
            'label' => 'LLL:EXT:z7_blog/Resources/Private/Language/locallang_db.xlf:tx_z7blog_domain_model_comment.palette.overview',
            'showitem' => 'lang, crdate'
        ],
        'name' => [
            'label' => 'LLL:EXT:z7_blog/Resources/Private/Language/locallang_db.xlf:tx_z7blog_domain_model_comment.palette.name',
            'showitem' => 'firstname, lastname'
        ],
        'links' => [
            'label' => 'LLL:EXT:z7_blog/Resources/Private/Language/locallang_db.xlf:tx_z7blog_domain_model_comment.palette.links',
            'showitem' => 'email, url'
        ]
    ],
    'types' => [
        '1' => [
            'showitem' => 'hidden, --palette--;;overview, --palette--;;name, --palette--;;links, comment, children, parent'
        ]
    ],
    'columns' => [
        'hidden' => [
            'exclude' => true,
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.hidden',
            'config' => [
                'type' => 'check',
                'items' => [
                    '1' => [
                        '0' => 'LLL:EXT:lang/locallang_core.xlf:labels.enabled'
                    ]
                ]
            ]
        ],
        'lang' => [
            'exclude' => false,
            'label' => 'LLL:EXT:z7_blog/Resources/Private/Language/locallang_db.xlf:tx_z7blog_domain_model_comment.lang',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'minitems' => 1,
                'maxitems' => 1,
                'itemsProcFunc' => 'TYPO3\CMS\Core\Service\IsoCodeService->renderIsoCodeSelectDropdown',
                'items' => [
                    ['-', '']
                ]
            ]
        ],
        'firstname' => [
            'exclude' => false,
            'label' => 'LLL:EXT:z7_blog/Resources/Private/Language/locallang_db.xlf:tx_z7blog_domain_model_comment.firstname',
            'config' => [
                'type' => 'input',
                'eval' => 'trim',
                'default' => ''
            ]
        ],
        'lastname' => [
            'exclude' => false,
            'label' => 'LLL:EXT:z7_blog/Resources/Private/Language/locallang_db.xlf:tx_z7blog_domain_model_comment.lastname',
            'config' => [
                'type' => 'input',
                'eval' => 'trim',
                'default' => ''
            ]
        ],
        'email' => [
            'exclude' => false,
            'label' => 'LLL:EXT:z7_blog/Resources/Private/Language/locallang_db.xlf:tx_z7blog_domain_model_comment.email',
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
            'label' => 'LLL:EXT:z7_blog/Resources/Private/Language/locallang_db.xlf:tx_z7blog_domain_model_comment.url',
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
        'comment' => [
            'exclude' => true,
            'label' => 'LLL:EXT:z7_blog/Resources/Private/Language/locallang_db.xlf:tx_z7blog_domain_model_comment.comment',
            'config' => [
                'type' => 'text',
                'cols' => 40,
                'rows' => 15,
                'eval' => 'trim',
                'default' => ''
            ]
        ],
        'children' => [
            'label' => 'LLL:EXT:z7_blog/Resources/Private/Language/locallang_db.xlf:tx_z7blog_domain_model_comment.children',
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
                    'newRecordLinkTitle' => 'LLL:EXT:z7_blog/Resources/Private/Language/locallang_db.xlf:tx_z7blog_domain_model_comment.children.add',
                ]
            ]
        ],
        'parent' => [
            'config' => [
                'type' => 'passthrough'
            ]
        ],
        'crdate' => [
            'label' => 'LLL:EXT:z7_blog/Resources/Private/Language/locallang_db.xlf:tx_z7blog_domain_model_comment.children',
            'config' => [
                'readOnly' => true,
                'type' => 'input',
                'renderType' => 'inputDateTime',
                'size' => 10,
                'eval' => 'date'
            ]
        ]
    ]
];



