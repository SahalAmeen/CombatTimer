<?php

namespace RumDaDuMCPE;

use pocketmine\scheduler\Task;
use pocketmine\utils\TextFormat;
use pocketmine\Player;

class HUDTask extends Task {
	public function onRun (int $currentTick) {
		$plugin = CombatHUD::getInstance();
		foreach ($plugin->getServer()->getOnlinePlayers() as $player) {
			if ($plugin->PlayerisInCombat($player)) {
				if(!$plugin->CreativeCheck($player)){
$plugin->setCreativeCheck($player, true);
				}else{
				if($player->getAllowFlight()){
					$player->setAllowFlight(false);
					$player->setFlying(false);
					$player->setGamemode(Player::SURVIVAL);
					$player->sendMessage(TextFormat::colorize("&cYou cannot fly whilst in combat. Disabled your flight."));
				}
				$player->sendPopup($plugin->sendHUD($player));
			} else {
					if($plugin->CreativeCheck($player)){
					$plugin->setCreativeCheck($player, false);
					}
				return;
			}

		}
	}
}
