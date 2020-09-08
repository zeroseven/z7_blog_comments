<?php declare(strict_types=1);

namespace Zeroseven\Z7BlogComments\Service;

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Mvc\Web\Routing\UriBuilder;
use TYPO3\CMS\Extbase\Object\ObjectManager;
use TYPO3\CMS\Extbase\Persistence\Generic\PersistenceManager;
use TYPO3\CMS\Extbase\Service\CacheService;
use Zeroseven\Z7BlogComments\Domain\Model\Comment;
use Zeroseven\Z7BlogComments\Domain\Repository\CommentRepository;

class ControlService
{

    public const PARAMETER = 'tx_z7blogcomments';

    public const STATE_ENABLED = 1;

    public const STATE_REJECTED = 2;

    public const STATE_DELETED = 3;

    public const STATE_EXPIRED = 4;

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
            ->setNoCache(true)
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

    protected static function initializeObjectManager(): ObjectManager
    {
        return GeneralUtility::makeInstance(ObjectManager::class);
    }

    protected static function initializeClass($classname): ?object
    {
        return self::initializeObjectManager()->get($classname);
    }

    protected static function performUpdate(Comment $comment, bool $hide, bool $delete = null): void
    {
        $repository = self::initializeClass(CommentRepository::class);

        $repository->update($comment->setPending(false)->setHidden($hide));

        if($delete) {
            $repository->remove($comment);
        }

        self::initializeClass(PersistenceManager::class)->persistAll();
    }

    public static function control(): int
    {

        if (
            ($parameter = GeneralUtility::_GET(self::PARAMETER))
            && ($action = $parameter['action'])
            && ($permissionKey = $parameter['permission_key'])
            && ($comment = self::initializeClass(CommentRepository::class)->findByPermissionKey($permissionKey))
        ) {

            if (!$comment->isPending()) {
                return self::STATE_EXPIRED;
            }

            if ($action === 'enable') {
                self::performUpdate($comment, false);

                // Clear cache on current page
                self::initializeClass(CacheService::class)->ClearPageCache($comment->getPid());

                return self::STATE_ENABLED;
            }

            if ($action === 'reject') {
                self::performUpdate($comment, true);
                return self::STATE_REJECTED;
            }

            if ($action === 'delete') {
                self::performUpdate($comment, true, true);
                return self::STATE_DELETED;
            }
        }

        return 0;
    }

}
