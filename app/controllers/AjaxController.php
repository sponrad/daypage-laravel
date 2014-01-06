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

}
?>