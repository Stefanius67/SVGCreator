<?php

declare(strict_types=1);

namespace SKien\SVGCreator\Shapes;

/**
 * Element that creates straight lines connecting several points.
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/SVG/Element/polyline
 * @link https://www.w3schools.com/graphics/svg_polyline.asp
 * @link https://developer.mozilla.org/en-US/docs/Web/SVG/Tutorial/Basic_Shapes#polyline
 *
 * @author Stefanius <s.kientzler@online.de>
 * @copyright MIT License - see the LICENSE file for details
 */
class SVGPolyline extends SVGShape
{
    use SVGPolyTrait;

    /**
     * Element that creates straight lines connecting several points.
     * @see \SKien\SVGCreator\Shapes\SVGPolyTrait::buildPoints()
     * @param array<mixed> $aPoints
     * @param string $strStyleOrClass
     * @link https://developer.mozilla.org/en-US/docs/Web/SVG/Element/polyline
     */
    public function __construct(array $aPoints, string $strStyleOrClass = null)
    {
        parent::__construct('polyline', '', $strStyleOrClass);

        $this->setAttribute('points', $this->buildPoints($aPoints));
    }
}