<?php

namespace jp\mazaicrafty\pmmp\FormInfo\form;

use pocketmine\Player;
use pocketmine\Server;
use pocketmine\level\Level;
use jp\mazaicrafty\pmmp\FormInfo\Main;
use jp\mazaicrafty\pmmp\FormInfo\interfaces\CallAction;
use jp\mazaicrafty\pmmp\FormInfo\{EventListener, Provider};

class PlayerStatus implements CallAction{

    const BACK_BUTTON = 0;

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
    public function createPlayerStatus(Player $player){
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

        $money = $this->getMain()->getEconomy()->myMoney($player->getName());
        $replace = [
            "%MONEY%",
            "%PLAYER%",
            "%X%",
            "%Y%",
            "%Z%",
            "{NL}",
            "%PING%",
            "%IP%",
            "%UUID%",
            "%XUID%",
            "%HEALTH%",
            "%MAXHEALTH%",
            "%FIRSTPLAYED%",
            "%LASTPLAYERD%"
        ];
        $str = [
            $money,
            $player->getName(),
            $player->getX(), $player->getY(),
            $player->getZ(),
            "\n", 
            $player->getPing(),
            $player->getAddress(),
            $player->getUniqueId(),
            $player->getXuid(),
            $player->getHealth(),
            $player->getMaxHealth(),
            $player->getFirstPlayed(),
            $player->getLastPlayed()
        ];
        $content = str_replace($replace , $str, $this->getMain()->getProvider()->getMessage("player_status.setContent"));

        $form->setTitle($this->getMain()->getProvider()->getMessage("player_status.setTitle"));
        $form->addButton($this->getMain()->getProvider()->getMessage("player_status.addButton.back")); // Close the Menu
        $form->setContent($content);

        $form->sendToPlayer($player);
    }

    /**
     * @return Main
     */
    public function getMain(): Main{
        return $this->main;
    }

}
