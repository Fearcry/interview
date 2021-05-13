<?php

namespace App\Http\Controllers;

use App\Services\CountryServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CityController extends Controller
{
    public function index($id,CountryServices $countryServices){
        return view('dashboard.pages.cities.index',['country'=>$countryServices->getByIdWithCities($id)]);
    }
    public function editIndex($id,CountryServices $countryServices){
        return view('dashboard.pages.cities.edit',['city'=>$countryServices->getByIdCity($id)]);
    }

    public function postCreate(Request $req, CountryServices  $countryServices){
        $validator = Validator::make($req->all(), [
            'name' => 'required|string|unique:cities',
        ]);
        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput($req->all());
        }

        try {
            $countryServices->createCity($req);
            toastr()->success('The city was created.', 'Success');
            return back();
        } catch (\Exception $ex) {
            toastr()->Error($ex->getMessage(), 'Error');
            return back()
                ->withInput($req->all());
        }
    }
    public function postEdit(Request $req, CountryServices  $countryServices){
        $validator = Validator::make($req->all(), [
            'name' => 'required|unique:cities,id,' . $req->id

        ]);
        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput($req->all());
        }

        try {
            $countryServices->editCity($req);
            toastr()->success('The city has been updated.', 'Success');
            return back();
        } catch (\Exception $ex) {
            toastr()->Error($ex->getMessage(), 'Error');
            return back()
                ->withInput($req->all());
        }
    }
    public function delete($id,CountryServices  $countryServices){

        try {
            $countryServices->deleteCity($id);
            toastr()->success('The city was deleted.', 'Success');
            return back();
        } catch (\Exception $ex) {
            toastr()->Error($ex->getMessage(), 'Error');
            return back();
        }
    }
}

