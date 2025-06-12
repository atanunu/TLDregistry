<?php
namespace App\Http\Controllers\Api\V1;
use App\Models\Tld; use Illuminate\Http\Request; use App\Http\Controllers\Controller;

class TldFeeController extends Controller{
    public function show(Tld $tld){return $tld->only(['create_fee','renew_fee','restore_fee','currency']);}
    public function update(Request $r,Tld $tld){
        $data=$r->validate(['create_fee'=>'required','renew_fee'=>'required','restore_fee'=>'required','currency'=>'required']);
        $tld->update($data); return $tld;
    }
}
