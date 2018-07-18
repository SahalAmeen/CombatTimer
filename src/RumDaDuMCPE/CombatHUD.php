<?php

namespace RumDaDuMCPE;

class CombatHUD extends \pocketmine\plugin\PluginBase implements \pocketmine\event\Listener {

	private static $instance;

	public function onEnable() {
		self::$instance = $this;
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
		$this->getServer()->getLogger()->info("§7[§aCOMBATHUD§7] §l§bEnabled!");
		$this->getScheduler()->scheduleRepeatingTask(new HUDTask($this), 20);
	}

	public static function getInstance() {
		return self::$instance;
	}

	public function playerIsInCombat(\pocketmine\Player $player) : bool {
		$cl = $this->getServer()->getPluginManager()->getPlugin("CombatLogger");
		if ($cl->isTagged($player)) return true;
		return false;
	}

	public function sendHUD(\pocketmine\Player $player) : string {
		$cl = $this->getServer()->getPluginManager()->getPlugin("CombatLogger");
		$timeleft = $cl->getTagDuration($player);
		return	"§l§cYou are now engaged in combat!\n".
			"§r§bTime remaining: §a".$timeleft;
	}
}
