<?php

class Brave extends Human
{
  const MAX_HITPOINT = parent::MAX_HITPOINT * 1.2;
  private $attackPoint = 30;

  public function __construct($name)
  {
    parent::__construct($name, self::MAX_HITPOINT, $this->attackPoint);
  }

  public function doAttack($enemies)
  {
    // HP0のとき
    if ($this->getHitPoint() <= 0) {
      return false;
    }
    $enemy = $this->selectTarget($enemies);

    if (rand(1, 3) === 1) {
      $attackPoint = $this->attackPoint * 1.5;
      echo sprintf("『%s』のスキルが発動した\n", $this->getName());
      echo sprintf("『ぜんりょくぎり』!!\n");
      echo sprintf("%s に %d のダメージ!\n", $enemy->getName(), $attackPoint);
      $enemy->tookDamage($attackPoint);
    } else {
      parent::doAttack($enemies);
    }
    return true;
  }
}
