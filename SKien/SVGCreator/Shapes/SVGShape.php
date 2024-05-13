<?php

declare(strict_types=1);

namespace SKien\SVGCreator\Shapes;

use SKien\SVGCreator\SVGElement;
use SKien\SVGCreator\Marker\SVGMarker;

/**
 * Base class for all shapes.
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

    /**
     * Sets the marker that will be drawn at the requested position(s).
     * The `$iPos` attribute can be one or a combination (binary OR) of:
     * - SVGMarker::MARKER_START:   at the first vertex of the element.
     * - SVGMarker::MARKER_MID:     at all interior vertices of the element.
     * - SVGMarker::MARKER_END:     at the final vertex of the element.
     * @param string|SVGMarker $id  marker or id of the marker.
     * @param int $iPos             position(s) to draw the marker.
     */
    public function setMarker(string|SVGMarker $id, int $iPos) : void
    {
        if (!is_string($id)) {
            $id = $id->getID();
        }
        if (($iPos & SVGMarker::MARKER_START) !== 0) {
            $this->setAttribute('marker-start', "url(#$id)");
        }
        if (($iPos & SVGMarker::MARKER_MID) !== 0) {
            $this->setAttribute('marker-mid', "url(#$id)");
        }
        if (($iPos & SVGMarker::MARKER_END) !== 0) {
            $this->setAttribute('marker-end', "url(#$id)");
        }
    }

    /**
     * Sets the marker that will be drawn at the first vertex of the element.
     * @param string|SVGMarker $id  marker or id of the marker.
     */
    public function setMarkerStart(string|SVGMarker $id) : void
    {
        if (!is_string($id)) {
            $id = $id->getID();
        }
        $this->setAttribute('marker-start', "url(#$id)");
    }

    /**
     * Sets the marker that will be drawn at all interior vertices of the element.
     * @param string|SVGMarker $id  marker or id of the marker.
     */
    public function setMarkerMid(string|SVGMarker $id) : void
    {
        if (!is_string($id)) {
            $id = $id->getID();
        }
        $this->setAttribute('marker-mid', "url(#$id)");
    }

    /**
     * Sets the arrowhead or polymarker that will be drawn at the final vertex of the element.
     * @param string|SVGMarker $id  marker or id of the marker.
     */
    public function setMarkerEnd(string|SVGMarker $id) : void
    {
        if (!is_string($id)) {
            $id = $id->getID();
        }
        $this->setAttribute('marker-end', "url(#$id)");
    }
}