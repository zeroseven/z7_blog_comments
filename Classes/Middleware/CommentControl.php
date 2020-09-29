<?php

declare(strict_types=1);

namespace Zeroseven\Z7BlogComments\Middleware;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use TYPO3\CMS\Core\Http\RedirectResponse;
use TYPO3\CMS\Core\Http\Uri;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Object\ObjectManager;
use TYPO3\CMS\Extbase\Service\CacheService;
use TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer;
use TYPO3\CMS\Frontend\Controller\TypoScriptFrontendController;
use Zeroseven\Z7BlogComments\Service\ControlService;
use Zeroseven\Z7BlogComments\Service\RequestService;

class CommentControl implements MiddlewareInterface
{
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        if (
            $GLOBALS['TSFE'] instanceof TypoScriptFrontendController
            && ($action = RequestService::getArgument('action'))
            && ($permissionKey = RequestService::getArgument('permission_key'))
        ) {
            // Control comment
            $state = ControlService::control($action, $permissionKey);

            // Clear cache
            GeneralUtility::makeInstance(ObjectManager::class)->get(CacheService::class)->ClearPageCache($GLOBALS['TSFE']->id);

            // Create typoLink
            $typolink = GeneralUtility::makeInstance(ContentObjectRenderer::class)->typoLink_URL([
                'parameter' => $GLOBALS['TSFE']->id,
                'forceAbsoluteUrl' => true,
                'no_cache' => true,
                'additionalParams' => '&' . RequestService::REQUEST_KEY . '[' . StateNotification::ARGUMENT . ']=' . $state,
                'addQueryString' => false
            ]);

            // Create Uri object
            $url = GeneralUtility::makeInstance(Uri::class, $typolink);

            // Forward to show notification, ciao!
            return GeneralUtility::makeInstance(RedirectResponse::class, $url, 307, ['X-Redirect-By' => 'TYPO3 Redirect: z7_blog_comments']);
        }

        return $handler->handle($request);
    }
}
