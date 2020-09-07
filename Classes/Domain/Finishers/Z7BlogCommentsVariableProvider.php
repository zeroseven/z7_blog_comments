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

    public const IDENTIFIER = 'Z7BlogComments';

    /** @var array */
    protected $defaultOptions = [
        'post' => null,
        'settings' => [],
    ];

    public function __construct(string $finisherIdentifier = '')
    {
        // Remove the string "VariableProvider" to make it accessible by "{finisherVariableProvider.Z7BlogComments}"
        parent::__construct(self::IDENTIFIER);
    }

    public function addVariable(string $key, $value): void
    {
        $this->finisherContext->getFinisherVariableProvider()->add($this->shortFinisherIdentifier, $key, $value ?: null);
    }

    protected function executeInternal()
    {

        // Load extension settings
        $this->addVariable('settings', SettingsService::getSettings());

        // Load post
        $this->addVariable('post', RepositoryService::getPostRepository()->findByUid($this->getTypoScriptFrontendController()->id));
    }
}
