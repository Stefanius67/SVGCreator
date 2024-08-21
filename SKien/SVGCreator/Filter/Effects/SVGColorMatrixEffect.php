<?php

declare(strict_types=1);

namespace SKien\SVGCreator\Filter\Effects;

/**
 * This filter changes colors based on a transformation matrix.
 *
 * Every pixel's color value [R,G,B,A] is matrix multiplied by a 5 by 5 color matrix
 * to create new color [R',G',B',A'].
 *
 * The type indicates the type of matrix operation. The keyword `matrix` indicates
 * that a full 5x4 matrix of values will be provided. The other keywords represent
 * convenience shortcuts to allow commonly used color operations to be performed
 * without specifying a complete matrix.
 *
 * Valid types:
 * - `matrix`
 * - `saturate`
 * - `hueRotate`
 * - `luminanceToAlpha`
 *
 * @author Stefanius <s.kientzler@online.de>
 * @copyright GPLv3 License - see the LICENSE file for details
 */
class SVGColorMatrixEffect extends SVGEffect
{
    /**
     * This filter changes colors based on a transformation matrix.
     * @see SVGColorMatrixEffect
     * @param string $strIn
     * @param string $strType   'matrix' | 'saturate' | 'hueRotate' | 'luminanceToAlpha'
     * @param array<mixed> $aValues
     * @link https://developer.mozilla.org/en-US/docs/Web/SVG/Element/feColorMatrix
     */
    public function __construct(?string $strIn, array $aValues = [], string $strType = null)
    {
        parent::__construct('feColorMatrix');

        $strValues = null;
        if (count($aValues) > 0) {
            if (is_array($aValues[0])) {
                $strValues = implode(', ', array_map(function(array $a) { return implode(' ', $a);}, $aValues));
            } else {
                $strValues = implode(' ', $aValues);
            }
        }
        $this->setAttribute('in', $strIn);
        $this->setAttribute('type', $strType);
        $this->setAttribute('values', $strValues);
    }
}