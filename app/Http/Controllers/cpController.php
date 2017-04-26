<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

use Auth;
use DB;

// use Illuminate\Support\Facades\Auth;
//use Illuminate\Support\Facades\DB;
//use App\Database\Eloquent\Model;



class cpController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /////////////////////////////////////////////////////////////////////
        // FIX ME
        // get data from users table : id, name, email, status, edu level...   
        // get data from edu table: id, school, major, time, degree, description
        // get data from exp table: id, orgnization, role, time, description
        // get data from img table: id, url, project...
        /////////////////////////////////////////////////////////////////////

        $user = Auth::user()->name;
        $id = Auth::id();
        
        $basicDB = DB::table('users')->where('id',$id);
        $myinfo['id'] = $basicDB->value('id');
        $myinfo['name'] = $basicDB->value('name');
        $name = $basicDB->value('name');
        $myinfo['status'] = $basicDB->value('status');
        $myinfo['edulevel'] = $basicDB->value('educationDegree');
        $myinfo['major'] = $basicDB->value('major');
        $myinfo['language'] = $basicDB->value('language');
        $myinfo['imgurl'] = $basicDB->value('url');

        $expDB = DB::select('select * from experience where name = :name', ['name' => $name]);
        $eduDB = DB::select('select * from education where name = :name', ['name' => $name]);
        $imgDB = DB::select('select * from image where name = :name', ['name' => $name]);

        // $myinfo = $userDB;
        $myedus = $eduDB;
        $myexps = $expDB;
        $expimgs = $imgDB;
        return view('myspace', ['myinfo'=>$myinfo, 'myedus'=> $myedus, 'myexps'=>$myexps, 'expimgs'=>$expimgs]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function welcom()
    {
        $recom_users = null;
        
        $recruits = DB::select('select * from jobDescription');
        //$recruits = null;
        return view('welcome', ['recom_users'=>$recom_users, 'recruits'=> $recruits]);
    }
    
    
    public function show_recruit()
    {
        //
        $user = Auth::user()->name;
        //$jobDB = DB::table('jobDescription')->where('name', $user);
        $myRecruits = DB::select('select * from jobDescription where name = :name', ['name' => $user]);
        
        //$myRecruits = null;
        return view('recruit', ['myRecruits'=>$myRecruits]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
 
    }
    
    // add new recruit
    public function rec_store(Request $request)
    {
        $name = Auth::user()->name;
        $company = $request -> input('company');
        $position = $request -> input('position');
        $description = $request -> input('description');
        
        DB::table('jobDescription')->insert(
            array('name'=>$name, 'companyName'=>$company, 'position'=>$position, 'description'=>$description)
        );
        
        $data['success']="maybe";
        return $data;
    }
    
    // add new experience
    public function exp_store(Request $request)
    {

        $username = $request->input('exp-username');
    

       $company_program= $request -> input('exp-org');
       $beginTime= $request ->input('exp-ftime');
       $endTime= $request ->input('exp-ttime');
       $title= $request ->input('exp-role');
       $description= $request ->input('exp-desc');
       $video = $request->input('exp-video');
    // $expDB = DB::insert('inser into experience (name,company_program,beginTime,endTime,title,description,video) values (name,company_program,beginTime,endTime,title,description,video)', ['name' => $username, 'company_program' => $company_program, 'beginTime'=>$beginTime,'endTime'=>$endTime,'title'=>$title,'description'=>$description,'video'=>$video]);
       DB::table('experience')->insert(
    array('name' => $username, 'company_program' => $company_program, 'beginTime'=>$beginTime, 'endTime'=>$endTime, 'title'=>$title,'description'=>$description,'video'=>$video,'haveimg'=>false)
        );
       // header("Location: /myspace");
        
       return redirect('myspace');
 
    }
    
    // add new education 
    public function edu_store(Request $request){
        $username = $request->input('edu-username');
        $school = $request->input('edu-school');
        $beginTime = $request->input('edu-ftime');
        $endTime = $request->input('edu-ttime');
        $major = $request->input('edu-major');
        $level = $request->input('edu-degree');
        // $description = $request->input('edu-desc');


         DB::table('education')->insert(
            array('name' => $username, 'school' => $school, 'beginTime'=>$beginTime, 'endTime'=>$endTime, 'major'=>$major,'level'=>$level)
        );
         return redirect('myspace');
    }
    
    public function edu_change(Request $request){
        
        $id = $request->input('eedu-id');
        
        $userid = Auth::id();
        $basicDB = DB::table('users')->where('id',$userid);
        $name = $basicDB->value('name');
        
        $school = $request->input('eedu-school');
        $beginTime = $request->input('eedu-ftime');
        $endTime = $request->input('eedu-ttime');
        $major = $request->input('eedu-major');
        $level = $request->input('eedu-degree');
        
        $edutable = DB::table('education')->where('id',$id);
        
        $success = $edutable->update(
            array('name' => $name, 'school' => $school, 'beginTime'=>$beginTime, 'endTime'=>$endTime, 'major'=>$major,'level'=>$level)
        );
        
        //$success = DB::update('update education set name ='.$name.', school ='.$school.', beginTime ='.$beginTime.', endTime ='.$endTime.', major ='.$major.', level ='.$level.' where id = ?', [$id]);
        return redirect('myspace');
         //return "success=".$success.", id=".$id.", ";
    }
    
    public function exp_change(Request $request){
        
        $id = $request->input('eexp-id');
        
        $userid = Auth::id();
        $basicDB = DB::table('users')->where('id',$userid);
        $name = $basicDB->value('name');
        
        $company_program= $request -> input('eexp-org');
        $beginTime= $request ->input('eexp-ftime');
        $endTime= $request ->input('eexp-ttime');
        $title= $request ->input('eexp-role');
        $description= $request ->input('eexp-desc');
        $video = $request->input('eexp-video');
        
        $exptable = DB::table('experience')->where('id',$id);
        
        $success = $exptable->update(
            array('name' => $name, 'company_program' => $company_program, 'beginTime'=>$beginTime, 'endTime'=>$endTime, 'title'=>$title,'description'=>$description,'video'=>$video,'haveimg'=>false)
        );
        
        //$success = DB::update('update education set name ='.$name.', school ='.$school.', beginTime ='.$beginTime.', endTime ='.$endTime.', major ='.$major.', level ='.$level.' where id = ?', [$id]);
        return redirect('myspace');
         //return "success=".$success.", id=".$id.", ";
    }
    
    public function rec_change(Request $request){
        $id = $request->input('erec-id');
        $position = $request->input('erec-position');
        $description = $request->input('erec-description');
        $company = $request->input('erec-company');
        
        $jobtable = DB::table('jobDescription')->where('id', $id);
        $success = $jobtable->update(
            array('position' => $position, 'companyName' => $company, 'description'=>$description)
        );
        
        return redirect('recruit');
    }
    
    public function info_change(Request $request){
        $id = Auth::id();
        $status = $request -> input('einfo-status');
        $major = $request -> input('einfo-major');
        $educationDegree = $request -> input('einfo-edulevel');
        $language = $request -> input('einfo-language');
        $url = $request -> input('einfo-url');
        
        $usertable = DB::table('users')->where('id',$id);
        $success = $usertable->update(
            array('status' => $status, 'major' => $major, 'educationDegree'=>$educationDegree, 'language'=>$language, 'url'=>$url)
        );
        return redirect('myspace');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function sendcv($recid)
    {
        $basicDB = DB::table('users');
        $jobDB = DB::table('jobDescription')->where('id',$recid);
        $to_name = $jobDB->value('name');
        $position = $jobDB->value('position');
        $data['sendto'] = $basicDB->where('name', $to_name)->value('email');
        $data['subject'] = "Apply for ".$position;
        
        
        $name = Auth::user()->name;
        $data['name'] = $name;
        $data['major'] = $basicDB->where('name', $name)->value('major');
        $data['language'] = $basicDB->where('name', $name)->value('language');
        $data['edulevel'] = $basicDB->where('name', $name)->value('educationDegree');
        
        $expDB = DB::select('select * from experience where name = :name', ['name' => $name]);
        $eduDB = DB::select('select * from education where name = :name', ['name' => $name]);
        //$imgDB = DB::select('select * from image where name = :name', ['name' => $name]);
        //$expcont = " ";
        //$educont = " ";
        //$br = "<br>";
        //
        //foreach($expDB as $exp){
        //    $time = $exp->value('beginTime')." -- ".$exp->value('endTime');
        //    $expcont = $expcont+$exp->value('company_program')+$br +$time+$br + $exp->value('title')+$br+$exp->value('description')+$br ;  
        //}
        //foreach($eduDB as $edu){
        //    $time = $edu->value('beginTime')." -- ".$edu->value('endTime');
        //    $educont = $educont+$edu->value('school')+$br +$time+$br + $edu->value('major')+$br+$edu->value('level')+$br ;  
        //}
        $data['exps']=$expDB;
        $data['edus']=$eduDB;
        return $data;
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //

    }
    
    // auto fill baseinfo edit form
    public function info_edit($userid){
        // echo "overhere";

        $basicDB = DB::table('users')->where('id',$userid);
        $myinfo['id'] = $userid;
        $myinfo['name'] = $basicDB->value('name');
        $myinfo['status'] = $basicDB->value('status');
        $myinfo['edulevel'] = $basicDB->value('educationDegree');
        $myinfo['major'] = $basicDB->value('major');
        $myinfo['language'] = $basicDB->value('language');
        $myinfo['imgurl'] = $basicDB->value('url');
        return $myinfo;


    }
    
    
    // auto fill exp_edit form
    public function edu_edit($eduid){
        // echo "overhere";

        $eduDB = DB::table('education')->where('id',$eduid);
        $edu['id'] = $eduid;
        $edu['school'] = $eduDB->value('school');
        $edu['ftime'] = $eduDB->value('beginTime');
        $edu['ttime'] = $eduDB->value('endTime');
        $edu['major'] = $eduDB->value('major');
        $edu['degree'] = $eduDB->value('level');
        
        return $edu;
    }
    
    
    
    // auto fill exp_edit form
    public function exp_edit($expid){
        // echo "overhere";

        $expDB = DB::table('experience')->where('id',$expid);
        $exp['id'] = $expid;
        $exp['orgnization'] = $expDB->value('company_program');
        $exp['ftime'] = $expDB->value('beginTime');
        $exp['ttime'] = $expDB->value('endTime');
        $exp['role'] = $expDB->value('title');
        $exp['desc'] = $expDB->value('description');
        $exp['video'] = $expDB->value('video');
        $exp['haveimg'] = $expDB->value('haveimg');
        
        return $exp;
    }
    
     // auto fill rec_edit form
    public function rec_edit($recid){
        // echo "overhere";

        $recDB = DB::table('jobDescription')->where('id',$recid);
        $rec['id'] = $recid;
        $rec['position'] = $recDB->value('position');
        $rec['companyName'] = $recDB->value('companyName');
        $rec['description'] = $recDB->value('description');
        
        return $rec;
    }
    
    // delete experience
    public function exp_delete($expid){
        DB::table('experience')->where('id', $expid)->delete();
        //header("Location: /");
        $data['success']="maybe";
        return $data;
    }

     // delete education
    public function edu_delete($eduid){
        DB::table('education')->where('id', $eduid)->delete();
        //header("Location: /");
        $data['success']="maybe";
        return $data;
    }
    
     // delete recruit
    public function rec_delete($recid){
        DB::table('jobDescription')->where('id', $recid)->delete();
        //header("Location: /");
        $data['success']="maybe";
        return $data;
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    
}
