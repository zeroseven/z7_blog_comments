<?php

declare(strict_types=1);

namespace Zeroseven\Z7BlogComments\ViewHelpers\Language;

use TYPO3\CMS\Core\Imaging\Icon;
use TYPO3\CMS\Core\Imaging\IconFactory;
use TYPO3\CMS\Core\Imaging\IconRegistry;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;

class FlagViewHelper extends AbstractViewHelper
{
    protected $escapeOutput = false;

    protected $escapeChildren = false;

    public function initializeArguments(): void
    {
        $this->registerArgument('languageCode', 'string', 'Language code', true);
    }

    protected function getIconName(): string
    {
        $code = strtolower(substr($this->arguments['languageCode'], 0, 2));

        // Ok, this is a bit hacky … sorry!
        // Merge "en" languages …
        if ($code === 'en') {
            $code = 'en-us-gb';
        }

        return 'flags-' . $code;
    }

    public function render(): string
    {

        // Get the icon name
        $iconName = $this->getIconName();

        // Try to find a suitable icon
        if ($iconName && GeneralUtility::makeInstance(IconRegistry::class)->isRegistered($iconName)) {
            return GeneralUtility::makeInstance(IconFactory::class)->getIcon($iconName, Icon::SIZE_SMALL)->render();
        }

        // Return the language code in super nice brackets
        return '[' . strtoupper($this->arguments['languageCode']) . ']';
    }
}
