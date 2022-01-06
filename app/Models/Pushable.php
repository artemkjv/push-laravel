<?php


namespace App\Models;


interface Pushable
{

    public function getTitle();

    public function getBody();

    public function getIcon();

    public function getImage();

    public function getOpenUrl();

    public function getDeeplink();

    public function getSound();

    public function getTimeToLive();

    public function getTimeToSend($timezone = 'UTC');

}
