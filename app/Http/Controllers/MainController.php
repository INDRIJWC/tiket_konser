<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Order;

class MainController extends Controller
{
    public function userPostLogin(Request $request) {

        $request->validate([
            "email"         =>    "required|email",
            "password"      =>    "required|min:6"
        ]);

        $credentials = [
            'email'             => $request->email,
            'password'          => $request->password,
        ];
        
        if (Auth::attempt($credentials)) {

            return redirect()->intended('dashboard');
            
        }else {
            return back()->with('error', 'Whoops! invalid username or password.');
        }
    }
 
	public function login(){
        return view('signin');
	}

    public function pemesan(){
        if(Auth::check()){
            return view('dashboard/pemesan');
        }
        return redirect::to("/")->withSuccess('Oopps! You do not have access');
	}

    public function order(Request $request){
        $request->validate([
            "name"        =>    "required",
            "alamat"      =>    "required|min:6"
        ]);

        $ticket = Order::insertGetId([
            'name' => $request->name,
            'address' => $request->alamat,
            'checkin' => false
        ]);
        
        if($ticket){
            return view('ticket', ["name" => $request->name, "adderss"=>$request->alamat, "id"=>$ticket]);
        }else{
            return back()->with('error', 'Whoops! Ada sesuatu yg salah nih guys.');
        }   
    }

    public function home(){
		if(Auth::check()) {	            
	        return view('dashboard/index');
		}
        return redirect::to("/")->withSuccess('Oopps! You do not have access');
	}

    public function checkin(){
        if(Auth::check()) {	            
	        return view('dashboard/checkin');
		}
        return redirect::to("/")->withSuccess('Oopps! You do not have access');
    }

    public function report(){
        if(Auth::check()) {	            
	        return view('dashboard/report');
		}
        return redirect::to("/")->withSuccess('Oopps! You do not have access');
    }

    public function deleteOrder($id){
        DB::table('booking')->where('id',base64_decode($id))->delete();
        return back()->with('success', 'Berhasil di hapus.');
    }

    public function editOrder(Request $request){
        $request->validate([
            "id"          =>    "required",
            "nama"        =>    "required",
            "alamat"      =>    "required"
        ]);

        $update = DB::table('booking')->where('id', $request->id)->update([
            'name' => $request->nama,
            'address' => $request->alamat
        ]);

        if($update){
            return back()->with('success', 'Berhasil di update.');
        }
        return back()->with('error', $request->id.' '.$request->nama.' '.$request->alamat);
    }

    public function dataPemesan(Request $request){
        if(Auth::check()) {
            $draw = $request->get('draw');
            $start = $request->get("start");
            $rowperpage = $request->get("length");

            $columnIndex_arr = $request->get('order');
            $columnName_arr = $request->get('columns');
            $order_arr = $request->get('order');
            $search_arr = $request->get('search');

            $columnIndex = $columnIndex_arr[0]['column'];
            $columnName = $columnName_arr[$columnIndex]['data'];
            $columnSortOrder = $order_arr[0]['dir'];
            $searchValue = $search_arr['value'];


            $datatotal = "";
            $data = "";
            
            $data = Order::where('name', 'like', '%' . $searchValue . '%')
                    ->orWhere('address', 'like', '%' . $searchValue . '%')
                    ->orderBy('id','ASC')->get();      
            
            
            $collectAll = collect($data);
            $collectFilter = collect($data);

            $totalRecords = $collectAll->count();
            $totalRecordswithFilter = $collectFilter->count();

            $result = $collectFilter
            ->skip($start)
            ->take($rowperpage);

            $data_arr=array();

            foreach($result as $p){
                $id       = $p->id;
                $nama       = $p->name;
                $address     = $p->address;
                $checkin     = $p->checkin;

                $data_arr[] = array(
                    "id"        => $id,
                    "nama"      => $nama,
                    "address"    => $address,
                    "checkin"       => $checkin
                );
            }

            $response = array(
                "draw" => intval($draw),
                "iTotalRecords" => $totalRecords,
                "iTotalDisplayRecords" => $totalRecordswithFilter,
                "aaData" => $data_arr
            );

            echo json_encode($response);
            exit;
            

        }else{
			echo json_encode("U dont have access");
				exit;
		}
	}

    public function requestData(Request $request, $type){
		if(Auth::check()) {
            $draw = $request->get('draw');
            $start = $request->get("start");
            $rowperpage = $request->get("length");

            $columnIndex_arr = $request->get('order');
            $columnName_arr = $request->get('columns');
            $order_arr = $request->get('order');
            $search_arr = $request->get('search');

            $columnIndex = $columnIndex_arr[0]['column'];
            $columnName = $columnName_arr[$columnIndex]['data'];
            $columnSortOrder = $order_arr[0]['dir'];
            $searchValue = $search_arr['value'];


            $datatotal = "";
            $data = "";
            
            $data = Order::where('checkin',$type)
                    ->where('name', 'like', '%' . $searchValue . '%')
                    ->orderBy('id','DESC')->get();      
            
            
            $collectAll = collect($data);
            $collectFilter = collect($data);

            $totalRecords = $collectAll->count();
            $totalRecordswithFilter = $collectFilter->count();

            $result = $collectFilter
            ->skip($start)
            ->take($rowperpage);

            $data_arr=array();

            foreach($result as $p){
                $nama       = $p->name;
                $address     = $p->address;
                $checkin     = $p->checkin;

                $data_arr[] = array(
                    "nama"      => $nama,
                    "address"    => $address,
                    "checkin"       => $checkin
                );
            }

            $response = array(
                "draw" => intval($draw),
                "iTotalRecords" => $totalRecords,
                "iTotalDisplayRecords" => $totalRecordswithFilter,
                "aaData" => $data_arr,
                "type"=>$type
            );

            echo json_encode($response);
            exit;
            

        }else{
			echo json_encode("U dont have access");
				exit;
		}
	}

    public function checkinTicket(Request $request){
        $request->validate([
            "idt"        =>    "required",
        ]);
        
        $ticket = Order::where(['id' => $request->idt])->first();
        if(!$ticket->checkin){
            DB::table('booking')->where(['id' => $request->idt])->update([
                'checkin' => true
            ]);
            $ticket = Order::where(['id' => $request->idt])->first();
        }else{
            return back()->with('error', 'Whoops! Sudah checkin');
        }
        
        
        if($ticket){
            return view('dashboard/detailticket', ["ticket" => $ticket]);
        }else{
            return back()->with('error', 'Whoops! Tiket tidak ditemukan');
        }
    }
    
}
