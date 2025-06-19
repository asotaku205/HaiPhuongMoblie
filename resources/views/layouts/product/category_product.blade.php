@extends('layouts.main')

@section('title')
@if(isset($category) && $category)
    {{ $category->category_name . ' - Hải Phương Mobile' }}
@else
    Danh mục không tồn tại - Hải Phương Mobile
@endif
@endsection

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Breadcrumb -->
    <div class="mb-6 bg-white rounded-lg shadow-sm p-3">
        <nav class="flex" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <a href="{{ route('home') }}" class="text-blue-600 hover:text-blue-800 font-medium">
                        <i class="fas fa-home mr-2"></i>
                        Trang chủ
                    </a> 
                </li>
                <li>
                    <div class="flex items-center">
                        <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
                        <span class="text-gray-700 font-medium">
                            @if(isset($category) && $category)
                                {{ $category->category_name }}
                            @else
                                Danh mục không tồn tại
                            @endif
                        </span>
                    </div>
                </li>
            </ol>
        </nav>
    </div>

    <!-- Category Header -->
    <div class="bg-gradient-to-r from-blue-500 to-blue-700 rounded-lg shadow-md p-8 mb-8 text-white">
        <h1 class="text-3xl font-bold mb-4">
            @if(isset($category) && $category)
                {{ $category->category_name }}
            @else
                Danh mục không tồn tại
            @endif
        </h1>
        <p class="text-white text-opacity-90">
            @if(isset($category) && $category)
                {{ $category->category_description }}
            @else
                Không có mô tả cho danh mục này.
            @endif
        </p>
    </div>
    
    <!-- Filter and Search -->
    <div class="bg-white rounded-lg shadow-md p-6 mb-8 border-t-4 border-blue-600">
        <h2 class="text-xl font-bold text-gray-900 mb-4 flex items-center">
            <i class="fas fa-filter mr-2 text-blue-600"></i> Bộ lọc sản phẩm
        </h2>
        <form action="{{ route('category.products', isset($category) ? $category->category_id : 0) }}" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-6">
            <div class="md:col-span-1">
                <label for="search" class="block text-sm font-medium text-gray-700 mb-2">Tìm kiếm</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-search text-gray-400"></i>
                    </div>
                    <input type="text" name="search" id="search" value="{{ request('search') }}" placeholder="Tên sản phẩm..." class="w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>
            </div>
            
            <!-- Bộ lọc danh mục con -->
            @if(isset($category) && $category->parent_id === null && $category->children->count() > 0)
            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-2">Danh mục </label>
                <div class="grid grid-cols-2 sm:grid-cols-3 gap-3 bg-gray-50 p-3 rounded-lg border border-gray-200 overflow-y-auto max-h-48">
                    <div class="flex items-center">
                        <input type="radio" id="subcategory_all" name="subcategory_id" value="" {{ request('subcategory_id') == '' || !request('subcategory_id') ? 'checked' : '' }} class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                        <label for="subcategory_all" class="ml-2 block text-sm text-gray-700">Tất cả</label>
                    </div>
                    
                    @foreach($category->children as $subcategory)
                    <div class="flex items-center">
                        <input type="radio" id="subcategory_{{ $subcategory->category_id }}" name="subcategory_id" value="{{ $subcategory->category_id }}" {{ request('subcategory_id') == $subcategory->category_id ? 'checked' : '' }} class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                        <label for="subcategory_{{ $subcategory->category_id }}" class="ml-2 block text-sm text-gray-700">{{ $subcategory->category_name }}</label>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif
            
            <div class="md:col-span-{{ isset($category) && $category->parent_id === null && $category->children->count() > 0 ? '1' : '2' }}">
                <label for="price_range" class="block text-sm font-medium text-gray-700 mb-2">Khoảng giá</label>
                <div class="grid grid-cols-2 gap-3 bg-gray-50 p-3 rounded-lg border border-gray-200">
                    <div class="flex items-center">
                        <input type="radio" id="price_all" name="price_range" value="" {{ request('price_range') == '' || !request('price_range') ? 'checked' : '' }} class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                        <label for="price_all" class="ml-2 block text-sm text-gray-700">Tất cả mức giá</label>
                    </div>
                    <div class="flex items-center">
                        <input type="radio" id="price_under_5m" name="price_range" value="under_5m" {{ request('price_range') == 'under_5m' ? 'checked' : '' }} class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                        <label for="price_under_5m" class="ml-2 block text-sm text-gray-700">Dưới 5 triệu</label>
                    </div>
                    <div class="flex items-center">
                        <input type="radio" id="price_5m_10m" name="price_range" value="5m_10m" {{ request('price_range') == '5m_10m' ? 'checked' : '' }} class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                        <label for="price_5m_10m" class="ml-2 block text-sm text-gray-700">Từ 5 - 10 triệu</label>
                    </div>
                    <div class="flex items-center">
                        <input type="radio" id="price_10m_15m" name="price_range" value="10m_15m" {{ request('price_range') == '10m_15m' ? 'checked' : '' }} class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                        <label for="price_10m_15m" class="ml-2 block text-sm text-gray-700">Từ 10 - 15 triệu</label>
                    </div>
                    <div class="flex items-center">
                        <input type="radio" id="price_15m_20m" name="price_range" value="15m_20m" {{ request('price_range') == '15m_20m' ? 'checked' : '' }} class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                        <label for="price_15m_20m" class="ml-2 block text-sm text-gray-700">Từ 15 - 20 triệu</label>
                    </div>
                    <div class="flex items-center">
                        <input type="radio" id="price_over_20m" name="price_range" value="over_20m" {{ request('price_range') == 'over_20m' ? 'checked' : '' }} class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                        <label for="price_over_20m" class="ml-2 block text-sm text-gray-700">Trên 20 triệu</label>
                    </div>
                </div>
            </div>
            
            <div class="md:col-span-1">
                <label for="sort" class="block text-sm font-medium text-gray-700 mb-2">Sắp xếp theo</label>
                <div class="relative">
                    <select name="sort" id="sort" class="appearance-none w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white pr-10">
                        <option value="" {{ request('sort') == '' ? 'selected' : '' }}>Mặc định</option>
                        <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Giá tăng dần</option>
                        <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Giá giảm dần</option>
                        <option value="name_asc" {{ request('sort') == 'name_asc' ? 'selected' : '' }}>Tên A-Z</option>
                        <option value="name_desc" {{ request('sort') == 'name_desc' ? 'selected' : '' }}>Tên Z-A</option>
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                        <i class="fas fa-chevron-down"></i>
                    </div>
                </div>
            </div>
            
            <div class="md:col-span-4 flex justify-end space-x-3 pt-2 border-t border-gray-200">
                <a href="{{ route('category.products', isset($category) ? $category->category_id : 0) }}" class="flex items-center px-4 py-2 rounded-lg bg-gray-200 text-gray-700 hover:bg-gray-300 transition-all duration-200 font-medium">
                    <i class="fas fa-times mr-2"></i>Xóa bộ lọc
                </a>
                <button type="submit" class="flex items-center px-6 py-2 rounded-lg bg-blue-600 text-white hover:bg-blue-700 transition-all duration-200 shadow-sm hover:shadow font-medium">
                    <i class="fas fa-filter mr-2"></i>Áp dụng
                </button>
            </div>
        </form>
    </div>

    <!-- Products Count and Active Filters -->
    @if($products->total() > 0)
    <div class="bg-blue-50 rounded-lg p-4 mb-6 border border-blue-100 shadow-sm">
        <div class="flex flex-wrap items-center justify-between">
            <div>
                <p class="text-gray-700 font-medium">
                    <i class="fas fa-tag mr-2 text-blue-600"></i>
                    <span class="font-bold text-blue-700">{{ $products->total() }}</span> sản phẩm được tìm thấy
                    @if(request('search') || request('price_range') || request('sort') || request('subcategory_id'))
                        với bộ lọc hiện tại
                    @endif
                </p>
            </div>
            
            @if(request('search') || request('price_range') || request('sort') || request('subcategory_id'))
            <div class="flex flex-wrap items-center mt-2 md:mt-0">
                <span class="text-gray-700 mr-2 font-medium">Bộ lọc đang áp dụng:</span>
                
                @if(request('search'))
                <span class="bg-blue-100 text-blue-800 text-xs font-medium px-3 py-1.5 rounded-full mr-2 mb-2 flex items-center">
                    <i class="fas fa-search mr-1"></i> {{ request('search') }}
                </span>
                @endif
                
                @if(request('subcategory_id'))
                <span class="bg-blue-100 text-blue-800 text-xs font-medium px-3 py-1.5 rounded-full mr-2 mb-2 flex items-center">
                    <i class="fas fa-tag mr-1"></i>
                    @foreach($category->children as $subcategory)
                        @if($subcategory->category_id == request('subcategory_id'))
                            {{ $subcategory->category_name }}
                        @endif
                    @endforeach
                </span>
                @endif
                
                @if(request('price_range'))
                <span class="bg-blue-100 text-blue-800 text-xs font-medium px-3 py-1.5 rounded-full mr-2 mb-2 flex items-center">
                    <i class="fas fa-money-bill-wave mr-1"></i>
                    @if(request('price_range') == 'under_5m')
                        Dưới 5 triệu
                    @elseif(request('price_range') == '5m_10m')
                        Từ 5 - 10 triệu
                    @elseif(request('price_range') == '10m_15m')
                        Từ 10 - 15 triệu
                    @elseif(request('price_range') == '15m_20m')
                        Từ 15 - 20 triệu
                    @elseif(request('price_range') == 'over_20m')
                        Trên 20 triệu
                    @endif
                </span>
                @endif
                
                @if(request('sort'))
                <span class="bg-blue-100 text-blue-800 text-xs font-medium px-3 py-1.5 rounded-full mr-2 mb-2 flex items-center">
                    <i class="fas fa-sort mr-1"></i>
                    @switch(request('sort'))
                        @case('price_asc')
                            Giá tăng dần
                            @break
                        @case('price_desc')
                            Giá giảm dần
                            @break
                        @case('name_asc')
                            Tên A-Z
                            @break
                        @case('name_desc')
                            Tên Z-A
                            @break
                    @endswitch
                </span>
                @endif
            </div>
            @endif
        </div>
    </div>
    @endif

    <!-- Products Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @forelse($products as $product)
        <div class="bg-white rounded-lg shadow-sm overflow-hidden hover:shadow-lg transition-all duration-300 border border-gray-100 group">
            <a href="{{route('product_post', $product->product_id)}}" class="block">
                <div class="relative pb-[100%] overflow-hidden bg-gray-50">
                    <img src="{{ asset('uploads/products/'.$product->product_image) }}" 
                         alt="{{ $product->product_name }}"
                         class="absolute inset-0 w-full h-full object-contain p-4 group-hover:scale-105 transition-transform duration-300">
                </div>
                <div class="p-5">
                    <h3 class="text-lg font-semibold text-gray-900 mb-2 line-clamp-2 group-hover:text-blue-600 transition-colors duration-200">
                        {{ $product->product_name }}
                    </h3>
                    <p class="text-gray-600 text-sm mb-3 line-clamp-2">
                        {{ $product->product_description }}
                    </p>
                    <div class="flex items-center justify-between pt-3 border-t border-gray-100">
                        <span class="text-xl font-bold text-red-600">
                            {{ number_format($product->product_price, 0, ',', '.') }} ₫
                        </span>
                        <button class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors shadow-sm hover:shadow group-hover:bg-blue-700">
                            <i class="fas fa-shopping-cart mr-2"></i>
                            Mua ngay
                        </button>
                    </div>
                </div>
            </a>
        </div>
        @empty
        <div class="col-span-full text-center py-16 bg-gray-50 rounded-lg border border-gray-200">
            <i class="fas fa-box-open text-5xl text-gray-300 mb-4"></i>
            <p class="text-gray-500 text-lg">Chưa có sản phẩm nào trong danh mục này</p>
            <p class="text-gray-400 mt-2">Vui lòng thử lại với bộ lọc khác hoặc quay lại sau</p>
        </div>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="mt-8 flex justify-center">
        {{ $products->links() }}
    </div>

    <!-- Related Categories -->
    @if(isset($related_categories) && $related_categories->count() > 0)
    <div class="mt-12 bg-white rounded-lg shadow-md p-6 border-t-4 border-blue-600">
        <h2 class="text-xl font-bold text-gray-900 mb-6 flex items-center">
            <i class="fas fa-th-large mr-2 text-blue-600"></i> Danh mục liên quan
        </h2>
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4">
            @foreach($related_categories as $related)
            <a href="{{ route('category.products', $related->category_id) }}" 
               class="bg-gray-50 rounded-lg p-4 text-center hover:shadow-md transition-all duration-300 border border-gray-100 hover:border-blue-200 hover:bg-blue-50 group">
                <h3 class="text-gray-700 font-medium group-hover:text-blue-600 transition-colors">{{ $related->category_name }}</h3>
            </a>
            @endforeach
        </div>
    </div>
    @endif
</div>
@endsection