<?php

namespace Zeroseven\Z7BlogComments\Domain\Finishers;

use DateTime;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Persistence\Generic\PersistenceManager;
use TYPO3\CMS\Form\Domain\Finishers\AbstractFinisher;
use Zeroseven\Z7BlogComments\Domain\Model\Comment;
use Zeroseven\Z7BlogComments\Domain\Repository\CommentRepository;

class Z7BlogCommentsDatabaseFinisher extends AbstractFinisher
{
    protected function executeInternal()
    {

        // Build new comment
        $comment = GeneralUtility::makeInstance(Comment::class)
            ->setCreateDate(new DateTime('now'))
            ->setPending(true)
            ->setRemoteAddress($_SERVER['REMOTE_ADDR'])
            ->setUserAgent($_SERVER['HTTP_USER_AGENT']);

        // Set storage pid
        $comment->setPid($GLOBALS['TSFE']->id);

        // Loop form and apply properties
        foreach ($this->finisherContext->getFormValues() ?? [] as $key => $value) {
            if($comment->_hasProperty($key)) {
                $comment->_setProperty($key, $value);
            }
        }

        // Write to database
        $this->objectManager->get(CommentRepository::class)->add($comment);
        $this->objectManager->get(PersistenceManager::class)->persistAll();
    }
}
