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
use pocketmine\Server;
use pocketmine\Player;

# Utils
use pocketmine\utils\TextFormat as COLOR;

# API
use jojoe77777\FormAPI\FormAPI;
use onebone\economyapi\EconomyAPI;

# FormInfo
use jp\mazaicrafty\pmmp\FormInfo\form\Menu;
use jp\mazaicrafty\pmmp\FormInfo\form\Status;
use jp\mazaicrafty\pmmp\FormInfo\form\Console;
use jp\mazaicrafty\pmmp\FormInfo\{EventListener, Provider};

class Main extends PluginBase{

    /**
     * @var EconomyAPI
     */
    private $economyAPI;

    /**
     * @var FormAPI
     */
    private $formAPI;

    /**
     * @var Provider
     */
    private $provider;

    /**
     * @var Listener
     */
    private $listener;

    /**
     * @var Menu
     */
    private $menu;

    /**
     * @var Status
     */
    private $status;

    /**
     * @var Console
     */
    private $console;

    public function onEnable(): void{
        $this->loadAPI();
        $this->loadClass();
    }

    public function loadClass(){
        $this->listener = new EventListener($this);
        $this->provider = new Provider($this);
        $this->menu = new Menu($this);
        $this->status = new Status($this);
        $this->console = new Console($this);
    }

    public function loadAPI(): void{
        $this->economyAPI = $this->getServer()->getPluginManager()->getPlugin("EconomyAPI");
        $this->formAPI = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
    }


    /**
     * @return Main
     */
    public function getMain(): Main{
        return $this;
    }

    /**
     * @return EventListener
     */
    public function getListener(): EventListener{
        return $this->listener;
    }

    /**
     * @return EconomyAPI
     */
    public function getEconomy(): EconomyAPI{
        return $this->economyAPI;
    }

    /**
     * @return FormAPI
     */
    public function getForm(): FormAPI{
        return $this->formAPI;
    }

    /**
     * @return Provider
     */
    public function getProvider(): Provider{
        return $this->provider;
    }

    /**
     * @return Menu
     */
    public function getMenu(): Menu{
        return $this->menu;
    }

    /**
     * @return Status
     */
    public function getStatus(): Status{
        return $this->status;
    }

    /**
     * @return Console
     */
    public function getConsole(): Console{
        return $this->console;
    }

}
