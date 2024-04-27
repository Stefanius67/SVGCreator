<?php

declare(strict_types=1);

namespace SKien\SVGCreator\Shapes;

/**
 * Generic element to define a shape.
 *
 * @see SVGPath::__construct
 *
 * @link https://www.w3schools.com/graphics/svg_path.asp
 * @link https://developer.mozilla.org/en-US/docs/Web/SVG/Tutorial/Paths
 *
 * @author Stefanius <s.kientzler@online.de>
 * @copyright MIT License - see the LICENSE file for details
 */
class SVGPath extends SVGShape
{
    protected string $strLastCmd = '';

    /**
     * Generic element to define a shape.
     * @param string $strStyleOrClass
     * @link https://developer.mozilla.org/en-US/docs/Web/SVG/Element/path
     */
    public function __construct(string $strStyleOrClass = null)
    {
        parent::__construct('path', '', $strStyleOrClass);

        $this->setAttribute('d', '');
    }

    /**
     * @param float $x
     * @param float $y
     */
    public function moveTo(float $x, float $y) : void
    {
        $this->strLastCmd = 'M';
        $this->oAttrib['d'] .= "M $x $y ";
    }

    /**
     * @param float $dx
     * @param float $dy
     */
    public function move(float $dx, float $dy) : void
    {
        $this->strLastCmd = 'm';
        $this->oAttrib['d'] .= "m $dx $dy ";
    }

    /**
     * @param float $x
     * @param float $y
     */
    public function lineTo(float $x, float $y) : void
    {
        $this->strLastCmd = 'L';
        $this->oAttrib['d'] .= "L $x $y ";
    }

    /**
     * @param float $dx
     * @param float $dy
     */
    public function line(float $dx, float $dy) : void
    {
        $this->strLastCmd = 'l';
        $this->oAttrib['d'] .= "l $dx $dy ";
    }

    /**
     * @param float $x
     */
    public function horzLineTo(float $x) : void
    {
        $this->strLastCmd = 'H';
        $this->oAttrib['d'] .= "H $x ";
    }

    /**
     * @param float $dx
     */
    public function horzLine(float $dx) : void
    {
        $this->strLastCmd = 'h';
        $this->oAttrib['d'] .= "h $dx ";
    }

    /**
     * @param float $y
     */
    public function vertLineTo(float $y) : void
    {
        $this->strLastCmd = 'V';
        $this->oAttrib['d'] .= "V $y ";
    }

    /**
     * @param float $dy
     */
    public function vertLine(float $dy) : void
    {
        $this->strLastCmd = 'v';
        $this->oAttrib['d'] .= "v $dy ";
    }

    /**
     * Closes the path.
     * Draws a straight line from the current position back to the first point of the path.
     */
    public function close() : void
    {
        $this->oAttrib['d'] .= "Z ";
    }

    /**
     * @link https://developer.mozilla.org/en-US/docs/Web/SVG/Tutorial/Paths#arcs
     * @param float $rx
     * @param float $ry
     * @param float $xAxisRotation
     * @param bool|int $largeArc
     * @param bool|int $sweep
     * @param float $x
     * @param float $y
     */
    public function arcAt(float $rx, float $ry, float $xAxisRotation, bool|int $largeArc, bool|int $sweep, float $x, float $y) : void
    {
        $iLargeArc = (int) $largeArc;
        $iSweep = (int) $sweep;
        $this->strLastCmd = 'A';
        $this->oAttrib['d'] .= "A $rx $ry, $xAxisRotation, $iLargeArc, $iSweep, $x $y ";
    }

    /**
     * @link https://developer.mozilla.org/en-US/docs/Web/SVG/Tutorial/Paths#arcs
     * @param float $rx
     * @param float $ry
     * @param float $xAxisRotation
     * @param bool|int $largeArc
     * @param bool|int $sweep
     * @param float $dx
     * @param float $dy
     */
    public function arc(float $rx, float $ry, float $xAxisRotation, bool|int $largeArc, bool|int $sweep, float $dx, float $dy) : void
    {
        $iLargeArc = (int) $largeArc;
        $iSweep = (int) $sweep;
        $this->strLastCmd = 'a';
        $this->oAttrib['d'] .= "a $rx $ry, $xAxisRotation, $iLargeArc, $iSweep, $dx $dy ";
    }

