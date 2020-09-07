<?php

namespace Zeroseven\Z7BlogComments\Domain\Finishers;

use DateTime;
use TYPO3\CMS\Core\Context\Context;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Persistence\Generic\PersistenceManager;
use TYPO3\CMS\Form\Domain\Finishers\AbstractFinisher;
use Zeroseven\Z7Blog\Service\RepositoryService;
use Zeroseven\Z7BlogComments\Domain\Model\Comment;
use Zeroseven\Z7BlogComments\Domain\Repository\CommentRepository;
use Zeroseven\Z7BlogComments\Service\ControlService;

class Z7BlogCommentsDatabaseFinisher extends AbstractFinisher
{

    protected function executeInternal()
    {

        // Build new comment
        $comment = GeneralUtility::makeInstance(Comment::class)
            ->setPost(RepositoryService::getPostRepository()->findByUid($this->getTypoScriptFrontendController()->id))
            ->setCreateDate(new DateTime('now'))
            ->setHidden(true)
            ->setPending(true)
            ->setSysLanguageUid(GeneralUtility::makeInstance(Context::class)->getPropertyFromAspect('language', 'id', 0))
            ->setRemoteAddress($_SERVER['REMOTE_ADDR'])
            ->setUserAgent($_SERVER['HTTP_USER_AGENT'])
            ->setPermissionKey(ControlService::createRandomString());

        // Loop form and apply properties
        foreach ($this->finisherContext->getFormValues() ?? [] as $key => $value) {
            if($comment->_hasProperty($key)) {
                $comment->_setProperty($key, $value);
            }
        }

        // Write to database
        $this->objectManager->get(CommentRepository::class)->add($comment);
        $this->objectManager->get(PersistenceManager::class)->persistAll();

        // Add comment to variable provider
        $this->finisherContext->getFinisherVariableProvider()->add('Z7BlogComments','comment', $comment);
    }
}
