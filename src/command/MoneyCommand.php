<?php

namespace te\command;

use iriss\CommandBase;
use pocketmine\command\CommandSender;
use te\command\player\SeeMoneySub;

class MoneyCommand extends CommandBase {

    public function __construct() {
        parent::__construct(
            'money',
            'all money commands',
            '/money <see|pay> <player>',
            [
                new SeeMoneySub()
            ],
        );
        $this->setPermission('money.command.player');
    }

    public function getCommandParameters(): array {
        return [];
    }

    protected function onRun(CommandSender $sender, array $parameters): void {}
}