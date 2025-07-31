<?php



namespace App\Http\Controllers\backend\admin;



use App\Http\Controllers\Controller;

use App\Http\Middleware\AdminAuthenticationMiddleware;

use App\Http\Middleware\BackendAuthenticationMiddleware;

use Illuminate\Http\Request;

use App\Models\BookIssue;

use Illuminate\Routing\Controllers\HasMiddleware;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\DB;

use Intervention\Image\Facades\Image;

use Illuminate\Support\Facades\File;

use PDOException;



class BookIssueController extends Controller implements HasMiddleware

{

    public static function middleware(): array

    {

        return [

            BackendAuthenticationMiddleware::class,

            AdminAuthenticationMiddleware::class

        ];

    }



    public function book_issue(Request $request)

    {



        // $test = DB::connection('secondary_db')->table('members')->get();

        // dd($test);

        $data = [];

        if ($request->isMethod('post')) {





            try {

             BookIssue::create([



                    'membership_number' => $request->membership_number,

                    'rack_id' => $request->rack_id,

                    'category_id' => $request->category_id,

                    'book_id' => $request->book_id,

                    'issue_date' => date('Y-m-d', strtotime($request->issue_date)),

                    'return_date' => date('Y-m-d', strtotime($request->return_date)),

                    'status'=>0,

                    'created_by' => Auth::user()->id,

                ]);





                return back()->with('success', 'Added Successfully');

            } catch (PDOException $e) {

                return back()->with('error', 'Failed Please Try Again' . $e);

            }

        }

        $data['book_category'] = DB::table('book_categories')->get();

        $data['racks'] = DB::table('racks')->get();

        $data['active_menu'] = 'book_issue';

        $data['page_title'] = 'Book Issue';

        return view('backend.admin.pages.book_issue', compact('data'));

    }





    public function get_book_list(Request $request)

    {

        $rack_id = $request->input('rack_id');

        $category_id = $request->input('category_id');

        $query = DB::table('books')

            ->select('id', 'name', 'volume_no', 'total_copy', 'author');



        // Apply rack_id filter if provided

        if (!empty($rack_id)) {

            $query->where('rack_id', $rack_id);

        }



        // Apply category_id filter if provided

        if (!empty($category_id)) {

            $query->where('category_id', $category_id);

        }



        $get_book_list = $query->get();



        if ($get_book_list) {

            return response()->json($get_book_list, JSON_UNESCAPED_UNICODE);

        } else response()->json([], JSON_UNESCAPED_UNICODE);

    }

    public function get_member_info(Request $request)

    {



        //$patient_info =DB::table('patients')->where('id', $patient_id )->first();

        $get_member_info = DB::table('members')->where('membership_number', $request->membership_number) ->first();



        if($get_member_info) {

            return response()->json($get_member_info, JSON_UNESCAPED_UNICODE);

        } else response()->json([], JSON_UNESCAPED_UNICODE);

    }


    public function get_book_info($id)

    {



        //$patient_info =DB::table('patients')->where('id', $patient_id )->first();

        $get_book_info = DB::table('books')->where('id', $id) ->first();



        if($get_book_info) {

            return response()->json($get_book_info, JSON_UNESCAPED_UNICODE);

        } else response()->json([], JSON_UNESCAPED_UNICODE);

    }



    public function get_returning_books(Request $request){

        $data=[];



        if ($request->isMethod('post')) {

            $id = 0;

            $id = $request->id;

            try {



                    $book_issues = BookIssue::find($id);

                    $actual_return_date = date('Y-m-d', strtotime($request->actual_return_date));

                    if($actual_return_date <= $book_issues->return_date){

                        $book_issues->update([

                            'actual_return_date' =>   $actual_return_date,

                            'status' =>1



                      ]);

                    }elseif($actual_return_date > $book_issues->return_date){

                        $book_issues->update([

                            'actual_return_date' =>   $actual_return_date,

                            'status' =>2



                      ]);

                    }



                    return back()->with('success', 'Updated Successfully');



            } catch (PDOException $e) {

                return back()->with('error', 'Failed Please Try again');

            }

        }

        $data['returning_books']= DB::table('book_issues')

        ->leftJoin('books', 'books.id', '=', 'book_issues.book_id')

        ->leftJoin('book_categories', 'book_categories.id', '=', 'book_issues.category_id')

        ->leftJoin('members', 'book_issues.membership_number', '=', 'members.membership_number')
        ->select('book_issues.id', 'books.name as book_name', 'books.photo as book_photo','book_issues.issue_date',  'book_issues.membership_number','book_issues.return_date', 'book_issues.actual_return_date', 'book_categories.name as category', 'members.name')

        ->where('book_issues.status', 0)

        ->get();



        $data['active_menu'] = 'returning_books';

        $data['page_title'] = 'Returning Books';

        return view('backend.admin.pages.returning_books', compact('data'));

    }

