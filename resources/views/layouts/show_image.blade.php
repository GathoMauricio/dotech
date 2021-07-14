<div class="show-image-modal" id="show_image_modal">
    <span 
    class="icon-cross cross-close" 
    onclick="$('#show_image_modal').css('display','none')"></span>
    <div id="show_image_container">
        <div id="show_image_description"></div>
    </div>
</div>
<input type="hidden" id="txt_show_service_image" value="{{ route('show_service_image') }}">
