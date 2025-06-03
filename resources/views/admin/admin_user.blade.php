@extends('admin.admin_layout')
@section('title', 'Quản lý người dùng - Hải Phương Mobile')
@section('page_title', 'Quản lý người dùng')
@section('content')
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div class="bg-white rounded-lg shadow overflow-hidden h-full w-full lg:col-span-2">
            <div class="flex justify-between items-center p-4 border-b border-gray-200">
                <h5 class="text-lg font-medium text-gray-800">Bảng người dùng</h5>
                <div class="flex space-x-2">
                    <button class="text-gray-500 hover:text-gray-700 focus:outline-none">
                        <i class="fa fa-chevron-up"></i>
                    </button>
                    <div class="relative">
                        <button class="text-gray-500 hover:text-gray-700 focus:outline-none" id="options-menu"
                            aria-expanded="true" aria-haspopup="true">
                            <i class="fa fa-wrench"></i>
                        </button>
                        <div class="hidden origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none"
                            role="menu" aria-orientation="vertical" aria-labelledby="options-menu">
                            <div class="py-1" role="none">
                                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                    role="menuitem">Tùy chọn 1</a>
                                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                    role="menuitem">Tùy chọn 2</a>
                            </div>
                        </div>
                    </div>
                    <button class="text-gray-500 hover:text-gray-700 focus:outline-none">
                        <i class="fa fa-times"></i>
                    </button>
                </div>
            </div>
            <div class="p-4">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
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
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $user->id }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{$user->fullname}}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $user->username }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $user->email }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $user->phone }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <div class="flex space-x-2">
                                                <a href="#" class="text-indigo-600 hover:text-indigo-900">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <a href="#" class="text-red-600 hover:text-red-900">
                                                    <i class="fa fa-trash"></i>
                                                </a>
                                            </div>
                                        </td>
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