<?php

namespace App\Http\Controllers\backend\admin;


use App\Http\Controllers\Controller;
use App\Http\Middleware\AdminAuthenticationMiddleware;
use App\Http\Middleware\BackendAuthenticationMiddleware;
use App\Models\SmsNotification;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Helpers\SmsSender;

use PDOException;

class DashboardController extends Controller implements HasMiddleware
{

  public static function middleware(): array
  {
    return [
      BackendAuthenticationMiddleware::class,
      AdminAuthenticationMiddleware::class
    ];
  }

  public function dashboard()
  {
      
    $data = array();
    $data['total_book'] = DB::table('books')->select('name')->groupBy('name')->get()->count();
    $data['total_book_copies'] = DB::table('books')->sum('total_copy');
    $data['total_author'] = DB::table('books')->distinct('author')->count('author');
    $data['total_rack'] = DB::table('racks')->count();
    $data['total_member'] = DB::table('members')->count();
    $data['total_donor'] = DB::table('donors')->count();
    $data['total_issue'] = DB::table('book_issues')->count();
    $data['total_returning'] = DB::table('book_issues')->where('status', 0)->count();

    $data['total_today_returning'] = DB::table('book_issues')->where('return_date', date('Y-m-d'))->where('status', 0)->count();
    
    // $data['sms_balance'] = SmsSender::smsbalnce(); 

    $data['books_by_user'] = DB::table('books')->selectRaw('created_by, SUM(total_copy) as total_copies, DATE(created_at) as created_date')->groupBy('created_by', 'created_date')->orderByDesc('created_date')->get();

    $data['active_menu'] = 'dashboard';
    $data['page_title'] = 'Dashboard';
    return view('backend.admin.pages.dashboard', compact('data'));
  }

  public function sms_notification_list(Request $request)
  {
    $data = array();
    $page_no = $request->page;

    $data_limit = 10;

    $data['serial'] = (($page_no ?? 1) - 1) * $data_limit;

    $data['sms_notifications'] = DB::table('sms_notifications')->orderByDesc('id')->paginate($data_limit);
    $data['active_menu'] = 'sms_notification_list';

    $data['page_title'] = 'SMS Notification';

    return view('backend.admin.pages.sms_notifications', compact('data'));
  }
}