    public function get_returning_books_delete($id)

    {

        $server_response =  ['status' => 'FAILED', 'message' => 'Not Found'];

        $book_issue = BookIssue::find($id);

        if ($book_issue) {



            $book_issue->delete();

            $server_response =  ['status' => 'SUCCESS', 'message' => 'Deleted Successfully'];

        } else {

            $server_response =  ['status' => 'FAILED', 'message' => 'Not Found'];

        }

        echo json_encode($server_response);

    }

    public function get_returned_books(Request $request){

        $data=[];

        $page_no = $request->page;

        $data_limit = 10;

        $data['serial'] = (($page_no ?? 1) - 1) * $data_limit;

        $data['returned_books']= DB::table('book_issues')

        ->leftJoin('books', 'books.id', '=', 'book_issues.book_id')
 ->leftJoin('members', 'book_issues.membership_number', '=', 'members.membership_number')
        ->select('book_issues.id', 'books.name as book_name', 'books.photo as book_photo','book_issues.issue_date',  'book_issues.membership_number','book_issues.return_date', 'book_issues.actual_return_date', 'book_categories.name as category', 'members.name')
        ->leftJoin('book_categories', 'book_categories.id', '=', 'book_issues.category_id')

        ->select('book_issues.id', 'books.name as book_name', 'books.photo as book_photo', 'book_issues.membership_number','book_issues.issue_date', 'book_issues.return_date', 'book_issues.actual_return_date', 'book_categories.name as category', 'book_issues.status', 'members.name')

        ->where('book_issues.status', '!=', 0)

        ->paginate($data_limit);

        $data['active_menu'] = 'returned_books';

        $data['page_title'] = 'Returned Books';

        return view('backend.admin.pages.returned_books', compact('data'));

    }





    public function report(Request $request){

        $data=[];

        if ($request->isMethod('post')) {

            $data['start_date'] = $request->input("start_date", '');

            $data['end_date'] = $request->input("end_date", '');

            $data['membership_number'] = $request->input("membership_number", '');

            $data['status'] = $request->input("status", 'all');



            $query = DB::table('book_issues')

            ->leftJoin('books', 'books.id', '=', 'book_issues.book_id')
 ->leftJoin('members', 'book_issues.membership_number', '=', 'members.membership_number')
        ->select('book_issues.id', 'books.name as book_name', 'books.photo as book_photo','book_issues.issue_date',  'book_issues.membership_number','book_issues.return_date', 'book_issues.actual_return_date', 'book_categories.name as category', 'members.name')
            ->leftJoin('book_categories', 'book_categories.id', '=', 'book_issues.category_id')

            ->select('book_issues.id', 'books.name as book_name', 'books.photo as book_photo', 'book_issues.membership_number','book_issues.issue_date', 'book_issues.return_date', 'book_issues.actual_return_date', 'book_categories.name as category', 'book_issues.status','members.name');



            if (!empty($data['start_date']) && !empty($data['end_date'])) {

                $query->whereBetween('book_issues.issue_date', [$data['start_date'], $data['end_date']]);

            }

              if (!empty($data['membership_number'])) {

                $query->where('book_issues.membership_number', $data['membership_number']);

            }

            if (in_array($data['status'], ['0','1', '2'])) {

                $query->where('book_issues.status', $data['status']);

            }





            $data['report'] = $query->get();

            // dd($data);

            return view('backend.admin.pages.report_print', compact('data'));

        }

        $data['active_menu'] = 'report';

        $data['page_title'] = 'Report';

        return view('backend.admin.pages.report', compact('data'));

    }

}

