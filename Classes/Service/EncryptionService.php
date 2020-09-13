<?php

declare(strict_types=1);

namespace Zeroseven\Z7BlogComments\Service;

use TYPO3\CMS\Frontend\Controller\TypoScriptFrontendController;

class EncryptionService
{

    /**
     * Generate an key depending on current page.
     * The key will be changed daily.
     *
     * @return string
     */
    protected static function generateKey(): string
    {
        if ($GLOBALS['TSFE'] instanceof TypoScriptFrontendController) {
            return md5(json_encode((array)$GLOBALS['TSFE']->page) . date('Y-m-d'));
        }

        return md5(__FILE__ . date('Y-m-d'));
    }

    /**
     * Returns an base64 encoded and reversed string.
     *
     * Same function in JavaScript:
     * const encryptKey = string => btoa(string.split('').reverse().join(''));
     *
     * @return string
     */
    public static function encryptKey(): string
    {
        return base64_encode(strrev(self::generateKey()));
    }

    /**
     * Decrypt the encrypted key
     *
     * Same function in JavaScript:
     * const decryptKey = string => atob(string).split('').reverse().join('');
     *
     * @param string
     * @return string
     */
    public static function decryptKey(string $string): string
    {
        return base64_decode(strrev($string));
    }

    /**
     * Checks if the given string is equal to the generated Key
     *
     * @param string $string
     * @return bool
     */
    public static function isValidKey(string $string): bool
    {
        return $string === self::generateKey();
    }
}
