<?php

declare(strict_types=1);

namespace Zeroseven\Z7BlogComments\ViewHelpers\Uri;

use TYPO3Fluid\Fluid\Core\Rendering\RenderingContextInterface;
use Zeroseven\Z7BlogComments\Service\ControlService;

class EnableViewHelper extends AbstractUriViewHelper
{
    public static function renderStatic(array $arguments, \Closure $renderChildrenClosure, RenderingContextInterface $renderingContext): string
    {
        return ControlService::createEnableUri($arguments['comment']);
    }
}
