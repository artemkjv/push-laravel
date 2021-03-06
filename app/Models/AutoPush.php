<?php

namespace App\Models;

use DateTimeZone;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AutoPush extends Model implements Pushable
{
    use HasFactory;

    public const PAGINATE = 10;
    protected $fillable = [
        'id',
        'name',
        'user_id',
        'user_modified_id',
        'time_to_live',
        'interval_value',
        'interval_type',
        'status',
        'template_id'
    ];

    public function apps(){
        return $this->belongsToMany(App::class);
    }

    public function segments(){
        return $this->belongsToMany(Segment::class, 'segment_auto_push');
    }

    public function template(){
        return $this->belongsTo(Template::class);
    }

    public function sentPushes(){
        return $this->morphedByMany(SentPush::class, 'pushable', 'sent_pushes');
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function getTitle()
    {
        return $this->template->getTitle();
    }

    public function getBody()
    {
        return $this->template->getBody();
    }

    public function getIcon()
    {
        return $this->template->icon;
    }

    public function getImage()
    {
        return $this->template->image;
    }

    public function getOpenUrl()
    {
        return $this->template->open_url;
    }

    public function getDeeplink()
    {
        return $this->template->deeplink;
    }

    public function getSound()
    {
        return $this->template->sound;
    }

    public function getTimeToLive()
    {
        return $this->time_to_live;
    }

    public function getTimeToSend($timezone = 'UTC')
    {
        $datetime = new \DateTime('NOW', new DateTimeZone($timezone));
        $datetime->modify("+{$this->interval_value} {$this->interval_type}");
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
