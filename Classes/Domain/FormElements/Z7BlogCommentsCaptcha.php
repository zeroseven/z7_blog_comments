<?php

declare(strict_types=1);

namespace Zeroseven\Z7BlogComments\Domain\FormElements;

use TYPO3\CMS\Form\Domain\Model\FormElements\AbstractFormElement;
use Zeroseven\Z7BlogComments\Service\EncryptionService;

class Z7BlogCommentsCaptcha extends AbstractFormElement
{
    public function initializeFormElement()
    {

        // Load "original" method
        parent::initializeFormElement();

        // Get encryption key
        $encryptedKey = EncryptionService::encryptKey();

        // Set data attribute
        $this->properties['fluidAdditionalAttributes'] = array_merge($this->properties['fluidAdditionalAttributes'] ?? [], ['data-encrypted-key' => $encryptedKey]);
    }
}
