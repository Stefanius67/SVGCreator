<?php

/**
 * This example creates a text path with a 3D-like filter and demonstrates
 * the different rendering when using the 'textlength', 'offset' and
 * 'textAdjustment' properties.
 *
 * @author Stefanius <s.kientzler@online.de>
 * @copyright GPLv3 License - see the LICENSE file for details
 */

declare(strict_types=1);

include '../autoloader.php';

use SKien\SVGCreator\SVG;
use SKien\SVGCreator\SVGGroup;
use SKien\SVGCreator\Filter\SVGFilter;
use SKien\SVGCreator\Filter\Effects\SVGCompositeEffect;
use SKien\SVGCreator\Filter\Effects\SVGEffect;
use SKien\SVGCreator\Filter\Effects\SVGGaussianBlurEffect;
use SKien\SVGCreator\Filter\Effects\SVGMergeEffect;
use SKien\SVGCreator\Filter\Effects\SVGOffsetEffect;
use SKien\SVGCreator\Filter\Effects\SVGSpecularLightingEffect;
use SKien\SVGCreator\Shapes\SVGPath;
use SKien\SVGCreator\Shapes\SVGRect;
use SKien\SVGCreator\Text\SVGText;
use SKien\SVGCreator\Text\SVGTextPath;

$oSVG = new SVG();
$oSVG->setPrettyOutput(true);
$oSVG->setSize(500, 350);
$oSVG->setViewbox(0, 0, 1750, 1200);
$oSVG->setPreserveAspectRatio('xMinYMin');

$oSVG->addStyleDef("text {font-size: 256px; font-weight: bold; font-family: 'Arial Black';}");
$oSVG->addStyleDef("path {fill: none; stroke: red; stroke-width: 5; stroke-dasharray: 5 10;}");
$oSVG->addStyleDef(".label {font-size: 48px; font-weight: 400; fill: black; font-family: 'Arial';}");

$oFilter = new SVGFilter();
$oFilter->addEffect(new SVGGaussianBlurEffect(SVGEffect::IN_SOURCE_ALPHA, 5), 'blur');
$oFilter->addEffect(new SVGOffsetEffect('blur', 5, 5), 'offset');
$oLighting = new SVGSpecularLightingEffect('offset', '#aaf', 8, 0.7, 2);
$oLighting->setPointLight(-100, -100, 100);
$oFilter->addEffect($oLighting, 'lighting');
$oFilter->addEffect(new SVGCompositeEffect('lighting', SVGEffect::IN_SOURCE_ALPHA, 'in'), 'comp');
$oFilter->addEffect(new SVGCompositeEffect(SVGEffect::IN_SOURCE_GRAPHIC, 'comp', 'arithmetic', 1.5, 0.5, 1, 0), 'paint');
$oFilter->addEffect(new SVGMergeEffect(['offset', 'paint']));
$oSVG->addDef($oFilter);

$oGroup = new SVGGroup();
$oSVG->add($oGroup);

$oPath = new SVGPath();
$oPath->moveTo(100, 500);
$oPath->quadraticCurveTo(1100, 100, 2100, 500);
$oPath->close();
$oSVG->addDef($oPath);
$oGroup->add($oPath);

$oTPath = new SVGTextPath($oPath, 'phpClasses', 30);
$oTPath->setStyle('fill: black;');
$oTPath->setFilter($oFilter);
$oGroup->add($oTPath);

$oPath = new SVGPath();
$oPath->moveTo(100, 1100);
$oPath->quadraticCurveTo(1100, 700, 2100, 1100);
$oPath->close();
$oSVG->addDef($oPath);
$oGroup->add($oPath);

$oTPath = new SVGTextPath($oPath, 'phpClasses', 30);
$oTPath->setStyle('fill: black;');
$oTPath->setFilter($oFilter);
$oTPath->setOffset(230);
$oGroup->add($oTPath);

$oPath = new SVGPath();
$oPath->moveTo(100, 1700);
$oPath->quadraticCurveTo(1100, 1300, 2100, 1700);
$oPath->close();
$oSVG->addDef($oPath);
$oGroup->add($oPath);

$oTPath = new SVGTextPath($oPath, 'phpClasses', 30);
$oTPath->setStyle('fill: black;');
$oTPath->setFilter($oFilter);
$oTPath->setTextLength(1980);
$oGroup->add($oTPath);

$oPath = new SVGPath();
$oPath->moveTo(100, 2300);
$oPath->quadraticCurveTo(1100, 1900, 2100, 2300);
$oPath->close();
$oSVG->addDef($oPath);
$oGroup->add($oPath);

$oTPath = new SVGTextPath($oPath, 'phpClasses', 30);
$oTPath->setStyle('fill: black;');
$oTPath->setFilter($oFilter);
$oTPath->setTextLength('110%');
$oTPath->setLengthAdjust(SVG::LENGTH_ADJUST_SPACING_AND_GLYPHS);
$oGroup->add($oTPath);

$oGroup->translate(400, 0);
$oGroup->scale(0.5);

$oSVG->add(new SVGText(20,  50, "1. Neither 'offset' nor 'texLength' is set.", 'label'));
$oSVG->add(new SVGText(20, 350, "2. 'offset' is defined to move the text along the path.", 'label'));
$oSVG->add(new SVGText(20, 650, "3. 'textLength' is specified and uses default length adjustment.", 'label'));
$oSVG->add(new SVGText(20, 950, "4. 'textLength' is specified in '%' and `LENGTH_ADJUST_SPACING_AND_GLYPHS`", 'label'));

$oSVG->add(new SVGRect(0, 0, 1750, 1200, 'fill: none; stroke: black;'));

$oSVG->output();
$oSVG->save('../wiki/SVGCreator.wiki/images/TextLengthAdjust.svg');
