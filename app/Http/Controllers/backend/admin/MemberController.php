<?php



namespace App\Http\Controllers\backend\admin;



use App\Http\Controllers\Controller;

use App\Http\Middleware\AdminAuthenticationMiddleware;

use App\Http\Middleware\BackendAuthenticationMiddleware;

use Illuminate\Http\Request;

use App\Models\Member;

use Illuminate\Routing\Controllers\HasMiddleware;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\DB;

use Intervention\Image\Facades\Image;

use Illuminate\Support\Facades\File;

use PDOException;



class MemberController extends Controller implements HasMiddleware

{

    public static function middleware(): array

    {

        return [

            BackendAuthenticationMiddleware::class,

            AdminAuthenticationMiddleware::class

        ];

    }



    public function member_add(Request $request)

    {

        $data = [];

        if ($request->isMethod('post')) {

            $photo  = $request->file('photo');



            $created_at = date("Y-m-d H:i:s");



            try {

                $newmember = Member::create([

                   

                    'name' => $request->name,

                    'membership_number' => $request->membership_number,

                    'phone' => $request->phone,

                    'email' => $request->email,


                    'member_photo' => null,

                    'created_by' => Auth::user()->id,

                  

                ]);

                if ($photo) {

                    $photo_extension = $photo->getClientOriginalExtension();

                    $photo_name = 'backend_assets/images/members/' . $newmember->id . '.' . 'jpg';

                    $image = Image::make($photo);

                    $image->resize(300, 450);

                    $image->save($photo_name);



                    $newmember->update(['member_photo' => $photo_name]);



                } else {



                    $photo_name = 'backend_assets/images/members/' . $newmember->id . '.' . 'jpg';

                    $newmember->update(['member_photo' => $photo_name]);

                }



                return back()->with('success', 'Added Successfully');

            } catch (PDOException $e) {

                return back()->with('error', 'Failed Please Try Again'.$e);

            }

        }

       

        $data['active_menu'] = 'member_add';

        $data['page_title'] = 'Member Add';

        return view('backend.admin.pages.member_add', compact('data'));

    }

    public function member_edit(Request $request, $id)

    {

        $data = [];

        $data['member'] = Member::find($id);

        if ($data['member'] != null) {

            if ($request->isMethod('post')) {

                $old_photo = $data['member']->member_photo;

                $photo  = $request->file('photo');

                if ($photo) {

                    if (File::exists($old_photo)) {

                        File::delete($old_photo);

                    }

                    $photo_extension = $photo->getClientOriginalExtension();

                    $photo_name = 'backend_assets/images/members/' . $data['member']->id . '.' . 'jpg';

                    $image = Image::make($photo);

                    $image->resize(300, 450);

                    $image->save($photo_name);

                } else {

                    $photo_name = $old_photo;

                }



                try {

                    $data['member']->update([

                    

                        'name' => $request->name,

                        'membership_number' => $request->membership_number,

                        'phone' => $request->phone,

                        'email' => $request->email,

                        'member_photo' => $photo_name,

                    ]);

                    return back()->with('success', 'Updated Successfully');

                } catch (PDOException $e) {

                    return back()->with('error', 'Failed Please Try Again');

                }

            }

        } else {

            return redirect()->route('admin.member.list')->with('failed', 'Wrong Attempt!');

        }


        $data['active_menu'] = 'member_edit';

        $data['page_title'] = 'Member Edit';

        return view('backend.admin.pages.member_edit', compact('data'));

    }

    public function member_list(Request $request)

    {

        $data = [];

       

        $data['member_list'] = DB::table('members')

            
            ->orderByDesc('id')

            ->get();


        $data['active_menu'] = 'member_list';

        $data['page_title'] = 'Member List';

        return view('backend.admin.pages.member_list', compact('data'));

    }

    public function member_delete($id)

    {

        $server_response =  ['status' => 'FAILED', 'message' => 'Not Found'];

        $member = Member::find($id);

        if ($member) {

            if (File::exists($member->member_photo)) {

                File::delete($member->member_photo);

            }

            $member->delete();

            $server_response =  ['status' => 'SUCCESS', 'message' => 'Deleted Successfully'];

        } else {

            $server_response =  ['status' => 'FAILED', 'message' => 'Not Found'];

        }

        echo json_encode($server_response);

    }



    public function member_bulk_add(Request $request)

    {

        $data = [];



        if ($request->isMethod('post')) {

            $nextId = DB::select("SHOW TABLE STATUS LIKE 'members'")[0]->Auto_increment;

            $member_name = $request->input('name', []);

            $phone = $request->input('phone', []);

            $volume = $request->input('volume_no', []);

            $totalVolume = $request->input('total_volume', []);

            $totalCopy = $request->input('total_copy', []);

            $created_at = date("Y-m-d H:i:s");

            $members = [];

            try {

                foreach ($member_name as $key => $name) {

                    $members[] = [

                        'issue_date' => date('Y-m-d', strtotime($request->issue_date)),

                        'name' => $name,

                        'membership_number' => $request->membership_number,

                        'phone' => $phone[$key],

                        'volume_no' => $volume[$key],

                        'rack_id' => $request->rack_id,

                        'total_volume' => $totalVolume[$key],

                        'total_copy' =>  $totalCopy[$key],

                        'email' => $request->email,

                        'photo' => 'backend_assets/images/members/' . $nextId++ . '.' . 'jpg',

                        'created_by' => Auth::user()->id,

                        'created_at' => $created_at,

                    ];

                }

                member::insert($members);

                return back()->with('success', 'Added Successfully');

            } catch (PDOException $e) {

                return back()->with('error', 'Failed Please Try Again');

            }

        }

        $data['member_category'] = DB::table('member_categories')->get();

        $data['donors'] = DB::table('donors')->get();

        $data['racks'] = DB::table('racks')->get();

        $data['active_menu'] = 'member_bulk_add';

        $data['page_title'] = 'member Bulk Add';

        return view('backend.admin.pages.member_bulk_add', compact('data'));

    }





    public function member_search(Request $request)

    {

        $data = [];

        if ($request->isMethod('post')) {

            $data['member_name'] = $request->input("name", '');

            $data['category'] = $request->input("category", 0);

            $data['rack_id'] = $request->input("rack_id", 0);

            $data['phone'] = $request->input("phone", '');



            $query = DB::table('members')

                ->leftJoin('member_categories', 'members.membership_number', '=', 'member_categories.id')

                ->leftJoin('racks', 'members.rack_id', '=', 'racks.id')

                ->select('members.id', 'members.name', 'members.phone', 'members.photo', 'members.total_copy', 'members.volume_no', 'members.issue_date', 'member_categories.name as category', 'racks.name as rack_name');



            if ($data['member_name'] > 0) {

                $query->where('members.name', 'like', '%' . $data['member_name'] . '%');

            }

            if ($data['category'] > 0) {

                $query->where('members.membership_number', $data['category']);

            }

            if ($data['rack_id'] > 0) {

                $query->where('members.rack_id', $data['rack_id']);

            }

            if ($data['phone'] > 0) {

                $query->where('members.phone', $data['phone']);

            }





            $data['member_search_list'] = $query->get();

            $data['member_category'] = DB::table('member_categories')->get();

            $data['rack_list'] = DB::table('racks')->get();





            $data['active_menu'] = 'member_list';

            $data['page_title'] = 'member List';

            return view('backend.admin.pages.member_search_list', compact('data'));

        }

    }



 


  
}

