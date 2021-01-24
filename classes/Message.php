<?php

class Message
{
  public function displayStatusMessage($objects)
  {
    foreach ($objects as $object) {
      $object->showHitPoint();
    }
  }

  public function displayAttackMessage($objects, $targets)
  {
    # code...
    foreach ($objects as $object) {
      $isFinishFlg = $this->isFinish($targets);
      if ($isFinishFlg) {
        return true;
      }
      if (get_class($object) == "WhiteMage") {
        $attackResult = $object->doAttackWhiteMage($targets, $objects);
      } else {
        $attackResult = $object->doAttack($targets);
      }
      if ($attackResult) {
        echo "\n";
      }
      $attackResult = false;
    }
    echo "\n";
    return false;
  }

  public function isFinish($objects)
  {
    $deathCnt = 0;
    foreach ($objects as $object) {
      if ($object->getHitPoint() > 0) {
        return false;
      }
      $deathCnt++;
    }
    if ($deathCnt === count($objects)) {
      return true;
    }
  }
}
