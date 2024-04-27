<?php

declare(strict_types=1);

namespace SKien\SVGCreator\Shapes;

/**
 * Helper trait for poly elements
 * - Polyline
 * - Polygon
 *
 * @author Stefanius <s.kientzler@online.de>
 * @copyright MIT License - see the LICENSE file for details
 */
trait SVGPolyTrait
{
    /**
     * Builds a list of points from an array for poly elements.
     * The array of points can be a flat (1-dimensional) list of sequential values with
     * alterning x and y coordinates or a list of arrays (2-dimensional) each holds a
     * x/y point.
     * <pre>
     * // sequential
     * $aFlat = [x1, y1, x2, y2, ..., xn, yn];
     * // points
     * $aPoints = [
     *     [x1, y1],
     *     [x2, y2],
     *     ...
     *     [xn, xn],
     * ];
     * </pre>
     * @param array $aPoints
     * @return string
     */
    public function buildPoints(array $aPoints) : string
    {
        $strPoints = '';
        if (count($aPoints) > 0) {
            if (is_array($aPoints[])) {
                $strPoints = implode(' ', array_map(function(array $a) { return implode(',', $a);}, $aPoints));
            } else {
                // check for even count?
                $strPoints = implode(' ', $aPoints);
            }
        }
        return $strPoints;
    }
}