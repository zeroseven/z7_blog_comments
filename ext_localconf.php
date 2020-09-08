<?php

call_user_func(static function () {

    // Load post trait collector instead of the "default" model
    $extbaseObjectContainer = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Extbase\Object\Container\Container::class);
    $extbaseObjectContainer->registerImplementation(\Zeroseven\Z7Blog\Domain\Model\Post::class, \Zeroseven\Z7Blog\Domain\Model\TraitCollector\PostTraitCollector::class);
});

// Register trait to extend posts
$GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['z7_blog']['traits'][\Zeroseven\Z7Blog\Domain\Model\Post::class][] = \Zeroseven\Z7BlogComments\Domain\Traits\Post::class;

// Register hooks
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS'][\TYPO3\CMS\Recordlist\RecordList\DatabaseRecordList::class]['modifyQuery'][] = \Zeroseven\Z7BlogComments\Hooks\DatabaseRecordList::class;
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['t3lib/class.t3lib_tcemain.php']['processDatamapClass'][] = \Zeroseven\Z7BlogComments\Hooks\DataHandler::class;

