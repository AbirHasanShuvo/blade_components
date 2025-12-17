<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function create()
    {
        return view('create');
    }

    public function ourFileStore(Request $request)
    {
        $post = new Post();

        $validator = $request->validate([
            'name' => 'required|max:255',
            'description' => 'required'
            // 'image' => 'required',
        ]);

        //upload image
        $imageName = '';
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->move(public_path('/image'), $imageName);
        }


        //add new post
        $post->name = $request->name;
        $post->description = $request->description;
        $post->image = $imageName;
        $post->save();

        //redirect to the home page
        flash()->success('Post created Successfully');
        return redirect()->route('home');
    }

    public function editData($id)
    {
        // dd($id);
        //this dd is basically a great feature and by it i can see the id

        $post = Post::find($id);
        return view('edit', ['ourPost' => $post]);
    }

    public function updateData($id, Request $request)
    {
        // dd($id);



        $validated = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'image' => 'required'

        ]);

        // $imageName = null;



        //update the post
        $post = Post::find($id);
        $post->name = $request->name;
        $post->description = $request->description;

        if (isset($request->image)) {
            $imageName = time() . '.' . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->move(public_path('/image'), $imageName);
            $post->image = $imageName;
        }


        $post->save();
        flash()->success('Post updated Successfully');
        return redirect()->route('home');
    }

    public function deleteData($id)
    {
        $post = Post::find($id);
        $post->delete();
        flash()->success('Post deleted Successfully');
        return redirect()->route('home');
    }

    //search function
    public function search(Request $request)
    {
        $search = $request->search;

        $posts = Post::where(function ($query) use ($search) {
            $query->where('name', 'LIKE', "%{$search}%")
                ->orWhere('description', 'LIKE', "%{$search}%");
        })
            ->paginate(5)   // same pagination as home
            ->withQueryString();

        return view('welcome', compact('posts'));
    }

    public function importCSV()
    {
        return view('import');
    }

    // public function storeCSV(Request $request)
    // {
    //     $request->validate([
    //         'csv' => 'required|file|mimes:csv,txt|max:2048'
    //     ]);

    //     $file = $request->file('csv');
    //     $csvData = fopen($file->getRealPath(), 'r');

    //     $isHeader = true;

    //     while (($data = fgetcsv($csvData, 1000, ',')) != false) {
    //         if ($isHeader) {
    //             $isHeader = false;
    //             continue;
    //         }

    //         if (empty($data[0]) && empty($data[1])) {
    //             continue;
    //         }

    //         //creating in the database

    //         Post::create([
    //             'name' => $data[0],
    //             'description' => $data[1],
    //         ]);

    //         fclose($csvData);

    //         flash()->success('CSV imported successfully!');
    //         return redirect()->route('home');
    //     }
    // }

    //updated

    public function storeCSV(Request $request)
    {
        $request->validate([
            'csv' => 'required|file|mimes:csv,txt|max:2048'
        ]);

        $file = $request->file('csv');
        $csvData = fopen($file->getRealPath(), 'r');

        $isHeader = true;

        while (($data = fgetcsv($csvData, 1000, ',')) !== false) {

            if ($isHeader) {
                $isHeader = false;
                continue;
            }

            if (empty($data[0]) && empty($data[1])) {
                continue;
            }

            Post::create([
                'name' => $data[0],
                'description' => $data[1],
            ]);
        }

        fclose($csvData);

        flash()->success('CSV imported successfully!');
        return redirect()->route('home');
    }


    // public function exportCSV()
    // {
    //     $filename = 'posts_' . now()->format('Y_m_d_His') . 'csv';

    //     $headers = [
    //         'Content-Type' => 'text/csv',
    //         'Content-Disposition' => 'attachment; filename=$filename'
    //     ];

    //     $callback = function () {
    //         $file = fopen('php://output', 'w');

    //         //csv column headers
    //         fputcsv($file, ['ID', 'Name', 'Description', 'Image']);

    //         Post::chunk(500, function ($posts) use ($file) {
    //             foreach ($posts as $post) {
    //                 fputcsv($file, [
    //                     $post->id,
    //                     $post->name,
    //                     $post->description,
    //                     $post->image

    //                 ]);
    //             }
    //         });
    //         fclose($file);
    //     };

    //     return response()->stream($callback, 200, $headers);
    // }

    //updated

    public function exportCSV()
    {
        $fileName = 'posts_' . now()->format('Y_m_d_His') . '.csv';

        $headers = [
            "Content-Type" => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
        ];

        $callback = function () {
            $file = fopen('php://output', 'w');

            // CSV column headers
            fputcsv($file, ['ID', 'Name', 'Description', 'Image']);

            Post::chunk(500, function ($posts) use ($file) {
                foreach ($posts as $post) {
                    fputcsv($file, [
                        $post->id,
                        $post->name,
                        $post->description,
                        $post->image,
                    ]);
                }
            });

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
