<?php

namespace jp\mazaicrafty\pmmp\FormInfo;

# Base
use pocketmine\Server;

# Events
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerInteractEvent;

# FormInfo
use jp\mazaicrafty\pmmp\FormInfo\Main;

class EventListener implements Listener{

    /** @var Main */
    private $main;

    /**
     * @param Main $main
     */
    public function __construct(Main $main){
        $this->main = $main;
        $this->getMain()->getServer()->getPluginManager()->registerEvents($this, $main);
    }

    /**
     * @param PlayerInteractEvent $event
     */
    public function onInteract(PlayerInteractEvent $event): void{
        $player = $event->getPlayer();

        if ($player->getInventory()->getItemInHand()->getID() ===
        $this->getMain()->getProvider()->getSetting("tap.item")){
            $this->getMain()->getMenu()->createMenu($player);
        }
    }

    /**
     * @return Main
     */
    public function getMain(): Main{
        return $this->main;
    }
}
