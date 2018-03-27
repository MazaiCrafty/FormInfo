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
class Console implements CallAction{

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

    public function createConsole(Player $player){
        $form = $this->getMain()->getForm()->createSimpleForm(
            function (Player $player, $result){
                if($result === null) return;// NOTE: Cancelled

                switch ($result){
                    case 0:
                    $this->getMain()->getMenu()->createMenu($player);
                    return;

                    case 1:
                    $this->getMain()->getServer()->dispatchCommand($player, $result);
                    return;
                }
            }
        );

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
