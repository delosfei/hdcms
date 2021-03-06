<?php

namespace Modules\Edu\Transformers\Front;

use Illuminate\Http\Resources\Json\Resource;

class SystemResource extends Resource
{
  /**
   * Transform the resource into an array.
   *
   * @param  \Illuminate\Http\Request
   * @return array
   */
  public function toArray($request)
  {
    return parent::toArray($request);
  }

  public function with($request)
  {
    return [
      'meta' => [
        'lessons' =>  $this->lesson()->with('video')->get(),
      ]
    ];
  }
}
