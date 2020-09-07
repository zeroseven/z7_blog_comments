<?php declare(strict_types=1);

namespace Zeroseven\Z7BlogComments\Service;

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Mvc\Web\Routing\UriBuilder;
use TYPO3\CMS\Extbase\Object\ObjectManager;
use Zeroseven\Z7BlogComments\Domain\Model\Comment;

class ControlService
{

    public const PARAMETER = 'z7blogcomments';

    public static function createRandomString(int $length = null, string $string = null): string
    {

        // Start with an random string
        $string .= sha1(uniqid($GLOBALS['TYPO3_CONF_VARS']['SYS']['encryptionKey'] ?? '¯\_(ツ)_/¯', true));

        // Define length, if empty
        if ($length === null) {
            $length = 128;
        }

        // Call recursive, till string length is reached
        if (strlen($string) < $length) {
            return self::createRandomString($length, $string);
        }

        // Crop string to desired length
        return substr($string, 0, $length);
    }

    protected static function createUri(string $action, Comment $comment, int $pageUid = null): string
    {
        return GeneralUtility::makeInstance(ObjectManager::class)->get(UriBuilder::class)
            ->setCreateAbsoluteUri(true)
            ->setTargetPageUid($pageUid ?: $GLOBALS['TSFE']->id)
            ->setSection('comment-' . $comment->getUid())
            ->setArguments([self::PARAMETER => [
                'permission_key' => $comment->getPermissionKey(),
                'action' => $action
            ]])->build();
    }

    public static function createEnableUri(Comment $comment, int $pageUid = null): string
    {
        return self::createUri('enable', $comment, $pageUid);
    }

    public static function createDeleteUri(Comment $comment, int $pageUid = null): string
    {
        return self::createUri('delete', $comment, $pageUid);
    }

    public static function createRejectUri(Comment $comment, int $pageUid = null): string
    {
        return self::createUri('reject', $comment, $pageUid);
    }

}
