<?php

declare(strict_types=1);

namespace Zeroseven\Z7BlogComments\Domain\Demand;

use Zeroseven\Z7Blog\Domain\Demand\AbstractDemand;

class CommentDemand extends AbstractDemand
{
    /** @var bool */
    public $pending = false;
}
