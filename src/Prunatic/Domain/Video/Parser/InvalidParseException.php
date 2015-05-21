<?php

namespace Prunatic\Domain\Video\Parser;

class InvalidParseException extends \Exception
{
    protected $message = 'No parse provider found for given site.';
}
