        <!-- Google web fonts -->
	<link href="http://fonts.googleapis.com/css?family=PT+Sans+Narrow:400,700" rel='stylesheet' />

	<!-- The main CSS file -->
	<link href="/bower_components/Mini-AJAX-File-Upload-Form/assets/css/style.css" rel="stylesheet" />
        
        <style>
            #upload {
                margin: 10px auto 100px;
            }
            #drop{

                border-image: url('/bower_components/Mini-AJAX-File-Upload-Form/assets/img/border-image.png') 25 repeat;
            }
            #upload ul li span{
                background: url('/bower_components/Mini-AJAX-File-Upload-Form/assets/img/icons.png') no-repeat;
            }
            html{
                background-color:initial;

                background-image:initial;
                background-image:initial;
                background-image:initial;

                min-height:initial;
            }
        </style>
        
        <form id="upload" method="post" action="{{$url_controller}}/upload?_token={{csrf_token()}}" enctype="multipart/form-data">
			<div id="note"></div>
			<div id="drop">
				Кинте файл

				<a>Обзор</a>
				<input type="file" name="upl" multiple />
			</div>

			<ul>
				<!-- The file uploads will be shown here -->
			</ul>

	</form>

		<!-- JavaScript Includes 
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
                -->
		<script src="/bower_components/Mini-AJAX-File-Upload-Form/assets/js/jquery.knob.js"></script>

		<!-- jQuery File Upload Dependencies -->
		<script src="/bower_components/Mini-AJAX-File-Upload-Form/assets/js/jquery.ui.widget.js"></script>
		<script src="/bower_components/Mini-AJAX-File-Upload-Form/assets/js/jquery.iframe-transport.js"></script>
		<script src="/bower_components/Mini-AJAX-File-Upload-Form/assets/js/jquery.fileupload.js"></script>
		
		<!-- Our main JS file -->
		<script src="/bower_components/Mini-AJAX-File-Upload-Form/assets/js/script.js"></script>


		<!-- Only used for the demos. Please ignore and remove. 
            <script src="http://cdn.tutorialzine.com/misc/enhance/v1.js" async></script>
        --> 