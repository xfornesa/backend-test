<?php

namespace Prunatic\Domain\Video\Parser;

use Prunatic\Domain\Video\Parser\Provider\FlubParseProvider;
use Prunatic\Domain\Video\Parser\Provider\GlorfParseProvider;
use Prunatic\Domain\Video\Parser\Provider\ParserProvider;

class ContentParserFactory
{
    /**
     * @param string $site
     * @return ParserProvider
     * @throws InvalidParseException
     */
    public function create($site)
    {
        switch($site) {
            case 'glorf':
                return new GlorfParseProvider();
            case 'flub':
                return new FlubParseProvider();
        }
        throw new InvalidParseException();
    }
}
