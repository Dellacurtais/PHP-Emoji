<?php
namespace Emoji\EmojiReplace;

require_once("EmojiSets.php");
use Emoji\EmojiReplace\EmojiSets as EmojiSets;

class Emoji extends EmojiSets {
	
	public function __construct(){
			
	}
	
	public function getCss($css = null){
		if ($css){
			return $css;
		}else{
			return "{$this->DirAssets}emoji.css";
		}
	}
	
	public function getIconLink($name,$EmojiPack = null){
		if (is_null($EmojiPack)){
			return "{$this->DirAssets}Icons/{$this->PackIcon}/{$name}.png";
		}else{
			return "{$this->DirAssets}Icons/{$EmojiPack}/{$name}.png";	
		}
	}
	
	public function getEmoji($emoji,$EmojiPack = null){
		if (!$this->LoadEmoji){
			$this->LoadEmojis();	
		}
		if (!isset($this->ListEmoji[$emoji])){
			return $emoji;
		}
		if ($this->ImgToBase64){
			$src = $this->ImageToBase64($this->getIconLink($this->ListEmoji[$emoji]));
		}else{
			$src = $this->getIconLink($this->ListEmoji[$emoji]);
		}
		
		$img = "<img class='emojiMco' alt='{$emoji}' src='{$src}'>";
		
		return $img;	
	}
	
	public function LoadEmojis($only = false){
		if ($only){
			$this->ListEmoji = json_decode(file_get_contents(__DIR__."/DataJson/emojiList.json"),1);
			$this->LoadEmoji = true;
			return;
		}
		$this->ListEmoji = json_decode(file_get_contents(__DIR__."/DataJson/emojiList.json"),1);
		$this->Emojis = json_decode(file_get_contents(__DIR__."/DataJson/emoji.json"),1);
		$this->LoadEmoji = true;
	}
	
	public function ImageToBase64($img){
		$imgData = base64_encode(file_get_contents($img));
		return 'data: '.mime_content_type($img).';base64,'.$imgData;
	}
	
	public function TextReplace($text){
		if (!$this->LoadEmoji){
			$this->LoadEmojis();	
		}
				
		$Keys = array_keys($this->Emojis);
		$Code = array_values($this->Emojis);

		$results = str_replace($Keys,$Code, $text);
		return $results;
	}
	
	public function generateEmoji(){
		$Build = false;		
		if (file_exists(__DIR__."/DataJson/emojiConfig.json")){
			$this->LastConfig = file_get_contents(__DIR__."/DataJson/emojiConfig.json");
			if ($this->LastConfig != $this->PackIcon){
				$Build = true;	
			}			
		}else{
			$Build = true;
		}
				
		if ($Build){
			$this->LoadEmojis(true);
			$Array = array();
			foreach ($this->ListEmoji as $Char=>$Code){
				$Array[$Char] = $this->getEmoji($Char);
			}
			$this->Emojis = $Array; 
			file_put_contents(__DIR__."/DataJson/emoji.json",json_encode($Array));
			file_put_contents(__DIR__."/DataJson/emojiConfig.json",$this->PackIcon);
		}
	}
}