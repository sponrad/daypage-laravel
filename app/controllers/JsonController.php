<?php
class JsonController extends BaseController {
  public function __construct(){
    //    $this->beforeFilter('csrf', array('on'=>'post'));
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
      if ($entry->user_id != $user->id){
	return Response::json( array('response' => 0, 'entryId' => $entry->id) );
      } 
    }
    else{
      $entry = new Entry;
    }
    $entry->user()->associate($user);
    $entry->date = Input::get('date'); 
    $entry->content = Input::get('content');
//    $entry->title = substr(explode("\n", Input::get('content'))[0], 0, 100);    
    $entry->save();

    return Response::json( array('response' => 1, 'entryId' => $entry->id) );
  }

  public function postDeleteEntry(){
    $user = Auth::user();
    $entry = Entry::find( intval( Input::get('id')));
    if ($entry->user_id == $user->id){
      $entry->delete();
      return Response::json( array('response' => 1) );      
    }
    else {
      return Response::json( array('response' => 0, 'entryId' => $entry->id) );
    }
  }

}

?>
