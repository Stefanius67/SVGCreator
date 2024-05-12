<?php

declare(strict_types=1);

namespace Tests\SKien\SVGCreator\Filter\Effects;

use PHPUnit\Framework\TestCase;
use SKien\SVGCreator\Filter\Effects\SVGMergeEffect;
use Tests\SKien\TestCaseAccessHelperTrait;

/**
 * Class SVGMergeEffectTest.
 *
 * @author Stefanius <s.kientzler@online.de>
 * @copyright MIT License - see the LICENSE file for details
 *
 * @covers \SKien\SVGCreator\Filter\Effects\SVGMergeEffect
 */
final class SVGMergeEffectTest extends TestCase
{
    use TestCaseAccessHelperTrait;

    private SVGMergeEffect $oSVGEffect;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->oSVGEffect = new SVGMergeEffect(['in1', 'in2']);
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown(): void
    {
        parent::tearDown();

        unset($this->oSVGEffect);
    }

    public function test__construct(): void
    {
        $this->assertEquals('feMerge', $this->oSVGEffect->getName());

        $aChilds = $this->getObjectProperty($this->oSVGEffect, 'aChilds');
        $this->assertEquals(2, count($aChilds));
        $this->assertEquals('feMergeNode', $aChilds[0]->getName());
        $this->assertEquals('in1', $aChilds[0]->getAttribute('in'));
        $this->assertEquals('feMergeNode', $aChilds[1]->getName());
        $this->assertEquals('in2', $aChilds[1]->getAttribute('in'));
    }

    public function testAddInput(): void
    {
        $this->oSVGEffect->addInput('in3');

        $aChilds = $this->getObjectProperty($this->oSVGEffect, 'aChilds');
        $this->assertEquals(3, count($aChilds));
        $this->assertEquals('feMergeNode', $aChilds[2]->getName());
        $this->assertEquals('in3', $aChilds[2]->getAttribute('in'));
    }
}
