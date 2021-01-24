<?php

class BlackMage extends Human
{
  const MAX_HITPOINT = parent::MAX_HITPOINT * 0.8;
  private $attackPoint = 10;
  private $intelligence = 20;

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

    if (rand(1, 2) === 1) {
      $intelligence = $this->intelligence * 1.5;
      echo sprintf("『%s』のスキルが発動した!\n", $this->getName());
      echo sprintf("『ファイア』!!\n");
      echo sprintf("%s に %d のダメージ!\n", $enemy->getName(), $intelligence);
      $enemy->tookDamage($intelligence);
    } else {
      parent::doAttack($enemies);
    }
    return true;
  }
}
