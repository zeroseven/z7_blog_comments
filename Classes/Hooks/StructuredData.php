<?php

declare(strict_types=1);

namespace Zeroseven\Z7BlogComments\Hooks;

use Zeroseven\Z7Blog\Event\StructuredDataEvent;
use Zeroseven\Z7BlogComments\Domain\Model\Comment;

class StructuredData
{

    protected function buildCommentsRecurstive($comments): ?array
    {

        if (is_iterable($comments)) {
            $commentData = [];
            $iteration = 0;

            foreach ($comments as $comment) {

                $commentData[$iteration] = [
                    '@type' => 'comment',
                    'description' => $comment->getText(),
                    'dateCreated' => $comment->getCreateDate()->format('Y-m-d h:i:s'),
                    'inLanguage' => $comment->getLanguageCode()
                ];

                // Add child comments
                if ($childComments = $comment->getChildren()) {
                    $commentData[$iteration]['commentCount'] = $childComments->count();
                    $commentData[$iteration]['comment'] = $this->buildCommentsRecurstive($childComments);
                }

                // Count up the iterator
                $iteration++;
            }

            return $commentData;
        }

        return null;
    }

    public function __invoke(StructuredDataEvent $event): void
    {

        if ($comments = $event->getPost()->getComments()) {
            $event->addData(['comment' => $this->buildCommentsRecurstive($comments), 'commentCount' => $comments->count()]);
        }
    }
}
