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
        if (!is_file($this->getMain()->getDataFolder() . "message.yml")){
            @mkdir($this->getMain()->getDatafolder());
            $this->getMain()->saveResource("message.yml");
        }

        $this->messages = new Config($this->getMain()->getDataFolder() . "messages.yml", Config::YAML, []);
        $this->messages->reload();
    }

    /**
     * @param string $message
     * @return string
     */
    public function getMessage(string $message){
        return $this->messages->get($message);
    }
}
