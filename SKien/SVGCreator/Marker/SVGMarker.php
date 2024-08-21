<?php

declare(strict_types=1);

namespace SKien\SVGCreator\Marker;

use SKien\SVGCreator\SVGElement;

/**
 * Class to define markers in a svg image.
 *
 * The classes `SVGArrowMarker` and `SVGBasicMarker` makes it easy to create
 * the most popular marker shapes that often needed.
 *
 * @see SVGArrowMarker
 * @see SVGBasicMarker
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/SVG/Element/marker
 *
 * @author Stefanius <s.kientzler@online.de>
 * @copyright GPLv3 License - see the LICENSE file for details
 */
class SVGMarker extends SVGElement
{
    /** Position(s) to draw a marker   */
    public const MARKER_START   = 0x01;
    public const MARKER_MID     = 0x02;
    public const MARKER_END     = 0x04;

    /** Valid values for the `setMarkerUnits()` method     */
    public const UNITS_USER_SPACE_ON_USE    = 'userSpaceOnUse';
    public const UNITS_STROKE_WIDTH         = 'strokeWidth';

    /**
     * Creates a marker element.
     * Based on a marker element as container any desired shape can be defined
     * that is drawn on the vertices (first, interior, final) of a line element
     * (SVGPath, SVGLine, SVGPolyline or SVGPolygon). <br>
     * A created marker have to be added to the SVG's `defs` using the `addMarker()`
     * method. Once added, it can be assigned to any line element using the
     * `setMarker()` or `setMarkerXXX()` methods of that element.
     * @param float|string $width
     * @param float|string $height
     * @link https://developer.mozilla.org/en-US/docs/Web/SVG/Element/marker
     */
    public function __construct(float|string $width, float|string $height)
    {
        parent::__construct('marker');

        $this->setAttribute('markerWidth', $width);
        $this->setAttribute('markerHeight', $height);
    }

    /**
     * Defines the coordinate system for the marker.
     * @param string $strUnits   `userSpaceOnUse` | `strokeWidth` (default)
     */
    public function setMarkerUnits(string $strUnits) : void
    {
        $this->setAttribute('markerUnits', $strUnits);
    }

    /**
     * Defines the orientation of the marker relative to the shape it is attached to.
     * The value can be `auto`, `auto-start-reverse` or an angle.
     * > An angle is a numeric value optional succeeded by the unit type ('deg': degrees,
     * > 'grad': grads,  'rad': radians). If no unit is specified the value is
     * > interpreted in degrees.
     * @param float|string $orientation     `auto` | `auto-start-reverse` | [angle] (default: 0)
     */
    public function setOrientation(float|string $orientation) : void
    {
        $this->setAttribute('orient', $orientation);
    }

    /**
     * Sets the refenrence point of the marker.
     * If the `refY` value is ommited, it is set to the `refX` value.
     * @param float|string $refX    `left` | `center` | `right` | [coordinate] (default: 0)
     * @param float|string $refY    `top` | `center` | `bottom` | [coordinate] (default: 0)
     */
    public function setRefPoint(float|string $refX, float|string $refY = null) : void
    {
        $this->setAttribute('refX', $refX);
        $this->setAttribute('refY', $refY ?? $refX);
    }
}