<?php
class AjaxController extends BaseController {

  public function getEntries(){
    $user = Auth::user();

    if (Input::has("date")){
      $date = date('Y-m-d H:i:s', strtotime( Input::get('date') )); 
      $entries = Entry::where('user_id', '=', $user->id)->where('date', '=', $date)->get();      
    }
    else{
      $entries = Entry::where('user_id', '=', $user->id)->get();
    }
   
   
    return View::make('ajaxEntries')->with(array('entries' => $entries));
  }

  public function loadEditor(){
    $user = Auth::user();
    
    if (Input::has("id")){
      $entry = Entry::find(parseint(Input::get("id")));
    }
    else{
      $entry = null;
    }

    return View::make('ajaxLoadEditor')->with(array('entry' => $entry));
  }

}
?>
