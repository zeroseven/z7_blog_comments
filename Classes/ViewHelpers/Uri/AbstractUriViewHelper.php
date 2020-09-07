<?php declare(strict_types=1);

namespace Zeroseven\Z7BlogComments\ViewHelpers\Uri;

use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;

class AbstractUriViewHelper extends AbstractViewHelper
{

    public function initializeArguments(): void
    {
        $this->registerArgument('comment', 'object', 'The comment you want to edit');
    }
}
