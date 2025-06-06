@push('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.1/dropzone.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.1/dropzone.min.css">
<script>
	// Disabling autoDiscover, otherwise Dropzone will try to attach twice.
	Dropzone.autoDiscover = false;
	$(document).ready(function () {
		// For Documentation Visit : (https://www.dropzonejs.com/)
		$('#dropzoneFileUpload').dropzone({
			url: "{{aurl('upload/image/'. $product->id)}}",
			paramName: 'file',
			uploadMultiple: false,
			autoDiscover: false,
			maxFiles: 15,
			maxFilesize: 3, // MB
			acceptedFiles: 'image/*',
			dictDefaultMessage: "{{trans('admin.dropzoneDefaultMessage')}}",
			dictRemoveFile: "{{trans('admin.delete')}}",	// the text to be used to remove a file
			params: {
				_token: '{{ csrf_token() }}'
			},
			addRemoveLinks: true,
			removedfile: function (file) {
				var fmock;
				$.ajax({
					url: "{{aurl('delete/image')}}",
					dataType: 'json',
					type : 'POST',
					data: {
						_token: '{{ csrf_token() }}',
						id: file.fileId
					}
				});
				// To Delete also The Thumbnail Image From dropzone area
				return (fmock = file.previewElement) != null ? fmock.parentNode.removeChild(file.previewElement) : void 0;
			},
			init: function () {
				@foreach($product->files()->get() as $file)
					var thisDropzone = this;
					// these information that will display on the thumbnail image inside the dropzone area
					var mockFile = { name: "{{$file->name}}", fileId: "{{$file->id}}", size: "{{$file->size}}", type: "{{$file->mime_type}}" };

					// Make sure that there is no progress bar, etc...
					// thisDropzone.emit("addedfile", mockFile);	// first way
					// thisDropzone.addFile.call(thisDropzone, mockFile);	// Second way
					thisDropzone.displayExistingFile(mockFile,'{{ url('storage/'. $file->full_file) }}');
				@endforeach

				this.on('sending', function (file, xhr, formData) {
					formData.append('fid', '');
					file.fid = '';
				});

				this.on('success', function (file, response) {
					file.fid = response.id;	// response is : {status: true, id: 12}
				});
			}
		});

		$('#mainFileUpload').dropzone({
			url: "{{aurl('update/image/'. $product->id)}}",
			paramName: 'file',			// request Name
			uploadMultiple: false,
			autoDiscover: false,
			maxFiles: 1,
			maxFilesize: 3, // MB
			acceptedFiles: 'image/*',
			dictDefaultMessage: "{{trans('admin.dropzoneDefaultMessage')}}",
			dictRemoveFile: "{{trans('admin.delete')}}",	// the text to be used to remove a file
			params: {
				_token: '{{ csrf_token() }}'
			},
			addRemoveLinks: true,
			removedfile: function (file) {
				var fmock;
				$.ajax({
					url: "{{aurl('delete/main/image')}}",
					dataType: 'json',
					type : 'POST',
					data: {
						_token: '{{ csrf_token() }}',
						id: '{{ $product->id }}'
					}
				});
				// To Delete also The Thumbnail Image From dropzone area
				return (fmock = file.previewElement) != null ? fmock.parentNode.removeChild(file.previewElement) : void 0;
			},
			init: function () {
				@if (! empty($product->photo))
					var thisDropzone = this;
					var mockFile = { name: "{{$product->title}}", size: "", type: "" };
					// Make sure that there is no progress bar, etc...
					// thisDropzone.emit("addedfile", mockFile);	// first way
					// thisDropzone.addFile.call(thisDropzone, mockFile);	// Second way
					thisDropzone.displayExistingFile(mockFile,'{{ url('storage/'. $product->photo) }}');
				@endif
				this.on('sending', function (file, xhr, formData) {
					formData.append('fid', '');
					file.fid = '';
				});

				this.on('success', function (file, response) {
					file.fid = response.id;	// response is : {status: true, id: 12}
				});
			}
		});
	});
</script>

@endpush

<div class="tab-pane fade my-3" id="product_media" role="tabpanel" aria-labelledby="product_media-tab">
	<h3>{{ trans('admin.product_main_media') }} {!! ' <span class="text-danger font-weight-bold">*</span>' !!}</h3>
	<div class="dropzone dropzone-previews" id="mainFileUpload"></div>
	<h3>{{ trans('admin.product_photos') }}</h3>
	<div class="dropzone dropzone-previews" id="dropzoneFileUpload"></div>
</div>
