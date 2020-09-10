<?php declare(strict_types=1);

namespace Zeroseven\Z7BlogComments\ViewHelpers\Language;

use TYPO3Fluid\Fluid\Core\Rendering\RenderingContextInterface;
use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractTagBasedViewHelper;
use Zeroseven\Z7BlogComments\Service\LanguageService;

class WrapViewHelper extends AbstractTagBasedViewHelper
{

    public function initializeArguments(): void
    {
        $this->registerTagAttribute('class', 'string', 'CSS class(es) for this element');
        $this->registerTagAttribute('dir', 'string', 'Text direction for this HTML element. Allowed strings: "ltr" (left to right), "rtl" (right to left)');
        $this->registerTagAttribute('id', 'string', 'Unique (in this file) identifier for this HTML element.');
        $this->registerTagAttribute('style', 'string', 'Individual CSS styles for this element');
        $this->registerTagAttribute('title', 'string', 'Tooltip text of element');
        $this->registerTagAttribute('accesskey', 'string', 'Keyboard shortcut to access this element');
        $this->registerTagAttribute('tabindex', 'integer', 'Specifies the tab order of this element');

        $this->registerArgument('languageCode', 'string', 'The language attribute text content');
        $this->registerArgument('tagName', 'string', 'Define tag name');
        $this->registerArgument('string', 'string', 'Content');
    }

    public function render()
    {

        // Define content
        $content = trim($this->arguments['string'] ?: $this->renderChildren());

        // Do nothing
        if(($this->arguments['languageCode'] === LanguageService::getLanguageCode() || empty($this->arguments['languageCode'])) && empty($this->arguments['tagName']) && empty($this->arguments['class']) && empty($this->arguments['dir']) && empty($this->arguments['id']) && empty($this->arguments['style']) && empty($this->arguments['title']) && empty($this->arguments['accesskey']) && empty($this->arguments['tabindex'])) {
            return $content . '<h1>JO!!!</h1>';
        }

        // Set the tag name
        $this->tag->setTagName($this->arguments['tagName'] ?: 'div');

        // Add language attribute
        if(!($this->arguments['languageCode'] === LanguageService::getLanguageCode() || empty($this->arguments['languageCode']))) {
            $this->tag->addAttribute('lang', $this->arguments['languageCode']);
        }

        // Set content
        $this->tag->setContent($content);

        // Return the tag
        return $this->tag->render();
    }

}
