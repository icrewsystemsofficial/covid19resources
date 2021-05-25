<?php

namespace App\Imports;

use App\Models\Category;
use App\Models\Resource;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Facades\Auth;

class ResourceImport implements ToCollection
{
    /**`
     * @param Collection $collection
     * @param $rows
     */
    public function collection($rows)
    {
        unset($rows[0]);

        foreach ($rows as $row) {
            $data = json_decode($row);
//            dd($data);


            $resource = array();
            $resource['title'] = $data[0];
            $resource['phone'] = $data[1];
            $resource['category'] = $data[2];
            $resource['city'] = $data[3];
            $resource['district'] = $data[4];
            $resource['state'] = $data[5];
            $resource['body'] = $data[6];
//           $resource['created_at'] = $data[7];



            $category = Category::where('name', $resource['category'])->get();
            foreach($category as $cat) {
                $id = $cat->id;
            }
            $resources = new Resource;
            $resources->title = $resource['title'];
            $resources->body = $resource['body'];
            $resources->phone = $resource['phone'];
            $resources->category = $id;
//            $resources->category = 1;
            $resources->state = $resource['state'];
            $resources->city = $resource['city'];
            $resources->district = $resource['district'];
            $resources->verified = 1;
            $resources->author_id = Auth::user()->id;
            $resources->save();


        }
        return;
    }
}
