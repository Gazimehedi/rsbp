<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RsvpController extends Controller
{
    public function index(){
        return view('index');
    }
    public function cardcodecheck(Request $request){
        $cardcode = $request->cardcode;
        $check = DB::table('invitationmaster')->where('cardCode',$cardcode)->get();
        if(isset($check) && $check != "[]"){
            $request->session()->put('perticipantlogin',true);
            return redirect('perticipantsdetails/'.$cardcode);
        }
        return redirect()->back()->with("error","Your code doesn't found");
    }
    public function perticipantdetails($cardcode){
        $check = DB::table('invitationmaster')
        ->where('cardCode',$cardcode)
        ->join('invitationtypes','invitationmaster.cardType', '=', 'invitationtypes.cardType')
        ->select('invitationmaster.*','invitationtypes.cardType','invitationtypes.typeName','invitationtypes.typeDescription','invitationtypes.typeImage')
        ->get();
        $related = DB::table('invitationparticipants')->where('cardCode',$cardcode)->get();
        if(session()->has('perticipantlogin')){
            return view('userdetails',compact(['check','related']));
        }else{
            return redirect('/')->with('error','Session Timeout');
        }
    }
    public function updateperticipation(Request $request,$id){
        $userpartic = $request->userpartic = "" ? 0 : $request->userpartic;
        $uservacci = $request->uservacci = "" ? 0 : $request->uservacci;
        DB::table('invitationmaster')->where('id',$id)
        ->update([
            'eMail'=>$request->useremail,
            'mobileNo'=>$request->usernum,
            'masterParticipation'=>$userpartic,
            'masterVaccination'=>$uservacci
        ]);
        if($request->relid != ""){
            $relid = $request->relid;
            $relname = $request->relname;
            $relpartic = $request->relpartic;
            $relvacci = $request->relvacci;
            foreach($relid as $key => $val){
                $relinfo['id'] =$val;
                $relinfo['relationshipName'] = isset($relname[$key]) ? $relname[$key] : 0;
                $relinfo['relationshipParticipation'] = isset($relpartic[$key]) ?$relpartic[$key] : 0;
                $relinfo['relationshipVaccination'] = isset($relvacci[$key]) ? $relvacci[$key] : 0;
                $uerupdate = DB::table('invitationparticipants')->where('id',$relid[$key])->update($relinfo);
            }
        }
        if(session()->has('perticipantlogin')){
            return redirect()->back()->with('success','Updated Successfully');
        }else{
            return redirect('/')->with('error','Session Timeout');
        }


    }
    public function comment($id){
        if(session()->has('perticipantlogin')){
            return view('comment',compact('id'));
        }else{
            return redirect('/')->with('error','Session Timeout');
        }
    }
    public function commentupdate(Request $request,$id){
        DB::table('invitationmaster')->where('id',$id)
        ->update(['comments'=>$request->comment]);
        $request->session()->forget('perticipantlogin');
        return redirect('/');
    }
}
