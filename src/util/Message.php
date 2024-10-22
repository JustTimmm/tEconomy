<?php

namespace te\util;

use pocketmine\utils\Config;
use te\Economy;

class Message {

    private static Config $cfg;

    public function __construct() {
        self::$cfg = Economy::getInstance()->cfg;
    }

    public static function seePlayerMoney(): string {
        return self::$cfg->getNested('message.see-player-money');
    }

    public static function seeYourMoney(): string {
        return self::$cfg->getNested('message.see-your-money');
    }
}