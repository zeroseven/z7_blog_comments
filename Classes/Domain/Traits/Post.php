<?php

declare(strict_types=1);

namespace Zeroseven\Z7BlogComments\Domain\Traits;

use TYPO3\CMS\Extbase\Annotation\ORM as Extbase;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

trait Post
{

    /**
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Zeroseven\Z7BlogComments\Domain\Model\Comment>
     * @Extbase\Cascade("remove")
     * @Extbase\Lazy
     */
    protected $comments;

    /** @var int */
    protected $commentMode;

    public function getComments(): ObjectStorage
    {
        return $this->comments;
    }

    public function setComments(ObjectStorage $comments): self
    {
        $this->comments = $comments;
        return $this;
    }

    public function getCommentMode(): int
    {
        return (int)$this->commentMode;
    }

    public function setCommentMode(int $mode): self
    {
        $this->commentMode = $mode;
        return $this;
    }
}
