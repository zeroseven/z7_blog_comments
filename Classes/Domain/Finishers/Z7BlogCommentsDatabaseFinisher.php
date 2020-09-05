<?php

namespace Zeroseven\Z7BlogComments\Domain\Finishers;

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Object\ObjectManager;
use TYPO3\CMS\Extbase\Persistence\Generic\Mapper\DataMapper;
use TYPO3\CMS\Extbase\Persistence\Generic\PersistenceManager;
use TYPO3\CMS\Form\Domain\Finishers\AbstractFinisher;
use Zeroseven\Z7BlogComments\Domain\Model\Comment;
use Zeroseven\Z7BlogComments\Domain\Repository\CommentRepository;

class Z7BlogCommentsDatabaseFinisher extends AbstractFinisher
{
    protected function executeInternal()
    {

        // Collect properties
        $properties = array_merge([
            'crdate' => time(),
            'state' => 0,
            'pid' => $GLOBALS['TSFE']->id,
            'remote_address' => $_SERVER['REMOTE_ADDR'],
            'user_agent' => $_SERVER['HTTP_USER_AGENT']
        ], $this->finisherContext->getFormValues());

        // Build extbase comment object
        $dataMapper = $this->objectManager->get(DataMapper::class);
        $comment = empty($results = $dataMapper->map(Comment::class, [$properties])) ? null : $results[0];

        // Write to database
        $this->objectManager->get(CommentRepository::class)->add($comment);
        $this->objectManager->get(PersistenceManager::class)->persistAll();
    }
}
