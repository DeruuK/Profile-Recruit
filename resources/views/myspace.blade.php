@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">   
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">HOME</div>
                <div id ="ms-baseinfo">
                    <div class="panel-heading">
					<table class="table">
                        <tr><th><h3>Baseinfo</h3></th>
                        <!-- FIX ME ----------------------------------    data-id should be {{$myinfo['id']}} -->
                        <td class="showtime"><button id="ms-info-edit" data-id={{$myinfo['id']}} data-toggle="modal" data-target="#editInfo">Edit</button></td>
						</tr>
					</table>
					</div>
                    <div class="panel-body">
                        <div id="ms-showinfo">
                            
                            @if ($myinfo != null)

                            <!--<div id = "myimg">
                                <img id="{{$myinfo['id']}}+img" src="img.php?imgurl={{$myinfo['imgurl']}}"><br>
                            </div>-->

                            <div id = "ms-infotable">
                                <table class="table">
                                    <tr><td>{{ $myinfo['name'] }}</td><td>{{ $myinfo['status'] }}</td></tr>
                                    <tr><td>{{ $myinfo['edulevel'] }}</td><td>{{$myinfo['major']}}</td></tr>
                                    <tr><td colspan="2">Programming Language: {{ $myinfo['language'] }}</td></tr>
                                </table>
                            </div>
                            @else
                                <p>no baseinfo...</p>
                            @endif
                        </div>
                    </div>
                </div>
                <div id = "ms-exper">
                    <div class="panel-heading">
                        <table class="table">
                        <tr><th><h3>Experience</h3></th>
                        
                        <td class="showtime"><button id="ms-exp-add" data-id = {{$myinfo['id']}} data-toggle="modal" data-target="#addExp">Add</button></td>
						</tr>
						</table>
                    </div>
                    <div class="panel-body">
                        <div id="ms-showexp">
                            @if($myexps != null)
								<div class = "showexp">
                                <table class="table">
                                @foreach($myexps as $exp)
                                    
                                           	<tr>
                                                <th colspan="2"><h4><b>{{$exp->company_program}}</b></h4></th>
												<td class="showtime">{{$exp->beginTime}} -- {{$exp->endTime}}</td>
                                             
                                           	</tr>
                                              <tr>
                                        	 	<td>
                                                    <button class="ms-exp-edit" data-id = "{{$exp->id}}" data-toggle="modal" data-target="#editExp">Edit</button>
													<button class="ms-exp-delete" data-id = "{{$exp->id}}" >Delete</button>
                                                </td>
												<td colspan="2"></td>
                                        	 </tr>
                                            <tr>
                                                <td colspan="3">TITLE/ROLE: {{$exp->title}}</td>
                                            </tr>
                                            <tr>
                                                <td colspan="3">DESCRIPTION: {{$exp->description}}</td>
                                            </tr>
 
                                        
                                        @if($exp->haveimg!=null)
										<tr><td colspan="3">
                                            <div id="{{$exp->company_program}}+imgs" class="carousel slide" data-ride="carousel">
                                            <ol class="carousel-indicators">
                                            @for ($i=0; $i<$exp->haveimg; $i++)
                                                @if($i==0)
                                                    <li data-target="#{{$exp->company_program}}+imgs" data-slide-to={{$i}} class="active"></li>
                                                @else
                                                    <li data-target="#{{$exp->company_program}}+imgs" data-slide-to={{$i}}></li>
                                                @endif
                                            @endfor
                                            @foreach($expimgs as $img)
                                                @if(strcmp($img->company_program,$exp->company_program)==0)
                                                    <div class="item active">
                                                        <img src="{{$img->url}}" alt="{{$exp->company_program}}" width="150">
                                                    </div>
                                                @endif
                                            @endforeach
											</td></tr>
                                        @endif
										
                                        @if($exp->video!=null)
											<tr><td colspan="3" class = "showvideo">
                                            <iframe width="560" height="315" src="{{$exp->video}}"></iframe>
											</td></tr>
                                        @endif
                                    
                                @endforeach
								
							</table>
							</div>
                            @else
                                <h3>No Experience yet</h3>
                            @endif
                                                     
                        </div>
                    </div>
                </div>
                <div id = "ms-edubg">
                    <div class="panel-heading">
                        <table class="table">
                        <tr><th><h3>Education Background</h3></th>
                         
                        <td class="showtime"><button id="ms-edu-add" data-id="user_id" data-toggle="modal" data-target="#addEdu">Add</button></td>
						</tr>
						</table>
                    </div>
                    <div class="panel-body">
                         @if($myedus != null)
							 <div class = "showexp">
							 <table class="table">
                            @foreach($myedus as $edu)
                                
                                    
                                        <tr>
                                            <th colspan="2"><h4><b>{{$edu->school}}</b></h4></th>
											<td class="showtime">{{$edu->beginTime}} -- {{$edu->endTime}}</td>
                                            
                                        </tr>
                                        <tr>
											<td>
                                                <button class="ms-edu-edit" data-id = {{$edu->id}} data-toggle="modal" data-target="#editEdu">Edit</button>
												<button class="ms-edu-delete" data-id = {{$edu->id}} >Delete</button>
                                            </td>
                                        	<td colspan="2"></td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">{{$edu->level}} in {{$edu->major}}</td>
                                            <td></td>
                                        </tr>
                                        
                                                   
                                
                            @endforeach
							</table>
							</div>
                        @else
                            <h3>No Edu Background yet</h3>
                        @endif
                    </div>                 
                </div>
            </div>
        </div>
    </div>   

    
