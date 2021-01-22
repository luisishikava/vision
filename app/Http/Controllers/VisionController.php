<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Google\Cloud\Vision\VisionClient;
use Libern\QRCodeReader\QRCodeReader;
use Goutte\Client;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\DomCrawler\Crawler;

class VisionController extends Controller
{

    public function checkImage(){
        return view('check-image');
    }


    public function checkImageSuccessPost(Request $request){
        $imageName = time() . $request->file('image')->getClientOriginalName();
        $request->file('image')->move(public_path('image'), $imageName);

        $vision = new VisionClient(['keyFile' => json_decode(file_get_contents(""), true)]);
        $image = fopen(public_path('image') . '/' . $imageName, 'r');
        $image = $vision->image($image, ['WEB_DETECTION', 'FACE_DETECTION', 'TEXT_DETECTION']);
        $result = $vision->annotate($image);
        $fullText = $result->fullText();
        $info = $result->info();
        $countString = null;
        
        if (isset($fullText)){
            $countString = strlen($fullText->text());
        }else{
            $countString = 0;
        }
        return view('check-image-success', ['image' => $imageName, 'fullText' => $fullText, 'info' => $info, 'countString' => $countString]);
    }

    public function checkQrcode(){
        return view('check-qrcode');
    }

    public function checkQrcodePost(Request $request){
        if ($request->hasFile('image')) {
            if ($request->file('image')->isValid()) {
                $uploadedFile = $request->file('image');
                $filename = time() . $uploadedFile->getClientOriginalName();
                $path = $request->image->storeAs('public', $filename);
                $QRCodeReader = new QRCodeReader();
                $qrcode_text = $QRCodeReader->decode(public_path('storage') . '/' . $filename);
     
            }
        }
        
        $vision = new VisionClient(['keyFile' => json_decode(file_get_contents(""), true)]);
        $image = fopen(public_path('storage') . '/' . $filename, 'r');
        $image = $vision->image($image, ['TEXT_DETECTION']);
        $result = $vision->annotate($image);
        $fullText = $result->fullText();
        $info = $result->info();
        $countString = null;

        if (isset($fullText)){
            $countString = strlen($fullText->text());
        }else{
            $countString = 0;
        }
        
     
        $items = [];
        $client = new Client(HttpClient::create(['timeout' => 60]));
        $crawler = $client->request('GET', $qrcode_text);
        foreach ($crawler->filter('[id*=Item]') as $key => $element) {
            $domElement = new Crawler($element);
            $items[$key]['title'] = $domElement->filter('.txtTit')->text();
            $items[$key]['code'] = $domElement->filter('.RCod')->text();
            $items[$key]['qtd'] = $domElement->filter('.Rqtd')->text();
            $items[$key]['price'] = $domElement->filter('.RvlUnit')->text();
            $items[$key]['total'] = $domElement->filter('.valor')->text();
        }

        return view('check-qrcode-success', ['image' => $filename, 'fullText' => $fullText, 'items' => $items, 'countString' => $countString]);
    }
}
