<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use File;
class ConfigureController extends Controller
{
    public function configure(){
    	return view('config.config');
    }

    public function sbus(){
    	try{
    		$bid=0;
    		$did=0;
    		$gid=0;
    		$dev = array();
    		$but = array();
    		$gat = array();
    		$path = base_path();
			$sbus_path = env('SBUS_BRIDGE_PATH');
			$buttons = $path.$sbus_path."buttons.txt";
			$devices = $path.$sbus_path."devices.txt";
			$gateways = $path.$sbus_path."gateways.txt";
			if(!file_exists($buttons))
				File::put($buttons,"");
			if(!file_exists($devices))
				File::put($devices,"");
			if(!file_exists($gateways))
				File::put($gateways,"");
			$b_content = File::get($buttons);
			$d_content = File::get($devices);
			$g_content = File::get($gateways);
			$d_rows = explode("\n",$d_content);
			$b_rows = explode("\n",$b_content);
			$g_rows = explode("\n",$g_content);
			foreach ($g_rows as $row) {
				if($row!=NULL){
					$data = explode(" ", $row);
					$temp['ip_addr'] = $data[0];
					$temp['username'] = $data[1];
					$temp['password'] = $data[2];
					$temp['id'] = $gid;
					array_push($gat,$temp);
					$gid++;
				}
			}

			foreach ($d_rows as $row) {
				if($row!=NULL){
					$data = explode(" ", $row);
					$temp['device_id'] = $data[0];
					$temp['ip_addr'] = $data[1];
					$temp['port'] = $data[2];
					$temp['id'] = $did;
					array_push($dev,$temp);
					$did++;
				}
			}
			
			foreach ($b_rows as $row) {
				if($row!=NULL){
					$data = explode(" ", $row);
					$temp['device_id'] = $data[0];
					$temp['button_id'] = $data[1];
					$temp['target_id'] = $data[2];
					$temp['ip_addr'] = $data[3];
					$temp['username'] = $data[4];
					$temp['password'] = $data[5];
					$temp['type'] = $data[6];
					$temp['id'] = $bid;
					array_push($but,$temp);
					$bid++;
				}
			}
    		return view('config.sbus',['devices'=>$dev,'buttons'=>$but,'gateways'=>$gat]);
    	}
    	catch(Exception $e){
    		return $e;
    	}
    }

    public function sbus_add_device(Request $request){
    	$rules = [
    		'device_id' => 'required|numeric',
    		'ip_addr' => 'required|ipv4',
    		'port' => 'required|numeric|max:65535'
    	];
    	$this->validate($request, $rules);
    	$data = $request->all();
    	$path = base_path();
		$sbus_path = env('SBUS_BRIDGE_PATH');
		$devices = $path.$sbus_path."devices.txt";
		$temp = $data['device_id']." ".$data['ip_addr']." ".$data['port']."\n";
		File::append($devices, $temp);
    	return redirect('/sbus');
    }

    public function sbus_delete_device($id){
    	try{
    		$lid=0;
    		$dev = array();
    		$path = base_path();
			$sbus_path = env('SBUS_BRIDGE_PATH');
			$devices = $path.$sbus_path."devices.txt";
			$d_content = File::get($devices);
			$d_rows = explode("\n",$d_content);

			foreach ($d_rows as $row) {
				if($row!=NULL){
					$data = explode(" ", $row);
					if($lid != $id){
						$temp = $data[0]." ".$data[1]." ".$data[2]."\n";
						array_push($dev,$temp);
					}
					$lid++;
				}
			}
			File::put($devices, $dev);
			return redirect('/sbus');

    	}
    	catch(Exception $e){

    	}
    }

