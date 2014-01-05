<?php

class Entry extends Eloquent{
    protected $table = 'entries';
    
    public function user() {
        return $this->belongsTo('User');
    }
}
?>