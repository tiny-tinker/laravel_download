@extends('layouts.app')

@section('title', 'Download')

@section('content')
<p>
Thank you for your interest in OmniBazaar. The OmniBazaar marketplace, including OmniCoin and CryptoBazaar, is open. <br/> <br/>

<b>The software is free to download and shopping in the marketplace is free.</b> And, during the initial phase of the marketplace, we will even give you some free OmniCoins when you join, when you refer a friend, and when you sell something in the marketplace. We think that makes OmniBazaar and CryptoBazaar <b>"better than free".</b> <br/> <br/>

Remember, the marketplace is "live". So, you should only list products or services you are willing and able to sell.<br/><br/>

If you make purchases, the bitcoins and OmniCoins you are spending are real money. Caveat emptor! ("Buyer beware!")<br/><br/>

We are rapidly developing new features and fixes. Be sure you check frequently for updates.<br/><br/>

Please submit any suggestions, bug reports or requests for support to 
</p>
<a href="http://support.OmniBazzar.com">http://support.OmniBazzar.com</a> <br/><br/>
<b>By clicking the download button below, you confirm that you have read and agree to be bound by the terms of our <b/><a href="http://omnibazaar.com//OMNIBAZAAR BETA AGREEMENT--Click-Through.pdf">OMNIBAZAAR BETA AGREEMENT.</a>
<br/>
<br/>
<div class="row">    
    <div class="well">
        <h1><span class="fa fa-windows"></span> Windows </h1>
        <a href="{{ asset('download/SetupOmniBazaar-Windows.exe') }}">Download Installer</a>
    </div>
</div>
<div class="row">    
    <div class="well">
        <h1><span class="fa fa-linux"></span> Linux </h1>
        <p>Comming Soon</p>
    </div>
</div>
<div class="row">    
    <div class="well">
        <h1><span class="fa fa-apple"></span> Mac </h1>
        <p>Comming Soon</a>
    </div>
</div>
@endsection