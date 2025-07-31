<?php



namespace App\Http\Controllers\backend\admin;



use App\Http\Controllers\Controller;

use App\Http\Middleware\AdminAuthenticationMiddleware;

use App\Http\Middleware\BackendAuthenticationMiddleware;

use Illuminate\Http\Request;

use App\Models\Book;

use Illuminate\Routing\Controllers\HasMiddleware;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\DB;

use Intervention\Image\Facades\Image;

use Illuminate\Support\Facades\File;

use PDOException;



class BookController extends Controller implements HasMiddleware

{

    public static function middleware(): array

    {

        return [

            BackendAuthenticationMiddleware::class,

            AdminAuthenticationMiddleware::class

        ];

    }



    public function book_add(Request $request)

    {

        $data = [];

        if ($request->isMethod('post')) {

            $photo  = $request->file('photo');



            $created_at = date("Y-m-d H:i:s");



            try {

                $newBook = Book::create([

                    'issue_date' => date('Y-m-d', strtotime($request->issue_date)),

                    'name' => $request->name,

                    'category_id' => $request->category_id,

                    'author' => $request->author,

                    'donor_id' => $request->donor_id,

                    'rack_id' => $request->rack_id,

                    'volume_no' => $request->volume_no,

                    'total_volume' => $request->total_volume,

                    'total_copy' => $request->total_copy,

                    'photo' => null,

                    'created_by' => Auth::user()->id,

                    'created_at' => $created_at,

                    'updated_at' => $created_at,

                ]);

                if ($photo) {

                    $photo_extension = $photo->getClientOriginalExtension();

                    $photo_name = 'backend_assets/images/books/' . $newBook->id . '.' . 'jpg';

                    $image = Image::make($photo);

                    $image->resize(300, 450);

                    $image->save($photo_name);



                    $newBook->update(['photo' => $photo_name]);



                } else {



                    $photo_name = 'backend_assets/images/books/' . $newBook->id . '.' . 'jpg';

                    $newBook->update(['photo' => $photo_name]);

                }



                return back()->with('success', 'Added Successfully');

            } catch (PDOException $e) {

                return back()->with('error', 'Failed Please Try Again'.$e);

            }

        }

        $data['book_category'] = DB::table('book_categories')->get();

        $data['donors'] = DB::table('donors')->get();

        $data['racks'] = DB::table('racks')->get();

        $data['active_menu'] = 'book_add';

        $data['page_title'] = 'Book Add';

        return view('backend.admin.pages.book_add', compact('data'));

    }

    public function book_edit(Request $request, $id)

    {

        $data = [];

        $data['book'] = Book::find($id);

        if ($data['book'] != null) {

            if ($request->isMethod('post')) {

                $old_photo = $data['book']->photo;

                $photo  = $request->file('photo');

                if ($photo) {

                    if (File::exists($old_photo)) {

                        File::delete($old_photo);

                    }

                    $photo_extension = $photo->getClientOriginalExtension();

                    $photo_name = 'backend_assets/images/books/' . $data['book']->id . '.' . 'jpg';

                    $image = Image::make($photo);

                    $image->resize(300, 450);

                    $image->save($photo_name);

                } else {

                    $photo_name = $old_photo;

                }



                try {

                    $data['book']->update([

                        'issue_date' => date('Y-m-d', strtotime($request->issue_date)),

                        'name' => $request->name,

                        'category_id' => $request->category_id,

                        'author' => $request->author,

                        'donor_id' => $request->donor_id,

                        'rack_id' => $request->rack_id,

                        'volume_no' => $request->volume_no,

                        'total_volume' => $request->total_volume,

                        'total_copy' => $request->total_copy,

                        'photo' => $photo_name,

                    ]);

                    return back()->with('success', 'Updated Successfully');

                } catch (PDOException $e) {

                    return back()->with('error', 'Failed Please Try Again');

                }

            }

        } else {

            return redirect()->route('admin.book.list')->with('failed', 'Wrong Attempt!');

        }

        $data['book_category'] = DB::table('book_categories')->get();

        $data['donors'] = DB::table('donors')->get();

        $data['racks'] = DB::table('racks')->get();

        $data['active_menu'] = 'book_edit';

        $data['page_title'] = 'Book Edit';

        return view('backend.admin.pages.book_edit', compact('data'));

    }

    public function book_list(Request $request)

    {

        $data = [];

        $page_no = $request->page;

        $data_limit = 10;

        $data['serial'] = (($page_no ?? 1) - 1) * $data_limit;

        $data['book_list'] = DB::table('books')

            ->leftJoin('book_categories', 'books.category_id', '=', 'book_categories.id')

            ->leftJoin('racks', 'books.rack_id', '=', 'racks.id')

            ->select('books.id', 'books.name', 'books.author', 'books.photo', 'books.total_copy',  'books.volume_no', 'book_categories.name as category', 'racks.name as rack_name')

            ->orderByDesc('books.id')

            ->paginate($data_limit);



        $data['book_category'] = DB::table('book_categories')->get();

        $data['rack_list'] = DB::table('racks')->get();



        $data['active_menu'] = 'book_list';

        $data['page_title'] = 'Book List';

        return view('backend.admin.pages.book_list', compact('data'));

    }

    public function book_delete($id)

    {

        $server_response =  ['status' => 'FAILED', 'message' => 'Not Found'];

        $book = Book::find($id);

        if ($book) {

            if (File::exists($book->photo)) {

                File::delete($book->photo);

            }

            $book->delete();

            $server_response =  ['status' => 'SUCCESS', 'message' => 'Deleted Successfully'];

        } else {

            $server_response =  ['status' => 'FAILED', 'message' => 'Not Found'];

        }

        echo json_encode($server_response);

    }



