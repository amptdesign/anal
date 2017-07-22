<?php
/**
 * @license see LICENSE
 */

namespace Serps\Core\Dom;

class NullDomNode implements DomNodeInterface
{
    /**
     * @inheritdoc
     */
    public function hasClass($className)
    {
        return false;
    }

    /**
     * @inheritdoc
     */
    public function getAttribute($name)
    {
        return null;
    }

    /**
     * @inheritdoc
     */
    public function getTagName()
    {
        return '';
    }

    /**
     * @inheritdoc
     */
    public function getNodeValue()
    {
        return '';
    }
}
