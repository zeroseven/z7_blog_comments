<?php

declare(strict_types=1);

namespace Zeroseven\Z7BlogComments\Widgets;

use FriendsOfTYPO3\Widgets\Widgets\Provider\UsersOnlineDataProvider;
use TYPO3\CMS\Backend\Utility\BackendUtility;
use TYPO3\CMS\Core\Cache\Frontend\FrontendInterface as Cache;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Dashboard\Widgets\ButtonProviderInterface;
use TYPO3\CMS\Dashboard\Widgets\ListDataProviderInterface;
use TYPO3\CMS\Dashboard\Widgets\RequireJsModuleInterface;
use TYPO3\CMS\Dashboard\Widgets\WidgetConfigurationInterface;
use TYPO3\CMS\Dashboard\Widgets\WidgetInterface;
use TYPO3\CMS\Fluid\View\StandaloneView;
use Zeroseven\Z7BlogComments\Domain\Demand\CommentDemand;
use Zeroseven\Z7BlogComments\Domain\Repository\CommentRepository;

class PendingComments implements WidgetInterface, RequireJsModuleInterface
{

    /**
     * @var WidgetConfigurationInterface
     */
    private $configuration;

    /**
     * @var StandaloneView
     */
    private $view;

    /**
     * @var Cache
     */
    private $cache;

    /**
     * @var array
     */
    private $options;

    /**
     * @var ButtonProviderInterface|null
     */
    private $buttonProvider;

    public function __construct(WidgetConfigurationInterface $configuration, UsersOnlineDataProvider $dataProvider, StandaloneView $view, $buttonProvider = null, array $options = [])
    {
        $this->configuration = $configuration;
        $this->view = $view;
        $this->options = $options;
        $this->buttonProvider = $buttonProvider;
        $this->dataProvider = $dataProvider;
    }

    public function getRequireJsModules(): array
    {
        return ['TYPO3/CMS/Z7BlogComments/Backend/PendingCommentsWidget'];
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
        ]);

        // Ciao!
        return $this->view->render();
    }
}
