<?php

namespace App\Http\Controllers\Back;

use App\Models\Book;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Back\UpdateBookRequest;
use App\Http\Requests\Back\StoreBookRequest;
use App\Notifications\BookDeleted;

class BookController extends Controller
{
	public function index()
	{
		Gate::authorize("view-any", Book::class);
		$books = Book::withoutPublished()
			->latest("id")
			->paginate();

		return view("back.books.index", compact("books"));
	}

	public function edit(int $id)
	{
		$book = Book::find($id);

		return view("back.books.edit", compact("book"));
	}

	public function update(UpdateBookRequest $request, int $id)
	{
		$book = Book::find($id);
		Gate::authorize("update", $book);

		$inputs = $request->safe()->except(["image"]);

		if ($request->hasFile("image")) {
			if ($book->image && Storage::exists($book->image)) {
				Storage::delete($book->image);
			}
			$inputs["image"] = $request
				->file("image")
				->store("images", "public");
		}

		$book->update($inputs);

		return redirect()->route("admin.books.index");
	}

	public function create()
	{
		return view("back.books.create");
	}

	public function published(int $id)
	{
		$book = Book::find($id);
		Gate::authorize("update", $book);

		$book->is_published = !$book->is_published;
		$book->save();

		return redirect()->back();
	}

	public function store(StoreBookRequest $request)
	{
		Gate::authorize("create", Book::class);
		// dd($request->all());
		$inputs = $request->safe()->except(["image"]);

		if ($request->hasFile("image")) {
			$inputs["image"] = $request
				->file("image")
				->store("images", "public");
		}

		Book::create($inputs);

		return redirect()->route("admin.books.index");
	}


public function destroy(int $id)
{
	$book = Book::find($id);
    Gate::authorize('delete', $book);

    $book->author->notify(new BookDeleted($book->title));

	if ($book->image) {
			Storage::disk("public")->delete($book->image);
		}
    $book->delete();

    return redirect()->route('admin.books.index');
}
}