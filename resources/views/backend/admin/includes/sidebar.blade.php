<!-- partial:partials/_sidebar.html -->
<nav class="sidebar">
    <div class="sidebar-header">
        <a href="{{ url('/') }}" class="sidebar-brand">
           Lib<span>rary</span>
        </a>
        <div class="sidebar-toggler ">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
    <div class="sidebar-body">
        <ul class="nav">
            <li class="nav-item nav-category">Admin</li>
            <!--  Dashboard  -->
            <li class="nav-item {{ $data['active_menu'] == 'dashboard' ? 'active' : '' }}">
                <a href="{{ route('admin.dashboard') }}" class="nav-link ">
                    <i class="fa-solid fa-chart-line"></i>
                    <span class="link-title">Dashboard</span>
                </a>
            </li>
            <li class="nav-item {{ $data['active_menu'] == 'racks' ? 'active' : '' }}">
                <a href="{{ route('admin.racks') }}" class="nav-link ">
                    <i class="fa-solid fa-layer-group"></i>
                    <span class="link-title">Racks</span>
                </a>
            </li>
            <li class="nav-item {{ $data['active_menu'] == 'book_category' ? 'active' : '' }}">
                <a href="{{ route('admin.book.category') }}" class="nav-link ">
                    <i class="fa-solid fa-list"></i>
                    <span class="link-title">Book Category</span>
                </a>
            </li>
            <li class="nav-item {{ $data['active_menu'] == 'donor' ? 'active' : '' }}">
                <a href="{{ route('admin.donor') }}" class="nav-link ">
                    <i class="fa-regular fa-user"></i>
                    <span class="link-title">Donors</span>
                </a>
            </li>

             <li class="nav-item {{ $data['active_menu'] == 'member_add' || $data['active_menu'] == 'member_edit' || $data['active_menu'] == 'member_list' ? 'active' : '' }}">
                <a class="nav-link" data-bs-toggle="collapse" href="#member" role="button" aria-expanded="false"
                    aria-controls="member">
                    <i class="fa-solid fa-users"></i>
                    <span class="link-title">Member Manage</span>
                    <i class="fa-solid fa-chevron-down link-arrow"></i>
                </a>
                <div class="collapse" id="member">
                    <ul class="nav sub-menu">
                        <li class="nav-item ">
                            <a href="{{ route('admin.member.add') }}"
                                class="nav-link {{ $data['active_menu'] == 'member_add' ? 'active' : '' }}">Member
                                Add</a>
                        </li>
                     
                        <li class="nav-item">
                            <a href="{{ route('admin.member.list') }}"
                                class="nav-link {{ $data['active_menu'] == 'member_list' ? 'active' : '' }}">Member List</a>
                        </li>
                       
                    </ul>
                </div>
            </li>

            <li class="nav-item {{ $data['active_menu'] == 'book_add' || $data['active_menu'] == 'book_edit' || $data['active_menu'] == 'book_list' || $data['active_menu'] == 'book_bulk_add' || $data['active_menu'] == 'photo_upload' || $data['active_menu'] == 'book_list_print' ? 'active' : '' }}">
                <a class="nav-link" data-bs-toggle="collapse" href="#book" role="button" aria-expanded="false"
                    aria-controls="book">
                    <i class="fa-solid fa-book"></i>
                    <span class="link-title">Books Manage</span>
                    <i class="fa-solid fa-chevron-down link-arrow"></i>
                </a>
                <div class="collapse" id="book">
                    <ul class="nav sub-menu">
                        <li class="nav-item ">
                            <a href="{{ route('admin.book.add') }}"
                                class="nav-link {{ $data['active_menu'] == 'book_add' ? 'active' : '' }}">Book
                                Add</a>
                        </li>
                        <li class="nav-item ">
                            <a href="{{ route('admin.book.bulk.add') }}"
                                class="nav-link {{ $data['active_menu'] == 'book_bulk_add' ? 'active' : '' }}">Book Bulk
                                Add</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.book.list') }}"
                                class="nav-link {{ $data['active_menu'] == 'book_list' ? 'active' : '' }}">Book List</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.photo.upload') }}"
                                class="nav-link {{ $data['active_menu'] == 'photo_upload' ? 'active' : '' }}">Upload Cover Photo</a>
                        </li>
                             <li class="nav-item">
                            <a href="{{ route('admin.book.list.print') }}"
                                class="nav-link {{ $data['active_menu'] == 'book_list_print' ? 'active' : '' }}" target="_blank">Book List Print</a>
                        </li>
                    </ul>
                </div>
            </li>

            <li
                class="nav-item {{ $data['active_menu'] == 'book_issue' || $data['active_menu'] == 'returning_books' ||  $data['active_menu'] == 'returned_books' || $data['active_menu'] == 'report'? 'active' : '' }}">
                <a class="nav-link" data-bs-toggle="collapse" href="#bookissue" role="button" aria-expanded="false"
                    aria-controls="bookissue">
                    <i class="fa-solid fa-book"></i>
                    <span class="link-title">Book Issue Manage</span>
                    <i class="fa-solid fa-chevron-down link-arrow"></i>
                </a>
                <div class="collapse" id="bookissue">
                    <ul class="nav sub-menu">
                        <li class="nav-item ">
                            <a href="{{ route('admin.book.issue') }}"
                                class="nav-link {{ $data['active_menu'] == 'book_issue' ? 'active' : '' }}">Book
                                Issue</a>
                        </li>
                        <li class="nav-item ">
                            <a href="{{ route('admin.get.returning.books') }}"
                                class="nav-link {{ $data['active_menu'] == 'returning_books' ? 'active' : '' }}">Returning Books</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.get.returned.books') }}"
                                class="nav-link {{ $data['active_menu'] == 'returned_books' ? 'active' : '' }}">Returned List</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.report') }}"
                                class="nav-link {{ $data['active_menu'] == 'report' ? 'active' : '' }}">Report</a>
                        </li>
                    </ul>
                </div>
            </li>
            
        </ul>
    </div>
</nav>

<!-- partial -->
