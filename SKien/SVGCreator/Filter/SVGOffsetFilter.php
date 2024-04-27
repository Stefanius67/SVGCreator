<?php

declare(strict_types=1);

namespace SKien\SVGCreator\Filter;

/**
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/SVG/Element/line
 *
 * @author Stefanius <s.kientzler@online.de>
 * @copyright MIT License - see the LICENSE file for details
 */
class SVGOffsetFilter extends SVGFilterEffect
{
    /**
     * @param string $strIn the result name of previous filter or one of the `SVGFilter::SVGFilter::IN_xxx` const
     * @param float $dx
     * @param float $dy
     * @link https://developer.mozilla.org/en-US/docs/Web/SVG/Element/feOffset
     */
    public function __construct(string $strIn, float $dx, float $dy)
    {
        parent::__construct('feOffset');

        $this->setAttribute('in', $strIn);
        $this->setAttribute('dx', $dx);
        $this->setAttribute('dy', $dy);
    }
}