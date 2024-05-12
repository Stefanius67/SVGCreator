<?php

declare(strict_types=1);

namespace SKien\SVGCreator\Filter\Effects;

/**
 * This effect performs the combination of two input images pixel-wise.
 *
 * The effect uses one of the
 * [Porter-Duff compositing](https://de.wikipedia.org/wiki/Porter-Duff_Composition)
 * operations: <br>
 * - `over`
 * - `in`
 * - `atop`
 * - `out`
 * - `xor`
 * - `lighter`
 * - `arithmetic`.
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/SVG/Element/feComposite
 *
 * @author Stefanius <s.kientzler@online.de>
 * @copyright MIT License - see the LICENSE file for details
 */
class SVGCompositeEffect extends SVGEffect
{
    public const OPERATOR_OVER          = 'over';
    public const OPERATOR_IN            = 'in';
    public const OPERATOR_ATOP          = 'atop';
    public const OPERATOR_OUT           = 'out';
    public const OPERATOR_XOR           = 'xor';
    public const OPERATOR_LIGHTER       = 'lighter';
    public const OPERATOR_ARITHMETIC    = 'arithmetic';

    /**
     * This effect performs the combination of two input images pixel-wise.
     * @see SVGCompositeEffect
     * @param string $strIn
     * @param string $strIn2
     * @param string $strOperator   'over' | 'in' | 'out' | 'atop' | 'xor' | 'lighter' | 'arithmetic'
     * @param float $k1             (only for operator = 'arithmetic')
     * @param float $k2             (only for operator = 'arithmetic')
     * @param float $k3             (only for operator = 'arithmetic')
     * @param float $k4             (only for operator = 'arithmetic')
     * @link https://developer.mozilla.org/en-US/docs/Web/SVG/Element/feComposite
     */
    public function __construct(
        string $strIn,
        string $strIn2,
        string $strOperator,
        float $k1 = null,
        float $k2 = null,
        float $k3 = null,
        float $k4 = null)
    {
        parent::__construct('feComposite');

        $this->setAttribute('in', $strIn);
        $this->setAttribute('in2', $strIn2);
        $this->setAttribute('operator', $strOperator);
        $this->setAttribute('k1', $k1);
        $this->setAttribute('k2', $k2);
        $this->setAttribute('k3', $k3);
        $this->setAttribute('k4', $k4);
    }
}