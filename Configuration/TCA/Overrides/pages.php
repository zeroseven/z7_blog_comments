<?php

defined('TYPO3_MODE') || die();

// Manipulate TCA
call_user_func(static function (string $table, int $dokType) {

    // Define new fields
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns($table, [
        'post_comment_mode' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:z7_blog_comments/Resources/Private/Language/locallang_db.xlf:pages.post_comment_mode',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'minitems' => 1,
                'maxitems' => 1,
                'default' => 0,
                'items' => [
                    ['LLL:EXT:z7_blog_comments/Resources/Private/Language/locallang_db.xlf:pages.post_comment_mode.2', 2],
                    ['LLL:EXT:z7_blog_comments/Resources/Private/Language/locallang_db.xlf:pages.post_comment_mode.div.enable', '--div--'],
                    ['LLL:EXT:z7_blog_comments/Resources/Private/Language/locallang_db.xlf:pages.post_comment_mode.0', 0],
                    ['LLL:EXT:z7_blog_comments/Resources/Private/Language/locallang_db.xlf:pages.post_comment_mode.1', 1]
                ]
            ]
        ],
        'post_comments' => [
            'displayCond' => 'FIELD:l10n_parent:=:0',
            'label' => 'LLL:EXT:z7_blog_comments/Resources/Private/Language/locallang_db.xlf:pages.post_comments',
            'config' => [
                'type' => 'inline',
                'foreign_table' => 'tx_z7blog_domain_model_comment',
                'foreign_field' => 'pid',
                'foreign_match_fields' => [
                  'parent' => '0'
                ],
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
                    'newRecordLinkTitle' => 'LLL:EXT:z7_blog_comments/Resources/Private/Language/locallang_db.xlf:pages.post_comments.add',
                ]
            ]
        ]
    ]);

    // Add new fields to TCA of blog posts
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes($table,'--div--;LLL:EXT:z7_blog_comments/Resources/Private/Language/locallang_db.xlf:pages.tab.comments, post_comment_mode, post_comments', (string)$dokType);

},'pages', \Zeroseven\Z7Blog\Domain\Model\Post::DOKTYPE);
