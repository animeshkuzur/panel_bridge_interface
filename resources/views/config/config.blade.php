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
                <button class="btn btn-outline-warning my-2 my-sm-0 btn-sm" type="submit">Save and Reboot</button>
            </form>
        </div>        
    </nav>
	<div class="config-panel">
		<div class="container">
			<div class="title">
				Configure Bridge <a href="http://silop.in" target="_blank"><img src="{{ URL::asset('/assets/logo.png') }}" height="60" width="144" class="float-right"></a>
			</div>
			<hr>
			<div class="content">
				<a href="{{ url('/sbus') }}" class="btn btn-primary btn-lg">FIBARO</a>
                <a href="{{ url('/zmote') }}" class="btn btn-primary btn-lg">ZMOTE</a>
                <hr>
                <button  class="btn btn-danger" data-toggle="modal" data-target="#confirm">Reset</button>
			</div>
		</div>
	</div>
    <!-- Modal -->
        <div class="modal fade" id="confirm" tabindex="-1" role="dialog" aria-labelledby="roomDetails" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Warning!</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="container">
                    <div class="row">
                        <div class="col">
                            <div class="title">
                                All the saved configuration will be lost, are you sure want to reset the device?
                            </div>
                        </div>
                    </div>
                    
                </div>
              </div>
              <div class="modal-footer">
                <a href="{{ url('/reset') }}" class="btn btn-success">Yes</a>
                <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
                <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
              </div>
            </div>
          </div>
        </div>
	<script src="{{URL::asset('/js/jquery.min.js')}}"></script>
    <script src="{{URL::asset('/js/popper.min.js')}}"></script>
    <script src="{{URL::asset('/js/bootstrap.min.js')}}"></script>
</body>
</html>