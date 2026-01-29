<?php

namespace App\Http\Controllers\backend;
use App\Http\Controllers\Controller;
use App\Http\Requests\BrandingValidate;
use App\Http\Requests\FooterLinkValidate;
use App\Http\Requests\SEOValidate;
use App\Http\Requests\SlideDataValidate;
use App\Http\Requests\SlideDataValidate2;
use App\Http\Requests\SlideDataValidate3;
use App\Http\Requests\SlideDataValidate4;
use App\Http\Requests\SlideDataValidate5;
use App\Http\Requests\SlideDataValidate6;
use App\Http\Requests\SocialMediaValidate;
use App\Http\Requests\AddressValidate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use App\Models\Setting;

class SettingController extends Controller
{
    public function siteSettings(){
        $settings = Setting::first();
        return view('Backend.Pages.Site-Settings', compact('settings'));
    }

    public function brandingUpdate(BrandingValidate $request){
        $validateData = $request->validated();

        $settings = Setting::first();

        if (!$settings) {
            return redirect()->back()->with("error", "সাইট সেটিংস পাওয়া যায়নি।");
        }

        if ($request->hasFile('logo')) {
            if ($settings->logo_path && Storage::disk('public')->exists($settings->logo_path)) {
                Storage::disk('public')->delete($settings->logo_path);
            }

            $logo = $request->file('logo');
            $logoName = time() . '_' . uniqid() . '.' . $logo->getClientOriginalExtension();
            $logoPath = $logo->storeAs('branding', $logoName, 'public');
        } else {
            $logoPath = $settings->logo_path;
        }

        if ($request->hasFile('favicon')) {
            if ($settings->favicon_path && Storage::disk('public')->exists($settings->favicon_path)) {
                Storage::disk('public')->delete($settings->favicon_path);
            }

            $favicon = $request->file('favicon');
            $faviconName = time() . '_' . uniqid() . '.' . $favicon->getClientOriginalExtension();
            $faviconPath = $favicon->storeAs('branding', $faviconName, 'public');
        } else {
            $faviconPath = $settings->favicon_path;
        }

        $settings->update([
            "site_title"   => $validateData['site_title'],
            "tagline"      => $validateData['tagline'],
            "logo_path"    => $logoPath,
            "favicon_path" => $faviconPath,
        ]);

        return redirect()->back()->with("success", "সাইটের ব্র্যান্ডিং সফলভাবে আপডেট হয়েছে।");
    }


    public function seoUpdate(SEOValidate $request){
        $validateData = $request->validated();

        $settings = Setting::first();
        if(!$settings){
            return redirect()->back()->with("error", "সাইট সেটিংস পাওয়া যায়নি।");
        }

        $settings->update([
            "meta_title"            => $validateData['meta_title'],
            "meta_description"      => $validateData['meta_description'],
            "meta_keywords"         => $validateData['meta_keywords'],
            "google_search_console" => $validateData['google_search_console'],
            "google_analytics"      => $validateData['google_analytics'],
        ]);

        return redirect()->back()->with("success", "সাইটের SEO সফলভাবে আপডেট হয়েছে।");
    }

    public function slideOneUpdate(SlideDataValidate $request){

        $validateData = $request->validated();

        $settings = Setting::first();
        if(!$settings){
            return redirect()->back()->with("error", "সাইট সেটিংস পাওয়া যায়নি।");
        }

       if ($request->hasFile('slide_image')) {
            if ($settings->slide_image_1_path && file_exists(public_path($settings->slide_image_1_path))) {
                unlink(public_path($settings->slide_image_1_path));
            }
            $image = $request->file('slide_image');
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('slide');
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }
            $image->move($destinationPath, $imageName);
            $imagePath = 'slide/' . $imageName;
        } else {
            $imagePath = $settings->slide_image_1_path;
        }

        $settings->update([
            "slide_title_1"       => $validateData['slide_title'],
            "slide_description_1" => $validateData['slide_description'],
            "slide_image_1_path"  => $imagePath,
        ]);

