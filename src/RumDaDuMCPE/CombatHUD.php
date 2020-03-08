<?php

namespace RumDaDuMCPE;
use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\Player;
use pocketmine\event\player\PlayerJoinEvent;

class CombatHUD extends PluginBase implements Listener {

	private static $instance;
        public $creativeCheck = [];
	
	public function onEnable() {
		self::$instance = $this;
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
		$this->getServer()->getLogger()->info("§7[§aCOMBATHUD§7] §l§bEnabled!");
		$this->getScheduler()->scheduleRepeatingTask(new HUDTask($this), 20);
	}

	public static function getInstance() {
		return self::$instance;
	}
	public function onJoin(PlayerJoinEvent $event){
$player = $event->getPlayer();
		$this->setCreativeCheck(false); //ensures creative checks are false to prevent errors when it isn't recognized.
	}

	public function playerIsInCombat(Player $player) : bool {
		$cl = $this->getServer()->getPluginManager()->getPlugin("CombatLogger");
		if ($cl->isTagged($player)) return true;
		return false;
	}
	public function hasCreativeCheck(Player $player): bool{
         return $this->creativeCheck[$player->getName()];
	}
public function setCreativeCheck(Player $player, bool $creativeCheck){
$this->creativeCheck[$player->getName()] = (bool)$creativeCheck;
}

	public function sendHUD(Player $player) : string {
		$cl = $this->getServer()->getPluginManager()->getPlugin("CombatLogger");
		$timeleft = $cl->getTagDuration($player);
		return	"§l§cYou are now engaged in combat!\n".
			"§r§bTime remaining: §a".$timeleft;
	}
}
