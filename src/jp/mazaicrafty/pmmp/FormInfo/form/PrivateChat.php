<?php

namespace jp\mazaicrafty\pmmp\FormInfo\form;

# Player
use pocketmine\Player;
use pocketmine\Server;

# FormInfo
use jp\mazaicrafty\pmmp\FormInfo\Main;
use jp\mazaicrafty\pmmp\FormInfo\interfaces\CallAction;
use jp\mazaicrafty\pmmp\FormInfo\{EventListener, Provider};

class PrivateChat implements CallAction{
    
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

    public function createPrivateChat(Player $player){
        $form = $this->getMain()->getForm()->createCustomForm(
            function (Player $player, $data){
                $result = $data[0];
                $text = $data[1];
                if ($text === null) return; // NOTE: Cancelled
                foreach ($this->playerList as $_player){
                    if ($result === 0){
                        $target = $_player->getPlayer();
                        if ($target instanceof Player){
                            if ($target->getName() === $player->getName()){
                                $player->sendMessage($this->getMain()->getProvider()->getMessage("private-chat.target.myself"));
                                return;
                            }
                            $message = $this->getMain()->getProvider()->getMessage("private-chat.message");
                            $set = str_replace("%SENDER%", $player, $message);
                            $target->sendWisper($set);
                            $target->sendWisper($text);
                            foreach ($this->playerList as $_player){
                                unset ($this->playerList[$_player->getName()]);
                            }
                        }
                    }
                }
            }
        );

        foreach ($this->getMain()->getServer()->getOnlinePlayers() as $target){
            $_player = $target->getPlayer();
            $this->playerList[$target->getName()] = $_player;
            $list[] = $target->getName();
        }

        $form->setTitle($this->getMain()->getProvider()->getMessage("private-chat.setTitle"));
        $form->addDropdown($this->getMain()->getProvider()->getMessage("private-chat.addDropdown.player"), $list);
        //$form->addInput($this->getMain()->getProvider()->getMessage("private-chat.addInput.player")); // Input PlayerName
        $form->addInput($this->getMain()->getProvider()->getMessage("private-chat.addInput.text")); // Input text

        $form->sendToPlayer($player);
    }

    /**
     * @return Main
     */
    public function getMain(): Main{
        return $this->main;
    }

}
