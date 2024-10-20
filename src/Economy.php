<?php
declare(strict_types=1);

namespace te;

use JsonException;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;
use pocketmine\utils\SingletonTrait;
use te\listener\PlayerListener;

class Economy extends PluginBase {
    use SingletonTrait;

    private Config $eco;
    public  Config $cfg;

    protected function onEnable(): void {
        $this::setInstance($this);

        $this->saveDefaultConfig();
        $this->saveResource('economy.json');

        $this->cfg = new Config($this->getDataFolder() . 'config.yml',   Config::YAML);
        $this->eco = new Config($this->getDataFolder() . 'economy.json', Config::JSON);

        $this->getServer()->getPluginManager()->registerEvents(new PlayerListener(), $this);
    }

    public function hasAccount(string $player): bool {
        return $this->eco->exists($player);
    }

    public function createAccount(string $player, float $default): void {
        if (!$this->hasAccount($player)) {
            $this->eco->set($player, $default);
        }
    }

    /**
     * @throws JsonException
     */
    public function deleteAccount(string $player): void {
        if ($this->hasAccount($player)) {
            $this->eco->remove($player);
            $this->eco->save();
        }
    }

    public function getAmount(string $player): float {
        return $this->eco->get($player);
    }

    public function addMoney(string $player, float $amount): void {
        $this->eco->set($player, $this->getAmount($player) + $amount);
    }

    public function removeMoney(string $player, float $amount): void {
        $this->eco->set($player, max(0, $this->getAmount($player) - $amount));
    }

    /**
     * @throws JsonException
     */
    public function setMoney(string $player, float $amount): void {
        $this->eco->set($player, $amount);
        $this->eco->save();
    }
}