<?php

declare(strict_types=1);

namespace Zeroseven\Z7BlogComments\Hooks;

class DataHandler
{
    public function processDatamap_preProcessFieldArray(array &$incomingFieldArray, string $table, $id, \TYPO3\CMS\Core\DataHandling\DataHandler $parentObject): void
    {

        // Remove "pending" when the record is changed via backend
        if ($table === 'tx_z7blog_domain_model_comment') {
            $incomingFieldArray['pending'] = 0;
        }
    }
}
