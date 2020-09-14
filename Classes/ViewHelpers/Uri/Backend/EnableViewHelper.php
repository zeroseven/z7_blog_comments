<?php

declare(strict_types=1);

namespace Zeroseven\Z7BlogComments\ViewHelpers\Uri\Backend;

use TYPO3\CMS\Backend\Utility\BackendUtility;

class EnableViewHelper extends AbstractBackendUriViewHelper
{

    public function render(): string
    {
        return BackendUtility::getLinkToDataHandlerAction(sprintf('&data[%s][%d][%s]=1', self::TABLE, $this->arguments['comment']->getUid(), $GLOBALS['TCA'][self::TABLE]['ctrl']['enablecolumns']['disabled']));
    }

}
