<?php

class Message
{
    public $type;
    public $value;

    public function Message($type, $value)
    {
        $this->type = $type;
        $this->value = $value;
    }

    public function __toString()
    {
        return "<div class=\"alert alert-$this->type\">$this->value</div>";
    }
}

?>