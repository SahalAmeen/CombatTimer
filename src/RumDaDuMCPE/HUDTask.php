<?php

namespace RumDaDuMCPE;

use pocketmine\scheduler\Task;

class HUDTask extends Task {
	public function onRun (int $currentTick) {
		$plugin = CombatHUD::getInstance();
		foreach ($plugin->getServer()->getOnlinePlayers() as $player) {
			if ($plugin->PlayerisInCombat($player)) {
				$player->sendPopup($plugin->sendHUD($player));
			} else {
				return;
			}

		}
	}
}
