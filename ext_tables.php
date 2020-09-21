<?php

defined('TYPO3_MODE') || die();

call_user_func(function () {

    // Allow table
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_z7blog_domain_model_comment');

    // Add language translations to the backend
    \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Page\PageRenderer::class)->addInlineLanguageLabelFile('EXT:z7_blog_comments/Resources/Private/Language/locallang.xlf');
});
