<?php

namespace App\Http\Controllers;

use App\Services\CountryServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CountryController extends Controller
{
    public function index(CountryServices $countries)
    {
        return view('dashboard.pages.countries.index', ['countries' => $countries->getAll()]);
    }
    public function editIndex($id, CountryServices $countries)
    {
        return view('dashboard.pages.countries.edit', ['country' => $countries->getById($id)]);
    }


    public function postCreate(Request $req, CountryServices $countryServices)
    {
        $validator = Validator::make($req->all(), [
            'name' => 'required|string|unique:countries',
        ]);
        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput($req->all());
        }

        try {
            $countryServices->create($req);
            toastr()->success('The country was created.', 'Success');
            return back();
        } catch (\Exception $ex) {
            toastr()->Error($ex->getMessage(), 'Error');
            return back()
                ->withInput($req->all());
        }
    }
    public function postEdit(Request $req, CountryServices $countryServices)
    {
        $validator = Validator::make($req->all(), [
            'name' => 'required|unique:countries,id,' . $req->id

        ]);
        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput($req->all());
        }

        try {
            $countryServices->edit($req);
            toastr()->success('The country has been updated.', 'Success');
            return back();
        } catch (\Exception $ex) {
            toastr()->Error($ex->getMessage(), 'Error');
            return back()
                ->withInput($req->all());
        }
    }
    public function delete($id, CountryServices $countryServices)
    {

        try {
            $countryServices->delete($id);
            toastr()->success('The country was deleted.', 'Success');
            return back();
        } catch (\Exception $ex) {
            toastr()->Error($ex->getMessage(), 'Error');
            return back();
        }
    }
}
