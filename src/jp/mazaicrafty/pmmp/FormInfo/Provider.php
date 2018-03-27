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

# Utils
use pocketmine\utils\Config;

# FormInfo
use jp\mazaicrafty\pmmp\FormInfo\Main;

class Provider{

    /**
     * @var Main
     */
    private $main;

    /**
     * @param Main $main
     */
    public function __construct(Main $main){
        $this->main = $main;
        @mkdir($this->getMain()->getDataFolder());
        $this->getMain()->saveResource("messages.yml");
        $this->getMain()->saveResource("config.yml");

        $this->messages = new Config($this->getMain()->getDataFolder() . "messages.yml", Config::YAML);
        $this->config = new Config($this->getMain()->getDataFolder() . "config.yml", Config::YAML);
    }

    /**
     * @return Main
     */
    public function getMain(){
        return $this->main;
    }

    /**
     * @param string $setting
     * @return string
     */
    public function getSetting(string $setting){
        return $this->config->get($setting);
    }

    /**
     * @param string $message
     * @return string
     */
    public function getMessage(string $message){
        return $this->messages->get($message);
    }
}
