<?php

class ExampleClass
{
    /** @var string  */
    private string $msg;

    public function __construct(string $msg)
    {
        $this->msg = $msg;
    }

    public function flawedMethod()
    {
        try {
            new \NoSuchClass($this->message);
        } catch  (Throwable $e) {
            throw new RuntimeException('Example Exception, follow how we got here.', 100, $e);
        }
    }
}
