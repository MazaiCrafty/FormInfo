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

namespace jp\mazaicrafty\pmmp\FormInfo;

# Base
use pocketmine\plugin\PluginBase;
use jp\mazaicrafty\pmmp\FormInfo\interfaces\CallAction;
use pocketmine\Server;
use pocketmine\Player;

# Utils
use pocketmine\utils\TextFormat as COLOR;
use pocketmine\utils\Config;

# API
use onebone\EconomyAPI;
use jojoe77777\FormAPI;

class Main extends PluginBase implements CallAction{

    /*
    * @var EconomyAPI
    */
    private $economyAPI;

    /*
    * @var FormAPI
    */
    private $formAPI;

    public function onEnable(): void{
        self::checkAPI();
        self::loadClass();
    }

    public function loadClass(): void{
        $this->menu = new Menu($this);
        $this->status = new Status($this);
    }

    public function checkAPI(): void{
        if ($this->getServer()->getPluginManager()->getPlugin("EconomyAPI") === null ||
        $this->getServer()->getPluginManager()->getPlugin("FormAPI") === null){
        $this->getLogger()->critical("Not found API");
        $this->getServer()->getPluginManager()->disablePlugin($this);
        }
        else{
        $this->economyapi = $this->getServer()->getPluginManager()->getPlugin("EconomyAPI");
        $this->formapi = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
        }
    }

    public function getMain(): Main{
        return $this;
    }

    public function getEconomy(): EconomyAPI{
        return $this->economyAPI;
    }

    public function getForm(): FormAPI{
        return $this->formAPI;
    }

    public function getMenu(): Menu{
        return $this->menu;
    }

    public function getStatus(): Status{
        return $this->status;
    }

}
