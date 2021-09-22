<?php

abstract class Action
{
    abstract public function execute($_request, $_files = null);
}