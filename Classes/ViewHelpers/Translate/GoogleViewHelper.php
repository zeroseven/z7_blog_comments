<?php

declare(strict_types=1);

namespace Zeroseven\Z7BlogComments\ViewHelpers\Translate;

use Zeroseven\Z7BlogComments\Service\LanguageService;

class GoogleViewHelper extends AbstractTranslateViewHelper
{
    protected function setHref(): void
    {
        $this->tag->addAttribute('href', 'https://translate.google.de/#view=home&op=translate&sl=auto&tl=' . (LanguageService::getLanguageCode() ?: 'en') . '&text=' . rawurlencode(trim($this->arguments['text'])));
    }
}
