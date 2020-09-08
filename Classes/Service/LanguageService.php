<?php declare(strict_types=1);

namespace Zeroseven\Z7BlogComments\Service;


use LanguageDetection\Language;
use TYPO3\CMS\Core\Context\Context;
use TYPO3\CMS\Core\Utility\GeneralUtility;

class LanguageService
{
    public static function getLanguageUid(): int
    {
        return (int)GeneralUtility::makeInstance(Context::class)->getPropertyFromAspect('language', 'id', 0);
    }

    public static function detectLanguageCode(string $text): string
    {

        // The language detection always delivers a result.
        // So we're checking here that the input is long enough to determine the language code.
        if(str_word_count($text) > 4 || strlen($text) > 16) {
            return (string)GeneralUtility::makeInstance(Language::class)->detect($text)->limit(0, 1);
        }

        return '';
    }
}