    public function sbus_add_button(Request $request){
    	$rules = [
    		'device_id' => 'required|numeric',
    		'button_id' => 'required|numeric',
    		'target_id' => 'required|numeric',
    		'ip_addr' => 'required|ipv4',
    		'type' => 'required'
    	];
    	$username = "";
    	$password = "";
    	$this->validate($request, $rules);
    	$data = $request->all();
    	$path = base_path();
		$sbus_path = env('SBUS_BRIDGE_PATH');
		$buttons = $path.$sbus_path."buttons.txt";
		$gateways = $path.$sbus_path."gateways.txt";
		$g_content = File::get($gateways);
		$g_rows = explode("\n",$g_content);
		foreach ($g_rows as $row) {
			if($row!=NULL){
				$dat = explode(" ", $row);
				if($dat[0] == $data['ip_addr']){
					$username = $dat[1];
					$password = $dat[2];
				}
			}
		}
		$temp = $data['device_id']." ".$data['button_id']." ".$data['target_id']." ".$data['ip_addr']." ".$username." ".$password." ".$data['type']."\n";
		File::append($buttons, $temp);
    	return redirect('/sbus');
    }

    public function sbus_delete_button($id){
    	try{
    		$lid=0;
    		$dev = array();
    		$path = base_path();
			$sbus_path = env('SBUS_BRIDGE_PATH');
			$buttons = $path.$sbus_path."buttons.txt";
			$b_content = File::get($buttons);
			$b_rows = explode("\n",$b_content);

			foreach ($b_rows as $row) {
				if($row!=NULL){
					$data = explode(" ", $row);
					if($lid != $id){
						$temp = $data[0]." ".$data[1]." ".$data[2]." ".$data[3]." ".$data[4]." ".$data[5]." ".$data[6]."\n";
						array_push($dev,$temp);
					}
					$lid++;
				}
			}
			File::put($buttons, $dev);
			return redirect('/sbus');

    	}
    	catch(Exception $e){

    	}
    }

    public function sbus_add_gateway(Request $request){
    	try{
	    	$rules = [
	    		'ip_addr' => 'required|ipv4',
	    		'username' => 'required',
	    		'password' => 'required'
	    	];
	    	$this->validate($request, $rules);
	    	$data = $request->all();
	    	$path = base_path();
			$sbus_path = env('SBUS_BRIDGE_PATH');
			$gateways = $path.$sbus_path."gateways.txt";
			$temp = $data['ip_addr']." ".$data['username']." ".$data['password']."\n";
			File::append($gateways, $temp);
	    	return redirect('/sbus');
    	}
    	catch(Exception $e){

    	}
    }

    public function sbus_delete_gateway($id){
    	try{
    		$lid=0;
    		$dev = array();
    		$path = base_path();
			$sbus_path = env('SBUS_BRIDGE_PATH');
			$gateways = $path.$sbus_path."gateways.txt";
			$g_content = File::get($gateways);
			$g_rows = explode("\n",$g_content);

			foreach ($g_rows as $row) {
				if($row!=NULL){
					$data = explode(" ", $row);
					if($lid != $id){
						$temp = $data[0]." ".$data[1]." ".$data[2]."\n";
						array_push($dev,$temp);
					}
					$lid++;
				}
			}
			File::put($gateways, $dev);
			return redirect('/sbus');
    	}
    	catch(Exception $e){

    	}
    }

