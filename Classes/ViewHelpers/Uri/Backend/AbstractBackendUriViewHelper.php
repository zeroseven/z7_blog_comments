<?php

declare(strict_types=1);

namespace Zeroseven\Z7BlogComments\ViewHelpers\Uri\Backend;

use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;

class AbstractBackendUriViewHelper extends AbstractViewHelper
{

    protected const TABLE = 'tx_z7blog_domain_model_comment';

    public function initializeArguments()
    {
        $this->registerArgument('comment', 'object', 'The comment object', true);
    }

}
