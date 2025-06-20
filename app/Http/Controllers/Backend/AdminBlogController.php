<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminBlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::with(['user', 'comments'])
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('admin.blog.index', compact('blogs'));
    }

    public function show($id)
    {
        $blog = Blog::with(['user', 'comments.user', 'comments.admin'])
            ->findOrFail($id);

        return view('admin.blog.show', compact('blog'));
    }

    public function updateStatus(Request $request, $id)
    {
        $blog = Blog::findOrFail($id);
        
        $request->validate([
            'status' => 'required|in:pending,solved,closed'
        ]);

        $blog->update(['status' => $request->status]);

        return redirect()->back()->with('success', 'Trạng thái bài viết đã được cập nhật!');
    }

    public function storeComment(Request $request, $blogId)
    {
        $request->validate([
            'content' => 'required',
            'is_solution' => 'boolean'
        ]);

        BlogComment::create([
            'content' => $request->content,
            'blog_id' => $blogId,
            'admin_id' => Auth::guard('admin')->id(),
            'is_solution' => $request->has('is_solution') ? true : false,
        ]);

        // Nếu đánh dấu là giải pháp, cập nhật trạng thái blog
        if ($request->has('is_solution')) {
            $blog = Blog::findOrFail($blogId);
            $blog->update(['status' => 'solved']);
        }

        return redirect()->route('admin.blogs.show', $blogId)->with('success', 'Bình luận đã được thêm!');
    }

    public function destroy($id)
    {
        $blog = Blog::findOrFail($id);
        $blog->delete();

        return redirect()->route('admin.blogs.index')->with('success', 'Bài viết đã được xóa!');
    }

    public function destroyComment($id)
    {
        $comment = BlogComment::findOrFail($id);
        $blogId = $comment->blog_id;
        $comment->delete();

        return redirect()->route('admin.blogs.show', $blogId)->with('success', 'Bình luận đã được xóa!');
    }
}
