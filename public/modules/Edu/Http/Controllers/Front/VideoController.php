<?php

namespace Modules\Edu\Http\Controllers\Front;

use App\Http\Controllers\ApiController;
use App\Scopes\SiteScope;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Modules\Edu\Entities\Video;
use Modules\Edu\Http\Requests\CommentRequest;
use Modules\Edu\Transformers\Front\CommentResource;
use Modules\Edu\Transformers\Front\VideoResource;

/**
 * 前台视频
 * @package Modules\Edu\Http\Controllers\Front
 */
class VideoController extends ApiController
{
  public function index()
  {
    $videos = Video::latest('id')->paginate(15);
    return VideoResource::collection($videos);
  }

  /**
   * 视频数据
   * @param Video $video
   * @return JsonResponse
   */
  public function show(Video $video)
  {
    return $this->json(new VideoResource($video));
  }

  /**
   * 点赞
   * @param Video $video
   * @return JsonResponse
   */
  public function favour(Video $video)
  {
    $video->favour()->toggle(Auth::id());
    $video['favour_count'] =  $video->favour()->count();
    $video->save();
    return $this->json(new VideoResource($video));
  }

  /**
   * 收藏
   * @param Video $video
   * @return JsonResponse
   */
  public function favorite(Video $video)
  {
    $video->favorite()->toggle(Auth::id());
    $video->favorite_count = $video->favorite()->count();
    $video->save();
    return $this->json(new VideoResource($video));
  }

  /**
   * 发表评论
   * @param Request $request
   * @param Video $video
   * @return JsonResponse
   */
  public function comment(CommentRequest $request, Video $video)
  {
    $video->comment()->create([
      'site_id' => SITEID,
      'user_id' => Auth::id(),
      'reply_user_id' => $request->reply_user_id ?: null,
      'content' => $request->content,
    ]);
    $video->comment_count = $video->comment()->count();
    $video->save();
    return $video->comment()->latest('id')->with(['user', 'reply'])->first();
  }

  /**
   * 获取评论列表
   * @param Video $video
   * @return JsonResponse
   */
  public function commentList(Video $video)
  {
    $comments = $video->comment()->with(['user', 'reply'])->get();
    return $this->json(CommentResource::collection($comments));
  }
}
