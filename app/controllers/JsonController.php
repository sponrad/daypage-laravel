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

}

?>