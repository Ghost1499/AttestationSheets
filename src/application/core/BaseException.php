<?php


    class BaseException extends Exception
    {
        public function __construct($message = "", $code = 0, Throwable $previous = null)
        {
            if (empty($message))
            {
                $message=__FILE__ . ' file ' . __CLASS__ . " class " . __METHOD__ . " method " . __LINE__ . " line error";

            }
            parent::__construct($message, $code, $previous);
        }

    }