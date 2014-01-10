<?php
class AjaxController extends BaseController {

  public function getEntries(){
    $user = Auth::user();

    if (Input::has("date")){
      $date = date('Y-m-d', strtotime( Input::get('date') )); 
      $entries = Entry::where('user_id', '=', $user->id)->where('date', '=', $date)->get();      
    }
    else{
      $entries = Entry::where('user_id', '=', $user->id)->get();
    }
   
    return View::make('ajaxEntries')->with(
      array('entries' => $entries,
	    'date' => $date,
	    ));
  }

  public function postLoadEditor(){
    $user = Auth::user();
    
    if (Input::has("id")){
      $entry = Entry::find(intval(Input::get('id')));
      $content = $entry->content;
      //$content = Entry::find(1)->content;
      $id = $entry->id;
    }
    else{
      $content = "";
      $id = "";
    }

    return View::make('ajaxLoadEditor')->with(array(
      'content' => $content,
      'id' => $id
    ));
    //return View::make('ajaxLoadEditor');
  }

}
?>
