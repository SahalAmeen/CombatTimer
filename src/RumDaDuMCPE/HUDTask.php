<?php

namespace RumDaDuMCPE;

use pocketmine\scheduler\Task;
use pocketmine\utils\TextFormat;

class HUDTask extends Task {
	public function onRun (int $currentTick) {
		$plugin = CombatHUD::getInstance();
		foreach ($plugin->getServer()->getOnlinePlayers() as $player) {
			if ($plugin->PlayerisInCombat($player)) {
				if($player->getAllowFlight() && $plugin->CreativeCheck()){
					$player->setAllowFlight(false);
					$player->setFlying(false);
					$player->sendMessage(TextFormat::colorize("&cYou cannot fly whilst in combat. Disabled your flight."));
				}
				$player->sendPopup($plugin->sendHUD($player));
			} else {
				return;
			}

		}
	}
}
