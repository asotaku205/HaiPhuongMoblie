@extends('admin.admin_layout')
@section('title', 'Quản lý người dùng - Hải Phương Mobile')
@section('page_title', 'Quản lý người dùng')

@section('css')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('content')
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div class="bg-white rounded-lg shadow overflow-hidden h-full w-full lg:col-span-2">
            <div class="flex flex-col md:flex-row justify-between items-center p-4 border-b border-gray-200">
                <div class="flex items-center mb-3 md:mb-0">
                    <h5 class="text-lg font-medium text-gray-800 mr-4">Bảng người dùng</h5>
                    <div class="flex items-center">
                        <select id="bulk-action-select" disabled
                            class="mr-2 px-3 py-2 bg-white border border-gray-300 rounded-md text-sm shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 opacity-50">
                            <option value="0">Chọn hành động</option>
                            <option value="delete">Xóa người dùng</option>
                            <option value="activate">Kích hoạt</option>
                            <option value="deactivate">Vô hiệu hóa</option>
                            <option value="export">Xuất dữ liệu</option>
                        </select>
                        <button id="apply-bulk-action" disabled 
                            class="px-4 py-2 bg-gray-200 text-gray-700 text-sm font-medium rounded hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-400 opacity-50">
                            Áp dụng
                        </button>
                        <span id="selected-count" class="ml-3 text-sm text-gray-600 hidden"></span>
                    </div>
                </div>
                
                <form action="{{ route('admin.user.search') }}" method="GET" class="flex items-center w-full md:w-auto">
                    <div class="relative flex-grow md:w-80">
                        <input type="text" name="search" placeholder="Tìm kiếm thành viên..." 
                               class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md leading-5 bg-white placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm transition duration-150 ease-in-out"
                               value="{{ request('search') }}">
                        <div class="absolute inset-y-0 right-0 flex items-center">
                            <button type="submit" class="p-1 focus:outline-none focus:shadow-outline hover:text-blue-500 mr-2">
                                <span class="sr-only">Tìm kiếm</span>
                                <svg class="h-5 w-5 text-gray-500 hover:text-blue-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="p-4">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    <input type="checkbox" id="select-all"
                                        class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">#
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Họ Tên</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Tên người dùng</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Email</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Số điện thoại</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @if(isset($infor_user) && count($infor_user) > 0)
                                @foreach($infor_user as $key => $user)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <input type="checkbox" name="selected_items[]" value="{{ $user->id }}"
                                                class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $user->id }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{$user->fullname}}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $user->username }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $user->email }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $user->phone }}</td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="5" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">
                                        Không có dữ liệu
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                    <div class="mt-4 ">
                        {{ $infor_user->links('pagination::tailwind') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
<script src="{{ asset('js/admin-bulk-actions.js') }}"></script>
@endsection