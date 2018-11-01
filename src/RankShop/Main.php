<?php

declare(strict_types=1);

namespace RankShop;

use pocketmine\plugin\PluginBase;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\event\Listener;
use jojoe77777\FormAPI;
use pocketmine\event\player\PlayerInteractEvent;
use pocketmine\utils\Config;
use pocketmine\event\player\PlayerCommandPreprocessEvent;
use pocketmine\event\server\ServerCommandEvent;
use pocketmine\Player;
use pocketmine\Server;
use onebone\economyapi\EconomyAPI;
use RankShop\Main;

class Main extends PluginBase implements Listener{
    
    public function onEnable(){
        $this->getLogger()->info("§aStarting RankShopUI plugin...");
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
		$this->eco = $this->getServer()->getPluginManager()->getPlugin("EconomyAPI");
		
		@mkdir($this->getDataFolder());
        $this->saveDefaultConfig();
        $this->getResource("config.yml");
    }

    public function checkDepends(){
        $this->formapi = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
        if(is_null($this->formapi)){
            $this->getLogger()->error("§4Please install FormAPI Plugin, disabling RankShopUI plugin...");
            $this->getPluginLoader()->disablePlugin($this);
        }
    }

    public function onCommand(CommandSender $sender, Command $cmd, string $label, array $args):bool{
        if($cmd->getName() == "rankshop"){
        if(!($sender instanceof Player)){
                $sender->sendMessage("§cPlease use this command from In-game!", false);
                return true;
        }
        $api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
        $form = $api->createSimpleForm(function (Player $sender, $data){
            $result = $data;
            if ($result == null) {
            }
            switch ($result) {
                    case 0:
                    $sender->sendMessage($this->getConfig()->get("cancelled"));
                        break;
                    case 1:
                    $this->LEGEND($sender);
                        break;
                    case 2:
                    $this->ULTRA($sender);
                        break;
                    case 3:
                    $this->ANON($sender);
                        break;
                    case 4:
                    $this->OMEGA($sender);
                        break;
                    case 5:
                    $this->SUPREME($sender);
                        break;
                    case 6:
                    $this->PLAT($sender);
                        break;
                    case 7:
                    $this->ROSIT($sender);
                        break;
                    case 8:
                    $this->ARCANE($sender);
                        break;
                    case 9:
                    $this->COLOSSAL($sender);
                        break;
                    $this->EXOTIC($sender);
					    break;
            }
        });
        $form->setContent("Please choose what rank you want to buy");
        $form->addButton("§cExit", 0);
        $form->addButton("LEGEND", 1);
        $form->addButton("ULTRA", 2);
        $form->addButton("ANON", 3);
        $form->addButton("OMEGA", 4);
        $form->addButton("SUPREME", 5);
        $form->addButton("PLAT", 6);
        $form->addButton("ROSIT", 7);
        $form->addButton("ARCANE", 8);
        $form->addButton("COLOSSAL", 9);
        $form->addButton("EXOTIC", 10);		
       $form->sendToPlayer($sender);
        }
        return true;
    }

    public function LEGEND($sender){
        $api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
        $form = $api->createModalForm(function (Player $sender, $data){
            $result = $data;
            if ($result == null) {
            }
            switch ($result) {
                    case 1:
            $money = $this->eco->myMoney($sender);
            $legend = $this->getConfig()->get("legend.cost");
            if($money >= $legend){
                
               $this->eco->reduceMoney($sender, $legend);
            $this->getServer()->dispatchCommand(new ConsoleCommandSender(), "setgroup " . $sender->getName() . " legend");
            return true;
               $sender->sendMessage($this->getConfig()->get("legend.buy.success"));
              return true;
            }else{
               $sender->sendMessage($this->getConfig()->get("legend.no.money"));
            }
                        break;
                    case 2:
               $sender->sendMessage($this->getConfig()->get("legend.cancelled"));
                        break;
            }
        });
        $form->setTitle("§lLEGEND");
        $form->setContent($this->getConfig()->get("legend.content"));
        $form->setButton1("Confirm", 1);
        $form->setButton2("Cancel", 2);
        $form->sendToPlayer($sender);
    }

    public function ULTRA($sender){
        $api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
        $form = $api->createModalForm(function (Player $sender, $data){
            $result = $data;
            if ($result == null) {
            }
            switch ($result) {
                    case 1:
            $money = $this->eco->myMoney($sender);
            $ultra = $this->getConfig()->get("ultra.cost");
            if($money >= $legend){
                
               $this->eco->reduceMoney($sender, $ultra);
            $this->getServer()->dispatchCommand(new ConsoleCommandSender(), "setgroup " . $sender->getName() . " ultra");
            return true;
               $sender->sendMessage($this->getConfig()->get("ultra.buy.success"));
              return true;
            }else{
               $sender->sendMessage($this->getConfig()->get("ultra.no.money"));
            }
                        break;
                    case 2:
               $sender->sendMessage($this->getConfig()->get("ultra.cancelled"));
                        break;
            }
        });
        $form->setTitle("§lULTRA");
        $form->setContent($this->getConfig()->get("ultra.content"));
        $form->setButton1("Confirm", 1);
        $form->setButton2("Cancel", 2);
        $form->sendToPlayer($sender);
    }

