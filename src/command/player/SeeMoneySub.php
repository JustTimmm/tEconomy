<?php

namespace te\command\player;

use iriss\CommandBase;
use iriss\parameters\PlayerParameter;
use pocketmine\command\CommandSender;
use pocketmine\lang\Translatable;
use pocketmine\player\Player;
use te\Economy;
use te\util\Message;

class SeeMoneySub extends CommandBase {

    public function __construct() {
        parent::__construct(
            'see',
            'see the money of <player>',
            '/money see <player>',
        );
        $this->setPermission('money.command.player.see');
    }

    public function getCommandParameters(): array {
        return [
            new PlayerParameter('target')
        ];
    }

    protected function onRun(CommandSender $sender, array $parameters): void {
        $player = $parameters['target'];
        $eco = Economy::getInstance();

        if (!isset($player)) return;

        if ($eco->hasAccount($player)) {
            $playerName = $player instanceof Player ? $player->getName() : $player;

            if ($sender instanceof Player) {
                if ($sender->getName() === $playerName) {
                    $msg = str_replace('[money]', $eco->getAmount($sender), Message::seeYourMoney());
                    $sender->sendMessage($msg);
                }
            }

            $msg = str_replace([
                '[player]',
                '[money]'
            ], [
                $playerName,
                $eco->getAmount($player)
            ], Message::seePlayerMoney());

            $sender->sendMessage($msg);
        }
    }
}