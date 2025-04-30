<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ReviewData;
use Illuminate\Http\Request;
use App\Models\Home;
use App\Models\Possible;
use App\Models\WhyChooseUs;
use App\Models\About;
use App\Models\AboutSec2;
use App\Models\Address;
use App\Models\Banner;
use App\Models\Body1;
use App\Models\Body2;
use App\Models\Contact;
use App\Models\ContactMessage;
use App\Models\Footer;
use App\Models\Hero;
use App\Models\Menu;
use App\Models\Navbar;
use App\Models\OurContact;
use App\Models\OurCoreValue;
use App\Models\PoweredByMrPc;
use App\Models\Review;
use App\Models\ReviewContent;
use App\Models\Service;

class FrontendController extends Controller
{
    public function getAllData()
    {
        $data = [
            'navbar' => Navbar::all(), 
            'about' => About::all(),
            'aboutsec2' => AboutSec2::all(),
            'banner' => Banner::all(),
            'services_background' => Menu::all(),
            'services_delivery' => Home::all(),
            'services_heading' => Hero::all(),
            'services_projectmanagement'=>Body1::all(),
            'services_support'=>Body2::all(),
            'possible' => Possible::all(),
            'ourcorevalue' => OurCoreValue::all(),
            'whychooseus' => WhyChooseUs::all(),
            'poweredbymrpc' => PoweredByMrPc::all(),
            'service' => Service::all(),
            'contact' => Contact::all(),
            'review' => Review::all(),
            'ourcontact' => OurContact::all(),
            'footer' => Footer::all(),
            'contactmessage' => ContactMessage::all(),
            'reviewcontent' => ReviewData::all(), 
            'reviewBackimg' => ReviewContent::all(), 
            'address' => Address::all(),

        ];

        return response()->json($data);
    }
}
