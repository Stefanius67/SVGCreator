<?php

declare(strict_types=1);

namespace SKien\SVGCreator\Gradients;

/**
 * Creates a simple gradient from colorFrom to colorTo.
 *
 * Supported gradient types:
 * - LINEAR_HORZ:   Linear gradient horizontal left to right
 * - LINEAR_VERT:   Linear gradient vertical top to bottom
 * - LINEAR_TL2BR:  Linear gradient top left to bottom right corner
 * - LINEAR_BL2TR:  Linear gradient bottom left to top right corner
 * - RADIAL:        Radial gradient
 *
 * the linear gradients runs from 0% to 100%, the radial runs from 10% to 100%.
 *
 * @SKienImage SVGSimpleGradient.png
 *
 * @author Stefanius <s.kientzler@online.de>
 * @copyright GPLv3 License - see the LICENSE file for details
 */
class SVGSimpleGradient extends SVGGradient
{
    /** Linear gradient horizontal left to right    */
    public const LINEAR_HORZ    = 0;
    /** Linear gradient vertical top to bottom      */
    public const LINEAR_VERT    = 1;
    /** Linear gradient top left to bottom right corner     */
    public const LINEAR_TL2BR   = 2;
    /** Linear gradient bottom left to top right corner     */
    public const LINEAR_BL2TR   = 3;
    /** Radial gradient from 10% to 100%     */
    public const RADIAL         = 4;

    /**
     * Creates a simple gradient from colorFrom to colorTo.
     * @param string $colorFrom
     * @param string $colorTo
     * @param int $iType        SVGSimpleGradient::RADIAL | SVGSimpleGradient::LINEAR_xxx
     */
    public function __construct(string $colorFrom, string $colorTo, int $iType = self::LINEAR_HORZ)
    {
        if ($iType !== self::RADIAL) {
            parent::__construct('linearGradient');
            $aTypes = [
                self::LINEAR_HORZ  => [0, 100, 0, 0],
                self::LINEAR_VERT  => [0, 0, 0, 100],
                self::LINEAR_TL2BR => [0, 100, 0, 100],
                self::LINEAR_BL2TR => [0, 100, 100, 0],
            ];

            $this->setAttribute('x1', "{$aTypes[$iType][0]}%");
            $this->setAttribute('x2', "{$aTypes[$iType][1]}%");
            $this->setAttribute('y1', "{$aTypes[$iType][2]}%");
            $this->setAttribute('y2', "{$aTypes[$iType][3]}%");

            $this->addStop(new SVGGradientStop('0%',   $colorFrom));
            $this->addStop(new SVGGradientStop('100%', $colorTo));
        } else {
            parent::__construct('radialGradient');

            $this->add(new SVGGradientStop('10%',  $colorFrom));
            $this->add(new SVGGradientStop('100%', $colorTo));
        }
    }
}