<!-- add Edu modal -->
	<div class="modal fade" id="addEdu" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
						&times;
					</button>
					<h4 class="modal-title" id="myModalLabel">
						Add Education
					</h4>
				</div>
				<div class="modal-body">
					<form role="form" id="addEduform" action = "addEduform">
						<div class="form-group">
                        <!--        a hidden input with user id         -->
                            <input type="hidden" id="edu-userid" name="edu-username"  value="{{$myinfo['name']}}">
							<label for="edu-school">School</label>
							<input type="text" class="form-control" name="edu-school" id="edu-school">
							<br>
                            <label for="edu-ftime">from</label>
							<input type="text" class="form-control" name="edu-ftime" id="edu-ftime">
                            <label for="edu-ttime">to</label>
							<input type="text" class="form-control" name="edu-ttime" id="edu-ttime">
							<br>
                            <label for="edu-major">major</label>
							<input type="text" class="form-control" name="edu-major" id="edu-major">
							<br>
                            <label for="edu-degree">Degree</label>
                            <select name="edu-degree" id="edu-degree">
								<option value="BS">B.S.</option>
								<option value="MS">M.S.</option>
								<option value="ME">M.E.</option>
								<option value="PHD">PHD</option>
                                <option value="other">other</option>
							</select><br>
							
							<!-- <label for="edu-desc">Description</label><br>
							<textarea class="form-control" rows="2" form="addEduform" name="edu-desc" id="edu-desc"></textarea> -->
						</div>
						<div class="modal-footer">
							<!--button type="button" class="btn btn-default" data-dismiss="modal">关闭
							</button>-->
							<input type="submit" name="insert" value="Add">
						</div>
					</form>
				</div>
				
			</div><!-- /.modal-content -->
		</div><!-- /.modal -->
	</div>
        
<!-- edit Edu modal -->
	<div class="modal fade" id="editEdu" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
						&times;
					</button>
					<h4 class="modal-title" id="myModalLabel">
						Edit Education
					</h4>
				</div>
				<div class="modal-body">
					<form role="form" id="editEduform" action = "editEduform" method="get">
						<div class="form-group">
                            <input type="hidden" class="form-control" id="eedu-id" name="eedu-id">
							<label for="eedu-school">School</label>
							<input type="text" class="form-control" name="eedu-school" id="eedu-school">
							<br>
                            <label for="eedu-ftime">from</label>
							<input type="text" class="form-control" name="eedu-ftime" id="eedu-ftime">
                            <label for="eedu-ttime">to</label>
							<input type="text" class="form-control" name="eedu-ttime" id="eedu-ttime">
							<br>
                            <label for="eedu-major">major</label>
							<input type="text" class="form-control" name="eedu-major" id="eedu-major">
							<br>
                            <label for="eedu-degree">Degree</label>
                            <select name="eedu-degree" id="eedu-degree">
								<option value="BS">B.S.</option>
								<option value="MS">M.S.</option>
								<option value="ME">M.E.</option>
								<option value="PHD">PHD</option>
                                <option value="other">other</option>
							</select><br>
						<div class="modal-footer">
							<input type="submit" name="EduEdit" value="Edit">
						</div>
						</div>
					</form>
				</div>
				
			</div><!-- /.modal-content -->
		</div><!-- /.modal -->
	</div>
 
 <!-- add Exp modal !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!-->
	<div class="modal fade" id="addExp" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
						&times;
					</button>
					<h4 class="modal-title" id="myModalLabel">
						Add Experience
					</h4>
				</div>
				<div class="modal-body">
					<form role="form" id="addExpform" method="get" action="addExpform">
						<div class="form-group">
							<input type="hidden" id="exp-userid" name="exp-username"  value="{{$myinfo['name']}}">
							<label for="exp-org">Organization</label>
							<input type="text" class="form-control" name="exp-org" id="exp-org">
							<br>
                            <label for="exp-ftime">from</label>
							<input type="text" class="form-control" name="exp-ftime" id="exp-ftime">
                            <label for="exp-ttime">to</label>
							<input type="text" class="form-control" name="exp-ttime" id="exp-ttime">
							<br>
                            <label for="exp-role">role</label>
							<input type="text" class="form-control" name="exp-role" id="exp-role">
							<br>                       
							<label for="exp-desc">Description</label><br>
							<textarea class="form-control" rows="2" form="addExpform" name="exp-desc" id="exp-desc"></textarea>
                            <label for="exp-video">video url</label>
							<input type="text" class="form-control" name="exp-video" id="exp-video">
                            <br>
							<!--<div>UPLOAD IMGS coming soon......</div>-->
							<!-- <form enctype="multipart/form-data" action="upload.php" method="POST">
								<p>
									<input type="hidden" name="MAX_FILE_SIZE" value="20000000" />
									<label for="uploadfile_input">Choose a file to upload:</label> 
									<input name="uploadedfile" type="file" id="uploadfile_input" />
								</p>
								<p>
									<input type="submit" value="Upload File" />
								</p>
							</form> -->
						</div>
						<div class="modal-footer">
						<!--button type="button" class="btn btn-default" data-dismiss="modal">关闭
						</button>-->
						<input type="submit" name="insert" value="Add">
							
						
						</div>
					</form>
				</div>
				
			</div><!-- /.modal-content -->
		</div><!-- /.modal -->
	</div>
        
