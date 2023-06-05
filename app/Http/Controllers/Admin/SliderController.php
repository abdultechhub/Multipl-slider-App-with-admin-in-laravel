<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Image;

use Illuminate\Support\Facades\Validator;

use App\Models\Slider;
use App\Models\SliderItem;
    
class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    


    public function index()
    {
        $slider = Slider::orderBy('id', 'desc')->get();

        return view('admin.slider.index', compact('slider'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        

        $slider = Slider::where('is_published', 1)->where('is_deleted', 0)->latest()->get();
        return view('admin.slider.create', compact( 'slider'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|min:5',
        ]);
        

        if ($validator->fails()) {
            return back()->withInput();
        }
        else{

            
            $slider = Slider::create([
                'title' => $request->input('title'),
                'slug' => $this->createSlug($request->input('title')),
                'created_at' => Carbon::now(),
            ]);


            if ($slider) {
               
                if ($request->file('slider_image_desk')) {
                    $images = $request->file('slider_image_desk');
                    foreach ($images as $key => $value) {
                        $slider_item = new SliderItem;
                        //$file = $request->file($value);
                        $file_ext = $value->getClientOriginalExtension();
                        $file_o_name = trim($value->getClientOriginalName());
                        $unique_id = trim('__'.hrtime(true).'_'.floor(rand()*1000));
                        $file_name = pathinfo($file_o_name, PATHINFO_FILENAME);
                        $slider_image_desk = Str::slug($file_name).$unique_id.'.'.$file_ext;

                        $upload_location_large = 'upload/slider/large/';

                        $moved_file_large =  Image::make($value)->save($upload_location_large.$slider_image_desk);

                        $slider_item->slider_image_desk = $slider_image_desk;

                        // dd($request->file('slider_image_tab')[$key]);
                        // // Upload Banner Image tablet
                        if(isset($request->file('slider_image_tab')[$key])){
                            
                            $image_tmp = $request->file('slider_image_tab')[$key];
                            $upload_location_medium = 'upload/slider/medium/';
                            if($image_tmp->isValid()){
                                // Get Image Extension
                                $file_ext = $value->getClientOriginalExtension();
                                $file_o_name = trim($value->getClientOriginalName());
                                $unique_id = trim('__'.hrtime(true).'_'.floor(rand()*1000));
                                $file_name = pathinfo($file_o_name, PATHINFO_FILENAME);
                                $slider_image_tab = Str::slug($file_name).$unique_id.'.'.$file_ext;
                            
                                // Upload the Image
                                Image::make($image_tmp)->save($upload_location_medium.$slider_image_tab);
                                $slider_item->slider_image_tab = $slider_image_tab;
                            }
                        }
                        // //Upload Banner Image mobile
                        if(isset($request->file('slider_image_mobile')[$key])){
                            $image_tmp = $request->file('slider_image_mobile')[$key];
                            $upload_location_small = 'upload/slider/small/';
                            if($image_tmp->isValid()){
                                $file_ext = $value->getClientOriginalExtension();
                                $file_o_name = trim($value->getClientOriginalName());
                                $unique_id = trim('__'.hrtime(true).'_'.floor(rand()*1000));
                                $file_name = pathinfo($file_o_name, PATHINFO_FILENAME);
                                $slider_image_mobile = Str::slug($file_name).$unique_id.'.'.$file_ext;


                                $imagePath = $upload_location_small.$slider_image_mobile;
                                // Upload the Image
                                Image::make($image_tmp)->save($imagePath);
                                $slider_item->slider_image_mobile = $slider_image_mobile;
                            }
                        }
                        if ($moved_file_large) {
                            $slider_item->slider_id = $slider->id;
                            $slider_item->title = $request->input('title')[$key];
                            $slider_item->slug =  Str::slug($request->input('title')[$key]);
                            $slider_item->link_text = $request->input('link_text')[$key];
                            $slider_item->link = $request->input('link')[$key];
                            $slider_item->content = $request->input('content')[$key];

                            $slider_item->save();
                        }
                    }
                } 
            }


            $notification = [
                'message' => 'Slider Created Successfully!!!',
                'alert-type' => 'success'
            ];

            return redirect()->route('slider.index')->with($notification);

        }
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
    public function edit($id)
    {
        $slider = Slider::where('id', $id)->first();

        return view('admin.slider.edit', compact('slider'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|min:5'
        ]);
        

        if ($validator->fails()) {
            return back()->withInput();
        }
        else{

            $slider = Slider::findOrFail($id);

            $slider_update = $slider->update([
                'title' => $request->input('title'),
                'slug' => $this->createSlug($request->input('slug')),
                'created_at' => Carbon::now(),
            ]);


            if ($slider) {
                $block_id = $request->input('block_id');
                foreach ($block_id as $key => $value) {
                    $slider_item2 = SliderItem::where('id', '=', $block_id[$key]);
                    $result =  $slider_item2->update([
                        'title' => $request->input('s_item_title')[$key],
                        'slug' =>  Str::slug($request->input('s_item_title')[$key]),
                        'link_text' => $request->input('link_text')[$key],
                        'link' => $request->input('link')[$key],
                        'content' => $request->input('content')[$key],
                        'position' => $request->input('block_no')[$key],
                    ]);
                }

                if($request->file('slider_image_desk')){
                    $images = $request->file('slider_image_desk');
                    $upload_location_large = 'upload/slider/large/';
                    foreach ($images as $key => $value) {
                        $block_id_live  = SliderItem::select('id')->where('id', $request->input('block_id')[$key])->where('slider_id', $id)->first();
                        $slider_item = SliderItem::where('id', '=', $request->input('block_id')[$key]);

                        $name_gen = 'slider_image_desk_' . hexdec(uniqid()) . '.' . $value->getClientOriginalExtension();
                        $value->move(public_path($upload_location_large), $name_gen);

                        $result =  $slider_item->update([
                            'slider_image_desk' => $name_gen,
                        ]);
                    }
                }
                if($request->file('slider_image_tab')){
                    $images = $request->file('slider_image_tab');
                    $upload_location_large =  'upload/slider/medium/';
                    foreach ($images as $key => $value) {
                        $block_id_live  = SliderItem::select('id')->where('id', $request->input('block_id')[$key])->where('slider_id', $id)->first();
                        $slider_item = SliderItem::where('id', '=', $request->input('block_id')[$key]);

                        $name_gen = 'slider_image_tab_' . hexdec(uniqid()) . '.' . $value->getClientOriginalExtension();
                        $value->move(public_path($upload_location_large), $name_gen);

                        $result =  $slider_item->update([
                            'slider_image_tab' => $name_gen,
                        ]);
                    }
                }
                if($request->file('slider_image_mobile')){
                    $images = $request->file('slider_image_mobile');
                    $upload_location_large = 'upload/slider/small/';
                    foreach ($images as $key => $value) {
                        $block_id_live  = SliderItem::select('id')->where('id', $request->input('block_id')[$key])->where('slider_id', $id)->first();
                        $slider_item = SliderItem::where('id', '=', $request->input('block_id')[$key]);

                        $name_gen = 'slider_image_mobile_' . hexdec(uniqid()) . '.' . $value->getClientOriginalExtension();
                        $value->move(public_path($upload_location_large), $name_gen);

                        $result =  $slider_item->update([
                            'slider_image_mobile' => $name_gen,
                        ]);
                    }
                }

            }

            $notification = [
                'message' => 'Slider Updated Successfully!!!',
                'alert-type' => 'success'
            ];

            return redirect()->route('slider.index')->with($notification);

        }
    }


    public function destroy($id)
    {
        $slider = Slider::findOrFail($id);
        $slider_id = $slider->id;

        $slider_item = SliderItem::where('slider_id', $id)->get();
        // dd($slider_item);

        foreach($slider_item as $value ){
            if (is_file($value->slider_img)) {
                unlink($value->slider_img);
            } 

            $value->delete();
        }
        

       // $slider_item_del = $slider_item->delete();

        
        $slider_del = $slider->delete();
        if($slider_del){
            
            $notification= [
                'message' => 'Slider Deleted Successfully!!!',
                'alert-type' => 'success'
            ]; 
        } 

        return redirect()->route('slider.index')->with($notification);
    }


    public function add_slider_item($id)
    {
        

        $slider = Slider::where('id', $id)->first();
        return view('admin.slider.create_slider_item', compact( 'slider'));
    }

    public function store_slider_item(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|min:5',
        ]);
        

        if ($validator->fails()) {
            return back()->withInput();
        }
        else{
            $slider_item = new SliderItem;


            $slider_item->slider_id = $request->input('slider_id');
            $slider_item->title = $request->input('title');
            $slider_item->slug =  Str::slug($request->input('title'));
            $slider_item->link_text = $request->input('link_text');
            $slider_item->link = $request->input('link');
            $slider_item->content = $request->input('content');

            if($request->file('slider_image_desk')){
                $images = $request->file('slider_image_desk');
                $upload_location_large = 'upload/slider/large/';
                $name_gen = 'slider_image_desk_' . hexdec(uniqid()) . '.' . $images->getClientOriginalExtension();
                $request->slider_image_desk->move(public_path($upload_location_large), $name_gen);

                $slider_item->slider_image_desk = $name_gen;
            }
            if($request->file('slider_image_tab')){
                $images = $request->file('slider_image_tab');
                $upload_location_large = 'upload/slider/medium/';
                $name_gen = 'slider_image_tab_' . hexdec(uniqid()) . '.' . $images->getClientOriginalExtension();
                $request->slider_image_tab->move(public_path($upload_location_large), $name_gen);

                $slider_item->slider_image_tab = $name_gen;
            }
            if($request->file('slider_image_mobile')){
                $images = $request->file('slider_image_mobile');
                $upload_location_large = 'upload/slider/small/';
                $name_gen = 'slider_image_mobile_' . hexdec(uniqid()) . '.' . $images->getClientOriginalExtension();
                $request->slider_image_mobile->move(public_path($upload_location_large), $name_gen);
                $slider_item->slider_image_mobile = $name_gen;
            }


            $slider_item->save();


            $notification = [
                'message' => 'Slider Created Successfully!!!',
                'alert-type' => 'success'
            ];

            return redirect()->route('slider.index')->with($notification);

        }
    }


    public function trash(Request $request, $id)
    {
        $blogpost = Slider::findOrFail($id);
        $blogpost->update([
            'is_deleted' => 1
        ]);
        $notification = [
            'message' => 'Page moved to trash folder successfully!!!',
            'alert-type' => 'success'
        ];
        return redirect()->route('slider.index')->with($notification);
    }
    public function changestatus(Request $request)
    {
        //dd($request->all());
        $slider = Slider::findOrFail($request->status_change_id);
        $slider->is_published = $request->is_published;
        $slider->save();

        return  response()->json([
            'message' => 'Slider status change successfully.',
            'alert-type' => 'success'
        ]);
    }
    public function restore(Request $request, $id)
    {
        $slider = Slider::findorFail($id);

        $slider->update([
            'is_deleted' => 0
        ]);

        $notification = [
            'message' => 'Page  Restore Successfully!!!',
            'alert-type' => 'success'
        ];

        return redirect()->route('slider.trash_folder')->with($notification);

    }
    
    public function trash_folder()
    {
        $slider = Slider::where('is_deleted', 0)->orderBy('id', 'desc')->get();
        $trash_slider = Slider::where('is_deleted', 1)->get();
        $draft_slider = Slider::where('is_published', 0)->get();

        return view('admin.slider.trash', compact('slider', 'trash_slider', 'draft_slider'));

    }

    public function draft_folder()
    {

        $slider = Slider::where('is_deleted', 0)->orderBy('id', 'desc')->get();
        $trash_slider = Slider::where('is_deleted', 1)->get();
        $draft_slider = Slider::where('is_published', 0)->get();

        return view('admin.slider.draft', compact('slider', 'trash_slider', 'draft_slider'));

    }


    public function delete_single_slide_item($id)
    {
        $slider_item_single = SliderItem::findOrFail($id);
        // if (is_file($media_image->media_file)) {
        //     unlink($media_image->media_file);
        // }
        

        if (is_file($slider_item_single->slider_img)) {
            unlink($slider_item_single->slider_img);
        } 

        $slider_item_single = $slider_item_single->delete();


        if ($slider_item_single) {
            return response()->json(
                ['status'=>true,
                 'response'=>"Slider Item Deleted Successfuly"]
            );
        }

    }


    public function createSlug($title, $id = 0)
    {
        $slug = Str::slug($title);
        $allSlugs = $this->getRelatedSlugs($slug, $id);
        if (!$allSlugs->contains('slug', $slug)) {
            return $slug;
        }

        $i = 1;
        $is_contain = true;
        do {
            $newSlug = $slug . '-' . $i;
            if (!$allSlugs->contains('slug', $newSlug)) {
                $is_contain = false;
                return $newSlug;
            }
            $i++;
        } while ($is_contain);
    }
    protected function getRelatedSlugs($slug, $id = 0)
    {
        return Slider::select('slug')->where('slug', 'like', $slug . '%')
            ->where('id', '<>', $id)
            ->get();
    }


    // images slug
    // Unique Slug generation
}
