<?php
namespace App\Twig;

use Twig\Compiler;
use Twig\Node\Node;

class HeloNode extends Node
{
    public function __construct($line, $tag = null)
    {
        parent::__construct([], [], $line, $tag);
    }

    public function compile(Compiler $compiler)
    {
        $compiler
            ->addDebugInfo($this) // デバッグ情報の追加
            ->write("echo 'Hello!'") // コンテンツの書き出し
            ->raw(";\n"); // テキストの書き出し
    }
}
