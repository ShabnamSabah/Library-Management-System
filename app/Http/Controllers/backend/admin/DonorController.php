<?php

namespace App\Http\Controllers\backend\admin;
use App\Http\Controllers\Controller;
use App\Http\Middleware\AdminAuthenticationMiddleware;
use App\Http\Middleware\BackendAuthenticationMiddleware;
use Illuminate\Http\Request;
use App\Models\Donor;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;
use PDOException;

class DonorController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
      return [
        BackendAuthenticationMiddleware::class,
        AdminAuthenticationMiddleware::class
      ];
    }

    // public function donor_add(Request $request)
    // {
    //     $data = [];
    //     if ($request->isMethod('post')) {
    //         $photo  = $request->file('photo');

    //         try {
    //             $newDonor = Donor::create([
    //                 'name' => $request->name,
    //                 'membership_number' => $request->membership_number,
    //                 'photo' => null,
    //                 'created_by' => Auth::user()->id,
    //             ]);
    //             if($photo){
    //                 $photo_extension = $photo->getClientOriginalExtension();
    //                 $photo_name = 'backend_assets/images/donors/'. $newDonor->id.'.'.'jpg';
    //                 $image = Image::make($photo);
    //                 $image->resize(300,300);
    //                 $image->save($photo_name);

    //                 $newDonor->update(['photo' => $photo_name]);
    //              }
    //             return back()->with('success', 'Added Successfully');
    //         } catch (PDOException $e) {
    //             return back()->with('error', 'Failed Please Try Again');
    //         }
    //     }
    //     $data['active_menu'] = 'donor_add';
    //     $data['page_title'] = 'Donor Add';
    //     return view('backend.admin.pages.donor_add', compact('data'));
    // }
    // public function donor_edit(Request $request, $id)
    // {
    //     $data = [];
    //     $data['donor'] = Donor::find($id);
    //     if(  $data['donor'] != null) {
    //     if ($request->isMethod('post')) {
    //         $old_photo = $data['donor']->photo;
    //         $photo  = $request->file('photo');
    //         if($photo){
    //             if(File::exists($old_photo)){
    //                 File::delete($old_photo);
    //             }
    //             $photo_extension = $photo->getClientOriginalExtension();
    //             $photo_name = 'backend_assets/images/donors/'.$data['donor']->id.'.'.'jpg';
    //             $image = Image::make($photo);
    //             $image->resize(300,300);
    //             $image->save($photo_name);

    //          }else{
    //             $photo_name = $old_photo;
    //          }

    //         try {
    //             $data['donor']->update([
    //                 'name' => $request->name,
    //                 'membership_number' => $request->membership_number,
    //                 'photo'=>$photo_name,
    //             ]);
    //             return back()->with('success', 'Updated Successfully');
    //         } catch (PDOException $e) {
    //             return back()->with('error', 'Failed Please Try Again');
    //         }
    //     }
    // }else{
    //     return redirect()->route('admin.donor.list')->with('failed', 'Wrong Attempt!');
    // }
    //     $data['active_menu'] = 'donor_edit';
    //     $data['page_title'] = 'Donor Edit';
    //     return view('backend.admin.pages.donor_edit', compact('data'));
    // }
    // public function donor_list()
    // {
    //     $data = [];
    //     $data['donor_list'] = DB::table('donors')->select('id','name', 'membership_number','photo')->get();
    //     $data['active_menu'] = 'donor_list';
    //     $data['page_title'] = 'Donor List';
    //     return view('backend.admin.pages.donor_list', compact('data'));
    // }
    public function donor_delete($id)
    {
        $server_response =  ['status' => 'FAILED', 'message' => 'Not Found'];
        $donor = Donor::find($id);
        if ($donor) {
            if(File::exists($donor->photo)){
                  File::delete($donor->photo);
            }
            $donor->delete();
            $server_response =  ['status' => 'SUCCESS', 'message' => 'Deleted Successfully'];
        } else {
            $server_response =  ['status' => 'FAILED', 'message' => 'Not Found'];
        }
        echo json_encode($server_response);
    }

    public function donors(Request $request){

        if ($request->isMethod('post')) {
            $id = 0;
            $id = $request->id;


            try {
                if ($id < 1) {
                    $photo  = $request->file('photo');
                    $newDonor = Donor::create([
                        'name' => $request->name,
                        'membership_number' => $request->membership_number,
                        'photo' => null,
                        'created_by' => Auth::user()->id,
                    ]);
                    if($photo){
                        $photo_extension = $photo->getClientOriginalExtension();
                        $photo_name = 'backend_assets/images/donors/'. $newDonor->id.'.'.'jpg';
                        $image = Image::make($photo);
                        $image->resize(300,300);
                        $image->save($photo_name);

                        $newDonor->update(['photo' => $photo_name]);
                     }
                    return back()->with('success', 'Added Successfully');
                } elseif ($id > 0) {
                    $donor = Donor::find($id);
                    $old_photo = $donor->photo;
                    $photo  = $request->file('photo');
                    if($photo){
                        if(File::exists($old_photo)){
                            File::delete($old_photo);
                        }
                        $photo_extension = $photo->getClientOriginalExtension();
                        $photo_name = 'backend_assets/images/donors/'.$donor->id.'.'.'jpg';
                        $image = Image::make($photo);
                        $image->resize(300,300);
                        $image->save($photo_name);

                     }else{
                        $photo_name = $old_photo;
                     }

                    $donor->update([
                        'name' => $request->name,
                        'membership_number' => $request->membership_number,
                        'photo'=>$photo_name,

                    ]);


                    return back()->with('success', 'Updated Successfully');
                }
            } catch (PDOException $e) {
                return back()->with('error', 'Failed Please Try again'.$e);
            }
        }
        $data['donor_list'] = DB::table('donors')
        ->leftJoin('books', 'books.donor_id', '=','donors.id')
        ->select('donors.id','donors.name', 'donors.membership_number','donors.photo',DB::raw('COUNT(books.id) as book_count'))
        ->groupBy('donors.id')->get();

        $data['active_menu'] = 'donor';
        $data['page_title'] = 'Donor List';
        return view('backend.admin.pages.donors', compact('data'));

    }
    public function donor_book_list($id){
        $data=[];
        $data['donor_book_list']= DB::table('books')
        ->leftJoin('book_categories', 'books.category_id','=', 'book_categories.id')

        ->select('books.id','books.name', 'books.author','books.photo', 'books.issue_date', 'book_categories.name as category')
        ->where('books.donor_id', $id)->get();
        $data['active_menu'] = 'donor';
        $data['page_title'] = 'Donor Book List';
        return view('backend.admin.pages.donor_book_list', compact('data'));
    }
}
