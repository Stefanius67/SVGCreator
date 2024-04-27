<?php

declare(strict_types=1);

namespace SKien\SVGCreator\Shapes;

use SKien\SVGCreator\SVGElement;

/**
 * Base class for all shapes:
 * - circle
 * - ellipse
 * - line
 * - path
 * - polygon
 * - polyline
 * - rect
 *
 * @see SVGCircle
 * @see SVGEllipse
 * @see SVGLine
 * @see SVGPath
 * @see SVGPolygon
 * @see SVGPolyline
 * @see SVGRect
 *
 * @author Stefanius <s.kientzler@online.de>
 * @copyright MIT License - see the LICENSE file for details
 */
class SVGShape extends SVGElement
{
    /**
     * Specifys a total length for the path.
     * @param float|string $length
     * @link https://developer.mozilla.org/en-US/docs/Web/SVG/Attribute/pathLength
     */
    public function setPathLength(float|string $length) : void
    {
        $this->setAttribute('pathLength', $length);
    }
}