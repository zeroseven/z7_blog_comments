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

}
