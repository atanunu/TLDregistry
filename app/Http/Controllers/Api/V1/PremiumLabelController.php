<?php
namespace App\Http\Controllers\Api\V1;
use App\Models\Tld; use App\Models\PremiumLabel;
use Illuminate\Http\Request; use App\Http\Controllers\Controller;

class PremiumLabelController extends Controller{
    public function index(Tld $tld){return $tld->premiumLabels;}
    public function store(Request $r,Tld $tld){
        $data=$r->validate(['label'=>'required','fee'=>'required','currency'=>'required','status'=>'required']);
        return $tld->premiumLabels()->create($data);
    }
    public function update(Request $r,Tld $tld, PremiumLabel $label){
        $label->update($r->all()); return $label;
    }
    public function destroy(Tld $tld, PremiumLabel $label){$label->delete(); return response()->noContent();}
}
