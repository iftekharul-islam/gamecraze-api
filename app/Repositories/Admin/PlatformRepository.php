<?php


namespace App\Repositories\Admin;


use App\Models\Platform;
use Illuminate\Support\Str;

class PlatformRepository
{
    /**
     * @return Platform[]|\Illuminate\Database\Eloquent\Collection
     */
    public function all() {
        return Platform::orderBy('name', 'ASC')->get();
    }

    /**
     * @param $request
     * @return mixed
     */
    public function store($request) {
        $platform = $request->only(['name', 'status', 'url', 'is_featured']);
        $platform['author_id'] = auth()->user()->id;

        $image = $request->file('url');
        $image_name ='platform'. time() . '.'.$image->getClientOriginalExtension();

        $image->storeAs('platform-image/', $image_name);
        $platform['url'] =  'storage/platform-image/' .$image_name;
        $platform['slug'] = Str::slug($platform['name']);
        return Platform::create($platform);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function edit($id) {
        return Platform::findOrFail($id);
    }

    /**
     * @param $request
     * @return bool
     */
    public function update($request) {
        $platform = Platform::findOrFail($request->id);
        $data = $request->only(['name', 'status', 'url', 'is_featured']);
        $platform->is_featured = $data['is_featured'];

        if (isset($data['name'])) {
            $platform->name = $data['name'];
            $platform->slug = Str::slug($data['name']);
        }
        if (isset($data['url'])) {
            if (file_exists($platform->url)) {
                unlink($platform->url);
            }
            $image = $request->file('url');
            $image_name ='platform'. time() . '.'.$image->getClientOriginalExtension();
            $image->storeAs('platform-image/', $image_name);
            $platform['url'] =  'storage/platform-image/' .$image_name;
        }
        if (isset($data['status'])) {
            $platform->status = $data['status'];
        }
        $platform->save();
        return $platform;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id) {
        $platform = Platform::find($id);
        unlink($platform->url);
        $platform->delete();
        return $platform;
    }
}
