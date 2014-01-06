<?php
class AjaxController extends BaseController {

  public function getEntries(){
    $user = Auth::user();
    $entries = Entry::where('user_id', '=', $user->id)->get();
    
    return View::make('ajaxEntries')->with(array('entries' => $entries));
  }

}
?>
