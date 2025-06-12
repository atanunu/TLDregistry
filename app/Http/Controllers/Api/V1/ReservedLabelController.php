<?php
namespace App\Http\Controllers\Api\V1;
use App\Models\Tld; use App\Models\ReservedLabel;
use Illuminate\Http\Request; use App\Http\Controllers\Controller;

class ReservedLabelController extends Controller{
    public function index(Tld $tld){return $tld->reservedLabels;}
    public function store(Request $r,Tld $tld){
        $data=$r->validate(['label'=>'required','status'=>'required','reason'=>'nullable']);
        return $tld->reservedLabels()->create($data);
    }
    public function update(Request $r,Tld $tld, ReservedLabel $label){
        $label->update($r->all()); return $label;
    }
    public function destroy(Tld $tld, ReservedLabel $label){$label->delete(); return response()->noContent();}
}
