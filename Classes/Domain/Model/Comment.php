<?php declare(strict_types=1);

namespace Zeroseven\Z7BlogComments\Domain\Model;

use DateTime;
use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use TYPO3\CMS\Extbase\Annotation\ORM as Extbase;

class Comment extends AbstractEntity
{

    /** @var string */
    protected $lang;

    /** @var string */
    protected $name;

    /** @var string */
    protected $email;

    /** @var string */
    protected $url;

    /** @var string */
    protected $comment;

    /** @var bool */
    protected $pending;

    /** @var \DateTime */
    protected $createDate;

    /** @var string */
    protected $remoteAddress;

    /** @var string */
    protected $userAgent;

    /**
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Zeroseven\Z7BlogComments\Domain\Model\Comment>
     * @Extbase\Cascade("remove")
     */
    protected $children;

    public function getLang(): string
    {
        return $this->lang;
    }

    public function setLang(string $lang): self
    {
        $this->lang = $lang;
        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;
        return $this;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function setUrl(string $url): self
    {
        $this->url = $url;
        return $this;
    }

    public function getComment(): string
    {
        return $this->comment;
    }

    public function setComment(string $comment): self
    {
        $this->comment = $comment;
        return $this;
    }

    public function isPending(): bool
    {
        return $this->pending;
    }

    public function setPending(bool $state): self
    {
        $this->pending = $state;
        return $this;
    }

    public function getCreateDate(): DateTime
    {
        return $this->createDate;
    }

    public function setCreateDate(DateTime $date = null): self
    {
        $this->createDate = $date ?: time();
        return $this;
    }

    public function getChildren(): \TYPO3\CMS\Extbase\Persistence\ObjectStorage
    {
        return $this->children;
    }

    public function setChildren(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $children): void
    {
        $this->children = $children;
    }

    public function getRemoteAddress(): string
    {
        return $this->remoteAddress;
    }

    public function setRemoteAddress(string $remoteAddress): self
    {
        $this->remoteAddress = $remoteAddress;
        return $this;
    }

    public function getUserAgent(): string
    {
        return $this->userAgent;
    }

    public function setUserAgent(string $userAgent): self
    {
        $this->userAgent = $userAgent;
        return $this;
    }
}
