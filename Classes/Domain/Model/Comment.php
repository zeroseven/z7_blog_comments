<?php declare(strict_types=1);

namespace Blog\Blogpages\Domain\Model;

use DateTime;
use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;

class Comment extends AbstractEntity
{

    public const STATUS_PENDING = 0;
    public const STATUS_APPROVED = 1;
    public const STATUS_DECLINED = 2;
    public const STATUS_DELETED = 3;

    /** @var string */
    protected $firstName;

    /** @var string */
    protected $lastName;

    /** @var string */
    protected $email;

    /** @var string */
    protected $url;

    /** @var string */
    protected $comment;

    /** @var int */
    protected $status;

    /** @var \DateTime */
    protected $createDate;

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;
        return $this;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;
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

    public function getStatus(): int
    {
        return $this->status;
    }

    public function setStatus(int $status): self
    {
        $this->status = $status;
        return $this;
    }

    public function getCreateDate(): DateTime
    {
        return $this->createDate;
    }

    public function setCreateDate(DateTime $createDate): self
    {
        $this->createDate = $createDate;
        return $this;
    }

}
