<?php

namespace Zeroseven\Z7BlogComments\TCA;

use TYPO3\CMS\Core\Service\IsoCodeService;
use Zeroseven\Z7BlogComments\Service\LanguageService;

class LanguageCode extends IsoCodeService
{
    protected function spliceItem(string $search, array &$array): ?array
    {
        foreach ($array as $key => $item) {
            if (is_array($item) && array_search($search, $item, true)) {
                return array_splice($array, $key, 1);
            }
        }

        return null;
    }

    public function renderIsoCodeSelectDropdown(array $conf = []): array
    {

        // Render "original" dropdown
        $conf = parent::renderIsoCodeSelectDropdown($conf);

        // Recommend language and manipulate items
        if (
            ($text = $conf['row']['text'] ?? null)
            && ($detectedLanguageCode = LanguageService::detectLanguageCode($text))
            && ($item = $this->spliceItem($detectedLanguageCode, $conf['items']))
        ) {
            array_unshift($conf['items'], ['LLL:EXT:z7_blog_comments/Resources/Private/Language/locallang_db.xlf:tx_z7blog_domain_model_comment.language_code.div.auto', '--div--'], ...$item);
        }

        return $conf;
    }
}
