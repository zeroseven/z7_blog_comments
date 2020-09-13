<?php

defined('TYPO3_MODE') || die();

call_user_func(function () {

    // Allow table
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_z7blog_domain_model_comment');
});
