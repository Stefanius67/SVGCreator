<?php

declare(strict_types=1);

namespace SKien\SVGCreator\Shapes;

/**
 * Element that creates a closed shape consisting of a set of connected straight
 * lines.
 *
 * The last point is connected to the first point.
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/SVG/Element/polygon
 * @link https://www.w3schools.com/graphics/svg_polygon.asp
 * @link https://developer.mozilla.org/en-US/docs/Web/SVG/Tutorial/Basic_Shapes#polylgon
 *
 * @author Stefanius <s.kientzler@online.de>
 * @copyright GPLv3 License - see the LICENSE file for details
 */
class SVGPolygon extends SVGShape
{
    use SVGPolyTrait;

    /**
     * Element that creates  a closed shape consisting of a set of connected straight
     * lines. The last point is connected to the first point.
     * @see \SKien\SVGCreator\Shapes\SVGPolyTrait::buildPoints()
     * @param array<mixed> $aPoints
     * @param string $strStyleOrClass
     * @link https://developer.mozilla.org/en-US/docs/Web/SVG/Element/polygon
     */
    public function __construct(array $aPoints, string $strStyleOrClass = null)
    {
        parent::__construct('polygon', '', $strStyleOrClass);

        $this->setAttribute('points', $this->buildPoints($aPoints));
    }
}