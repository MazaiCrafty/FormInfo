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

# Command
use pocketmine\command\ConsoleCommandSender;

class Menu{

    /**
     * @var Main
     */
    private $main;

    /**
     * @param Main $owner
     */
    public function __construct(Main $owner){
        $this->main = $main;
    }

    public function createConsole(Player $player){
        $api = Server::getInstance()->getPluginManager()->getPlugin("FormAPI");
        $form = $api->createSimpleForm(function (Player $player, array $args){
            $result = $args[0];
            if ($result === null) return;

            switch ($result){
                case 0:
                $this->getMain()->getMenu()->createMenu();
                return;

                case 1:
                $this->getMain()->getServer()->dispatchCommand($player, $result);
                return;
            }
        });

        $form->setTitle($this->getMain()->getProvider()->getMessage("console.setTitle"));
        $form->addButton($this->getMain()->getProvider()->getMessage("console.addButton.back")); // Back to Menu
        $form->addInput($this->getMain()->getProvider()->getMessage("console.addInput.command")); // Input command

        $form->sendToPlayer($player);
    }

    /**
     * @return Main
     */
    public function getMain(): Main{
        return $this->main;
    }
}
