<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\ApiController;
use App\Http\Requests\SiteRequest;
use App\Http\Resources\SiteResource;
use App\Models\Site;
use Illuminate\Http\Request;

class SiteController extends ApiController
{
    public function index()
    {
        return $this->success('',SiteResource::collection(Site::all()));
    }

    public function store(SiteRequest $request, Site $site)
    {
        $site->name = $request->name;
        $site->description = $request->description;
        $site->save();
        return $this->success('站点添加成功');
    }

    public function show(Site $site)
    {
        return $this->success('',new SiteResource($site));
    }

    public function update(Request $request, Site $site)
    {
        $site->fill($request->all())->save();
        return $this->success('栏目修改成功');
    }

    public function destroy(Site $site)
    {
        $this->authorize('delete', $site);
        $site->delete();
        return $this->success('栏目删除成功');
    }

}
