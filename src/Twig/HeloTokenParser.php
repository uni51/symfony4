<?php
namespace App\Twig;

use Twig\Token;
use Twig\TokenParser\AbstractTokenParser;

class HeloTokenParser extends AbstractTokenParser
{
    public function parse(Token $token)
    {
        $parser = $this->parser; // パーサーの取得
        $stream = $parser->getStream(); // ストリームの取得
        $stream->expect(Token::BLOCK_END_TYPE);

        return new HeloNode($token->getLine(), $this->getTag());
    }

    public function getTag()
    {
        return 'helo';
    }
}
