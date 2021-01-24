<?php

class Lives
{
  const MAX_HITPOINT = 100;
  private $name;
  private $hitPoint;
  private $attackPoint;
  private $intelligence;

  public function __construct($name, $hitPoint = 50, $attackPoint = 10, $intelligence = 0)
  {
    $this->name = $name;
    $this->hitPoint = $hitPoint;
    $this->attackPoint = $attackPoint;
    $this->intelligence = $intelligence;
  }
  // 名前取得
  public function getName()
  {
    return $this->name;
  }
  // HP取得
  public function getHitPoint()
  {
    return $this->hitPoint;
  }
  // ダメージを受けたとき
  public function tookDamage($damage)
  {
    $this->hitPoint -= $damage;
    if ($this->hitPoint < 0) {
      $this->hitPoint = 0;
    }
  }
  // HP回復
  public function recoveryDamage($heal, $target)
  {
    $this->hitPoint += $heal;
    if ($this->hitPoint > $target::MAX_HITPOINT) {
      $this->hitPoint = $target::MAX_HITPOINT;
    }
    echo $this->hitPoint;
  }
  public function showHitPoint()
  {
    echo sprintf("%s : %d/%d\n", $this->getName(), $this->getHitPoint(), static::MAX_HITPOINT);
  }

  public function isEnableAttack($targets)
  {
    // 自身がHP0
    if ($this->getHitPoint() == 0) {
      return false;
    }
    // 敵が全員HP0
    $isAllDie = true;
    foreach ($targets as $target) {
      if ($target->getHitPoint() > 0) {
        $isAllDie = false;
      }
    }
    if ($isAllDie) {
      return false;
    }
    return true;
  }

  public function selectTarget($targets)
  {
    $target = $targets[rand(0, count($targets) - 1)];
    // 対象がHP0のとき再度きめる
    while ($target->getHitPoint() <= 0) {
      $target = $targets[rand(0, count($targets) - 1)];
    }
    return $target;
  }

  public function doAttack($targets)
  {
    if (!$this->isEnableAttack($targets)) {
      return false;
    }
    // Target select
    $target = $this->selectTarget($targets);

    echo sprintf("『%s』の攻撃！\n", $this->getName());
    echo sprintf("【%s】に %d のダメージ！\n", $target->getName(), $this->attackPoint);
    $target->tookDamage($this->attackPoint);
    return true;
  }
}
