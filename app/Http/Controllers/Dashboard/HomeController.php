<?php

namespace App\Http\Controllers\Dashboard;


use App\Models\Ad;
use App\Models\Nw;
use App\Models\About;
use App\Models\Artical;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Publisher;
use Illuminate\Support\Facades\Storage;


class HomeController extends Controller
{

    public function index()
    {

        $ad_count = Ad::count();
        $a_count = Artical::count();
        $n_count = Nw::count();
        $p_count = Publisher::count();
       

        return view('dashboard.index' , compact('ad_count','a_count','n_count','p_count'));
    }


    public function edit($id)
    {
        $this->authorize('edit', About::class);
        $abouts = About::findOrFail($id);
        return view('dashboard.abouts.edit', compact('abouts'));
    }




    public function update(Request $request, $id)
    {
        $this->authorize('edit', About::class);
        $request->validate([
            'about_ar' => 'required',
            'about_en' => 'required',
            'objective_ar' => 'required',
            'objective_en' => 'required',
            'mission_ar' => 'required',
            'mission_en' => 'required',
            'vission_ar' => 'required',
            'vission_en' => 'required',
            'goal_ar' => 'required',
            'goal_en' => 'required',
            'image' => 'required|image',
            
        ]);

        $abouts = About::findOrFail($id); 

    if ($request->hasFile('image')) {
        // حذف الصورة القديمة إذا كانت موجودة
        if ($abouts->image && Storage::exists('uploads/abouts/' . $abouts->image)) {
            Storage::delete('uploads/abouts/' . $abouts->image);
        }

        // توليد اسم جديد للصورة وتخزينها
        $img_name = rand() . time() . $request->file('image')->getClientOriginalName();
        $request->file('image')->move(public_path('uploads/abouts'), $img_name);
    }


        $abouts::updat([
             'image' => $img_name,
             'about_ar' => $request->about_ar,
            'about_en' => $request->about_en,
            'objective_ar' => $request->objective_ar,
            'objective_en' => $request->objective_en,
            'mission_ar' => $request->mission_ar,
            'mission_en' => $request->mission_en,
            'vission_ar' => $request->vission_ar,
            'vission_en' => $request->vission_en,
            'goal_ar' => $request->goal_ar,
            'goal_en' => $request->goal_en,


    ]);



       
        return redirect()->route('dashboard.about.edit')->with('success', __('About updated successfully.'));
    }


}
