@extends('layouts.app')

@section('title', 'Download')

@section('content')
    <div class="row margin-0">
        <p>
            As a Publisher you receive OmniCoins for each new user listing that other users publish on your server. But, you must keep your server continuously running and connected to the Internet, in order for those listings to be available.
        </p>
        <p>
        The compressed files on this page install a database and web server on your computer. Please read the README.txt file for details. If you would like to run these Publisher programs when your computer starts, go to "Preferences" in OmniBazaar and enable the setting there.
        </p>
        <p>
            You will need at least a dual-core processor and 8GB of RAM to run the Publisher software. You must also have either a static IP address or a DNS redirect service such as <a target="_blank" href="https://dyn.com/dns/ ">DynDNS</a> or <a target="_blank" href=" https://www.noip.com/">NoIP</a>.
        </p>

        <p>Please submit any suggestions, bug reports or requests for support to</p>
        <a href="http://support.OmniBazaar.com">http://support.OmniBazzar.com</a> <br/><br/>
        <b>By clicking the download button below, you confirm that you have read and agree to be bound by the terms of our <b/><a href="http://omnibazaar.com//OMNIBAZAAR BETA AGREEMENT--Click-Through.pdf">OMNIBAZAAR BETA AGREEMENT.</a>
            <br/>
            <br/>
            <div class="row">
                <div class="well">
                    <h1><span class="fa fa-windows"></span> Windows </h1>
                    <a href="{{ route('publisherDownload.windows') }}">Download Installer</a>
                </div>
            </div>
            <div class="row">
                <div class="well">
                    <h1><span class="fa fa-linux"></span> Linux </h1>
                    <a href="{{ route('publisherDownload.linux') }}">Download Installer</a>
                </div>
            </div>
            <div class="row">
                <div class="well">
                    <h1><span class="fa fa-apple"></span> Mac </h1>
                    <a href="{{ route('publisherDownload.mac') }}">Download Installer</a>
                </div>
            </div>
    </div>
@endsection