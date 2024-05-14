<?php

/**
 * This example creates a badge that displays the PHPUnit coverage.
 *
 * The coverage is calculated from the 'clover.xml' using the package
 * 'PHPUnit Coverage Report Check' created by Eric Sizemore
 * (not included in this package!)
 *
 * @link https://www.phpclasses.org/package/13171
 *
 * @author Stefanius <s.kientzler@online.de>
 * @copyright MIT License - see the LICENSE file for details
 */

declare(strict_types=1);

include 'autoloader.php';

use Esi\CoverageCheck\CoverageCheck;
use SKien\SVGCreator\SVG;
use SKien\SVGCreator\SVGElement;
use SKien\SVGCreator\SVGGroup;
use SKien\SVGCreator\Filter\SVGDropShadowFilter;
use SKien\SVGCreator\Shapes\SVGRect;
use SKien\SVGCreator\Text\SVGText;

$oCoverage = new CoverageCheck();
$strCoverage = $oCoverage->nonConsoleCall('clover.xml', 100, true);

$oSVG = new SVG();
$oSVG->setPrettyOutput(true);
$oSVG->setSize(110, 20);
$oSVG->setViewbox(0, 0, 1100, 200);

$oSVG->addStyleDef("text {font-size: 104px; font-weight: normal; fill: white; font-family: Verdana,Geneva,DejaVu Sans,sans-serif;}");

// define dropshaddow filters for the textoutput
$oTextShaddow1 = $oSVG->addFilter(new SVGDropShadowFilter(7, 7, 1, 'black'));
$oTextShaddow2 = $oSVG->addFilter(new SVGDropShadowFilter(7, 7, 1, '#073877'));

// create a clipPath that restricts to the bounding rect with round corners
$oClipPath = new SVGElement('clipPath');
$oClipRect = $oClipPath->add(new SVGRect(0, 0, 1100, 200));
$oClipRect->setCornerRadius(30);
$oSVG->addDef($oClipPath);

// create a group, apply the defined clipPath and add the colored backgropund rects and the textelements
$oGroup = new SVGGroup();
$oGroup->setClipPath($oClipPath);
$oGroup->add(new SVGRect(0, 0, 550, 200, 'fill: #555; stroke: none;'));
$oGroup->add(new SVGRect(550, 0, 550, 200, 'fill: #0d6efd; stroke: none;'));
$oText = $oGroup->add(new SVGText(275, 110, 'coverage', SVGText::STYLE_ALIGN_MIDDLE . SVGText::STYLE_VALIGN_MIDDLE));
$oText->setFilter($oTextShaddow1);
$oText->setTextRendering(SVGText::RENDER_OPTIMIZE_LEGIBILITY);
$oText->setTitle('PHPUnit code coverage: ' . $strCoverage);
$oText = $oGroup->add(new SVGText(1080, 110, $strCoverage, SVGText::STYLE_ALIGN_END . SVGText::STYLE_VALIGN_MIDDLE));
$oText->setFilter($oTextShaddow2);
$oText->setTextRendering(SVGText::RENDER_OPTIMIZE_LEGIBILITY);

$oSVG->add($oGroup);

$oSVG->save('./images/PhpUnitCoverageBadge.svg');
$oSVG->output();