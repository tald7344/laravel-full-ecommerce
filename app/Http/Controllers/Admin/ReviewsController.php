<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\DataTables\ReviewDatatable;
use App\Http\Requests\ReviewsRequest;
use App\Model\Product;
use App\Model\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ReviewsController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(ReviewDatatable $reviews)
  {
    return $reviews->render('admin.reviews.index', ['title' => trans('admin.reviewPanel')]);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    return view('admin.reviews.create', ['title' => trans('admin.new_review')]);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(ReviewsRequest $request)
  {
    $product = Product::find($request->product_id);
    if (is_null($product)) {
      return back()->with('error', trans('admin.wrong_product_id_msg'));
    }
    Review::create($request->all());
    return back()->with('success', trans('admin.create_success'));
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit(Review $review)
  {
//    return view('admin.reviews.edit', ['title' => trans('admin.edit_review_page'), 'review' => $review]);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(ReviewsRequest $request, Review $review)
  {
    $review->update($request->all());
    return redirect(aurl('review'))->with('success', trans('admin.update_success'));
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy(ReviewsRequest $review)
  {
    $review->delete();
    return redirect(aurl('review'))->with('success', trans('admin.delete_success'));
  }

  public function destroyAll()
  {
    if (!request('items')) {
      return redirect(aurl('review'))->with('error', trans('admin.please_check_record_number'));
    }
    // destroy : it Make the Delete based on the number of request items it received
    Review::destroy(request('items'));
    return redirect(aurl('review'))->with('success', trans('admin.delete_success'));
  }

  public function approve(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'approve' => 'required|in:0,1'
    ]);
    if ($validator->fails()) {
      return redirect(aurl('review'))->with('error', trans('admin.wrong_approve_id_msg'));
    }
    $review = Review::find($request->id);
    if (is_null($review)) {
      return redirect(aurl('review'))->with('error', trans('admin.wrong_id_msg'));
    }
    $review->isApprove = $request->approve;
    $review->save();
    return redirect(aurl('review'));
  }
}
