<?php

declare(strict_types=1);

namespace Zeroseven\Z7BlogComments\Middleware;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use TYPO3\CMS\Core\Page\PageRenderer;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Object\ObjectManager;
use TYPO3\CMS\Extbase\Service\CacheService;
use TYPO3\CMS\Extbase\Utility\LocalizationUtility;
use TYPO3\CMS\Frontend\Controller\TypoScriptFrontendController;
use TYPO3Fluid\Fluid\Core\ViewHelper\TagBuilder;
use Zeroseven\Z7Blog\Service\SettingsService;
use Zeroseven\Z7BlogComments\Service\ControlService;

class CommentControl implements MiddlewareInterface
{
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
        if (($styles = SettingsService::getSettings('comments.includeCSS')) && ($stylePath = $styles['notification'] ?? null)) {
            $absoluteStylePath = GeneralUtility::getFileAbsFileName($stylePath);

            if ($notificationStyles = file_exists($absoluteStylePath) ? file_get_contents($absoluteStylePath) : null) {
                $pageRenderer->addCssInlineBlock(self::class, $notificationStyles, false, false);
            }
        }
    }

    protected function clearPageCache(): void
    {
        GeneralUtility::makeInstance(ObjectManager::class)->get(CacheService::class)->ClearPageCache($GLOBALS['TSFE']->id);
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        if ($GLOBALS['TSFE'] instanceof TypoScriptFrontendController && $state = ControlService::control()) {

            // Show notification
            if ($state === ControlService::STATE_ENABLED) {
                $this->setNotification('control.enabled', 'success');
                $this->clearPageCache();
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
