<?php

namespace App\Http\Controllers;

use App\Models\Detail;
use App\Models\Language;
use Illuminate\Http\Request;

class DetailController extends Controller
{



    public function store(Request $request)
    {
        $detail = Detail::create([
            'apartment_id' => $request->apartment_id,
        ]);

        return $this->saveDetail($detail, $request);
    }






    public function update(Request $request, Detail $detail)
    {
        return $this->saveDetail($detail, $request);
    }






    public function destroy(Detail $detail)
    {
        $detail->delete();

        return redirect()->back();
    }





    public function saveDetail(Detail $detail, Request $request): \Illuminate\Http\RedirectResponse
    {
        foreach (Language::all() as $language) {
            $name = 'name_' . $language->code;
            $value = 'value_' . $language->code;

            $detail->setTranslation('name', $language->code, $request->$name);
            $detail->setTranslation('value', $language->code, $request->$value);
            $detail->save();
        }

        return redirect()->back();
    }
}
