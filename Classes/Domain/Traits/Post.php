<?php declare(strict_types=1);

namespace Zeroseven\Z7BlogComments\Domain\Traits;

use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

trait Post
{

    /** @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Zeroseven\Z7BlogComments\Domain\Model\Comment> */
    protected $comments;

    /** @var bool */
    protected $commentsEnabled;

    public function getComments(): ObjectStorage
    {
        return $this->comments;
    }

    public function setComments(ObjectStorage $comments): self
    {
        $this->comments = $comments;
        return $this;
    }

    public function isCommentsEnabled(): bool
    {
        return $this->commentsEnabled;
    }

    public function setCommentsEnabled(bool $commentsEnabled): self
    {
        $this->commentsEnabled = $commentsEnabled;
        return $this;
    }

}
