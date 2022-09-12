<?php
$settings_details = App\Models\Setting::get()->first();
?>
<div class="copy">
    <div class="container">
        <a href="/">2021 &copy; All Rights Reserved | Designed and Developed by Diya Patel and Urja Pandav</a>

        <span>
        
            <a href="{{$settings_details->linkedln}}">
                <i class="fab fa-linkedin-in"></i>
            </a>
          
            <a href="{{$settings_details->twitter}}">
                <i class="fab fa-twitter"></i>
            </a>
            <a href="{{$settings_details->facebook}}">
                <i class="fab fa-facebook-f"></i>
            </a>
        </span>
    </div>
</div>