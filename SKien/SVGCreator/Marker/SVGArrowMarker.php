<?php

declare(strict_types=1);

namespace SKien\SVGCreator\Marker;


use SKien\SVGCreator\Shapes\SVGPath;

/**
 * Class to create some standard arrow markers.
 *
 * This class provides arrow markers of various types, optionally with a bar to
 * which the arrow points. The arrows are colored with the stroke color of the
 * shape they are assigned to. <br>
 * The normal representation of the different styles are designed for a square base.
 * By changing the width (respectively, the aspect ratio), the stretching or
 * compression of the arrow to be displayed can be influenced.
 *
 * @SKienImage SVGArrowMarker.png
 *
 * @author Stefanius <s.kientzler@online.de>
 * @copyright MIT License - see the LICENSE file for details
 */
class SVGArrowMarker extends SVGMarker
{
    /** Filled arrow    */
    public const FILLED_ARROW           = 0x01;
    /** Line arrow    */
    public const LINE_ARROW             = 0x02;
    /** Arrow in the shape of a harpoon   */
    public const HARPOON_ARROW          = 0x03;
    /** Filled arrow with closing bar    */
    public const FILLED_ARROW_TO_BAR    = 0x11;
    /** Line arrow with closing bar    */
    public const LINE_ARROW_TO_BAR      = 0x12;
    /** Arrow in the shape of a harpoon with closing bar   */
    public const HARPOON_ARROW_TO_BAR   = 0x13;

    /**
     * Creates an arrow marker of the requested shape.
     * @see SVGArrowMarker
     * @param float|string $width
     * @param float|string $height
     * @param int $iType
     */
    public function __construct(float|string $width, float|string $height, int $iType = self::FILLED_ARROW)
    {
        parent::__construct($width, $height);

        $bToBar = ($iType & 0x10) !== 0;
        $iType = $iType & 0x0F;

        $this->setRefPoint(18, 10);
        $this->setMarkerUnits(SVGMarker::UNITS_STROKE_WIDTH);
        $this->setPreserveAspectRatio('none');
        $this->setOrientation('auto-start-reverse');
        $this->setStyle('stroke: none; fill: context-stroke;');
        $aPath = [
            self::FILLED_ARROW  => 'M 0 0 L 20 10 L 0 20 Z',
            self::LINE_ARROW    => 'M 0 0 L 20 10 L 0 20 L 0 18 L 17 10 L 0 2 Z',
            self::HARPOON_ARROW => 'M 0 0 L 20 10 L 0 20 L 10 10 Z',
        ];
        if (isset($aPath[$iType])) {
            $this->add(SVGPath::fromString($aPath[$iType]));
        } else {
            trigger_error('Invalid parameter iType [' . $iType . '] specified', E_USER_WARNING);
        }
        if ($bToBar) {
            $barWidth = 2 * ($height / $width);
            $this->add(SVGPath::fromString("M 20 0 h $barWidth v 20 h -$barWidth Z"));
            $this->setViewbox(0, 0, 20 + $barWidth, 20);
        } else {
            $this->setViewbox(0, 0, 20, 20);
        }
    }
}