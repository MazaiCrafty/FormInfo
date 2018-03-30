<?php

namespace jp\mazaicrafty\pmmp\FormInfo\form;

# Player
use pocketmine\Player;
use pocketmine\Server;

# FormInfo
use jp\mazaicrafty\pmmp\FormInfo\Main;
use jp\mazaicrafty\pmmp\FormInfo\interfaces\CallAction;
use jp\mazaicrafty\pmmp\FormInfo\{EventListener, Provider};

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
        $form = $this->getMain()->getForm()->createCustomForm(
            function (Player $player, $args){
                $command = $args[0];
                if($command === null) return;// NOTE: Cancelled

                $this->getMain()->getServer()->dispatchCommand($player, $command);
                return;
            }
        );

        $form->setTitle($this->getMain()->getProvider()->getMessage("console.setTitle"));
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