    public function book_bulk_add(Request $request)

    {

        $data = [];



        if ($request->isMethod('post')) {

            $nextId = DB::select("SHOW TABLE STATUS LIKE 'books'")[0]->Auto_increment;

            $book_name = $request->input('name', []);

            $author = $request->input('author', []);

            $volume = $request->input('volume_no', []);

            $totalVolume = $request->input('total_volume', []);

            $totalCopy = $request->input('total_copy', []);

            $created_at = date("Y-m-d H:i:s");

            $books = [];

            try {

                foreach ($book_name as $key => $name) {

                    $books[] = [

                        'issue_date' => date('Y-m-d', strtotime($request->issue_date)),

                        'name' => $name,

                        'category_id' => $request->category_id,

                        'author' => $author[$key],

                        'volume_no' => $volume[$key],

                        'rack_id' => $request->rack_id,

                        'total_volume' => $totalVolume[$key],

                        'total_copy' =>  $totalCopy[$key],

                        'donor_id' => $request->donor_id,

                        'photo' => 'backend_assets/images/books/' . $nextId++ . '.' . 'jpg',

                        'created_by' => Auth::user()->id,

                        'created_at' => $created_at,

                    ];

                }

                Book::insert($books);

                return back()->with('success', 'Added Successfully');

            } catch (PDOException $e) {

                return back()->with('error', 'Failed Please Try Again');

            }

        }

        $data['book_category'] = DB::table('book_categories')->get();

        $data['donors'] = DB::table('donors')->get();

        $data['racks'] = DB::table('racks')->get();

        $data['active_menu'] = 'book_bulk_add';

        $data['page_title'] = 'Book Bulk Add';

        return view('backend.admin.pages.book_bulk_add', compact('data'));

    }





    public function book_search(Request $request)

    {

        $data = [];

        if ($request->isMethod('post')) {

            $data['book_name'] = $request->input("name", '');

            $data['category'] = $request->input("category", 0);

            $data['rack_id'] = $request->input("rack_id", 0);

            $data['author'] = $request->input("author", '');



            $query = DB::table('books')

                ->leftJoin('book_categories', 'books.category_id', '=', 'book_categories.id')

                ->leftJoin('racks', 'books.rack_id', '=', 'racks.id')

                ->select('books.id', 'books.name', 'books.author', 'books.photo', 'books.total_copy', 'books.volume_no', 'books.issue_date', 'book_categories.name as category', 'racks.name as rack_name');



            if ($data['book_name'] > 0) {

                $query->where('books.name', 'like', '%' . $data['book_name'] . '%');

            }

            if ($data['category'] > 0) {

                $query->where('books.category_id', $data['category']);

            }

            if ($data['rack_id'] > 0) {

                $query->where('books.rack_id', $data['rack_id']);

            }

            if ($data['author'] > 0) {

                $query->where('books.author', $data['author']);

            }





            $data['book_search_list'] = $query->get();

            $data['book_category'] = DB::table('book_categories')->get();

            $data['rack_list'] = DB::table('racks')->get();





            $data['active_menu'] = 'book_list';

            $data['page_title'] = 'Book List';

            return view('backend.admin.pages.book_search_list', compact('data'));

        }

    }



    public function author_list()

    {

        $data = [];

        // $data['author_list'] = DB::table('books')->select('author')->distinct()->pluck('author');

        $data['author_list'] = DB::table('books')

            ->select('author', DB::raw('COUNT(*) as book_count'))

            ->groupBy('author')

            ->get();

        $data['active_menu'] = 'author_list';

        $data['page_title'] = 'Author List';

        return view('backend.admin.pages.author_list', compact('data'));

    }



    public function photo_upload(Request $request)

    {

        $data = [];



        //dd(public_path('/backend_assets/images/books'));



        if ($request->isMethod('post')) {

            $request->validate([

                'files.*' => 'required|image|mimes:jpg|max:2048',

            ]);



            $uploadedFiles = [];



            if ($request->hasFile('files')) {

                foreach ($request->file('files') as $file) {

                    $filename =  $file->getClientOriginalName();



                    try {

                        $destinationPath = '/home/gazipurdistrictb/library.gazipurdistrictbarassociation.com/backend_assets/images/books/';

                        $file->move($destinationPath, $filename);



                    } catch (\Exception $e) {

                        return response()->json([

                            'error' => 'File move failed!',

                            'message' => $e->getMessage()

                        ], 500);

                    }





                    // Resize image

                    $imagePath = $destinationPath . $filename;

                    $image = Image::make($imagePath);

                    $image->resize(300, 450);

                    $image->save($imagePath); // Save resized image

                    $uploadedFiles[] = [

                        'filename' => $filename,

                        'path' => asset("backend_assets/images/books/$filename"),

                    ];

                }

            }



            return response()->json(['success' => true, 'files' => $uploadedFiles]);

       }



        $data['active_menu'] = 'photo_upload';

        $data['page_title'] = 'Upload Photo';

        return view('backend.admin.pages.photo_upload', compact('data'));

    }

       public function book_list_print(Request $request)

    {

        $data = [];



        $data['book_list'] = DB::table('books')

            ->leftJoin('book_categories', 'books.category_id', '=', 'book_categories.id')

            ->leftJoin('racks', 'books.rack_id', '=', 'racks.id')

            ->select('books.id', 'books.name', 'books.author', 'books.photo', 'books.total_copy',  'books.volume_no','books.total_volume', 'book_categories.name as category', 'racks.name as rack_name')

            ->orderByDesc('books.id')

            ->get();






        $data['active_menu'] = 'book_list_print';

        $data['page_title'] = 'Book List';

        return view('backend.admin.pages.book_list_print', compact('data'));

    }
}