        return redirect()->back()->with("success", "স্লাইড তথ্য সফলভাবে আপডেট হয়েছে।");
    }

    public function slideTwoUpdate(SlideDataValidate2 $request){

        $validateData = $request->validated();

        $settings = Setting::first();
        if(!$settings){
            return redirect()->back()->with("error", "সাইট সেটিংস পাওয়া যায়নি।");
        }

       if ($request->hasFile('slide_image_2')) {
            if ($settings->slide_image_2_path && file_exists(public_path($settings->slide_image_2_path))) {
                unlink(public_path($settings->slide_image_2_path));
            }
            $image = $request->file('slide_image_2');
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('slide');
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }
            $image->move($destinationPath, $imageName);
            $imagePath = 'slide/' . $imageName;
        } else {
            $imagePath = $settings->slide_image_2_path;
        }

        $settings->update([
            "slide_title_2"       => $validateData['slide_title_2'],
            "slide_description_2" => $validateData['slide_description_2'],
            "slide_image_2_path"  => $imagePath,
        ]);

        return redirect()->back()->with("success", "স্লাইড তথ্য সফলভাবে আপডেট হয়েছে।");
    }

    public function slideThreeUpdate(SlideDataValidate3 $request){

        $validateData = $request->validated();

        $settings = Setting::first();
        if(!$settings){
            return redirect()->back()->with("error", "সাইট সেটিংস পাওয়া যায়নি।");
        }

       if ($request->hasFile('slide_image_3')) {
            if ($settings->slide_image_3_path && file_exists(public_path($settings->slide_image_3_path))) {
                unlink(public_path($settings->slide_image_3_path));
            }
            $image = $request->file('slide_image_3');
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('slide');
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }
            $image->move($destinationPath, $imageName);
            $imagePath = 'slide/' . $imageName;
        } else {
            $imagePath = $settings->slide_image_3_path;
        }

        $settings->update([
            "slide_title_3"       => $validateData['slide_title_3'],
            "slide_description_3" => $validateData['slide_description_3'],
            "slide_image_3_path"  => $imagePath,
        ]);

        return redirect()->back()->with("success", "স্লাইড তথ্য সফলভাবে আপডেট হয়েছে।");
    }

    public function slideFourUpdate(SlideDataValidate4 $request){

        $validateData = $request->validated();

        $settings = Setting::first();
        if(!$settings){
            return redirect()->back()->with("error", "সাইট সেটিংস পাওয়া যায়নি।");
        }

       if ($request->hasFile('slide_image_4')) {
            if ($settings->slide_image_4_path && file_exists(public_path($settings->slide_image_4_path))) {
                unlink(public_path($settings->slide_image_4_path));
            }
            $image = $request->file('slide_image_4');
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('slide');
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }
            $image->move($destinationPath, $imageName);
            $imagePath = 'slide/' . $imageName;
        } else {
            $imagePath = $settings->slide_image_4_path;
        }

        $settings->update([
            "slide_title_4"       => $validateData['slide_title_4'],
            "slide_description_4" => $validateData['slide_description_4'],
            "slide_image_4_path"  => $imagePath,
        ]);

        return redirect()->back()->with("success", "স্লাইড তথ্য সফলভাবে আপডেট হয়েছে।");
    }

    public function slideFiveUpdate(SlideDataValidate5 $request){

        $validateData = $request->validated();

        $settings = Setting::first();
        if(!$settings){
            return redirect()->back()->with("error", "সাইট সেটিংস পাওয়া যায়নি।");
        }

       if ($request->hasFile('slide_image_5')) {
            if ($settings->slide_image_5_path && file_exists(public_path($settings->slide_image_5_path))) {
                unlink(public_path($settings->slide_image_5_path));
            }
            $image = $request->file('slide_image_5');
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('slide');
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }
            $image->move($destinationPath, $imageName);
            $imagePath = 'slide/' . $imageName;
        } else {
            $imagePath = $settings->slide_image_5_path;
        }

        $settings->update([
            "slide_title_5"       => $validateData['slide_title_5'],
            "slide_description_5" => $validateData['slide_description_5'],
            "slide_image_5_path"  => $imagePath,
        ]);

        return redirect()->back()->with("success", "স্লাইড তথ্য সফলভাবে আপডেট হয়েছে।");
    }

    public function slideSixUpdate(SlideDataValidate6 $request){

        $validateData = $request->validated();

        $settings = Setting::first();
        if(!$settings){
            return redirect()->back()->with("error", "সাইট সেটিংস পাওয়া যায়নি।");
        }

       if ($request->hasFile('slide_image_6')) {
            if ($settings->slide_image_6_path && file_exists(public_path($settings->slide_image_6_path))) {
                unlink(public_path($settings->slide_image_6_path));
            }
            $image = $request->file('slide_image_6');
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('slide');
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }
            $image->move($destinationPath, $imageName);
            $imagePath = 'slide/' . $imageName;
        } else {
            $imagePath = $settings->slide_image_6_path;
        }

        $settings->update([
            "slide_title_6"       => $validateData['slide_title_6'],
            "slide_description_6" => $validateData['slide_description_6'],
            "slide_image_6_path"  => $imagePath,
        ]);

        return redirect()->back()->with("success", "স্লাইড তথ্য সফলভাবে আপডেট হয়েছে।");
    }

    public function footerLinkUpdate(FooterLinkValidate $request){

        $validateData = $request->validated();

        $settings = Setting::first();
        if(!$settings){
            return redirect()->back()->with("error", "সাইট সেটিংস পাওয়া যায়নি।");
        }

        $settings->update([
            "link_name_1" => $validateData['link_name_1'],
            "link_1" => $validateData['link_1'],

            "link_name_2" => $validateData['link_name_2'],
            "link_2" => $validateData['link_2'],

            "link_name_3" => $validateData['link_name_3'],
            "link_3" => $validateData['link_3'],
        ]);

        return redirect()->back()->with("success", "ফুটার লিংক সফলভাবে আপডেট হয়েছে।");
    }

    public function socialUpdate(SocialMediaValidate $request){
        $validateData = $request->validated();

        $settings = Setting::first();
        if(!$settings){
            return redirect()->back()->with("error", "সাইট সেটিংস পাওয়া যায়নি।");
        }

        $settings->update([
            "facebook_url" => $validateData['facebook_url'],
            "youtube_url" => $validateData['youtube_url'],
            "twitter_url" => $validateData['twitter_url'],
            "instagram_url" => $validateData['instagram_url'],
        ]);

        return redirect()->back()->with("success", "সোশ্যাল মিডিয়া লিংক সফলভাবে আপডেট হয়েছে।");
    }

    public function contactInfoUpdate(AddressValidate $request){
        $validateData = $request->Validated();

        $settings = Setting::first();
        if(!$settings){
            return redirect()->back()->with("error", "সাইট সেটিংস পাওয়া যায়নি।");
        }

        $settings->update([
            "email"    => $validateData['email'],
            "phone_no" => $validateData['phone_no'],
            "address"  => $validateData['address'],
        ]);

        return redirect()->back()->with("success", "যোগাযোগের তথ্য সফলভাবে আপডেট হয়েছে।");
    }
}