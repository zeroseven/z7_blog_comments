<?php

declare(strict_types=1);

namespace Zeroseven\Z7BlogComments\Widgets;

use FriendsOfTYPO3\Widgets\Widgets\Provider\UsersOnlineDataProvider;
use TYPO3\CMS\Backend\Utility\BackendUtility;
use TYPO3\CMS\Core\Cache\Frontend\FrontendInterface as Cache;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Dashboard\Widgets\AdditionalCssInterface;
use TYPO3\CMS\Dashboard\Widgets\ButtonProviderInterface;
use TYPO3\CMS\Dashboard\Widgets\RequireJsModuleInterface;
use TYPO3\CMS\Dashboard\Widgets\WidgetConfigurationInterface;
use TYPO3\CMS\Dashboard\Widgets\WidgetInterface;
use TYPO3\CMS\Fluid\View\StandaloneView;
use Zeroseven\Z7BlogComments\Domain\Repository\CommentRepository;

class PendingComments implements WidgetInterface, RequireJsModuleInterface, AdditionalCssInterface
{

    /** @var WidgetConfigurationInterface  */
    private $configuration;

    /** @var StandaloneView */
    private $view;

    public function __construct(WidgetConfigurationInterface $configuration, UsersOnlineDataProvider $dataProvider, StandaloneView $view, $buttonProvider = null, array $options = [])
    {
        $this->configuration = $configuration;
        $this->view = $view;
    }

    public function getRequireJsModules(): array
    {
        return ['TYPO3/CMS/Z7BlogComments/Backend/PendingCommentsWidget'];
    }

    public function getCssFiles(): array
    {
        return ['EXT:z7_blog_comments/Resources/Public/Css/Backend/PendingCommentsWidget.dist.min.css'];
    }

    protected function getPendingComments(): ?array
    {
        // Get pending comments
        if ($result = GeneralUtility::makeInstance(CommentRepository::class)->findPending()) {
            return array_filter($result->toArray(), static function ($comment) {

                // This will check the permission of the user
                return is_array(BackendUtility::getRecord('pages', $comment->getUid()));
            });
        }

        return null;
    }

    public function renderWidgetContent(): string
    {
        // Setup view
        $this->view->setTemplatePathAndFilename('EXT:z7_blog_comments/Resources/Private/Templates/Widget/PendingComments.html');
        $this->view->assignMultiple([
            'comments' => $this->getPendingComments(),
            'configuration' => $this->configuration
        ]);

        // Ciao!
        return $this->view->render();
    }
}
