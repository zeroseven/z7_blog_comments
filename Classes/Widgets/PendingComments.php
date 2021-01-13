<?php

declare(strict_types=1);

namespace Zeroseven\Z7BlogComments\Widgets;

use TYPO3\CMS\Backend\Utility\BackendUtility;
use TYPO3\CMS\Core\Authentication\BackendUserAuthentication;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Dashboard\Widgets\AdditionalCssInterface;
use TYPO3\CMS\Dashboard\Widgets\ListDataProviderInterface;
use TYPO3\CMS\Dashboard\Widgets\RequireJsModuleInterface;
use TYPO3\CMS\Dashboard\Widgets\WidgetConfigurationInterface;
use TYPO3\CMS\Dashboard\Widgets\WidgetInterface;
use TYPO3\CMS\Extbase\Object\ObjectManager;
use TYPO3\CMS\Extbase\Persistence\Generic\Mapper\DataMapper;
use TYPO3\CMS\Fluid\View\StandaloneView;
use Zeroseven\Z7BlogComments\Domain\Model\Comment;
use Zeroseven\Z7BlogComments\Domain\Repository\CommentRepository;

class PendingComments implements WidgetInterface, RequireJsModuleInterface, AdditionalCssInterface
{

    /** @var WidgetConfigurationInterface */
    private $configuration;

    /** @var StandaloneView */
    private $view;

    public function __construct(WidgetConfigurationInterface $configuration, ListDataProviderInterface $dataProvider = null, StandaloneView $view, $buttonProvider = null, array $options = [])
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

    protected function getBackendUser(): BackendUserAuthentication
    {
        return $GLOBALS['BE_USER'];
    }

    protected function getPendingComments(): ?array
    {
        /** @var BackendUserAuthentication */
        $backendUser = $this->getBackendUser();

        // Get pending comments
        if ($result = GeneralUtility::makeInstance(CommentRepository::class)->findPending()) {
            return array_filter($result->toArray(), static function ($comment) use ($backendUser) {

                // This will check the permission of the user
                return $backendUser->doesUserHaveAccess(BackendUtility::getRecord('pages', $comment->getPid()), 1);
            });
        }

        return null;
    }

    public function renderWidgetContent(): string
    {
        // Get the comments table name
        $tableName = GeneralUtility::makeInstance(ObjectManager::class)->get(DataMapper::class)->getDataMap(Comment::class)->getTableName();

        // Setup view
        $this->view->setTemplatePathAndFilename('EXT:z7_blog_comments/Resources/Private/Templates/Widget/PendingComments.html');
        $this->view->assignMultiple([
            'unauthorizedTable' => $this->getBackendUser()->check('tables_modify', $tableName) ? null : $tableName,
            'comments' => $this->getPendingComments(),
            'configuration' => $this->configuration
        ]);

        // Ciao!
        return $this->view->render();
    }
}
