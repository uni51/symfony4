<?php
namespace App\Twig;

use Twig\Compiler;
use Twig\Node\Node;
use Twig\Node\Expression\AbstractExpression;

class HeloNode extends Node
{
    public function __construct(AbstractExpression $value, $line, $tag = null)
    {
        parent::__construct(['value' => $value], [], $line, $tag);
    }

    public function compile(Compiler $compiler)
    {
        $compiler
            ->addDebugInfo($this) // デバッグ情報の追加
            ->write("echo 'Hello, ' .") // コンテンツの書き出し
            ->subcompile($this->getNode('value')) // 子ノードのコンパイル
            ->raw(";\n"); // テキストの書き出し
    }
}