<!-- edit Exp modal -->
	<div class="modal fade" id="editExp" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
						&times;
					</button>
					<h4 class="modal-title" id="myModalLabel">
						Edit Experience
					</h4>
				</div>
				<div class="modal-body">
					<form role="form" id="editExpform" method="get" action="editExpform">
						<div class="form-group">
							<input type="hidden" class="form-control" id="eexp-id" name="eexp-id">
							<label for="eexp-org">Organization</label>
							<input type="text" class="form-control" name="eexp-org" id="eexp-org">
							<br>
                            <label for="eexp-ftime">from</label>
							<input type="text" class="form-control" name="eexp-ftime" id="eexp-ftime">
                            <label for="exp-ttime">to</label>
							<input type="text" class="form-control" name="eexp-ttime" id="eexp-ttime">
							<br>
                            <label for="eexp-role">role</label>
							<input type="text" class="form-control" name="eexp-role" id="eexp-role">
							<br>
							
							<label for="eexp-desc">Description</label><br>
							<textarea class="form-control" rows="2" form="editExpform" name="eexp-desc" id="eexp-desc"></textarea>
                            <label for="eexp-video">video url</label>
							<input type="text" class="form-control" name="eexp-video" id="eexp-video">
                            <br>
							<!--<div>UPLOAD IMGS coming soon......</div>-->
							<!--<form enctype="multipart/form-data" action="upload.php" method="POST">
								<p>
									<input type="hidden" name="MAX_FILE_SIZE" value="20000000" />
									<label for="uploadfile_input">Choose a file to upload:</label> 
									<input name="uploadedfile" type="file" id="uploadfile_input" />
								</p>
								<p>
									<input type="submit" value="Upload File" />
								</p>
							</form>-->
						</div>
						<div class="modal-footer">
							<input type="submit" name="ExpEdit" value="Edit">
						</div>
					</form>
				</div>
				
			</div><!-- /.modal-content -->
		</div><!-- /.modal -->
	</div>
        
<!-- edit Baseinfo modal -->
	<div class="modal fade" id="editInfo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
						&times;
					</button>
					<h4 class="modal-title" id="myModalLabel">
						Modify Baseinfo
					</h4>
				</div>
				<div class="modal-body">
					<form role="form" id="editInfoform" method="get" action="editINFOform">
						<div class="form-group">
							<h4 name="einfo-name" id="einfo-name"></h4>
							<br>
                            <label for="einfo-status">Status</label>
                            <select name="einfo-status" id="einfo-status">
								<option value="full-time">full time</option>
								<option value="new-graduate">new graduate</option>
								<option value="recruiter">recruiter</option>
							</select><br>
                            <label for="einfo-major">Major</label>
							<input type="text" class="form-control" name="einfo-major" id="einfo-major">
							<br>
                            <label for="einfo-edulevel">Education Level</label>
							<input type="text" class="form-control" name="einfo-edulevel" id="einfo-edulevel">
							<br>
							<label for="einfo-language">Programing Language</label>
							<input class="form-control" name="einfo-language" id="einfo-language"></input>
                            <br>
                            <label for="einfo-url">Video URL</label>
							<input class="form-control" name="einfo-url" id="einfo-url"></input>
                            <br>
						</div>
						<div class="modal-footer">
							<input type="submit" name="InfoEdit" value="Edit">
						</div>
					</form>
				</div>
				
			</div><!-- /.modal-content -->
		</div><!-- /.modal -->
	</div>       

</div>
@endsection