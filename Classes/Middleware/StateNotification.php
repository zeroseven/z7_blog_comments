<?php

declare(strict_types=1);

namespace Zeroseven\Z7BlogComments\Middleware;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use TYPO3\CMS\Core\Page\PageRenderer;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Utility\LocalizationUtility;
use TYPO3Fluid\Fluid\Core\ViewHelper\TagBuilder;
use Zeroseven\Z7Blog\Service\SettingsService;
use Zeroseven\Z7BlogComments\Service\ControlService;
use Zeroseven\Z7BlogComments\Service\RequestService;

class StateNotification implements MiddlewareInterface
{

    public const ARGUMENT = 'state';

    protected function setNotification(string $translationKey, string $state): void
    {

        // Translate Message
        $message = LocalizationUtility::translate($translationKey, 'z7_blog_comments') ?: $translationKey;

        // Build tag
        $tagBuilder = GeneralUtility::makeInstance(TagBuilder::class, 'p', $message);
        $tagBuilder->addAttribute('role', 'status');
        $tagBuilder->addAttribute('class', 'blgcmnt-notification--' . $state);

        // Add content to page
        $pageRenderer = GeneralUtility::makeInstance(PageRenderer::class);
        $pageRenderer->addFooterData($tagBuilder->render());

        // Add styles
        if ($notificationStyles = SettingsService::getSettings('includeCSS.comments_notification')) {
            $absoluteStylePath = GeneralUtility::getFileAbsFileName($notificationStyles);

            if ($notificationStyles = file_exists($absoluteStylePath) ? file_get_contents($absoluteStylePath) : null) {
                $pageRenderer->addCssInlineBlock(self::class, $notificationStyles, false, false);
            }
        }
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        if ($state = (int)RequestService::getArgument(self::ARGUMENT)) {

            // Show notification
            if ($state === ControlService::STATE_ENABLED) {
                $this->setNotification('control.enabled', 'success');
            } elseif ($state === ControlService::STATE_REJECTED) {
                $this->setNotification('control.rejected', 'info');
            } elseif ($state === ControlService::STATE_DELETED) {
                $this->setNotification('control.deleted', 'info');
            } elseif ($state === ControlService::STATE_EXPIRED) {
                $this->setNotification('control.expired', 'error');
            }

            // Return request …
            return $handler->handle($request)->withHeader('X-Robots-Tag', 'noindex')->withHeader('X-Blog-Comment-State', (string)$state);
        }

        return $handler->handle($request);
    }
}
