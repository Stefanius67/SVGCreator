<?php

declare(strict_types=1);

namespace Tests\SKien\SVGCreator\Filter\Effects;

use PHPUnit\Framework\TestCase;
use SKien\SVGCreator\Filter\Effects\SVGComponentTransferEffect;
use Tests\SKien\TestCaseAccessHelperTrait;

/**
 * Class SVGComponentTransferEffectTest.
 *
 * @author Stefanius <s.kientzler@online.de>
 * @copyright MIT License - see the LICENSE file for details
 *
 * @covers \SKien\SVGCreator\Filter\Effects\SVGComponentTransferEffect
 */
final class SVGComponentTransferEffectTest extends TestCase
{
    use TestCaseAccessHelperTrait;

    private SVGComponentTransferEffect $oSVGEffect;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->oSVGEffect = new SVGComponentTransferEffect('in');
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
        $this->assertEquals('feComponentTransfer', $this->oSVGEffect->getName());

        $this->assertEquals('in', $this->oSVGEffect->getAttribute('in'));
    }

    public function testAddIdentityFunc(): void
    {
        $this->oSVGEffect->addIdentityFunc('R');
        $aChilds = $this->getObjectProperty($this->oSVGEffect, 'aChilds');
        $this->assertEquals('feFuncR', $aChilds[0]->getName());
        $this->assertEquals('identity', $aChilds[0]->getAttribute('type'));
    }

    public function testAddTableFunc(): void
    {
        $this->oSVGEffect->addTableFunc('G', [1, 2, 3, 4, 5]);
        $aChilds = $this->getObjectProperty($this->oSVGEffect, 'aChilds');
        $this->assertEquals('feFuncG', $aChilds[0]->getName());
        $this->assertEquals('table', $aChilds[0]->getAttribute('type'));
        $this->assertEquals('1 2 3 4 5', $aChilds[0]->getAttribute('tableValues'));
    }

    public function testAddDiscreteFunc(): void
    {
        $this->oSVGEffect->addDiscreteFunc('B', [1, 2, 3, 4, 5]);
        $aChilds = $this->getObjectProperty($this->oSVGEffect, 'aChilds');
        $this->assertEquals('feFuncB', $aChilds[0]->getName());
        $this->assertEquals('discrete', $aChilds[0]->getAttribute('type'));
        $this->assertEquals('1 2 3 4 5', $aChilds[0]->getAttribute('tableValues'));
    }

    public function testAddLinearFunc(): void
    {
        $this->oSVGEffect->addLinearFunc('A', 1, 2);
        $aChilds = $this->getObjectProperty($this->oSVGEffect, 'aChilds');
        $this->assertEquals('feFuncA', $aChilds[0]->getName());
        $this->assertEquals('linear', $aChilds[0]->getAttribute('type'));
        $this->assertEquals('1', $aChilds[0]->getAttribute('slope'));
        $this->assertEquals('2', $aChilds[0]->getAttribute('intercept'));
    }

    public function testAddGammaFunc(): void
    {
        $this->oSVGEffect->addGammaFunc('R', 1, 2, 3);
        $aChilds = $this->getObjectProperty($this->oSVGEffect, 'aChilds');
        $this->assertEquals('feFuncR', $aChilds[0]->getName());
        $this->assertEquals('gamma', $aChilds[0]->getAttribute('type'));
        $this->assertEquals('1', $aChilds[0]->getAttribute('amplitude'));
        $this->assertEquals('2', $aChilds[0]->getAttribute('exponent'));
        $this->assertEquals('3', $aChilds[0]->getAttribute('offset'));
    }

    public function testAddFuncWarning(): void
    {
        $this->expectWarning();
        $this->oSVGEffect->addGammaFunc('X', 1, 2, 3);
    }
}
