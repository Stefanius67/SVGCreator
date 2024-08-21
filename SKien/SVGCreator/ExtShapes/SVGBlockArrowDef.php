<?php

declare(strict_types=1);

namespace SKien\SVGCreator\ExtShapes;

use SKien\SVGCreator\SVGElement;

/**
 * This class describes the dimensions of an arrow- and head/pike created using the
 * `SVGBlockArrow` class.
 *
 * @author Stefanius <s.kientzler@online.de>
 * @copyright GPLv3 License - see the LICENSE file for details
 */
class SVGBlockArrowDef extends SVGElement
{
    /** @var float  the width of the arrow itself     */
    public float $width;
    /** @var float  the width of the arrow pike/head     */
    public float $pikeWidth;
    /** @var float  the length of the arrow pike/head     */
    public float $pikeLength;

    /**
     * @param float $width
     * @param float $pikeWidth
     * @param float $pikeLength
     * @param string $strStyleOrClass
     */
    public function __construct(float $width, float $pikeWidth, float $pikeLength, string $strStyleOrClass = null)
    {
        parent::__construct('', '', $strStyleOrClass);

        $this->width = $width;
        $this->pikeWidth = $pikeWidth;
        $this->pikeLength = $pikeLength;
    }
}