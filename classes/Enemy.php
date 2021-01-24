<?php
class Enemy extends Lives
{
  const MAX_HITPOINT = 100;

  public function __construct($name, $attackPoint)
  {
    $hitPoint = self::MAX_HITPOINT;
    $intelligence = 0;
    parent::__construct($name, $hitPoint, $attackPoint, $intelligence);
  }
}
