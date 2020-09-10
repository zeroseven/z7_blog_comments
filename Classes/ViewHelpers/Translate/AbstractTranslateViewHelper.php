<?php declare(strict_types=1);

namespace Zeroseven\Z7BlogComments\ViewHelpers\Translate;

use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractTagBasedViewHelper;
use Zeroseven\Z7BlogComments\Service\LanguageService;

/**
 * This viewHelper creates a simple translation link. Maybe that's enough for your project.
 * The cooler way would be to translate the content inside the page with fancy APIs ...
 * But it's not part of that extension ;-)
 */
abstract class AbstractTranslateViewHelper extends AbstractTagBasedViewHelper
{

    protected $tagName = 'a';

    public function initializeArguments(): void
    {

        parent::initializeArguments();

        $this->registerTagAttribute('class', 'string', 'CSS class(es) for this element');
        $this->registerTagAttribute('dir', 'string', 'Text direction for this HTML element. Allowed strings: "ltr" (left to right), "rtl" (right to left)');
        $this->registerTagAttribute('id', 'string', 'Unique (in this file) identifier for this HTML element.');
        $this->registerTagAttribute('style', 'string', 'Individual CSS styles for this element');
        $this->registerTagAttribute('title', 'string', 'Tooltip text of element');
        $this->registerTagAttribute('accesskey', 'string', 'Keyboard shortcut to access this element');
        $this->registerTagAttribute('tabindex', 'integer', 'Specifies the tab order of this element');
        $this->registerTagAttribute('onclick', 'string', 'JavaScript evaluated for the onclick event');
        $this->registerTagAttribute('target', 'string', 'Specifies where to open the linked document', false, '_blank');
        $this->registerTagAttribute('rel', 'string', 'Specified the relationship between the current document and the linked document.', false, 'external');

        $this->registerArgument('languageCode', 'string', 'The two letter language code');
        $this->registerArgument('string', 'string', 'Link text');
        $this->registerArgument('text', 'string', 'The text you want to translate', true);
    }

    abstract protected function setHref(): void;

    public function render(): string
    {

        // Do nothing
        if (empty($this->arguments['languageCode']) || $this->arguments['languageCode'] === LanguageService::getLanguageCode()) {
            return '';
        }

        // Set link url
        $this->setHref();

        // Set content
        $this->tag->setContent($this->arguments['string'] ?: $this->renderChildren());

        return $this->tag->render();
    }

}
