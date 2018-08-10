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
  <div class="counter" hidden="hidden" id="counter">
    <div class="text">
      <h5>Reboot Initiated</h5>
      <div class="sec" id="sec">
        45
      </div>seconds remaining
    </div>
  </div>
  <nav class="navbar navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="/">
                
                Panel Bridge Interface 
            </a>
                <button class="btn btn-outline-warning my-2 my-sm-0 btn-sm" id="snr" name="snr">Save and Reboot</button>   
        </div>        
    </nav>
	<div class="config-panel">
		<div class="container">
			<div class="title">
				Fibaro Bridge <a href="{{ url('/').'/reload/1' }}" class="btn btn-outline-secondary">Reload</a> <a href="http://silop.in" target="_blank"><img src="{{ URL::asset('/assets/logo.png') }}" height="60" width="144" class="float-right"></a>
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
        <div class="devices">
          <div class="title">
            Fibaro Gateway : <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#add_gateway">Add a new gateway</button>
          </div>
          <div class="content">
            <table class="table table-striped table-sm">
              <thead>
                <tr>
                  <th scope="col">Fibaro IP Address</th>
                  <th scope="col">Fibaro Username</th>
                  <th scope="col">Fibaro Password</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody>
                @if($gateways!=NULL)
                  @foreach($gateways as $gateway)
                    <tr>
                      <td>{{ $gateway['ip_addr'] }}</td>
                      <td>{{ $gateway['username'] }}</td>
                      <td>{{ $gateway['password'] }}</td>
                      <td><a href="{{ url('/sbus/').'/'.$gateway['id'].'/delete/gateway' }}" class="btn btn-sm btn-outline-danger">Delete</a> <!-- <button class="btn btn-sm btn-outline-primary" data-toggle="modal" data-target="#edit_device">Edit</button> --></td>
                    </tr>
                  @endforeach
                @endif
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <!--   -->
			<div class="content">
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
								      <td><a href="{{ url('/sbus/').'/'.$device['id'].'/delete/device' }}" class="btn btn-sm btn-outline-danger">Delete</a> <!-- <button class="btn btn-sm btn-outline-primary" data-toggle="modal" data-target="#edit_device">Edit</button> --></td>
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
						<table class="table table-striped table-sm">
						  <thead>
						    <tr>
						      <th scope="col">Device ID</th>
						      <th scope="col">Button ID</th>
						      <th scope="col">Target ID</th>
						      <th scope="col">Fibaro IP Address</th>
						      <th scope="col">Fibaro Username</th>
						      <th scope="col">Fibaro Password</th>
						      <th scope="col">Button Type</th>
						      <th scope="col">Action</th>
						    </tr>
						  </thead>
						  <tbody>
						    @if($buttons!=NULL)
						    	@foreach($buttons as $button)
						    		<tr>
								      <td>{{ $button['device_id'] }}</td>
								      <td>{{ $button['button_id'] }}</td>
								      <td>{{ $button['target_id'] }}</td>
								      <td>{{ $button['ip_addr'] }}</td>
								      <td>{{ $button['username'] }}</td>
								      <td>{{ $button['password'] }}</td>
								      <td>{{ $button['type'] }}</td>
								      <td><a href="{{ url('/sbus/').'/'.$button['id'].'/delete/button' }}" class="btn btn-sm btn-outline-danger">Delete</a> <!-- <button class="btn btn-sm btn-outline-primary">Edit</button> --></td>
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
                                {!! Form::open(array('route' => 'sbus/add/device','method'=>'POST')) !!}
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

        <!-- Add Gateway Modal -->
        <div class="modal fade" id="add_gateway" tabindex="-1" role="dialog" aria-labelledby="add_gateway" aria-hidden="true">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Add a New Gateway</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="container">
                    <div class="row">
                        <div class="col">
                            <div class="title">
                                {!! Form::open(array('route' => 'sbus/add/gateway','method'=>'POST')) !!}
                            <div class="row">
                              <div class="col">
                                <div class="form-group">
                                      <label for="ip_addr">Fibaro IP Address</label>
                                      <input type="text" name="ip_addr" id="ip_addr" class="form-control form-control-sm">
                                    </div>
                              </div>
                              <div class="col">
                                <div class="form-group">
                                      <label for="username">Fibaro Username</label>
                                      <input type="text" name="username" id="username" class="form-control form-control-sm">
                                    </div>
                              </div>
                            </div>
                        <div class="row">
                          <div class="col">
                            <div class="form-group">
                                      <label for="password">Fibaro Password</label>
                                      <input type="text" name="password" id="password" class="form-control form-control-sm">
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
                <h5 class="modal-title" id="exampleModalLongTitle2">Map a New Button</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="container">
                    <div class="row">
                        <div class="col">
                            <div class="title">

                                {!! Form::open(array('route' => 'sbus/add/button','method'=>'POST')) !!}
                                <div class="row">
                         			<div class="col">
                         				<div class="form-group">
		                                	<label for="device_id">Panel Device ID</label>
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
                                			<label for="button_id">Panel Button ID</label>
		                                	<input type="text" name="button_id" id="button_id" class="form-control form-control-sm">
        		                        </div>
                         			</div>
                         		</div>
                				<div class="row">
                					<div class="col">
                						<div class="form-group">
		                                	<label for="port">Fibaro Target Device ID</label>
		                                	<input type="text" name="target_id" id="target_id" class="form-control form-control-sm">
		                                </div>
                					</div>
                					<div class="col">
                						<div class="form-group">
		                          <label for="ip_addr">Fibaro IP Address</label>
		                           	<select class="form-control form-control-sm" id="ip_addr" name="ip_addr">
                                  @if($gateways!=NULL)
                                    @foreach($gateways as $gateway)
                                        <option value="{{ $gateway['ip_addr'] }}">{{ $gateway['ip_addr'] }}</option>          
                                    @endforeach
                                  @endif
                                </select>
		                        </div>
                					</div>
                				</div>
                				
                				<div class="row">
                					<div class="col">
                						<div class="form-group">
		                                	<label for="type">Device Type</label>
		                                	<select class="form-control form-control-sm" id="type" name="type">
                                                <option value="toggle">toggle</option>
                                                <option value="scene">scene</option>
                                                <option value="dim">dim</option>
                                                <option value="other">other</option>
                                            </select>
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

	<script src="{{URL::asset('/js/jquery.min.js')}}"></script>
    <script src="{{URL::asset('/js/popper.min.js')}}"></script>
    <script src="{{URL::asset('/js/bootstrap.min.js')}}"></script>
    <script type="text/javascript">
      $('#snr').on('click', function() {

        $('#counter').removeAttr('hidden');

        $.ajax({
          url: "{{ url('/reboot') }}",
          type: "GET",
          data: null,
          success: function(response) {
            console.log(response);
          },
          error: function(xhr) {
            
          }
        });
        var i=45;

         
          setInterval(function(){
            if(i>=0){
              $('#sec').text(i);
              /*console.log(i);  */
            }
            else{
              window.location.reload();
            }
            i--;

          }, 1000);

        

      });
    </script>
</body>
</html>