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
use pocketmine\Player;
use pocketmine\Server;

# FormInfo
use jp\mazaicrafty\pmmp\FormInfo\Main;
use jp\mazaicrafty\pmmp\FormInfo\interfaces\CallAction;
use jp\mazaicrafty\pmmp\FormInfo\{EventListener, Provider};
use jojoe77777\FormAPI\FormAPI;
class Status implements CallAction{

    /**
     * @var Main
     */
    private $main;

    /**
     * @param Main $main
     */
    public function __construct(Main $main){
        $this->main = $main;
    }

    /**
     * @param Player $player
     */
    public function createStatus(Player $player){
        $form = $this->getMain()->getForm()->createSimpleForm(function (Player $player, array $args){
            $result = $args[0];
            $name = $player->getName();
            $money = $this->getMain()->getEconomy()->myMoney($name);
            if(!isset($result)) return;

            switch ($result){
                case 0:
                // Back to Menu
                $this->getMain()->getMenu()->createMenu($player);
                return;
            }
        });

        $form->setTitle($this->getMain()->getProvider()->getMessage("status.setTitle"));
        $form->addButton($this->getMain()->getProvider()->getMessage("status.addButton.back")); // Close the Menu
        $form->setContent($this->getMain()->getProvider()->getMessage("status.setContent.myMoney"));

        $form->sendToPlayer($player);
    }

    /**
     * @return Main
     */
    public function getMain(): Main{
        return $this->main;
    }

}
