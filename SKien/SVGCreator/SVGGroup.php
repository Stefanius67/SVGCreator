<?php

declare(strict_types=1);

namespace SKien\SVGCreator;

/**
 *
 * @author Stefanius <s.kientzler@online.de>
 * @copyright MIT License - see the LICENSE file for details
 */
class SVGGroup extends SVGElement
{
    /**
     */
    public function __construct()
    {
        parent::__construct('g');
    }
}