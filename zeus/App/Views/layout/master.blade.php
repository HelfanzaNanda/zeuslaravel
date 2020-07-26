@php
$admin_template=config_read('admin_template');
@endphp
@extends('themes.'.$admin_template.'.master')