<?php

namespace App\Http\Controllers\backend\admin;
use App\Http\Controllers\Controller;
use App\Http\Middleware\AdminAuthenticationMiddleware;
use App\Http\Middleware\BackendAuthenticationMiddleware;
use Illuminate\Http\Request;
use App\Models\BookCategory;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PDOException;

class BookCategoryController extends Controller implements HasMiddleware
{ //
    public static function middleware(): array
    {
      return [
        BackendAuthenticationMiddleware::class,
        AdminAuthenticationMiddleware::class
      ];
    }



    public function book_category(Request $request){

        if ($request->isMethod('post')) {
            $id = 0;
            $id = $request->id;
            try {
                if ($id < 1) {
                    BookCategory::create([
                    'name' => $request->name,
                    'priority' => $request->priority,
                    'created_by' =>Auth::user()->id,
                    ]);
                    return back()->with('success', 'Added Successfully');
                } elseif ($id > 0) {
                    $racks = BookCategory::find($id);
                    $racks->update([
                          'name' => $request->name,
                          'priority' => $request->priority,

                    ]);
                    return back()->with('success', 'Updated Successfully');
                }
            } catch (PDOException $e) {
                return back()->with('error', 'Failed Please Try again'.$e);
            }
        }
        $data['book_category_list'] = DB::table('book_categories')->select('id', 'name', 'priority')->get();
        $data['active_menu'] = 'book_category';
        $data['page_title'] = 'Book Category List';
        return view('backend.admin.pages.book_category', compact('data'));

    }

    public function book_category_delete($id)
    {
        $server_response =  ['status' => 'FAILED', 'message' => 'Not Found'];
        $book_category = BookCategory::find($id);
        if ($book_category) {

            $book_category->delete();
            $server_response =  ['status' => 'SUCCESS', 'message' => 'Deleted Successfully'];
        }
        echo json_encode($server_response);
    }

    
}
