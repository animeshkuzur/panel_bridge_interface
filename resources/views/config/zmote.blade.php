<!DOCTYPE html>
<html>
<head>
	<title>SILOP :: Smart Intelligent Living Our Promise</title>
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="{{URL::asset('/css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{URL::asset('/css/styles.css')}}">
</head>
<body>
	<nav class="navbar navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="/">
                
                Panel Bridge Interface 
            </a>
            <form class="form-inline" method="GET" action="{{ url('/reboot') }}">
                <button class="btn btn-outline-warning my-2 my-sm-0" type="submit">Save and Reboot</button>
            </form>
        </div>        
    </nav>
	<div class="config-panel">
		<div class="container">
			<div class="title">
				ZMote Bridge<a href="http://silop.in" target="_blank"><img src="{{ URL::asset('/assets/logo.png') }}" height="60" width="144" class="float-right"></a>
			</div>
			<hr>
			<div class="errors">
									@if($errors)
					                    @if(count($errors))
					                        @foreach($errors->all() as $error)
					                            <div class="alert alert-danger alert-dismissible" role="alert">
					                                <font style="font-size: 12px; padding: 0px; margin : 0px;">
					                                    {{$error}}
					                                </font>
					                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
					                                    <span aria-hidden="true">&times;</span>
					                                          
					                                </button>
					                            </div>
					                        @endforeach
					                    @endif
					                @endif
								</div>
			<div class="content">
				<div class="zmote">
					<div class="title">
						ZMote : <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#add_zmote">Add a new ZMote</button>
					</div>
					<div class="content">
						<table class="table table-striped table-sm">
						  <thead>
						    <tr>
						      <th scope="col">Device ID</th>
						      <th scope="col">UUID</th>
						      <th scope="col">IP Address</th>
						      <th scope="col">Action</th>
						    </tr>
						  </thead>
						  <tbody>
						    @if($zmotes!=NULL)
						    	@foreach($zmotes as $zmote)
						    		<tr>
								      <td>{{ $zmote['device_id'] }}</td>
								      <td>{{ $zmote['UUID'] }}</td>
								      <td>{{ $zmote['ip_addr'] }}</td>
								      <td><a href="{{ url('/zmote/').'/'.$zmote['id'].'/delete/zmote' }}" class="btn btn-sm btn-outline-danger">Delete</a> <button class="btn btn-sm btn-outline-primary">Edit</button></td>
								    </tr>
						    	@endforeach
						    @endif
						  </tbody>
						</table>
					</div>
				</div>
				<!--   -->
				<div class="devices">
					<div class="title">
						Panels : <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#add_device">Add a new panel</button>
					</div>
					
					<div class="content">
						<table class="table table-striped table-sm">
						  <thead>
						    <tr>
						      <th scope="col">Device ID</th>
						      <th scope="col">IP Address</th>
						      <th scope="col">Port</th>
						      <th scope="col">Action</th>
						    </tr>
						  </thead>
						  <tbody>
						    @if($devices!=NULL)
						    	@foreach($devices as $device)
						    		<tr>
								      <td>{{ $device['device_id'] }}</td>
								      <td>{{ $device['ip_addr'] }}</td>
								      <td>{{ $device['port'] }}</td>
								      <td><a href="{{ url('/zmote/').'/'.$device['id'].'/delete/device' }}" class="btn btn-sm btn-outline-danger">Delete</a> <button class="btn btn-sm btn-outline-primary" data-toggle="modal" data-target="#edit_device">Edit</button></td>
								    </tr>
						    	@endforeach
						    @endif

						  </tbody>
						</table>
					</div>
				</div>
				<!--   -->
				<div class="buttons">
					<div class="title">
						Map Panel Buttons : <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#add_button">Map a new button</button>
					</div>
					<div class="content">
						<div class="table-responsive">
						<table class="table table-striped table-sm">
						  <thead>
						    <tr>
						      <th scope="col">UUID</th>
						      <th scope="col">Button ID</th>
						      <th scope="col">Action</th>
						      <th scope="col">IR Code</th>
						    </tr>
						  </thead>
						  <tbody>
						    @if($buttons!=NULL)
						    	@foreach($buttons as $button)
						    		<tr>
								      <td>{{ $button['UUID'] }}</td>
								      <td>{{ $button['button_id'] }}</td>
								      <td><a href="{{ url('/zmote/').'/'.$button['id'].'/delete/button' }}" class="btn btn-sm btn-outline-danger">Delete</a> <button class="btn btn-sm btn-outline-primary">Edit</button></td>
								      <td>{{ $button['ir_code'] }}</td>
								    </tr>
						    	@endforeach
						    @endif
						  </tbody>
						</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

		<!-- Add Device Modal -->
        <div class="modal fade" id="add_device" tabindex="-1" role="dialog" aria-labelledby="add_device" aria-hidden="true">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Add a New Device</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="container">
                    <div class="row">
                        <div class="col">
                            <div class="title">
                                {!! Form::open(array('route' => 'zmote/add/device','method'=>'POST')) !!}
                         		<div class="row">
                         			<div class="col">
                         				<div class="form-group">
		                                	<label for="device_id">Device ID</label>
		                                	<input type="text" name="device_id" id="device_id" class="form-control form-control-sm">
		                                </div>
                         			</div>
                         			<div class="col">
                         				<div class="form-group">
                                			<label for="ip_addr">IP Address</label>
		                                	<input type="text" name="ip_addr" id="ip_addr" class="form-control form-control-sm">
        		                        </div>
                         			</div>
                         		</div>
                				<div class="row">
                					<div class="col">
                						<div class="form-group">
		                                	<label for="port">Port</label>
		                                	<input type="text" name="port" id="port" class="form-control form-control-sm">
		                                </div>
                					</div>
                					<div class="col">
                						
                					</div>
                				</div>                
                               
                                
                            </div>
                        </div>
                    </div>
                    
                </div>
              </div>
              <div class="modal-footer">
              	<button type="submit" class="btn btn-success">Add</button>
                {!! Form::close() !!}
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
              </div>
            </div>
          </div>
        </div>

        <!-- Add Zmote Modal -->
        <div class="modal fade" id="add_zmote" tabindex="-1" role="dialog" aria-labelledby="add_zmote" aria-hidden="true">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Add a New ZMote</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="container">
                    <div class="row">
                        <div class="col">
                            <div class="title">
                                {!! Form::open(array('route' => 'zmote/add/zmote','method'=>'POST')) !!}
                         		<div class="row">
                         			<div class="col">
                         				<div class="form-group">
		                                	<label for="device_id">Device ID</label>
		                                	<select class="form-control form-control-sm" id="device_id" name="device_id">
                                                @if($devices!=NULL)
											    	@foreach($devices as $device)
											    			<option value="{{ $device['device_id'] }}">{{ $device['device_id'] }}</option>		      
											    	@endforeach
											    @endif
                                            </select>
		                                </div>
                         			</div>
                         			<div class="col">
                         				<div class="form-group">
                                			<label for="ip_addr">UUID</label>
		                                	<input type="text" name="UUID" id="UUID" class="form-control form-control-sm">
        		                        </div>
                         			</div>
                         		</div>
                				<div class="row">
                					<div class="col">
                						<div class="form-group">
		                                	<label for="port">IP Address</label>
		                                	<input type="text" name="ip_addr" id="ip_addr" class="form-control form-control-sm">
		                                </div>
                					</div>
                					<div class="col">
                						
                					</div>
                				</div>                
                               
                                
                            </div>
                        </div>
                    </div>
                    
                </div>
              </div>
              <div class="modal-footer">
              	<button type="submit" class="btn btn-success">Add</button>
                {!! Form::close() !!}
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
              </div>
            </div>
          </div>
        </div>

        <!-- Edit Device Modal -->
        <div class="modal fade" id="edit_device" tabindex="-1" role="dialog" aria-labelledby="edit_device" aria-hidden="true">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Edit Device</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="container">
                    <div class="row">
                        <div class="col">
                            <div class="title">
                                
                            </div>
                        </div>
                    </div>
                    
                </div>
              </div>
              <div class="modal-footer">
                <a href="#" class="btn btn-success">Save</a>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
              </div>
            </div>
          </div>
        </div>


        <!-- Add Button Modal -->
        <div class="modal fade" id="add_button" tabindex="-1" role="dialog" aria-labelledby="add_button" aria-hidden="true">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle2">Add a New Button</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="container">
                    <div class="row">
                        <div class="col">
                            <div class="title">

                                {!! Form::open(array('route' => 'zmote/add/button','method'=>'POST')) !!}
                                <div class="row">
                         			<div class="col">
                         				<div class="form-group">
		                                	<label for="device_id">Device ID</label>
		                                	<select class="form-control form-control-sm" id="device_id" name="device_id">
                                                
                                                
                                                @if($devices!=NULL)
											    	@foreach($devices as $device)
											    			<option value="{{ $device['device_id'] }}">{{ $device['device_id'] }}</option>		      
											    	@endforeach
											    @endif
                                            </select>
		                                </div>
                         			</div>
                         			<div class="col">
                         				<div class="form-group">
                                			<label for="zmote_uuid">ZMote UUID</label>
		                                	<select class="form-control form-control-sm" id="zmote_uuid" name="zmote_uuid">
                                                @if($zmotes!=NULL)
											    	@foreach($zmotes as $zmote)
											    			<option value="{{ $zmote['UUID'] }}">{{ $zmote['UUID'] }}</option>
											    	@endforeach
											    @endif
                                            </select>
        		                        </div>
                         			</div>
                         		</div>
                				<div class="row">
                					<div class="col">
                						<div class="form-group">
		                                	<label for="type">Button Type</label>
		                                	<select class="form-control form-control-sm" id="type" name="type">
                                                <option value="ON">ON</option>
                                                <option value="OFF">OFF</option>
                                                <option value="16">16</option>
                                                <option value="17">17</option>
                                                <option value="18">18</option>
                                                <option value="19">19</option>
                                                <option value="20">20</option>
                                                <option value="21">21</option>
                                                <option value="22">22</option>
                                                <option value="23">23</option>
                                                <option value="24">24</option>
                                                <option value="25">25</option>
                                                <option value="26">26</option>
                                                <option value="27">27</option>
                                                <option value="28">28</option>
                                                <option value="29">29</option>
                                                <option value="30">30</option>
                                                <option value="LOW">LOW</option>
                                                <option value="MED">MED</option>
                                                <option value="HIGH">HIGH</option>
                                            </select>
		                                </div>
                					</div>
                					<div class="col">
                						
                					</div>
                				</div>
                				
                				<div class="row">
                					<div class="col">
                						<div class="form-group">
		                                	<label for="ir_code">IR Code</label>
		                                	<textarea rows="3" name="ir_code" id="ir_code" class="form-control form-control-sm"></textarea>
		                                </div>
                					</div>
                				</div>
                            </div>
                        </div>
                    </div>
                    
                </div>
              </div>
              <div class="modal-footer">
              	<button type="submit" class="btn btn-success">Add</button>
                {!! Form::close() !!}
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
              </div>
            </div>
          </div>
        </div>

	<script src="{{URL::asset('/js/jquery.min.js')}}"></script>
    <script src="{{URL::asset('/js/popper.min.js')}}"></script>
    <script src="{{URL::asset('/js/bootstrap.min.js')}}"></script>
</body>
</html>