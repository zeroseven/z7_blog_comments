<?php

declare(strict_types=1);

namespace Zeroseven\Z7BlogComments\Domain\Model;

use DateTime;
use TYPO3\CMS\Extbase\Annotation\ORM as Extbase;
use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use Zeroseven\Z7Blog\Domain\Model\Post;

class Comment extends AbstractEntity
{

    /**
     * @var \Zeroseven\Z7Blog\Domain\Model\Post
     * @Extbase\Lazy
     */
    protected $post;

    /** @var bool */
    protected $hidden;

    /** @var int */
    protected $sysLanguageUid;

    /** @var string */
    protected $languageCode;

    /** @var string */
    protected $name;

    /** @var string */
    protected $email;

    /** @var string */
    protected $url;

    /** @var string */
    protected $text;

    /** @var string */
    protected $permissionKey;

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

    /**
     * @var \Zeroseven\Z7BlogComments\Domain\Model\Comment
     */
    protected $parent;

    public function getPost(): Post
    {
        return $this->post;
    }

    public function setPost(Post $post): self
    {
        $this->post = $post;
        return $this;
    }

    public function isHidden(): bool
    {
        return $this->hidden;
    }

    public function setHidden(bool $state): self
    {
        $this->hidden = $state;
        return $this;
    }

    public function getSysLanguageUid(): int
    {
        return $this->sysLanguageUid;
    }

    public function setSysLanguageUid(int $id): self
    {
        $this->sysLanguageUid = $id;
        return $this;
    }

    public function getLanguageCode(): string
    {
        return $this->languageCode;
    }

    public function setLanguageCode(string $code): self
    {
        $this->languageCode = $code;
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

    public function getText(): string
    {
        return $this->text;
    }

    public function setText(string $text): self
    {
        $this->text = $text;
        return $this;
    }

    public function getPermissionKey(): string
    {
        return $this->permissionKey;
    }

    public function setPermissionKey(string $permissionKey): self
    {
        $this->permissionKey = $permissionKey;
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

    public function getChildren(): \TYPO3\CMS\Extbase\Persistence\ObjectStorage
    {
        return $this->children;
    }

    public function setChildren(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $children): void
    {
        $this->children = $children;
    }

    public function getParent(): ?self
    {
        return $this->parent;
    }

    public function setParent(self $parent): self
    {
        $this->parent = $parent;
        return $this;
    }
}
