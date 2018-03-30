<?php

namespace jp\mazaicrafty\pmmp\FormInfo\form;

use pocketmine\Player;
use pocketmine\Server;
use pocketmine\level\Level;
use jp\mazaicrafty\pmmp\FormInfo\Main;
use jp\mazaicrafty\pmmp\FormInfo\interfaces\CallAction;
use jp\mazaicrafty\pmmp\FormInfo\{EventListener, Provider};

class ServerStatus implements CallAction{

    const BACK_BUTTON = 0;
    /**
     * @var Main $main
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
    public function createServerStatus(Player $player){
        $form = $this->getMain()->getForm()->createSimpleForm(
            function (Player $player, $result){
                if($result === null) return;// NOTE: Cancelled

                switch ($result){
                    case Status::BACK_BUTTON:
                    // Back to Menu
                    $this->getMain()->getMenu()->createMenu($player);
                    return;
                }
            }
        );
        //
    }

    /**
     * @return Main
     */
    public function getMain(): Main{
        return $this->main;
    }

}
