<?php declare(strict_types=1);


class ValidationError extends Exception
{
    /**
     * ValidationError constructor.
     * @param string $message
     * @param int $code
     * @param Exception|null $previous
     */
    public function __construct(string $message, int $code = 0, Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    public function __toString(): string
    {
        return __CLASS__ . ": [{$this->code}]: {$this->message}";
    }
}