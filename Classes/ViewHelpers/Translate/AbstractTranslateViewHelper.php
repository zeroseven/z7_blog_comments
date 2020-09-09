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

        $this->registerUniversalTagAttributes();
        $this->registerTagAttribute('target', 'string', 'Specifies where to open the linked document', false, '_blank');
        $this->registerTagAttribute('rel', 'string', 'Specified the relationship between the current document and the linked document.', false, 'external');

        $this->registerArgument('string', 'string', 'Link text');
        $this->registerArgument('text', 'string', 'The text you want to translate', true);
    }

    abstract protected function setHref(): void;

    public function render(): string
    {

        // Do nothing
        if (empty($this->arguments['lang']) || $this->arguments['lang'] === LanguageService::getLanguageCode()) {
            return '';
        }

        // Set link url
        $this->setHref();

        // Set content
        $this->tag->setContent($this->arguments['string'] ?: $this->renderChildren());

        return $this->tag->render();
    }

}
