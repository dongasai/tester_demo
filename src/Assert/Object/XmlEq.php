<?php

namespace mtf\Assert\Object;

use mtf\Framework\Constraint;

/**
 * xml对象判断
 */
class XmlEq extends Constraint
{

    /**
     * 约束值
     *
     * @var \DOMDocument $expected
     */
    protected $expected;
    private   $ignoreCase;

    public function __construct($expected = null, bool $ignoreCase = true)
    {
        $this->expected   = $expected;
        $this->ignoreCase = $ignoreCase;
    }

    public function assertions($value, $message = ''): bool
    {
        return true;
    }

    /**
     * 断言逻辑
     *
     * @param \DOMDocument $value
     * @return bool
     */
    protected function matches($value): bool
    {
        return $this->nodeToText($value, $this->ignoreCase) == $this->nodeToText($this->expected, $this->ignoreCase);
    }

    /**
     * 节点转字符串
     *
     * @param \DOMNode $node 节点
     * @param bool $canonicalize 重新构建节点
     * @param bool $ignoreCase 不区分大小写
     * @return string
     */
    private function nodeToText(\DOMNode $node, bool $ignoreCase = true): string
    {

        $document = $node instanceof \DOMDocument ? $node : $node->ownerDocument;

        $document->formatOutput = true;
        $document->normalizeDocument();

        $text = $node instanceof \DOMDocument ? $node->saveXML() : $document->saveXML($node);

        return $ignoreCase ? \strtolower($text) : $text;
    }

}