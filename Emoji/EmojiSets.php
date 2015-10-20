<?php
namespace Emoji\EmojiReplace;

class EmojiSets {
		
	/**
	*	@ImageToBase64
	*/
	public $ImgToBase64 = false;
	
	/**
	*	@DirAssets Set the default dir fot icon packpage
	*/
	public $DirAssets = "./Emoji/AssetsEmoji/";
	
	/**
	*	@PackIcon Set the default Packpage icon for replace
	*/
	public $PackIcon = "IconsIphone";
	
	/**
	*	@LoadEmoji
	*/
	public $LoadEmoji = false;
	public $ListEmoji;
	public $Emojis;
	public $LastConfig;
	
	public function setDirAssets($dir){
		$this->DirAssets = $dir;		
	}
	
	public function setDirPack($Pack){
		$this->PackIcon = $Pack;		
	}
	
	public function setImgToBase64($bool){
		$this->ImgToBase64 = false;		
	}
}