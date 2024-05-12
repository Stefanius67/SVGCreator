<?php

declare(strict_types=1);

namespace SKien\SVGCreator\Filter\Effects;

use SKien\SVGCreator\SVGElement;

/**
 * This effect performs color-component-wise remapping of data for each pixel.
 *
 * It allows operations like brightness adjustment, contrast adjustment, color
 * balance or thresholding.
 *
 * @author Stefanius <s.kientzler@online.de>
 * @copyright MIT License - see the LICENSE file for details
 */
class SVGComponentTransferEffect extends SVGEffect
{
    /**
     * This effect performs color-component-wise remapping of data for each pixel.
     * @see SVGComponentTransferEffect
     * @param string $strIn
     * @link https://developer.mozilla.org/en-US/docs/Web/SVG/Element/feComponentTransfer
     */
    public function __construct(string $strIn = null)
    {
        parent::__construct('feComponentTransfer');

        $this->setAttribute('in', $strIn);
    }

    /**
     * Adds a identity transfer function for the given component.
     * @param string $strComponent  'R' | 'G' | 'B' | 'A'
     */
    public function addIdentityFunc(string $strComponent) : void
    {
        if ($this->isValidComponent($strComponent)) {
            $oFunc = new SVGElement('feFunc' . $strComponent);
            $oFunc->setAttribute('type', 'identity');
            $this->add($oFunc);
        }
    }

    /**
     * Adds a table transfer function for the given component.
     * Performs a linear interpolation between values given in the attribute tableValues.
     * @param string $strComponent  'R' | 'G' | 'B' | 'A'
     * @param array<float|string> $values
     */
    public function addTableFunc(string $strComponent, array $values = []) : void
    {
        if ($this->isValidComponent($strComponent)) {
            $oFunc = new SVGElement('feFunc' . $strComponent);
            $oFunc->setAttribute('type', 'table');
            $oFunc->setAttribute('tableValues', implode(' ', $values));
            $this->add($oFunc);
        }
    }

    /**
     * Adds a discrete transfer function for the given component.
     * @param string $strComponent  'R' | 'G' | 'B' | 'A'
     * @param array<float|string> $values
     */
    public function addDiscreteFunc(string $strComponent, array $values = []) : void
    {
        if ($this->isValidComponent($strComponent)) {
            $oFunc = new SVGElement('feFunc' . $strComponent);
            $oFunc->setAttribute('type', 'discrete');
            $oFunc->setAttribute('tableValues', implode(' ', $values));
            $this->add($oFunc);
        }
    }

    /**
     * Adds a linear transfer function for the given component.
     * The function is defined by the following linear equation: <br>
     * `C' = slope * C + intercept` <br>
     * Default values are 1 for slope and 0 for intercept
     * @param string $strComponent  'R' | 'G' | 'B' | 'A'
     * @param float $slope
     * @param float $intercept
     */
    public function addLinearFunc(string $strComponent, float $slope = null, float $intercept = null) : void
    {
        if ($this->isValidComponent($strComponent)) {
            $oFunc = new SVGElement('feFunc' . $strComponent);
            $oFunc->setAttribute('type', 'linear');
            $oFunc->setAttribute('slope', $slope);
            $oFunc->setAttribute('intercept', $intercept);
            $this->add($oFunc);
        }
    }

    /**
     * Adds a gamma transfer function for the given component.
     * The function is defined by the following exponential function: <br>
     * `C' = amplitude * pow(C, exponent) + offset` <br>
     * Default values are 1 for amplitude, 1 for exponent and 0 for offset
     * @param string $strComponent  'R' | 'G' | 'B' | 'A'
     * @param float $amplitude
     * @param float $exponent
     * @param float $offset
     */
    public function addGammaFunc(string $strComponent, float $amplitude = null, float $exponent = null, float $offset = null) : void
    {
        if ($this->isValidComponent($strComponent)) {
            $oFunc = new SVGElement('feFunc' . $strComponent);
            $oFunc->setAttribute('type', 'gamma');
            $oFunc->setAttribute('amplitude', $amplitude);
            $oFunc->setAttribute('exponent', $exponent);
            $oFunc->setAttribute('offset', $offset);
            $this->add($oFunc);
        }
    }

    /**
     * Checks the requested value for valid component.
     * @param string $strComponent
     * @return bool
     */
    private function isValidComponent(string &$strComponent) : bool
    {
        $strComponent = strtoupper($strComponent);
        $bValid = in_array($strComponent, ['R', 'G', 'B', 'A']);
        if (!$bValid) {
            trigger_error('Invalid parameter `strCommponent`: ' . $strComponent, E_USER_WARNING);
        }
        return $bValid;
    }
}