<p id="p_message" class="bg-success font-weight-bold" style="padding:3px;padding-left:10px;color:white;border-radius:10px;">
    <span onclick="$('#p_message').hide();" class="icon icon-cross float-right" style="cursor:pointer;padding:5px;"></span>
    {{ Session::get('message') }}
</p>