    /**
     * @link https://developer.mozilla.org/en-US/docs/Web/SVG/Tutorial/Paths#curve_commands
     * @param float $x1
     * @param float $y1
     * @param float $x2
     * @param float $y2
     * @param float $x
     * @param float $y
     */
    public function curveAt(float $x1, float $y1, float $x2, float $y2, float $x, float $y) : void
    {
        $this->strLastCmd = 'C';
        $this->oAttrib['d'] .= "C $x1 $y1, $x2 $y2, $x $y ";
    }

    /**
     * @link https://developer.mozilla.org/en-US/docs/Web/SVG/Tutorial/Paths#curve_commands
     * @param float $dx1
     * @param float $dy1
     * @param float $dx2
     * @param float $dy2
     * @param float $dx
     * @param float $dy
     */
    public function curve(float $dx1, float $dy1, float $dx2, float $dy2, float $dx, float $dy) : void
    {
        $this->strLastCmd = 'c';
        $this->oAttrib['d'] .= "c $dx1 $dy1, $dx2 $dy2, $dx $dy ";
    }

    /**
     * @link https://developer.mozilla.org/en-US/docs/Web/SVG/Tutorial/Paths#curve_commands
     * @param float $x2
     * @param float $y2
     * @param float $x
     * @param float $y
     */
    public function smoothCurveAt(float $x2, float $y2, float $x, float $y) : void
    {
        if ($this->strLastCmd !== 'S' && $this->strLastCmd !== 'C') {
            trigger_error('A smoothCurve . command can only follows a curve or another smoothCurve - command!', E_USER_WARNING);
        }
        $this->strLastCmd = 'S';
        $this->oAttrib['d'] .= "S $x2 $y2, $x $y ";
    }

    /**
     * @link https://developer.mozilla.org/en-US/docs/Web/SVG/Tutorial/Paths#curve_commands
     * @param float $dx2
     * @param float $dy2
     * @param float $dx
     * @param float $dy
     */
    public function smoothCurve(float $dx2, float $dy2, float $dx, float $dy) : void
    {
        if ($this->strLastCmd !== 's' && $this->strLastCmd !== 'c') {
            trigger_error('A smoothCurve . command can only follows a curve or another smoothCurve - command!', E_USER_WARNING);
        }
        $this->strLastCmd = 's';
        $this->oAttrib['d'] .= "s $dx2 $dy2, $dx $dy ";
    }

    /**
     * @link https://developer.mozilla.org/en-US/docs/Web/SVG/Tutorial/Paths#curve_commands
     * @param float $x1
     * @param float $y1
     * @param float $x
     * @param float $y
     */
    public function quadraticCurveAt(float $x1, float $y1, float $x, float $y) : void
    {
        $this->strLastCmd = 'Q';
        $this->oAttrib['d'] .= "Q $x1 $y1, $x $y ";
    }

    /**
     * @link https://developer.mozilla.org/en-US/docs/Web/SVG/Tutorial/Paths#curve_commands
     * @param float $dx1
     * @param float $dy1
     * @param float $dx
     * @param float $dy
     */
    public function quadraticCurve(float $dx1, float $dy1, float $dx, float $dy) : void
    {
        $this->strLastCmd = 'q';
        $this->oAttrib['d'] .= "q $dx1 $dy1, $dx $dy ";
    }

    /**
     * @link https://developer.mozilla.org/en-US/docs/Web/SVG/Tutorial/Paths#curve_commands
     * @param float $x
     * @param float $y
     */
    public function smoothQuadraticCurveAt(float $x, float $y) : void
    {
        if ($this->strLastCmd !== 'Q' && $this->strLastCmd !== 'T') {
            trigger_error('A smoothQuadraticCurve . command can only follows a quadraticCurve or another smoothQuadraticCurve - command!', E_USER_WARNING);
        }
        $this->strLastCmd = 'T';
        $this->oAttrib['d'] .= "T $x $y ";
    }

    /**
     * @link https://developer.mozilla.org/en-US/docs/Web/SVG/Tutorial/Paths#curve_commands
     * @param float $dx
     * @param float $dy
     */
    public function smoothQuadraticCurve(float $dx, float $dy) : void
    {
        if ($this->strLastCmd !== 'q' && $this->strLastCmd !== 't') {
            trigger_error('A smoothQuadraticCurve . command can only follows a quadraticCurve or another smoothQuadraticCurve - command!', E_USER_WARNING);
        }
        $this->strLastCmd = 't';
        $this->oAttrib['d'] .= "t $dx $dy ";
    }
}