    public function zmote(){
    	try{
    		$bid=0;
    		$did=0;
    		$zid=0;
    		$dev = array();
    		$but = array();
    		$zmote = array();
    		$path = base_path();
			$sbus_path = env('ZMOTE_BRIDGE_PATH');
			$buttons = $path.$sbus_path."Buttons.txt";
			$devices = $path.$sbus_path."Devices.txt";
			$zmotes = $path.$sbus_path."ZMotes.txt";
			if(!file_exists($buttons))
				File::put($buttons,"");
			if(!file_exists($devices))
				File::put($devices,"");
			if(!file_exists($zmotes))
				File::put($zmotes,"");
			$b_content = File::get($buttons);
			$d_content = File::get($devices);
			$z_content = File::get($zmotes);
			$d_rows = explode("\n",$d_content);
			$b_rows = explode("\n",$b_content);
			$z_rows = explode("\n",$z_content);

			foreach ($d_rows as $row) {
				if($row!=NULL){
					$data = explode(" ", $row);
					$temp['device_id'] = $data[0];
					$temp['ip_addr'] = $data[1];
					$temp['port'] = $data[2];
					$temp['id'] = $did;
					array_push($dev,$temp);
					$did++;
				}
			}

			foreach ($z_rows as $row) {
				if($row!=NULL){
					$data = explode(" ", $row);
					$temp['device_id'] = $data[0];
					$temp['UUID'] = $data[1];
					$temp['ip_addr'] = $data[2];
					$temp['id'] = $zid;
					array_push($zmote,$temp);
					$zid++;
				}
			}
			
			foreach ($b_rows as $row) {
				if($row!=NULL){
					$data = explode(" ", $row);
					$s="";
					switch($data[1]){
						case "01" : $s= "ON";
						break;
						case "02" : $s= "OFF";
						break;
						case "0a" : $s= "LOW";
						break;
						case "0b" : $s= "MED";
						break;
						case "0c" : $s= "HIGH";
						break;
						case "10" : $s= "16";
						break;
						case "11" : $s= "17";
						break;
						case "12" : $s= "18";
						break;
						case "13" : $s= "19";
						break;
						case "14" : $s= "20";
						break;
						case "15" : $s= "21";
						break;
						case "16" : $s= "22";
						break;
						case "17" : $s= "23";
						break;
						case "18" : $s= "24";
						break;
						case "19" : $s= "25";
						break;
						case "1a" : $s= "26";
						break;
						case "1b" : $s= "27";
						break;
						case "1c" : $s= "28";
						break;
						case "1d" : $s= "29";
						break;
						case "1e" : $s= "30";
						break;
					}

					$temp['UUID'] = $data[0];
					$temp['button_id'] = $data[1];
					$temp['ir_code'] = $data[2];
					$temp['type'] = $s;
					$temp['id'] = $bid;
					array_push($but,$temp);
					$bid++;
				}
			}


    		return view('config.zmote',['devices'=>$dev,'buttons'=>$but,'zmotes'=>$zmote]);
    	}
    	catch(Exception $e){

    	}
    }

    public function zmote_add_device(Request $request){
    	try{
    		$rules = [
	    		'ip_addr' => 'required|ipv4',
	    		'device_id' => 'required|numeric',
	    		'port' => 'required|numeric|max:65535'
	    	];
	    	$this->validate($request, $rules);
	    	$data = $request->all();
	    	$path = base_path();
			$sbus_path = env('ZMOTE_BRIDGE_PATH');
			$devices = $path.$sbus_path."Devices.txt";
			$temp = $data['device_id']." ".$data['ip_addr']." ".$data['port']."\n";
			File::append($devices, $temp);
	    	return redirect('/zmote');
    	}
    	catch(Exception $e){

    	}
    }

    public function zmote_add_zmote(Request $request){
    	try{
    		$rules = [
	    		'ip_addr' => 'required|ipv4',
	    		'device_id' => 'required|numeric',
	    		'UUID' => 'required'
	    	];
	    	$this->validate($request, $rules);
	    	$data = $request->all();
	    	$path = base_path();
			$sbus_path = env('ZMOTE_BRIDGE_PATH');
			$zmotes = $path.$sbus_path."ZMotes.txt";
			$temp = $data['device_id']." ".$data['UUID']." ".$data['ip_addr']."\n";
			File::append($zmotes, $temp);
	    	return redirect('/zmote');
    	}
    	catch(Exception $e){

    	}
    }

    public function zmote_add_button(Request $request){
    	try{
    		$s="";
    		$rules = [
	    		'device_id' => 'required|numeric',
	    		'zmote_uuid' => 'required',
	    		'type' => 'required',
	    		'ir_code' => 'required'
	    	];
	    	$this->validate($request, $rules);
	    	$data = $request->all();
	    	$path = base_path();
			$sbus_path = env('ZMOTE_BRIDGE_PATH');
			$buttons = $path.$sbus_path."Buttons.txt";
			
			switch($data['type']){
				case "ON" : $s= "01";
				break;
				case "OFF" : $s= "02";
				break;
				case "LOW" : $s= "0a";
				break;
				case "MED" : $s= "0b";
				break;
				case "HIGH" : $s= "0c";
				break;
				case "16" : $s= "10";
				break;
				case "17" : $s= "11";
				break;
				case "18" : $s= "12";
				break;
				case "19" : $s= "13";
				break;
				case "20" : $s= "14";
				break;
				case "21" : $s= "15";
				break;
				case "22" : $s= "16";
				break;
				case "23" : $s= "17";
				break;
				case "24" : $s= "18";
				break;
				case "25" : $s= "19";
				break;
				case "26" : $s= "1a";
				break;
				case "27" : $s= "1b";
				break;
				case "28" : $s= "1c";
				break;
				case "29" : $s= "1d";
				break;
				case "30" : $s= "1e";
				break;
			}

			$temp = $data['zmote_uuid']." ".$s." ".$data['ir_code']."\n";
			File::append($buttons, $temp);
	    	return redirect('/zmote');
    	}
    	catch(Exception $e){

    	}
    }

