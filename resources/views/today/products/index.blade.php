<?php 
/**
 * User Controller
 *
 * @copyright  2016 SparkSupport
 * @author     Ajith
 * @date     08-11-16
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
?>
@extends('layouts.admin')
@section('title', 'Main page')

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-9">
        <h2>Live Stream Ingest</h2>
        <ol class="breadcrumb">
          <li>
            <a href="index.html">Home</a>
          </li>
          <li>
            <a>Streaming Video</a>
          </li>
          <li class="active">
            <strong>Live Stream Ingest</strong>
          </li>
        </ol>                    
    </div>
    <div class="col-lg-2">
        <div class="title-action">
            <select class="selectpicker" data-live-search="true" id="channel_name">
            <option value="">All</option>
            @foreach ($stations as $station)
            <option value="{{$station->id}}">{{$station->station_name}}</option>
            @endforeach
      </select>
        </div>
    </div>
</div>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">                                
                    <h5><i class="fa fa-list-alt"></i> Live Stream Listing</h5>
                </div>
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-lg-12">
                            <ul class="list-inline">
                                @foreach ($stations as $station)
                                <li>
                                    <a href="{{ url('/') }}/live-stream-detail/{{$station->id}}" class="thumbnail">
                                        <img src="{{$station->station_logo}}" alt="" style="width: 295px; height: 220px;">
                                        <div class="padding-top-bottom-10">
                                            <strong>{{$station->station_name}}</strong>
                                            <br/>
                                            <small class="text-muted">Online</small>
                                            <i class="fa fa-circle online"></i>
                                        </div>
                                    </a>
                                </li>                 
                                @endforeach
                            </ul>                 
                            <nav class="text-center">
                              <ul class="pagination">
                                @include('pagination.default', ['paginator' => $stations])
                              </ul>
                            </nav>
                        </div>
                    </div>
                </div>            
            </div>
        </div>
    </div>
</div>
@endsection
