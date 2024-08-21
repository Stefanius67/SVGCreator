<?php

declare(strict_types=1);

namespace SKien\SVGCreator\Filter\Effects;

use SKien\SVGCreator\SVGElement;

/**
 * This element allows filter effects to be applied concurrently instead of sequentially.
 * This is achieved by other filters storing their output via the result attribute and
 * then accessing it in a <feMergeNode> child.
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/SVG/Element/feMerge
 * @link https://developer.mozilla.org/en-US/docs/Web/SVG/Element/feMergeNode
 *
 * @author Stefanius <s.kientzler@online.de>
 * @copyright GPLv3 License - see the LICENSE file for details
 */
class SVGMergeEffect extends SVGEffect
{
    /**
     * This element allows filter effects to be applied concurrently instead of sequentially.
     * The filters to apply have to be added using the `addInput()`method.
     * @param array<string> $aIn
     * @link https://developer.mozilla.org/en-US/docs/Web/SVG/Element/feMerge
     * @link https://developer.mozilla.org/en-US/docs/Web/SVG/Element/feMergeNode
     */
    public function __construct(array $aIn = [])
    {
        parent::__construct('feMerge');
        foreach ($aIn as $strIn) {
            $this->addInput($strIn);
        }
    }

    /**
     * Adds the result of a previous applied effect.
     * @param string $strIn name of the effect to add
     */
    public function addInput(string $strIn) : void
    {
        $oNode = new SVGElement('feMergeNode');
        $oNode->setAttribute('in', $strIn);
        $this->add($oNode);
    }
}