    public function ANON($sender){
        $api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
        $form = $api->createModalForm(function (Player $sender, $data){
            $result = $data;
            if ($result == null) {
            }
            switch ($result) {
                    case 1:
            $money = $this->eco->myMoney($sender);
            $anon = $this->getConfig()->get("anon.cost");
            if($money >= $anon){
                
               $this->eco->reduceMoney($sender, $anon);
            $this->getServer()->dispatchCommand(new ConsoleCommandSender(), "setgroup " . $sender->getName() . " anon");
            return true;
               $sender->sendMessage($this->getConfig()->get("anon.buy.success"));
              return true;
            }else{
               $sender->sendMessage($this->getConfig()->get("anon.no.money"));
            }
                        break;
                    case 2:
               $sender->sendMessage($this->getConfig()->get("anon.cancelled"));
                        break;
            }
        });
        $form->setTitle("§lANON");
        $form->setContent($this->getConfig()->get("anon.content"));
        $form->setButton1("Confirm", 1);
        $form->setButton2("Cancel", 2);
        $form->sendToPlayer($sender);
    }
	
    public function OMEGA($sender){
        $api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
        $form = $api->createModalForm(function (Player $sender, $data){
            $result = $data;
            if ($result == null) {
            }
            switch ($result) {
                    case 1:
            $money = $this->eco->myMoney($sender);
            $omega = $this->getConfig->get("omega.cost");
            if($money >= $omega){
                
               $this->eco->reduceMoney($sender, $omega);
            $this->getServer()->dispatchCommand(new ConsoleCommandSender(), "setgroup " . $sender->getName() . " omega");
            return true;
               $sender->sendMessage($this->getConfig()->get("omega.buy.success"));
              return true;
            }else{
               $sender->sendMessage($this->getConfig()->get("omega.no.money"));
            }
                        break;
                    case 2:
               $sender->sendMessage($this->getConfig()->get("omega.cancelled"));
                        break;
            }
        });
        $form->setTitle("§lOMEGA");
        $form->setContent($this->getConfig()->get("omega.content"));
        $form->setButton1("Confirm", 1);
        $form->setButton2("Cancel", 2);
        $form->sendToPlayer($sender);
    }
	
	    public function SUPREME($sender){
        $api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
        $form = $api->createModalForm(function (Player $sender, $data){
            $result = $data;
            if ($result == null) {
            }
            switch ($result) {
                    case 1:
            $money = $this->eco->myMoney($sender);
            $supreme = $this->getConfig()->get("supreme.cost");
            if($money >= $supreme){
                
               $this->eco->reduceMoney($sender, $supreme);
            $this->getServer()->dispatchCommand(new ConsoleCommandSender(), "setgroup " . $sender->getName() . " supreme");
            return true;
               $sender->sendMessage($this->getConfig()->get("supreme.buy.success"));
              return true;
            }else{
               $sender->sendMessage($this->getConfig()->get("supreme.no.money"));
            }
                        break;
                    case 2:
               $sender->sendMessage($this->getConfig()->get("supreme.cancelled"));
                        break;
            }
        });
        $form->setTitle("§lSUPREME");
        $form->setContent($this->getConfig()->get("supreme.content"));
        $form->setButton1("Confirm", 1);
        $form->setButton2("Cancel", 2);
        $form->sendToPlayer($sender);
    }
	
	    public function PLAT($sender){
        $api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
        $form = $api->createModalForm(function (Player $sender, $data){
            $result = $data;
            if ($result == null) {
            }
            switch ($result) {
                    case 1:
            $money = $this->eco->myMoney($sender);
            $plat = $this->getCofig()->get("plat.cost");
            if($money >= $plat){
                
               $this->eco->reduceMoney($sender, $plat);
            $this->getServer()->dispatchCommand(new ConsoleCommandSender(), "setgroup " . $sender->getName() . " plat");
            return true;
               $sender->sendMessage($this->getConfig()->get("plat.buy.success"));
              return true;
            }else{
               $sender->sendMessage($this->getConfig()->get("plat.no.money"));
            }
                        break;
                    case 2:
               $sender->sendMessage($this->getConfig()->get("plat.cancelled"));
                        break;
            }
        });
        $form->setTitle("§lPLAT");
        $form->setContent($this->getConfig()->get("plat.content"));
        $form->setButton1("Confirm", 1);
        $form->setButton2("Cancel", 2);
        $form->sendToPlayer($sender);
    }
	
