<?php

declare(strict_types=1);

namespace Zeroseven\Z7BlogComments\Domain\Model\TraitCollector;

use Zeroseven\Z7Blog\Service\TraitCollectorService;
use Zeroseven\Z7BlogComments\Domain\Model\Comment;

TraitCollectorService::createClass(
    __NAMESPACE__,
    'CommentTraitCollector',
    Comment::class
);

// Fallback for the ClassesConfigurationFactory
if (!class_exists(CommentTraitCollector::class)) {
    class CommentTraitCollector extends Comment
    {
    }
}
