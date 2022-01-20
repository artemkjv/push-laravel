<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomPush extends Model implements Pushable
{
    use HasFactory;

    public const PAGINATE = 10;

    protected $casts = [
        'title' => 'array',
        'body' => 'array'
    ];

    protected $fillable = [
        'id',
        'name',
        'user_id',
        'user_modified_id',
        'title',
        'body',
        'open_url',
        'deeplink',
        'image',
        'icon',
        'time_to_live',
        'time_to_send',
    ];

    public function apps(){
        return $this->belongsToMany(App::class);
    }

    public function segments(){
        return $this->belongsToMany(Segment::class, 'segment_custom_push');
    }

    public function sentPushes(){
        return $this->morphedByMany(SentPush::class, 'pushable', 'sent_pushes');
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function getTitle()
    {
        if(is_array($this->title)){
            return $this->title;
        }
        return json_decode($this->title, true);
    }

    public function getBody()
    {
        if(is_array($this->body)){
            return $this->body;
        }
        return json_decode($this->body, true);
    }

    public function getIcon()
    {
        return $this->icon;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function getOpenUrl()
    {
        return $this->open_url;
    }

    public function getDeeplink()
    {
        return $this->deeplink;
    }

    public function getSound()
    {
        return  $this->sound;
    }

    public function getTimeToLive()
    {
        return $this->time_to_live;
    }

    public function getTimeToSend($timezone = 'UTC')
    {
        $datetime = new \DateTime($this->time_to_send, new \DateTimeZone($timezone));
        $datetime->setTimezone(new \DateTimeZone('UTC'));
        return $datetime;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getUser()
    {
        return $this->user;
    }

    public function copy(){
        $new = $this->replicate();
        $new->name = 'Copy ' . $this->name;
        $new->push();
        $this->relations = [];
        $this->load('apps', 'segments');
        foreach ($this->relations as $relationName => $values){
            $new->{$relationName}()->sync($values);
        }
    }

}
