<?php

namespace Zeroseven\Z7BlogComments\Domain\Finishers;

use TYPO3\CMS\Form\Domain\Finishers\AbstractFinisher;
use Zeroseven\Z7Blog\Service\RepositoryService;
use Zeroseven\Z7Blog\Service\SettingsService;

/**
 * This finisher for form framework will add some variables.
 * It's important to load this finisher first!
 */
class Z7BlogCommentsVariableProvider extends AbstractFinisher
{

    /** @var array */
    protected $defaultOptions = [
        'post' => null,
        'settings' => [],
    ];

    public function __construct(string $finisherIdentifier = '')
    {
        // Remove the string "VariableProvider" to make it accessible by "{finisherVariableProvider.Z7BlogComments}"
        parent::__construct(str_replace('VariableProvider', '', $finisherIdentifier));
    }

    protected function executeInternal()
    {

        // Load extension settings
        $this->finisherContext->getFinisherVariableProvider()->add(
            $this->shortFinisherIdentifier,
            'settings',
            SettingsService::getSettings() ?: null
        );

        // Load post
        $this->finisherContext->getFinisherVariableProvider()->add(
            $this->shortFinisherIdentifier,
            'post',
            RepositoryService::getPostRepository()->findByUid($this->getTypoScriptFrontendController()->id) ?: null
        );
    }
}
