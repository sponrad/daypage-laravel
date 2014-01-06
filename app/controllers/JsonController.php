<?php
class JsonController extends BaseController {
    public function __construct(){
        $this->beforeFilter('csrf', array('on'=>'post'));
    }

    public function getEntries(){
        $user = Auth::user();
        $entries = DB::table("entries")->where("user_id", $user->id)->get();
        return Response::json( $entries );
    }

    public function postSaveEntry(){
        $user = Auth::user();
        
        if (Input::has('id')){
            $entry = Entry::find( intval(Input::get('id')) );
        }
        else{
            $entry = new Entry;
        }
        $entry->user()->associate($user);
        $entry->date = date('Y-m-d H:i:s', strtotime( Input::get('date') )); 
        $entry->content = Input::get('content');
        $entry->title = substr(explode("\n", Input::get('content')[0]), 0, 100);
        $entry->save();

        return Response::json( array('response' => 1) );
    }

}

?>