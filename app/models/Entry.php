<?php

class Entry extends Eloquent{
    protected $table = 'entries';
    
    public function user() {
        return $this->belongsTo('User', 'user_id');
    }

    public function group(){
        return $this->belongsTo('Group', 'group_id');
    }
}
?>