<?php

class WhiteMage extends Human
{
  const MAX_HITPOINT = parent::MAX_HITPOINT * 0.8;
  private $attackPoint = 10;
  private $intelligence = 30;

  public function __construct($name)
  {
    parent::__construct($name, self::MAX_HITPOINT, $this->attackPoint);
  }

  public function doAttackWhiteMage($enemies, $humans)
  {
    // HP0のとき
    if ($this->getHitPoint() <= 0) {
      return false;
    }
    $humanIndex = rand(0, count($humans) - 1);
    $human = $humans[$humanIndex];

    if (rand(1, 2) === 1) {
      $intelligence = $human::MAX_HITPOINT * 0.5;
      echo sprintf("『%s』のスキルが発動した!\n", $this->getName());
      echo sprintf("『ケアル』!!\n");
      echo sprintf("%s のHPを %d 回復!\n", $human->getName(), $intelligence);
      $human->recoveryDamage($intelligence, $human);
    } else {
      parent::doAttack($enemies);
    }
    return true;
  }
}