    public function zmote_delete_device($id){
    	try{
    		$lid=0;
    		$dev = array();
    		$path = base_path();
			$sbus_path = env('ZMOTE_BRIDGE_PATH');
			$devices = $path.$sbus_path."Devices.txt";
			$d_content = File::get($devices);
			$d_rows = explode("\n",$d_content);

			foreach ($d_rows as $row) {
				if($row!=NULL){
					$data = explode(" ", $row);
					if($lid != $id){
						$temp = $data[0]." ".$data[1]." ".$data[2]."\n";
						array_push($dev,$temp);
					}
					$lid++;
				}
			}
			File::put($devices, $dev);
			return redirect('/zmote');
    	}
    	catch(Exception $e){

    	}
    }

    public function zmote_delete_zmote($id){
    	try{
    		$lid=0;
    		$dev = array();
    		$path = base_path();
			$sbus_path = env('ZMOTE_BRIDGE_PATH');
			$zmotes = $path.$sbus_path."ZMotes.txt";
			$z_content = File::get($zmotes);
			$z_rows = explode("\n",$z_content);

			foreach ($z_rows as $row) {
				if($row!=NULL){
					$data = explode(" ", $row);
					if($lid != $id){
						$temp = $data[0]." ".$data[1]." ".$data[2]."\n";
						array_push($dev,$temp);
					}
					$lid++;
				}
			}
			File::put($zmotes, $dev);
			return redirect('/zmote');
    	}
    	catch(Exception $e){

    	}
    }

    public function zmote_delete_button($id){
    	try{
    		$lid=0;
    		$but = array();
    		$path = base_path();
			$sbus_path = env('ZMOTE_BRIDGE_PATH');
			$buttons = $path.$sbus_path."Buttons.txt";
			$b_content = File::get($buttons);
			$b_rows = explode("\n",$b_content);

			foreach ($b_rows as $row) {
				if($row!=NULL){
					$data = explode(" ", $row);
					if($lid != $id){
						$temp = $data[0]." ".$data[1]." ".$data[2]."\n";
						array_push($but,$temp);
					}
					$lid++;
				}
			}
			File::put($buttons, $but);
			return redirect('/zmote');
    	}
    	catch(Exception $e){

    	}
    }

    public function reset(){
    	try{
    		$path = base_path();
			$sbus_keys = $path.env('SBUS_BRIDGE_PATH')."keys.txt";
			$sbus_devices = $path.env('SBUS_BRIDGE_PATH')."devices.txt";
			$sbus_buttons = $path.env('SBUS_BRIDGE_PATH')."buttons.txt";
			$sbus_gateways = $path.env('SBUS_BRIDGE_PATH')."gateways.txt";

			$zmote_keys = $path.env('ZMOTE_BRIDGE_PATH')."keys.txt";
			$zmote_devices = $path.env('ZMOTE_BRIDGE_PATH')."Devices.txt";
			$zmote_buttons = $path.env('ZMOTE_BRIDGE_PATH')."Buttons.txt";
			$zmote_zmotes = $path.env('ZMOTE_BRIDGE_PATH')."ZMotes.txt";

			File::Delete($sbus_keys);
			File::Delete($sbus_devices);
			File::Delete($sbus_buttons);
			File::Delete($sbus_gateways);

			File::Delete($zmote_keys);
			File::Delete($zmote_devices);
			File::Delete($zmote_buttons);
			File::Delete($zmote_zmotes);
    		return redirect('/');
    	}
    	catch(Exception $e){
    		
    	}
    }

    public function reboot(){
    	try{
    		echo "Device Rebooting...<BR>";
    		$path = base_path().'/reboot.sh';
    		exec($path,$output,$result);
    		return $result;
    	}
    	catch(Exception $e){
    		return $e;
    	}
    }
}
