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

  public function postLoadEditor(){
    $user = Auth::user();
    
    if (Input::has("id")){
      $content = Entry::find(intval(Input::get('id')))->content;
      //$content = Entry::find(1)->content;
    }
    else{
      $content = "";
    }

    return View::make('ajaxLoadEditor')->with(array('content' => $content));
    //return View::make('ajaxLoadEditor');
  }

}
?>
