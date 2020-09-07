<?php declare(strict_types=1);

namespace Zeroseven\Z7BlogComments\Middleware;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Psr\Http\Server\MiddlewareInterface;
use TYPO3\CMS\Core\Http\RedirectResponse;
use TYPO3\CMS\Core\Http\Uri;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer;
use TYPO3\CMS\Frontend\Controller\TypoScriptFrontendController;
use Zeroseven\Z7BlogComments\Service\ControlService;

class CommentControl implements MiddlewareInterface
{

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {

        if ($GLOBALS['TSFE'] instanceof TypoScriptFrontendController && $state = ControlService::control()) {

            // Build typolink
            $link = GeneralUtility::makeInstance(ContentObjectRenderer::class)->typoLink_URL([
                'parameter' => $GLOBALS['TSFE']->id,
                'forceAbsoluteUrl' => true,
                'useCacheHash' => false,
                'no_cache' => true,
                'additionalParams' => '&' . ControlService::PARAMETER . '[state]=' . $state,
            ]);

            // Build http uri
            $url = GeneralUtility::makeInstance(Uri::class, $link);

            // Redirect
            return GeneralUtility::makeInstance(RedirectResponse::class, $url, 307, ['X-Redirect-By' => 'TYPO3 Redirect: z7_blog (comments)']);
        }

        return $handler->handle($request);
    }

}
