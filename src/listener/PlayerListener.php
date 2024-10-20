<?php

namespace te\listener;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerJoinEvent;
use te\Economy;

class PlayerListener implements Listener {

    private function onJoin(PlayerJoinEvent $e): void {
        $player = $e->getPlayer();
        $eco = Economy::getInstance();

        if (!$player->hasPlayedBefore()) {
            $eco->createAccount($player, $eco->cfg->get('default-money'));
        }
    }
}