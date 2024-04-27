<?php

declare(strict_types=1);

namespace SKien\SVGCreator\Filter;

use SKien\SVGCreator\SVGElement;

/**
 * @author Stefanius <s.kientzler@online.de>
 * @copyright MIT License - see the LICENSE file for details
 */
class SVGFilterEffect extends SVGElement
{
    public function __construct(string $strName)
    {
        parent::__construct($strName);
    }

    /**
     * Sets the name of the effect result.
     * The name of a effect is needed, if a filter contains the combination
     * of multiple effects and one effect needs the computed result of an
     * preceeding filter.
     * @param string $strResult
     */
    public function setResult(string $strResult) : void
    {
        $this->setAttribute('result', $strResult);
    }
}