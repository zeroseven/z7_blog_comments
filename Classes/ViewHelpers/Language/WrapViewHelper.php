<?php declare(strict_types=1);

namespace Zeroseven\Z7BlogComments\ViewHelpers\Language;

use TYPO3Fluid\Fluid\Core\Rendering\RenderingContextInterface;
use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;
use Zeroseven\Z7BlogComments\Service\LanguageService;

class WrapViewHelper extends AbstractViewHelper
{

    protected $escapeOutput = false;

    protected $escapeChildren = false;

    public function initializeArguments(): void
    {
        $this->registerArgument('languageCode', 'string', 'The language attribute text content');
        $this->registerArgument('tag', 'string', 'Define tag name', false, 'div');
    }

    public static function renderStatic(array $arguments, \Closure $renderChildrenClosure, RenderingContextInterface $renderingContext): string
    {

        // Do nothing
        if(empty($arguments['languageCode']) || $arguments['languageCode'] === LanguageService::getLanguageCode()) {
            return $renderChildrenClosure();
        }

        // Wrap text with lang attribute
        return '<' . $arguments['tag'] . ' lang="' .  $arguments['languageCode'] . '">' .  trim($renderChildrenClosure()) . '</' . $arguments['tag'] . '>';
    }

}
