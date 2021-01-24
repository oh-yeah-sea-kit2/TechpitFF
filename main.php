<?php
require_once('./classes/Lives.php');
require_once('./classes/Human.php');
require_once('./classes/Enemy.php');
require_once('./classes/Brave.php');
require_once('./classes/BlackMage.php');
require_once('./classes/WhiteMage.php');
require_once('./classes/Message.php');

$members = array();
$members[] = new Brave("ティーダ");
$members[] = new WhiteMage("ユウナ");
$members[] = new BlackMage("ルールー");

$enemies = array();
$enemies[] = new Enemy("ゴブリン", 20);
$enemies[] = new Enemy("ボム", 25);
$enemies[] = new Enemy("モルボル", 30);

$turn = 1;
$isFinishFlg = false;

$messageObj = new Message;


while (!$isFinishFlg) {
  echo sprintf("*** %d ターン目 ***\n\n", $turn);

  // HP display
  echo "【パーティ】\n";
  $messageObj->displayStatusMessage($members);
  echo "\n";
  echo "【敵】\n";
  $messageObj->displayStatusMessage($enemies);
  echo "\n";

  // ATTACK
  $isFinishFlg = $messageObj->displayAttackMessage($members, $enemies);
  // Check Enemy
  if ($isFinishFlg) {
    $message = "♪♪♪ファンファーレ♪♪♪\n\n";
    break;
  }
  $isFinishFlg = $messageObj->displayAttackMessage($enemies, $members);
  // Check Member
  if ($isFinishFlg) {
    $message = "GAME OVER...\n\n";
    break;
  }

  // 1秒待つ
  usleep(1 * 1000000);
  $turn++;
}

// RESULT
echo sprintf("＝＝＝戦闘終了＝＝＝\n");
echo $message;
echo "【パーティ】\n";
$messageObj->displayStatusMessage($members);
echo "\n";
echo "【敵】\n";
$messageObj->displayStatusMessage($enemies);
echo "\n";
