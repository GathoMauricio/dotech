@extends('layouts.app')
@section('content')
<br><br>
<h4 class="title_page">Test</h4>
<script type="text/javascript"
	src="https://slideshow.triptracker.net/slide.js"></script>
<script type="text/javascript">
  var viewer = new PhotoViewer();
  viewer.disableEmailLink();
  viewer.disablePhotoLink();
  viewer.enableLoop();
  viewer.enableAutoPlay();
  viewer.add('{{ asset("img/fb.png") }}');
</script>
<a href="javascript:void(viewer.show(0))">Slideshow</a>
@endsection