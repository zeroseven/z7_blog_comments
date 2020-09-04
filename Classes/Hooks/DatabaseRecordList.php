<?php declare(strict_types=1);

namespace Zeroseven\Z7BlogComments\Hooks;

use TYPO3\CMS\Core\Database\Query\QueryBuilder;

class DatabaseRecordList
{

    public function modifyQuery(array $parameters, string $table, int $pageId, array $additionalConstraints, array $fieldList, QueryBuilder $queryBuilder): void
    {

        // Hide child comments in backend list module
        if ($table === 'tx_z7blog_domain_model_comment') {
            $queryBuilder->andWhere('parent = 0');
        }
    }
}
