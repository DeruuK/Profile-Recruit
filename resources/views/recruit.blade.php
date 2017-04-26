@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">   
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
            <div class="panel-heading">RECRUIT</div>
                <div class="panel-body">
                <div class="well">
                <form id="addRecruit" class="form-group">
                    {{ csrf_field() }}
                    <label for="company">Company</label>
                    <input type="text" name="company" id="company" class="form-control"><br>
                    <label for="position">Position</label>
                    <input type="text" name="position" id="position" class="form-control"><br>
                    <label for="description">Description</label><br>
                    <textarea rows="4" form="addRecruit" name="description" id="description" class="form-control"></textarea><br>
                    <div class="modal-footer">
					<input type="submit" name="addRet" value="Add">
                    </div>
				</form>
                </div>
                <div id="myRecruit">
                    @if($myRecruits != null)
						
						<table class="table">
                            @foreach($myRecruits as $rec)
                                <tr>
                                    <th><h4><b>{{$rec->position}}</b></h4></th>         
                                </tr>
                                <tr>
									<td>
                                        <button class="ms-rec-edit" data-id = "{{$rec->id}}" data-toggle="modal" data-target="#editRec">Edit</button>
                                        <button class="ms-rec-delete" data-id = "{{$rec->id}}" >Delete</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Company: <i>{{$rec->companyName}}</i>
                                    
                                    </td>
                                </tr>
                                <tr>
                                    <td>{{$rec->description}}</td>
                                </tr>
                            @endforeach
						</table>
						
                    @else
                        <h3>No Edu Background yet</h3>
                    @endif
                </div>
                
                </div>
            </div>
        </div>
    </div>
    <!-- edit Recruit modal -->
	<div class="modal fade" id="editRec" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
						&times;
					</button>
					<h4 class="modal-title" id="myModalLabel">
						Edit Recruit
					</h4>
				</div>
				<div class="modal-body">
					<form role="form" id="editRecform" action = "editRecform" method="get">
						<div class="form-group">
                            <input type="hidden" class="form-control" id="erec-id" name="erec-id">
							<label for="erec-position">Position</label>
							<input type="text" class="form-control" name="erec-position" id="erec-position">
							<br>
                            <label for="erec-company">Company</label>
							<input type="text" class="form-control" name="erec-company" id="erec-company">
							<br>
                            <label for="erec-description">Degree</label>
                            <textarea rows="4" form="editRecform" name="erec-description" id="erec-description" class="form-control"></textarea><br>
						<div class="modal-footer">
							<input type="submit" name="RecEdit" value="Edit">
						</div>
						</div>
					</form>
				</div>			
			</div><!-- /.modal-content -->
		</div><!-- /.modal -->
	</div>
        
</div>

@endsection