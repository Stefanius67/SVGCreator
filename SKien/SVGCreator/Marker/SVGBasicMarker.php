<?php

declare(strict_types=1);

namespace SKien\SVGCreator\Marker;


use SKien\SVGCreator\Shapes\SVGCircle;
use SKien\SVGCreator\Shapes\SVGPath;

/**
 * Class to create some popular basic markers.
 *
 * By default, a basic markers is draw in a size of 10 x 10 (relative to the
 * stroke-width of the line it is attached to).
 * The size can be changed by setting the `$size` param of the constructor.
 * The fill- and stroke color can be bedined in the constructor. Deafult value is
 * no stroke and the strikecolor of the line is used as fillcolor for the marker.
 *
 * Supported shapes:
 * - DOT
 * - SQUARE
 * - BAR
 * - TRIANGLE
 * - RHOMBUS
 *
 * @SKienImage SVGBasicMarker.png
 *
 * @author Stefanius <s.kientzler@online.de>
 * @copyright GPLv3 License - see the LICENSE file for details
 */
class SVGBasicMarker extends SVGMarker
{
    /** A simple dot    */
    public const DOT        = 1;
    /** A square   */
    public const SQUARE     = 2;
    /** A horizontal bar (90 degree to the line)    */
    public const BAR        = 3;
    /** A triangle   */
    public const TRIANGLE   = 4;
    /** A rhombus (square rotated by 45 degree)   */
    public const RHOMBUS    = 5;

    /**
     * Creates an basic marker of the requested shape.
     * @see SVGBasicMarker
     * @param int $iType
     * @param float|string|array<float|string> $size  float|string: width=height=size; array: width=size[0], height=size[1]
     * @param string $fillColor
     * @param string $strokeColor
     */
    public function __construct(int $iType = self::DOT, float|string|array $size = 10, string $fillColor = 'context-stroke', string $strokeColor = 'none')
    {
        if (is_array($size)) {
            $width = $size[0];
            $height = $size[1];
        } else {
            $width = $size;
            $height = $size;
        }
        parent::__construct($width, $height);

        $this->setRefPoint(10, 10);
        $this->setViewbox(0, 0, 20, 20);
        $this->setMarkerUnits(SVGMarker::UNITS_STROKE_WIDTH);
        $this->setPreserveAspectRatio('none');
        $this->setOrientation('auto-start-reverse');
        $this->setStyle("stroke: $strokeColor; fill: $fillColor;");
        $aPath = [
            // self::DOT       => 'M 0 10 A 10 10, 0, 1, 0, 10 0 A 10 10, 0, 0, 0, 0 10',
            self::SQUARE    => 'M 0 0 H 20 V 20 H -20 Z',
            self::BAR       => 'M 9 0 h 2 v 20 h -2 Z',
            self::TRIANGLE  => 'M 10 0 L 20 20 L 0 20 Z',
            self::RHOMBUS   => 'M 10 0 L 20 10 L 10 20 L 0 10 Z',
        ];
        if (isset($aPath[$iType])) {
            $this->add(SVGPath::fromString($aPath[$iType]));
        } else if ($iType === self::DOT) {
            // currently only the DOT isn't composed with a path
            $this->add(new SVGCircle(10, 10, 10));
        } else {
            trigger_error('Invalid parameter iType [' . $iType . '] specified', E_USER_WARNING);
        }
    }
}