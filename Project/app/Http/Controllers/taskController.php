<?php

namespace App\Http\Controllers;

use App\Services\TaskServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class taskController extends Controller
{
    public function create(Request $req, TaskServices $tasks)
    {
        $validator = Validator::make($req->all(), [
            'content' => 'required|max:200',
        ], [], ['content' => 'Task']);
        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput($req->all());
        }
        try {
            $tasks->create($req);
            toastr()->success('New task added.', 'Success');
            return back();
        } catch (\Exception $ex) {
            toastr()->error($ex->getMessage(), 'Error');
            return back();
        }
    }
    public function delete($id, TaskServices $tasks)
    {
        try {
            $tasks->delete($id);
            toastr()->success('Task removed.', 'Success');
            return back();
        } catch (\Exception $ex) {
            toastr()->error($ex->getMessage(), 'Error');
            return back();
        }
    }
}
