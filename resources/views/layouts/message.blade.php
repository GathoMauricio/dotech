<div class="msg_container">
    <div class="msg_content">
        <span onclick="$('.msg_container').hide();" class="icon icon-cross float-right" style="cursor:pointer;"></span>
        <label><span class="icon-checkmark"></span> Mensaje</label>
        <br/>
        {{ Session::get('message') }}
    </div>
</div>
<script type="text/javascript"> 
document.getElementById('message').play();
</script>