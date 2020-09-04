<?php

defined('TYPO3_MODE') || die('Access denied.');

call_user_func(static function () {
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile(
        'z7_blog_comments',
        'Configuration/TypoScript',
        'Blog comments'
    );
});
