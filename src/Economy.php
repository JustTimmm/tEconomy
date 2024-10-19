<?php
declare(strict_types=1);

namespace te;

use JsonException;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;
use pocketmine\utils\SingletonTrait;

class Economy extends PluginBase {
    use SingletonTrait;

    private Config $cfg;

    protected function onEnable(): void {
        $this::setInstance($this);
        $this->saveResource('economy.json');
        $this->cfg = new Config($this->getDataFolder() . 'economy.json', Config::JSON);
    }

    public function hasAccount(string $player): bool {
        return $this->cfg->exists($player);
    }

    public function createAccount(string $player, float $default): void {
        if (!$this->hasAccount($player)) {
            $this->cfg->set($player, $default);
        }
    }

    /**
     * @throws JsonException
     */
    public function deleteAccount(string $player): void {
        if ($this->hasAccount($player)) {
            $this->cfg->remove($player);
            $this->cfg->save();
        }
    }

    public function getAmount(string $player): float {
        return $this->cfg->get($player);
    }

    public function addMoney(string $player, float $amount): void {
        $this->cfg->set($player, $this->getAmount($player) + $amount);
    }

    public function removeMoney(string $player, float $amount): void {
        $this->cfg->set($player, max(0, $this->getAmount($player) - $amount));
    }

    /**
     * @throws JsonException
     */
    public function setMoney(string $player, float $amount): void {
        $this->cfg->set($player, $amount);
        $this->cfg->save();
    }
}