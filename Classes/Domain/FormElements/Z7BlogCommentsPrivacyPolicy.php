<?php

declare(strict_types=1);

namespace Zeroseven\Z7BlogComments\Domain\FormElements;

use TYPO3\CMS\Form\Domain\Model\FormElements\AbstractFormElement;
use Zeroseven\Z7Blog\Service\SettingsService;

class Z7BlogCommentsPrivacyPolicy extends AbstractFormElement
{
    public function initializeFormElement()
    {

        // Load "original" method
        parent::initializeFormElement();

        // Add link by settings
        if(empty($this->properties['link'])) {
            $this->properties['link'] = SettingsService::getSettings('commentsForm.privacyPolicyLink');
        }
    }
}
