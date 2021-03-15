
<!--
<p id="p_message" class="bg-success font-weight-bold" style="padding:3px;padding-left:10px;color:white;border-radius:10px;">
    <span onclick="$('#p_message').hide();" class="icon icon-cross float-right" style="cursor:pointer;padding:5px;"></span>
    {{ Session::get('message') }}
</p>
-->
<div class="msg_container">
    <div class="msg_content">
        <span onclick="$('.msg_container').hide();" class="icon icon-cross float-right" style="cursor:pointer;"></span>
        <br/>
        {{ Session::get('message') }}
    </div>
</div>
<audio id="notification" preload="auto">
  <source src="{{ asset('sound/pristine.mp3') }}" type="audio/mp3">
</audio>
<script type="text/javascript"> 
document.getElementById('notification').play();
</script>