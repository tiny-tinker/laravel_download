@extends('layouts.app')

@section('title', 'Download')

@section('content')
<div class="row margin-0">
    <p>
    Thank you for your interest in OmniBazaar. The OmniBazaar marketplace, including OmniCoin and CryptoBazaar, is open. <br/> <br/>

    <b>The software is free to download and shopping in the marketplace is free.</b> And, during the initial phase of the marketplace, we will even give you some free OmniCoins when you join, when you refer a friend, and when you sell something in the marketplace. We think that makes OmniBazaar and CryptoBazaar <b>"better than free".</b> <br/> <br/>

    Remember, the marketplace is "live". So, you should only list products or services you are willing and able to sell.<br/><br/>

    If you make purchases, the bitcoins and OmniCoins you are spending are real money. Caveat emptor! ("Buyer beware!")<br/><br/>

    We are rapidly developing new features and fixes. Be sure you check frequently for updates.<br/><br/>

    Please submit any suggestions, bug reports or requests for support to 
    </p>
    <a href="http://support.OmniBazaar.com">http://support.OmniBazzar.com</a> <br/><br/>
    <b>By clicking the download button below, you confirm that you have read and agree to be bound by the terms of our <b/><a href="http://omnibazaar.com//OMNIBAZAAR BETA AGREEMENT--Click-Through.pdf">OMNIBAZAAR BETA AGREEMENT.</a>
    <br/>
    <br/>
    <div class="row">    
        <div class="well">
            <h1><span class="fa fa-windows"></span> Windows </h1>
            <a class='download-link' data-href="{{ route('download.windows') }}">Download Installer</a>
        </div>
    </div>
    <div class="row">    
        <div class="well">
            <h1><span class="fa fa-linux"></span> Linux </h1>
            <a class='download-link' data-href="{{ route('download.linux') }}" onClick=>Download Installer</a>
        </div>
    </div>
    <div class="row">    
        <div class="well">
            <h1><span class="fa fa-apple"></span> Mac </h1>
            <a class='download-link' data-href="{{ route('download.mac') }}">Download Installer</a>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $('document').ready(function(){        
        $('.download-link').click(handleDownloadClick);
    });

    const handleDownloadClick = function() {
        console.log('Download link clicked');
        $('#fader').css('display', 'flex');
        setCookie('downloadStarted', 0, 100); //Expiration could be anything... As long as we reset the value
        console.log($(this).data('href'));
        window.location = $(this).data('href');
        setTimeout(checkDownloadCookie, 100); //Initiate the loop to check the cookie.
    }
    
    var setCookie = function(name, value, expiracy) {
        var exdate = new Date();
        exdate.setTime(exdate.getTime() + expiracy * 1000);
        var c_value = escape(value) + ((expiracy == null) ? "" : "; expires=" + exdate.toUTCString());
        document.cookie = name + "=" + c_value + '; path=/';
    };

    var getCookie = function(name) {
        console.log(name);        
        console.log(document.cookie);
        var i, x, y, ARRcookies = document.cookie.split(";");
        for (i = 0; i < ARRcookies.length; i++) {
            x = ARRcookies[i].substr(0, ARRcookies[i].indexOf("="));
            y = ARRcookies[i].substr(ARRcookies[i].indexOf("=") + 1);
            console.log(ARRcookies[i]);
            x = x.replace(/^\s+|\s+$/g, "");
            if (x == name) {
                return y ? decodeURI(unescape(y.replace(/\+/g, ' '))) : y; //;//unescape(decodeURI(y));
            }
        }
    };

    var downloadTimeout;
    var checkDownloadCookie = function() {

        console.log('CHECKING COOKIE');
        console.log(getCookie("downloadStarted"));
    if (getCookie("downloadStarted") == 1) {
        setCookie("downloadStarted", "false", 100); //Expiration could be anything... As long as we reset the value
        $('#fader').css('display', 'none');
    } else {
        downloadTimeout = setTimeout(checkDownloadCookie, 1000); //Re-run this function in 1 second.
    }
};

</script>
@endsection