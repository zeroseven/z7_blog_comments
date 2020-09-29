<?php

declare(strict_types=1);

namespace Zeroseven\Z7BlogComments\Service;

use TYPO3\CMS\Core\Utility\GeneralUtility;

class RequestService
{
    public const REQUEST_KEY = 'tx_z7blogcomments';

    public static function getArguments(): array
    {
        return GeneralUtility::_GP(self::REQUEST_KEY) ?: [];
    }

    public static function getArgument(string $key): ?string
    {
        $arguments = self::getArguments();

        return $arguments[$key] ?? null;
    }
}
