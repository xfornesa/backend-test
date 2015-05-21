<?php

namespace Prunatic\Domain\Video\Loader;

class MissingFileLoaderException extends \Exception
{
    protected $message = 'Missing a file loader for given file extension.';
}
