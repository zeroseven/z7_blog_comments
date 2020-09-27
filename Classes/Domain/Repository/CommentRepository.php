<?php

namespace Zeroseven\Z7BlogComments\Domain\Repository;

use TYPO3\CMS\Extbase\Persistence\Generic\Typo3QuerySettings;
use TYPO3\CMS\Extbase\Persistence\QueryInterface;
use TYPO3\CMS\Extbase\Persistence\QueryResultInterface;
use Zeroseven\Z7Blog\Domain\Demand\AbstractDemand;
use Zeroseven\Z7Blog\Domain\Model\Post;
use Zeroseven\Z7Blog\Domain\Repository\AbstractRepository;
use Zeroseven\Z7BlogComments\Domain\Demand\CommentDemand;

class CommentRepository extends AbstractRepository
{
    public function initializeObject()
    {
        $querySettings = $this->objectManager->get(Typo3QuerySettings::class);
        $querySettings->setRespectStoragePage(false);
        $this->setDefaultQuerySettings($querySettings);
    }

    public function createQuery(): QueryInterface
    {

        // Get "original" query object
        $query = parent::createQuery();

        // Add default constraints
        $query->matching(
            $query->logicalOr(
                $query->equals('parent', 0),
                $query->logicalAnd(
                    $query->equals('parent.deleted', 0),
                    $query->equals('parent.hidden', 0)
                )
            )
        );

        return $query;
    }

    protected function initializeDemand(): AbstractDemand
    {
        return CommentDemand::makeInstance();
    }

    public function findPending(bool $respectRestrictions = null): ?QueryResultInterface
    {

        // Respect restrictions on query
        if ($respectRestrictions) {
            return parent::findByPending();
        }

        // Create query
        $query = $this->createQuery();

        // Set constraint
        $query->matching(
            $query->logicalAnd(
                $query->getConstraint(),
                $query->equals('pending', 1)
            )
        );

        // Allow hidden pages
        $query->getQuerySettings()->setIgnoreEnableFields(true);

        // Return result
        return $query->execute();
    }

    public function findByPermissionKey(string $key, bool $respectRestrictions = null)
    {

        // Respect restrictions on query
        if ($respectRestrictions) {
            return parent::findOneByPermissionKey($key);
        }

        // Create query
        $query = $this->createQuery();

        // Configure database query
        $query->setLimit(1);
        $query->matching(
            $query->equals('permission_key', $key)
        );

        // Allow hidden pages
        $query->getQuerySettings()->setIgnoreEnableFields(true)->setIncludeDeleted(true);

        // Get posts and store and return the first one …
        return ($comments = $query->execute()) ? $comments->getFirst() : null;
    }
}
