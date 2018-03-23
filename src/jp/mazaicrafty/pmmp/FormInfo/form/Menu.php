<?php

/*
 * ___  ___               _ _____            __ _         
 * |  \/  |              (_)  __ \          / _| |        
 * | .  . | __ _ ______ _ _| /  \/_ __ __ _| |_| |_ _   _ 
 * | |\/| |/ _` |_  / _` | | |   | '__/ _` |  _| __| | | |
 * | |  | | (_| |/ / (_| | | \__/\ | | (_| | | | |_| |_| |
 * \_|  |_/\__,_/___\__,_|_|\____/_|  \__,_|_|  \__|\__, |
 *                                                   __/ |
 *                                                  |___/
 * Copyright (C) 2017-2018 @MazaiCrafty (https://twitter.com/MazaiCrafty)
 *
 * This program is free plugin.
 */

namespace jp\mazaicrafty\pmmp\FormInfo\form;

# Player
use pocketmine\Server;
use pocketmine\Player;

class Menu{

    /**
     * @var Main
     */
    private $main;

    /**
     * @param Main $owner
     */
    public function __construct(Main $main){
        $this->main = $main;
    }

    /**
     * @param Player $player
     */
    public function createMenu(Player $player){
        $api = $this->getMain()->getServer()->getPluginManager()->getPlugin("FormAPI");
        $form = $api->createSimpleForm(function (Player $player, array $args){
            $result = $args[0];
            if ($result === null) return;

            switch ($result){
                case 0:
                // Close the Menu
                return;

                case 1:
                $this->getMain()->getStatus()->createStatus();
                return;
                
                case 2:
                $this->getMain()->getConsole()->createConsole();
                return;
            }
        });

        $form->setTitle($this->getMain()->getProvider()->getMessage("menu.setTitle"));
        $form->setContent($this->getMain()->getProvider()->getMessage("menu.setContent"));
        $form->addButton($this->getMain()->getProvider()->getMessage("menu.addButton.close")); // Close the Menu
        $form->addButton($this->getMain()->getProvider()->getMessage("menu.addButton.status")); // createStatus()
        $form->addButton($this->getMain()->getProvider()->getMessage("menu.addButton.console")); // createConsole()

        $form->sendToPlayer($player);
    }

    /**
     * @return Main
     */
    public function getMain(): Main{
        return $this->main;
    }
}
