<?php

namespace App\Http\Controllers\backend\admin;
use App\Http\Controllers\Controller;
use App\Http\Middleware\AdminAuthenticationMiddleware;
use App\Http\Middleware\BackendAuthenticationMiddleware;
use Illuminate\Http\Request;
use App\Models\Rack;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PDOException;

class RacksController extends Controller implements HasMiddleware
{ //
    public static function middleware(): array
    {
      return [
        BackendAuthenticationMiddleware::class,
        AdminAuthenticationMiddleware::class
      ];
    }



    public function racks(Request $request){

        if ($request->isMethod('post')) {
            $id = 0;
            $id = $request->id;
            try {
                if ($id < 1) {
                    Rack::create([
                    'name' => $request->name,
                    'created_by' =>Auth::user()->id,
                    ]);
                    return back()->with('success', 'Added Successfully');
                } elseif ($id > 0) {
                    $racks = Rack::find($id);
                    $racks->update([
                          'name' => $request->name,

                    ]);
                    return back()->with('success', 'Updated Successfully');
                }
            } catch (PDOException $e) {
                return back()->with('error', 'Failed Please Try again');
            }
        }
        $data['racks_list'] = DB::table('racks')->select('id', 'name')->get();
        $data['active_menu'] = 'racks';
        $data['page_title'] = 'Racks List';
        return view('backend.admin.pages.racks', compact('data'));

    }

    public function rack_delete($id)
    {
        $server_response =  ['status' => 'FAILED', 'message' => 'Not Found'];
        $racks = Rack::find($id);
        if ($racks) {

            $racks->delete();
            $server_response =  ['status' => 'SUCCESS', 'message' => 'Deleted Successfully'];
        }
        echo json_encode($server_response);
    }
}
