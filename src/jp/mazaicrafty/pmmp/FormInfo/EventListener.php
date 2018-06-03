<?php

namespace jp\mazaicrafty\pmmp\FormInfo;

use pocketmine\Server;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerInteractEvent;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\item\Item;
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
     * @param PlayerJoinEvent $event
     */
    public function onJoin(PlayerJoinEvent $event): void{
        $player = $event->getPlayer();
        if ($this->getMain()->getProvider()->getSetting("join.give-item")){
            $tap = $this->getMain()->getProvider()->getSetting("tap.item");
            $damage = $this->getMain()->getProvider()->getSetting("tap.item-damage");
            $amount = $this->getMain()->getProvider()->getSetting("tap.item-amount");
            $item = Item::get($tap, $damage, $amount);
            if (!($player->getInventory()->contains($item))){
                $player->getInventory()->addItem($item);
            }
        }
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
