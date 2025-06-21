@extends('admin.admin_layout')
@section('title', 'Quản lý người dùng - Hải Phương Mobile')
@section('page_title', 'Quản lý người dùng')
@section('content')
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="p-4 sm:p-6 border-b border-gray-200">
            <div class="flex flex-col space-y-4 sm:space-y-0 sm:flex-row sm:justify-between sm:items-center">
                <h5 class="text-lg font-medium text-gray-800">Bảng người dùng</h5>
                <form action="{{ route('admin.user.search') }}" method="GET" class="w-full sm:w-80">
                    <div class="relative">
                        <input type="text" name="search" placeholder="Tìm kiếm thành viên..." 
                               class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md leading-5 bg-white placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm transition duration-150 ease-in-out"
                               value="{{ request('search') }}">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="absolute inset-y-0 right-0 flex items-center">
                            <button type="submit" class="p-2 focus:outline-none focus:shadow-outline hover:text-blue-500">
                                <span class="sr-only">Tìm kiếm</span>
                                <svg class="h-5 w-5 text-gray-500 hover:text-blue-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Desktop Table -->
        <div class="hidden lg:block overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">#</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Họ Tên</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tên người dùng</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Số điện thoại</th>
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
        </div>

        <!-- Mobile Cards -->
        <div class="lg:hidden">
            @if(isset($infor_user) && count($infor_user) > 0)
                <div class="space-y-4 p-4">
                    @foreach($infor_user as $user)
                    <div class="bg-white border border-gray-200 rounded-lg shadow-sm p-4">
                        <div class="flex items-start justify-between mb-3">
                            <div class="flex items-center space-x-3">
                                <div class="flex-shrink-0">
                                    <div class="h-10 w-10 bg-indigo-100 rounded-full flex items-center justify-center">
                                        <span class="text-sm font-medium text-indigo-800">{{ substr($user->fullname, 0, 1) }}</span>
                                    </div>
                                </div>
                                <div>
                                    <h3 class="text-sm font-medium text-gray-900">{{ $user->fullname }}</h3>
                                    <p class="text-xs text-gray-500">ID: {{ $user->id }}</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="space-y-2">
                            <div class="flex justify-between">
                                <span class="text-sm text-gray-500">Tên người dùng:</span>
                                <span class="text-sm font-medium text-gray-900">{{ $user->username }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-sm text-gray-500">Email:</span>
                                <span class="text-sm font-medium text-gray-900 break-all">{{ $user->email }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-sm text-gray-500">Số điện thoại:</span>
                                <span class="text-sm font-medium text-gray-900">{{ $user->phone }}</span>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            @else
                <div class="p-8 text-center text-gray-500">
                    <i class="fas fa-users text-4xl mb-4"></i>
                    <p>Không có người dùng nào</p>
                </div>
            @endif
        </div>

        <!-- Pagination -->
        <div class="px-4 py-3 border-t border-gray-200 sm:px-6">
            {{ $infor_user->links('pagination::tailwind') }}
        </div>
    </div>
@endsection