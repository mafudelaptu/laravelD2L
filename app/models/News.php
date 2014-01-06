<?php

class News extends Eloquent {
	protected $guarded = array();

	public static $rules = array(
		'title' => 'required',
		'content' => 'required',
		'order' => 'required',
		'active' => 'required'
	);


	public static function getAllActiveNews(){
		return News::where("news.active", 1)->orderBy("news.order");
	}
}
