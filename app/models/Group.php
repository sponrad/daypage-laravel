<?php

class Group extends Eloquent{
    protected $table = 'groups';
    
    public function users() {
        return $this->belongsToMany('User');
    }
    
    public function entries() {
        return $this->hasMany('Entry');
    }
}
?>