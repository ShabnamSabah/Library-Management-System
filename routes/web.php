<?php

use App\Http\Controllers\backend\admin\BookCategoryController;
use App\Http\Controllers\backend\admin\DashboardController;
use App\Http\Controllers\backend\admin\ProfileController;
use App\Http\Controllers\backend\admin\RacksController;
use App\Http\Controllers\backend\admin\BookController;
use App\Http\Controllers\backend\admin\DonorController;
use App\Http\Controllers\backend\admin\BookIssueController;
use App\Http\Controllers\backend\admin\MemberController;
use App\Http\Controllers\backend\AuthenticationController;
use App\Http\Controllers\backend\operator\DashboardController as OperatorDashboardController;
use App\Http\Controllers\backend\operator\ProfileController as OperatorProfileController;

use App\Http\Middleware\AdminAuthenticationMiddleware;
use App\Http\Middleware\OperatorAuthenticationMiddleware;
use Illuminate\Support\Facades\Route;

// frontend

//Route::get('/', [FrontEndController::class, 'home'])->name('home');


// backend
Route::match(['get', 'post'], '/', [AuthenticationController::class, 'login'])->name('login');
// route prefix
Route::prefix('admin')->group(function () {
    // route name prefix
    Route::name('admin.')->group(function () {
        //middleware
        Route::middleware(AdminAuthenticationMiddleware::class)->group(function () {
            Route::get('logout', [AuthenticationController::class, 'logout'])->name('logout');
            //profile
            Route::get('profile', [ProfileController::class, 'profile'])->name('profile');
            Route::post('profile-info/update', [ProfileController::class, 'profile_info_update'])->name('profile.info.update');
            Route::post('profile-password/update', [ProfileController::class, 'profile_password_update'])->name('profile.password.update');
            //dashboard
            Route::get('dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');


            Route::match(['get', 'post'], 'racks', [RacksController::class, 'racks'])->name('racks');
            Route::get( 'rack/delete/{id}', [RacksController::class, 'rack_delete'])->name('rack.delete');

            Route::match(['get', 'post'], 'book-category', [BookCategoryController::class, 'book_category'])->name('book.category');
            Route::get( 'book-category/delete/{id}', [BookCategoryController::class, 'book_category_delete'])->name('book.category.delete');

            Route::match(['get', 'post'], 'donors', [DonorController::class, 'donors'])->name('donor');
            Route::get( 'donor/delete/{id}', [DonorController::class, 'donor_delete'])->name('donor.delete');
            Route::get( 'donor-book-list/{id}', [DonorController::class, 'donor_book_list'])->name('donor.book.list');

            Route::match(['get','post'],'book/add',[BookController::class,'book_add'])->name('book.add');
            Route::match(['get','post'],'book/edit/{id}',[BookController::class,'book_edit'])->name('book.edit');
            Route::get('book/list',[BookController::class,'book_list'])->name('book.list');
            Route::get('book/delete/{id}',[BookController::class,'book_delete'])->name('book.delete');
            Route::match(['get','post'],'book_cover-photo-upload',[BookController::class,'photo_upload'])->name('photo.upload');
            Route::get('book/list/print',[BookController::class,'book_list_print'])->name('book.list.print');

            Route::match(['get','post'],'book-issue',[BookIssueController::class,'book_issue'])->name('book.issue');
            Route::match(['get','post'],'book-bulk-add',[BookController::class,'book_bulk_add'])->name('book.bulk.add');
            Route::post('book-search',[BookController::class,'book_search'])->name('book.search');
            Route::get('author/list',[BookController::class,'author_list'])->name('author.list');

            Route::get('get-member-info',[BookIssueController::class,'get_member_info'])->name('get.member.info');
            Route::get('get-book-list',[BookIssueController::class,'get_book_list'])->name('get.book.list');
            Route::get('get-book-info/{id}',[BookIssueController::class,'get_book_info'])->name('get.book.info');

            Route::match(['get','post'],'get-returning-books',[BookIssueController::class,'get_returning_books'])->name('get.returning.books');
            Route::match(['get','post'],'get-returning-books/delete/{id}',[BookIssueController::class,'get_returning_books_delete'])->name('get.returning.books.delete');
            Route::get('get-returned-books',[BookIssueController::class,'get_returned_books'])->name('get.returned.books');

            Route::match(['get','post'],'report',[BookIssueController::class,'report'])->name('report');


             Route::match(['get','post'],'member/add',[MemberController::class,'member_add'])->name('member.add');
            Route::match(['get','post'],'member/edit/{id}',[MemberController::class,'member_edit'])->name('member.edit');
            Route::get('member/list',[MemberController::class,'member_list'])->name('member.list');
            Route::get('member/delete/{id}',[MemberController::class,'member_delete'])->name('member.delete');

           
        });
    });
});
// Book
// route prefix
Route::prefix('operator')->group(function () {
    // route name prefix
    Route::name('operator.')->group(function () {
        //middleware
            Route::middleware(OperatorAuthenticationMiddleware::class)->group(function () {
            Route::get('logout', [AuthenticationController::class, 'logout'])->name('logout');
            //profile
            Route::get('profile', [OperatorProfileController::class, 'profile'])->name('profile');
            Route::post('profile-info/update', [OperatorProfileController::class, 'profile_info_update'])->name('profile.info.update');
            Route::post('profile-password/update', [OperatorProfileController::class, 'profile_password_update'])->name('profile.password.update');
            //dashboard
            Route::get('dashboard', [OperatorDashboardController::class, 'dashboard'])->name('dashboard');
        });
    });
});
