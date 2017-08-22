<?php

namespace RumDaDuMCPE;

class CombatHUD extends \pocketmine\plugin\PluginBase implements \pocketmine\event\Listener {

	public function onEnable() {
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
		$this->getServer()->getLogger()->info("§7[§aCOMBATHUD§7] §l§bEnabled!");
	}

	/**
	 * @priority HIGH
	 */

	public function onMove(\pocketmine\event\player\PlayerMoveEvent $event) {
		if ($this->playerIsInCombat($event->getPlayer())) {
			$this->sendHUD($event->getPlayer());
		}
	}

	public function playerIsInCombat(\pocketmine\Player $player) : bool {
		$cl = $this->getServer()->getPluginManager()->getPlugin("CombatLogger");
		if ($cl->isTagged($player)) return true;
		return false;
	}

	public function sendHUD(\pocketmine\Player $player) {
		$cl = $this->getServer()->getPluginManager()->getPlugin("CombatLogger");
		$timeleft = $cl->getTagDuration($player);
		$player->sendPopup(
					"§l§cYou are now engaged in combat!\n".
					"§r§bTime remaining: §a".$timeleft
				  );
	}
}
