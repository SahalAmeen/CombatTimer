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
				if(!$plugin->hasCreativeCheck($player)){
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
					if($plugin->hasCreativeCheck($player)){ //checks to ensure creative check doesn't get set to false more than once.
					$plugin->setCreativeCheck($player, false);
					}
				return;
			}

		}
	}
}
