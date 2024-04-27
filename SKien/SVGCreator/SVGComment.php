<?php

declare(strict_types=1);

namespace SKien\SVGCreator;

/**
 *
 * @author Stefanius <s.kientzler@online.de>
 * @copyright MIT License - see the LICENSE file for details
 */
class SVGComment extends SVGElement
{
    protected string $strComment = '';

    /**
     */
    public function __construct(string $strComment)
    {
        parent::__construct('');
        $this->strComment = $strComment;
    }

    /**
     * @param \DOMDocument $oDOMDoc
     * @return \DOMNode|false
     */
    protected function createDOMNode(\DOMDocument $oDOMDoc) : \DOMNode|false
    {
        return $oDOMDoc->createComment($this->strComment);
    }

    /**
     * Suppress comments, if the `bPrettyOutput` for the image is not set.
     * {@inheritDoc}
     * @see \SKien\SVGCreator\SVGElement::appendToDOM()
     */
    public function appendToDOM(\DOMNode $oParent) : \DOMNode|false
    {
        if ($this->oRoot === null || !$this->oRoot->isPrettyOutput()) {
            return false;
        }
        return parent::appendToDOM($oParent);
    }
}