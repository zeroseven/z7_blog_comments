<?php declare(strict_types=1);

namespace Zeroseven\Z7BlogComments\ViewHelpers\Translate;

use Zeroseven\Z7BlogComments\Service\LanguageService;

class DeeplViewHelper extends AbstractTranslateViewHelper
{

    protected function setHref(): void
    {
        $this->tag->addAttribute('href', 'https://www.deepl.com/translator#' . ($this->arguments['lang'] ?: 'auto') . '/' . (LanguageService::getLanguageCode() ?: 'en') . '/' .  rawurlencode(trim($this->arguments['text'])));
    }

}
