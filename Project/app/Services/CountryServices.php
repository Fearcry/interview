<?php

namespace App\Services;

use App\Models\Cities;
use App\Models\Countries;

class CountryServices
{
    public function getAll()
    {
        return Countries::all();
    }
    public function getById($id)
    {
        return Countries::where('id', $id)->first();
    }

    public function getByIdWithCities($id)
    {
        return Countries::where('id', $id)->first();
    }
    public function create($req)
    {
        Countries::create([
            'name' => $req->name
        ]);
    }
    public function edit($req)
    {
        $country = Countries::where('id', $req->id)->first();
        if (!isset($country)) {
            throw new \Exception("No such country exists");
        }
        $country->name = $req->name;
        $country->save();
    }
    public function delete($id)
    {
        $country = Countries::where('id', $id)->first();
        if (!isset($country)) {
            throw new \Exception("No such country exists");
        }
        $country->delete();
    }

    public function getByIdCity($id)
    {
        return Cities::where('id', $id)->first();
    }
    public function createCity($req)
    {
        Cities::create([
            'country_id' => $req->country_id,
            'name' => $req->name
        ]);
    }

    public function editCity($req)
    {
        $city = Cities::where('id', $req->id)->first();
        if (!isset($city)) {
            throw new \Exception("No such city exists");
        }
        $city->name = $req->name;
        $city->save();
    }
    public function deleteCity($id)
    {
        $city = Cities::where('id', $id)->first();
        if (!isset($city)) {
            throw new \Exception("No such city exists");
        }
        $city->delete();
    }

}
