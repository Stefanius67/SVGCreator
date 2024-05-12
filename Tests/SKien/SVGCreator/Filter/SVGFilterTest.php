<?php

declare(strict_types=1);

namespace Tests\SKien\SVGCreator\Filter;

use PHPUnit\Framework\TestCase;
use SKien\SVGCreator\Filter\SVGFilter;
use SKien\SVGCreator\Filter\Effects\SVGEffect;
use Tests\SKien\TestCaseAccessHelperTrait;

/**
 * Class SVGFilterTest.
 *
 * @author Stefanius <s.kientzler@online.de>
 * @copyright MIT License - see the LICENSE file for details
 *
 * @covers \SKien\SVGCreator\Filter\SVGFilter
 */
final class SVGFilterTest extends TestCase
{
    use TestCaseAccessHelperTrait;

    private SVGFilter $oSVGFilter;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->oSVGFilter = new SVGFilter();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown(): void
    {
        parent::tearDown();

        unset($this->oSVGFilter);
    }

    public function test__construct(): void
    {
        $this->assertEquals('filter', $this->oSVGFilter->getName());
    }

    public function testAddEffect(): void
    {
        $this->oSVGFilter->addEffect(new SVGEffect('feTest'), 'result');
        $aChilds = $this->getObjectProperty($this->oSVGFilter, 'aChilds');
        $this->assertEquals('feTest', $aChilds[0]->getName());
        $this->assertEquals('result', $aChilds[0]->getAttribute('result'));
    }
}
