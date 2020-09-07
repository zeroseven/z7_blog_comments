<?php

namespace Zeroseven\Z7BlogComments\Domain\Repository;

use TYPO3\CMS\Extbase\Persistence\Generic\Typo3QuerySettings;
use Zeroseven\Z7Blog\Domain\Demand\AbstractDemand;
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

    protected function initializeDemand(): AbstractDemand
    {
        return CommentDemand::makeInstance();
    }

    public function findByPermissionKey(string $key, bool $respectRestrictions = null)
    {

        // Respect restrictions on query
        if($respectRestrictions) {
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
        return ($posts = $query->execute()) ? $posts->getFirst() : null;
    }

}
