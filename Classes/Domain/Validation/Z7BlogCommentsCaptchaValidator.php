<?php

declare(strict_types=1);

namespace Zeroseven\Z7BlogComments\Domain\Validation;

use TYPO3\CMS\Extbase\Validation\Validator\AbstractValidator;
use Zeroseven\Z7BlogComments\Service\EncryptionService;

class Z7BlogCommentsCaptchaValidator extends AbstractValidator
{
    protected $acceptsEmptyValues = false;

    protected function isValid($value): void
    {
        if (!EncryptionService::isValidKey($value)) {
            $this->addError(
                $this->translateErrorMessage(
                    'validation.error.Z7BlogCommentsCaptchaValidator',
                    'z7_blog_comments'
                ),
                1599736767
            );
        }
    }
}
