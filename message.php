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
        return "<div class=\"message message-$this->type\">$this->value</div>";
    }
}

?>