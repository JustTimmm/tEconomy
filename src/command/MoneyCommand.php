<?php

namespace te\command;

use iriss\CommandBase;
use pocketmine\command\CommandSender;
use te\Economy;

class MoneyCommand extends CommandBase {

    public function __construct() {
        parent::__construct(
            Economy::getInstance()->cfg->getNested('money-command.name'),
            Economy::getInstance()->cfg->getNested('money-command.description'),
            Economy::getInstance()->cfg->getNested('money-command.usage'),
            [],
            Economy::getInstance()->cfg->getNested('money-command.aliases')
        );
    }

    public function getCommandParameters(): array {
        return [];
    }

    protected function onRun(CommandSender $sender, array $parameters): void {}
}