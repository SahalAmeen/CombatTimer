<?php

namespace RumDaDuMCPE;
use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\Player;

class CombatHUD extends PluginBase implements Listener {

	private static $instance;
        public $creativeCheck = false;
	
	public function onEnable() {
		self::$instance = $this;
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
		$this->getServer()->getLogger()->info("§7[§aCOMBATHUD§7] §l§bEnabled!");
		$this->getScheduler()->scheduleRepeatingTask(new HUDTask($this), 20);
	}

	public static function getInstance() {
		return self::$instance;
	}

	public function playerIsInCombat(Player $player) : bool {
		$cl = $this->getServer()->getPluginManager()->getPlugin("CombatLogger");
		if ($cl->isTagged($player)) return true;
		return false;
	}
	public function CreativeCheck(): bool{
         return $this->creativeCheck;
	}
public function setCreativeCheck(bool $creativeCheck){
$this->creativeCheck = $creativeCheck;
}

	public function sendHUD(Player $player) : string {
		$cl = $this->getServer()->getPluginManager()->getPlugin("CombatLogger");
		$timeleft = $cl->getTagDuration($player);
		return	"§l§cYou are now engaged in combat!\n".
			"§r§bTime remaining: §a".$timeleft;
	}
}