	    public function ROSIT($sender){
        $api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
        $form = $api->createModalForm(function (Player $sender, $data){
            $result = $data;
            if ($result == null) {
            }
            switch ($result) {
                    case 1:
            $money = $this->eco->myMoney($sender);
            $rosit = $this->getConfig()->get("rosit.cost");
            if($money >= $rosit){
                
               $this->eco->reduceMoney($sender, $rosit);
            $this->getServer()->dispatchCommand(new ConsoleCommandSender(), "setgroup " . $sender->getName() . " rosit");
            return true;
               $sender->sendMessage($this->getConfig()->get("rosit.buy.success"));
              return true;
            }else{
               $sender->sendMessage($this->getConfig()->get("rosit.no.money"));
            }
                        break;
                    case 2:
               $sender->sendMessage($this->getConfig()->get("rosit.cancelled"));
                        break;
            }
        });
        $form->setTitle("§lROSIT");
        $form->setContent($this->getConfig()->get("rosit.content"));
        $form->setButton1("Confirm", 1);
        $form->setButton2("Cancel", 2);
        $form->sendToPlayer($sender);
    }
	
	    public function ARCANE($sender){
        $api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
        $form = $api->createModalForm(function (Player $sender, $data){
            $result = $data;
            if ($result == null) {
            }
            switch ($result) {
                    case 1:
            $money = $this->eco->myMoney($sender);
            $arcane = $this->getConfig()->get("arcane.cost");
            if($money >= $arcane){
                
               $this->eco->reduceMoney($sender, $arcane);
            $this->getServer()->dispatchCommand(new ConsoleCommandSender(), "setgroup " . $sender->getName() . " arcane");
            return true;
               $sender->sendMessage($this->getConfig()->get("arcane.buy.success"));
              return true;
            }else{
               $sender->sendMessage($this->getConfig()->get("arcane.no.money"));
            }
                        break;
                    case 2:
               $sender->sendMessage($this->getConfig()->get("arcane.cancelled"));
                        break;
            }
        });
        $form->setTitle("§lARCANE");
        $form->setContent($this->getConfig()->get("arcane.content"));
        $form->setButton1("Confirm", 1);
        $form->setButton2("Cancel", 2);
        $form->sendToPlayer($sender);
    }
	
	    public function COLOSSAL($sender){
        $api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
        $form = $api->createModalForm(function (Player $sender, $data){
            $result = $data;
            if ($result == null) {
            }
            switch ($result) {
                    case 1:
            $money = $this->eco->myMoney($sender);
            $colossal = $this->getConfig()->get("colossal.cost");
            if($money >= $colossal){
                
               $this->eco->reduceMoney($sender, $colossal);
            $this->getServer()->dispatchCommand(new ConsoleCommandSender(), "setgroup " . $sender->getName() . " colossal");
            return true;
               $sender->sendMessage($this->getConfig()->get("colossal.buy.success"));
              return true;
            }else{
               $sender->sendMessage($this->getConfig()->get("colossal.no.money"));
            }
                        break;
                    case 2:
               $sender->sendMessage($this->getConfig()->get("colossal.cancelled"));
                        break;
            }
        });
        $form->setTitle("§lCOLOSSAL");
        $form->setContent($this->getConfig()->get("colossal.content"));
        $form->setButton1("Confirm", 1);
        $form->setButton2("Cancel", 2);
        $form->sendToPlayer($sender);
    }
	
	    public function EXOTIC($sender){
        $api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
        $form = $api->createModalForm(function (Player $sender, $data){
            $result = $data;
            if ($result == null) {
            }
            switch ($result) {
                    case 1:
            $money = $this->eco->myMoney($sender);
            $exotic = $this->getConfig()->get("exotic.cost");
            if($money >= $exotic){
                
               $this->eco->reduceMoney($sender, $colossal);
            $this->getServer()->dispatchCommand(new ConsoleCommandSender(), "setgroup " . $sender->getName() . " exotic");
            return true;
               $sender->sendMessage($this->getConfig()->get("exotic.buy.success"));
              return true;
            }else{
               $sender->sendMessage($this->getConfig()->get("exotic.no.money"));
            }
                        break;
                    case 2:
               $sender->sendMessage($this->getConfig()->get("exotic.cancelled"));
                        break;
            }
        });
        $form->setTitle("§lEXOTIC");
        $form->setContent($this->getConfig()->get("exotic.content"));
        $form->setButton1("Confirm", 1);
        $form->setButton2("Cancel", 2);
        $form->sendToPlayer($sender);
    }

    public function onDisable(){
        $this->getLogger()->info("§cDisabling RankShopUI plugin...");
    }
}
